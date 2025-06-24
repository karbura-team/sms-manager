<?php

namespace SmsManager;

class Sms
{

    public static function sendByLMT($numero, $message, $source, $username, $password)
    {

        $url = 'http://lmtgroup.dyndns.org/sendsms/sendsmsGold.php?';
        $timeout = 10;
        $destination = $numero;
        $request = $url . "UserName=" . urlencode($username) . "&Password=" . urlencode($password) . "";
        $request .= "&SOA=" . urlencode($source) . "&MN=" . urlencode($destination) . "&SM=" . urlencode($message);

        $url = $request;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_exec($ch);
        curl_close($ch);

        return 'success';
    }

    public static function sendByMTARGET($numero, $message, $source, $username, $password)
    {
        return self::sendByNexhas($numero, $message, $source, $username, $password);
    }

    public static function sendByNexhas($numero, $message, $source, $username, $password)
    {

        $destination = $numero;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://smsvas.com/bulk/public/index.php/api/v1/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                  "user": "' . $username . '",
                  "password": "' . $password . '",
                  "senderid": "' . $source . '",
                  "sms": "' . $message . '",
                  "mobiles": "' . $destination . '"
              }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return 'success';
    }

}

?>