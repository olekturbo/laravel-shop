<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Mail\OrderPaid;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;


class TransferController extends Controller
{
    public function order(Request $request) {
            $client = new Client();
            $products = $request->session()->get('cart');

            /* API */
            $id = config('tpay.tpay_id');
            $api_key = config('tpay.tpay_api_key');
            $api_password = config('tpay.tpay_api_password');
            $api_security = config('tpay.tpay_security');
            $api_email = config('tpay.tpay_email');

            /* TRANSACTION */
            $randomNumber = $this->generateRandomString();
            $description = 'Płatność za transakcję ' . $randomNumber;
            $price = $products->totalPrice;
            $crc = rand ( 1000 , 9999 );;
            $group = $request->group ?? 103;
            $md5sum = md5($id.$price.$crc.$api_security);
            $rules_confirmation = $request->rules_confirmation ? 1 : 0;
            $email = $request->email;
            $name = $request->first_name . " " . $request->last_name;
            $address = $request->street;
            $city = $request->city;
            $zip = $request->post_code;
            $phone = $request->phone;

            /* POST */
            $URI = 'https://secure.tpay.com/api/gw/'.$api_key.'/transaction/create';
            $params['form_params'] = [
                'api_password' => $api_password,
                'id' => $id,
                'amount' => $price,
                'description' => $description,
                'crc' => $crc,
                'md5sum' => $md5sum,
                'group' => $group,
                'name' => 'test user',
                'result_url' => route('transfer.callback'),
                'result_email' => $api_email,
                'return_url' => route('transfer.success'),
                'return_error_url' => route('transfer.error'),
                'accept_tos' => $rules_confirmation,
                'email' => $email,
                'name' => $name,
                'address' => $address,
                'city' => $city,
                'zip' => $zip,
                'phone' => $phone,
                'merchant_description' => 'Laravel MyOwnApp'
            ];
            $response = $client->post($URI, $params);

            $data = simplexml_load_string($response->getBody()->getContents());

            /* NEW PAYMENT */
            $payment = new Payment([
                'seller_id' => $id,
                'tr_id' => $data->title,
                'tr_amount' => $data->amount,
                'md5sum' => $md5sum,
                'tr_crc' => $crc
            ]);
            $payment->save();

            /* NEW ORDER */
            $order = new Order([
                'number' => $randomNumber,
                'price' => $price,
                'payment_id' => $payment->id
            ]);
            $order->save();

            $items = $products->items;
            foreach($items as $sizes) {
                foreach($sizes as $size => $item) {
                    $order->products()->attach($item['item']->id, [
                        'quantity' => $item['qty'],
                        'size' => $size
                    ]);
                    $item['item']->quantity -= $item['qty'];
                    $item['item']->save();
                }
            }

            /* MAIL */
            Mail::to($email)->send(new OrderCreated($order));

            $request->session()->put('order', $order->number);
            $request->session()->put('email', $email);

            return redirect()->away($data->url);

    }
    public function callback(Request $request) {
        // sprawdzenie adresu IP oraz występowania zmiennych POST
        $ip_table = array('195.149.229.109', '148.251.96.163', '178.32.201.77',
            '46.248.167.59', '46.29.19.106'); $_POST['id'];
        if (in_array($_SERVER['REMOTE_ADDR'], $ip_table) && !empty($request)){
            $seller_id = $request['id'];
            $tr_status = $request['tr_status'];
            $tr_id = $request['tr_id'];
            $tr_amount = $request['tr_amount'];
            $tr_paid = $request['tr_paid'];
            $tr_error = $request['tr_error'];
            $tr_date = $request['tr_date'];
            $tr_desc = $request['tr_desc'];
            $tr_crc = $request['tr_crc'];
            $tr_email = $request['tr_email'];
            $md5sum = $request['md5sum'];

            $payment = Payment::where('tr_id', $tr_id)->first();

            $checkMD5 = $this->isMd5Valid(
                $md5sum,
                number_format($tr_amount, 2, '.', ''),
                $tr_crc,
                $tr_id
            );

            if($tr_status=='TRUE' && $tr_error=='none'){
                if($checkMD5 !== false) {
                    $payment->tr_status = $tr_status;
                    $payment->tr_amount = $tr_amount;
                    $payment->tr_paid = $tr_paid;
                    $payment->tr_date = $tr_date;
                    $payment->tr_desc = $tr_desc;
                    $payment->tr_email = $tr_email;
                }
            }
            else
            {
                $payment->tr_status = 'ERROR';
                $payment->tr_error = $tr_error;
            }

            $payment->save();

        }
        echo 'TRUE'; // odpowiedź dla serwera o odebraniu danych
    }

    public function success() {
        session()->forget('cart');
        $order = session()->get('order');
        return view('transfers.success', compact('order'));
    }

    public function error() {
        return view('transfers.error');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Check md5 sum to validate tpay response.
     * The values of variables that md5 sum includes are available only for
     * merchant and tpay system.
     *
     * @param string $md5sum md5 sum received from tpay
     * @param float $transactionAmount transaction amount
     * @param string $crc transaction crc
     *
     * @return bool
     */
    private function isMd5Valid($md5sum, $transactionAmount, $crc, $id)
    {
        if (!is_string($md5sum) || strlen($md5sum) !== 32) {
            return false;
        }
        return ($md5sum === md5( config('tpay.tpay_id') . $id .
                $transactionAmount . $crc . config('tpay.tpay_security')));
    }
}
