<?php






//STK PUSH FOR THE FIRST PLAN  
 if(isset($_POST['standard'])){
    $detail = $_POST['phone']; 

    $amount = '1'; //Amount to transact 
    $phone = $detail; // Phone number paying
    
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


//STK PUSH FOR THE SECOND PLAN 
if(isset($_POST['premium'])){
    $detail = $_POST['Phone']; 
    $amount = '2'; //Amount to transact 
    $phone = $detail; // Phone number paying
    
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <div class="pricing-table-container">

        <div class="pricing-header">
            <h2 style="color: white!important;">Please choose a plan below</h2>
            <div class="plans-switch-container">
                <input type="checkbox" class="plans-switch">
                <span class="monthly">Monthly</span>
                <span class="yearly">Yearly</span>
            </div>
        </div>


        <div class="pricing-table">
            <div class="table">
                <div class="content">
                    <h3>Basic</h3>

                    <div class="price-container">
                        <span class="price basic-price">Free</span>
                        <span class="plan-duration">/ month</span>
                    </div>

                    <div class="description">
                        This plan is the best for individuals who are getting started
                    </div>

                    <ul class="features">
                        <li>SD Streaming</li>
                        <li>No downloads</li>
                        <li>Restricted access</li>
                    </ul>
                    <label for="exampleFormControlInput1" class="form-label">Confirm Phone</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="254 *** *** ">
                    <br>
                    <br>
                    <button href="#" class="btn sub">Choose Plan</button>
                </div>

                <img class="table-bg" src="images/bg-shape1.svg" alt="">
            </div>

            <!-- End of basic plan -->


            <div class="table best-value">

                <span class="value">Best Value</span>

                <div class="content">
                    <h3>Standard </h3>

                    <div class="price-container">
                        <span class="price professional-price">$7</span>
                        <span class="plan-duration">/ month</span>
                    </div>

                    <div class="description">
                        This plan is for businesses that are getting started
                    </div>

                    <ul class="features">
                        <li>SD Streaming</li>
                        <li>unlimited downloads</li>
                        <li>Restricted access</li>
                    </ul>
                    <form action="./pricing.php" method="POST">
                        <label for="exampleFormControlInput1" class="form-label">Confirm Phone</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="254 *** *** " name="phone">
                        <br>
                        <br>
                        <br>
                        <br>
                        <button class="btn btn-info btn-lg sub" type="submit" name="standard">Choose Plan</button>
                    </form>
                </div>

                <img class="table-bg" src="images/bg-shape2.svg" alt="">
            </div>

            <!-- End of Professional Plan -->


            <div class="table">
                <div class="content">
                    <h3>Business</h3>

                    <div class="price-container">
                        <span class="price business-price">$ 15</span>
                        <span class="plan-duration">/ month</span>
                    </div>

                    <div class="description">
                        This plan is the best for large businesses
                    </div>

                    <ul class="features">
                        <li>HD Streaming</li>
                        <li>Unlimited downloads</li>
                        <li>Restricted access</li>
                        <li>Multiple Devices</li>
                    </ul>
                    <form action="./pricing.php" method="POST">
                        <label for="exampleFormControlInput1" class="form-label">Confirm Phone</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="254 *** *** " name="Phone">
                        <br><br><br>
                        <button class="btn sub" type="submit" name="premium">Choose Plan</button>
                    </form>
                </div>

                <img class="table-bg" src="images/bg-shape1.svg" alt="">
            </div>
        </div>
    </div>


    <script src="form.js"></script>
</body>

</html>