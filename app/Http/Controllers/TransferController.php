<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TransferController extends Controller
{
    public function callback() {
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
                \Log::info('test');
            }
            else
            {
                \Log::info('test');
            }
        }
        echo 'TRUE'; // odpowiedź dla serwera o odebraniu danych
    }
}
