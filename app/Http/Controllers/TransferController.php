<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function order(Request $request) {
        $client = new Client();
        $products = $request->session()->get('cart');

        $id = config('tpay.tpay_id');
        $totalPrice = $products->totalPrice;
        $description = 'Opis transakcji';
        $crc = 'Transakcja';
        $security_code = config('tpay.tpay_security');

        $response = $client->request('POST', 'https://secure.tpay.com', [
            'form_params' => [
                'id' => $id,
                'kwota' => $totalPrice,
                'opis' => $description,
                'crc' => $crc,
                'md5sum' => $id.$totalPrice.$crc.$security_code,
                'wyn_url' => route('transfer.callback')
            ]
        ]);
    }

    public function callback(Request $request) {
        // sprawdzenie adresu IP oraz występowania zmiennych POST
        $ip_table = array('195.149.229.109', '148.251.96.163', '178.32.201.77',
            '46.248.167.59', '46.29.19.106'); $request['id'];
        if (in_array($_SERVER['REMOTE_ADDR'], $ip_table) && !empty($request)){
            $id_sprzedawcy = $request['id'];
            $status_transakcji = $request['tr_status'];
            $id_transakcji = $request['tr_id'];
            $kwota_transakcji = $request['tr_amount'];
            $kwota_zaplacona = $request['tr_paid'];
            $blad = $request['tr_error'];
            $data_transakcji = $request['tr_date'];
            $opis_transakcji = $request['tr_desc'];
            $ciag_pomocniczy = $request['tr_crc'];
            $email_klienta = $request['tr_email'];
            $suma_kontrolna = $request['md5sum'];
        // sprawdzenie stanu transakcji
            if($status_transakcji=='TRUE' && $blad=='none'){
                /*
                Dalsze przetwarzanie, np:
                - identyfikacja transakcji na podstawie ciągu pomocniczego
                - weryfikacja transakcji (sprawdzenie poprawności kwoty itp.)
                - realizacja zamówienia
                */
            }
            else
            {
        // transakcja wykonana niepoprawnie
            }
        }
        echo 'TRUE'; // odpowiedź dla serwera o odebraniu danych
    }
}
