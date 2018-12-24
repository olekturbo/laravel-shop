<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class TransferController extends Controller
{
    public function order(Request $request) {
            $client = new Client();

            /* API */
            $id = config('tpay.tpay_id');
            $api_key = config('tpay.tpay_api_key');
            $api_password = config('tpay.tpay_api_password');
            $api_security = config('tpay.tpay_security');

            /* TRANSACTION */
            $description = 'Opis';
            $price = $request->session()->get('cart')->totalPrice;
            $crc = 1234;
            $md5sum = md5($id.$price.$crc.$api_security);

            /* POST */
            $URI = 'https://secure.tpay.com/api/gw/'.$api_key.'/transaction/create';
            $params['form_params'] = [
                'api_password' => $api_password,
                'id' => $id,
                'amount' => $price,
                'description' => $description,
                'crc' => $crc,
                'md5sum' => $md5sum,
                'group' => 150,
                'name' => 'test user',
                'result_url' => route('transfer.callback'),
                'return_url' => route('transfer.success'),
                'return_error_url' => route('transfer.error')
            ];
            $response = $client->post($URI, $params);

            $data = simplexml_load_string($response->getBody()->getContents());

            return redirect()->away($data->url);

    }
    public function callback(Request $request) {
        // sprawdzenie adresu IP oraz występowania zmiennych POST
        $ip_table = array('195.149.229.109', '148.251.96.163', '178.32.201.77',
            '46.248.167.59', '46.29.19.106'); $_POST['id'];
        if (in_array($_SERVER['REMOTE_ADDR'], $ip_table) && !empty($_POST)){
            $id_sprzedawcy = $_POST['id'];
            $status_transakcji = $_POST['tr_status'];
            $id_transakcji = $_POST['tr_id'];
            $kwota_transakcji = $_POST['tr_amount'];
            $kwota_zaplacona = $_POST['tr_paid'];
            $blad = $_POST['tr_error'];
            $data_transakcji = $_POST['tr_date'];
            $opis_transakcji = $_POST['tr_desc'];
            $ciag_pomocniczy = $_POST['tr_crc'];
            $email_klienta = $_POST['tr_email'];
            $suma_kontrolna = $_POST['md5sum'];

            if($status_transakcji=='TRUE' && $blad=='none'){
                \Log::info($request->all());
            }
            else
            {
                \Log::info($request->all());
            }
        }
        echo 'TRUE'; // odpowiedź dla serwera o odebraniu danych
    }

    public function success() {
        return view('transfers.success');
    }

    public function error() {
        return view('transfers.error');
    }
}
