<?php

header("Content-Type: application/json");

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "stkTinypesaResponse.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);

$callbackContent = json_decode($stkCallbackResponse);

$ResultCode = $callbackContent->Body->stkCallback->ResultCode;
$CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
$Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->Value;
//$BackupNumber = $_SESSION['phone'];


if ($ResultCode == 0) {

    //$conn = new mysqli("server244", "ingwdchl_fortune", "Fortuneseeker#001", "ingwdchl_data");
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"], 1);
    $active_group = 'default';
    $query_builder = TRUE;
    $conn = new mysqli("$cleardb_server", "$cleardb_username", "$cleardb_password", "$cleardb_db");
   
    $dara = "SELECT * FROM records";
    $result = $conn->query($dara);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $BackupNumber = $row["BackupNumber"];
      }
    } else {
      echo "0 results";
    }

    // Check connection
    if ($conn->connect_error) {
        die("<h1>Connection failed:</h1> " . $conn->connect_error);
    } else {
      
          //Assigns session var to $array
        
  
        $sql=("INSERT INTO tinypesa(BackupNumber,CheckoutRequestID,ResultCode,amount,MpesaReceiptNumber,PhoneNumber) VALUES ('$BackupNumber','$CheckoutRequestID','$ResultCode','$Amount','$MpesaReceiptNumber','$PhoneNumber')");


        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        
       // sql to delete a record
        $terminator = "DELETE FROM records";  

        if (mysqli_query($conn, $terminator)) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . mysqli_error($conn);
        }

          mysqli_close($conn);
    
}
}
?>