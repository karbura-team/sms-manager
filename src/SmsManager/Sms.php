<?php

   namespace SmsManager;
   
   class Sms {

      public static function sendByLMT($numero,$message,$source,$username,$password) {

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

      public static function sendByMTARGET($numero,$message,$source,$username,$password) {

                    $destination = $numero; $source = urlencode($source);
                    
                    $message = urlencode($message);

                    $url = 'https://api-public.mtarget.fr/api-sms.json?username='.$username.'&password='.$password.'&sender='.$source.'&msisdn=%2b237'.$destination.'&msg='.$message;
        
                    $ch = curl_init();
            
                    curl_setopt($ch, CURLOPT_URL, $url);
            
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
                    curl_exec($ch);
        
                    curl_close($ch);

                    return 'success';
     }
     
   }
?>