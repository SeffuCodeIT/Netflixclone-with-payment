<?php
 

 if(isset($_POST['premium'])){
 
     $amount = '1'; //Amount to transact 
     $phone = $_POST['phone']; // Phone number paying
     
     $Account_no = 'Netflix Pay'; // Enter account number optional
     $url = 'https://tinypesa.com/api/v1/express/initialize';
     $data = array(
         'amount' => $amount,
         'msisdn' => $phone,
         'account_no'=>$Account_no
     );
     $headers = array(
         'Content-Type: application/x-www-form-urlencoded',
         'ApiKey: TqZBBoo8DoD' // Replace with your api key
      );
     $info = http_build_query($data);
     
     $curl = curl_init();
     curl_setopt($curl, CURLOPT_URL, $url);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
     $resp = curl_exec($curl);
     $msg_resp = json_decode($resp);
     
     
     if ($msg_resp ->success == 'true') {

       echo "<center><h5>WAIT FOR  STK POP UP🔥</h5></center>";
     } else {
       echo "<center><h5> Phone number required🐛</h5></center>";
      
     }
}



?>