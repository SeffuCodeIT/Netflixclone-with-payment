<?php 

//index.php

include 'database_connection.php';



if(isset($_POST["submit"]))

{




    $formdata = array();



    if(empty($_POST['phone']))
    {
       echo"<center><h5>Phone Number is Required🙄</h5></center>";
    }
    else
    {
        $formdata['phone'] = $_POST['phone'];
    }

    if($message == '')
    {
        $data = array(
            ':phone'       =>  $formdata['phone']
        );

        $query = "
        SELECT * FROM tinypesa 
        WHERE PhoneNumber = :phone
        ";

        $statement = $conn->prepare($query);

        $statement->execute($data);

        if($statement->rowCount() > 0)
        {
            foreach($statement->fetchAll() as $row)
            {
                if($row['PhoneNumber'] == $formdata['phone'] && $row['MpesaReceiptNumber'] != NULL or $row['BackupNumber'] ==$formdata['phone'])
                {
                    session_start();

                    session_regenerate_id();

                    $user_session_id = session_id();

                    $query = "
                    UPDATE tinypesa 
                    SET user_session_id = '".$user_session_id."' 
                    WHERE user_id = '".$row['user_id']."'
                    ";

                    $conn->query($query);

                    $_SESSION['user_id'] = $row['user_id'];

                    $_SESSION['user_session_id'] = $user_session_id;

                    echo"<center><h5>Success🎉 Redirect.... </h5></center>";

                    header('location:home.php');
                }
                else
                {
                   echo"<center><p>Choose Subscription🎁 </p></center>";
                }
            }
        }
        else
        {
           

        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Netflix SignIn Page Clone</title>
    </head>
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-image: linear-gradient(rgba(0, 0, 0, .6), rgba(0,0,0, .6)), url(./images/background.jpg);
    overflow-x: hidden;
}
.container {
    min-height: 140vh;
}
.logo {
    width: 167px;
    fill: #e50914;
    position: absolute;
    top: 20px;
    left: 50px;
}
form {
    color: #fff;
    background-color: rgba(0, 0, 0, .6);
    border-radius: .3rem;
    width: 450px;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    padding: 60px;
    margin-top: 6rem;
}
form h1 {
    margin-bottom: 28px;
}
.form-group {
    width: 100%;
    height: 50px;
    margin-bottom: 16px;
    position: relative;
}
.form-group input {
    width: 100%;
    height: 100%;
    background-color: #333;
    border: none;
    border-radius: .3rem;
    outline: none;
    color: #fff;
    padding: 16px 20px 0;
    font-size: 1rem;
}
.form-group label {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    color: #8c8c8c;
    pointer-events: none;
    transition: 200ms ease-in-out transform,
                200ms ease-in-out font-size;
}
.form-group input:focus ~ label,
.form-group input:valid ~ label {
    transform: translateY(-1.25rem);
    font-size: .7rem;
}

form button {
    width: 100%;
    height: 48px;
    font-size: 1rem;
    background-color: #e50914;
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: .3rem;
    cursor: pointer;
    margin: 24px 0 12px;
}
.remember {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.remember label {
    font-size: .85rem;
    color: #b3b3b3;
}
.remember a {
    color: #b3b3b3;
    font-size: .85rem;
    text-decoration: none;
}
.remember a:hover {
    text-decoration: underline;
}

.facebook-login {
    margin-top: 3rem;
    display: flex;
    align-items: center;
}
.facebook-login img {
    width: 20px;
    aspect-ratio: 1;
    margin-right: 10px;
}
.facebook-login a {
    color: #737373;
    font-size: .8rem;
    text-decoration: none;
}

.signup {
    margin-top: 16px;
}
.signup p {
    color: #737373;
}
.signup p a {
    color: #fff;
    text-decoration: none;
}
.signup p a:hover {
    text-decoration: underline;
}

.captcha {
    font-size: .8rem;
    color: #8c8c8c;
    margin-top: 0.5rem;
}
.captcha a {
    color: #0071eb;
    text-decoration: none;
}
.captcha a:hover {
    text-decoration: underline;
}

footer {
    position: absolute;
    left: 0;
    bottom: -40vh;
    width: 100%;
    height: 260px;
    background-color: rgba(0, 0, 0, .6);
    padding: 30px 170px;
}
footer a {
    color: #757575;
    text-decoration: none;
}
footer a:hover {
    text-decoration: underline;
}

footer .top {
    margin-bottom: 30px;
}
footer .links {
    display: flex;
    flex-wrap: wrap;
}
footer .links a {
    display: inline-block;
    width: 250px;
    margin-bottom: 16px;
    font-size: 0.8rem;
}
    </style>
    <body>
        <div class="container">
            <div class="logo">
                <svg viewBox="0 0 111 30" class="svg-icon svg-icon-netflix-logo" focusable="true">
                    <g id="netflix-logo">
                        <path
                            d="M105.06233,14.2806261 L110.999156,30 C109.249227,29.7497422 107.500234,29.4366857 105.718437,29.1554972 L102.374168,20.4686475 L98.9371075,28.4375293 C97.2499766,28.1563408 95.5928391,28.061674 93.9057081,27.8432843 L99.9372012,14.0931671 L94.4680851,-5.68434189e-14 L99.5313525,-5.68434189e-14 L102.593495,7.87421502 L105.874965,-5.68434189e-14 L110.999156,-5.68434189e-14 L105.06233,14.2806261 Z M90.4686475,-5.68434189e-14 L85.8749649,-5.68434189e-14 L85.8749649,27.2499766 C87.3746368,27.3437061 88.9371075,27.4055675 90.4686475,27.5930265 L90.4686475,-5.68434189e-14 Z M81.9055207,26.93692 C77.7186241,26.6557316 73.5307901,26.4064111 69.250164,26.3117443 L69.250164,-5.68434189e-14 L73.9366389,-5.68434189e-14 L73.9366389,21.8745899 C76.6248008,21.9373887 79.3120255,22.1557784 81.9055207,22.2804387 L81.9055207,26.93692 Z M64.2496954,10.6561065 L64.2496954,15.3435186 L57.8442216,15.3435186 L57.8442216,25.9996251 L53.2186709,25.9996251 L53.2186709,-5.68434189e-14 L66.3436123,-5.68434189e-14 L66.3436123,4.68741213 L57.8442216,4.68741213 L57.8442216,10.6561065 L64.2496954,10.6561065 Z M45.3435186,4.68741213 L45.3435186,26.2498828 C43.7810479,26.2498828 42.1876465,26.2498828 40.6561065,26.3117443 L40.6561065,4.68741213 L35.8121661,4.68741213 L35.8121661,-5.68434189e-14 L50.2183897,-5.68434189e-14 L50.2183897,4.68741213 L45.3435186,4.68741213 Z M30.749836,15.5928391 C28.687787,15.5928391 26.2498828,15.5928391 24.4999531,15.6875059 L24.4999531,22.6562939 C27.2499766,22.4678976 30,22.2495079 32.7809542,22.1557784 L32.7809542,26.6557316 L19.812541,27.6876933 L19.812541,-5.68434189e-14 L32.7809542,-5.68434189e-14 L32.7809542,4.68741213 L24.4999531,4.68741213 L24.4999531,10.9991564 C26.3126816,10.9991564 29.0936358,10.9054269 30.749836,10.9054269 L30.749836,15.5928391 Z M4.78114163,12.9684132 L4.78114163,29.3429562 C3.09401069,29.5313525 1.59340144,29.7497422 0,30 L0,-5.68434189e-14 L4.4690224,-5.68434189e-14 L10.562377,17.0315868 L10.562377,-5.68434189e-14 L15.2497891,-5.68434189e-14 L15.2497891,28.061674 C13.5935889,28.3437998 11.906458,28.4375293 10.1246602,28.6868498 L4.78114163,12.9684132 Z"
                            id="Fill-14"></path>
                    </g>
                </svg>
            </div>
            <div class="form-container">
                <form>
                    <h1>Sign In</h1>
                    
                    <div class="form-group">
                        <input type="phone" required>
                        <label>Phone Number</label>
                    </div>
                    <button>Sign In</button>
                    <div class="remember">
                        <div class="left">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="right">
                            <a href="#">Need help?</a>
                        </div>
                    </div>
                    <div class="signup">
                        <p>New to Netflix? <a href="#">Sign up now</a>.</p>
                    </div>
                </form>
            </div>
            <footer>
                <div class="top">
                    <a href="#">Questions? Contact us.</a>
                </div>
                <div class="links">
                    <a href="#">FAQ</a>
                    <a href="#">Help Center</a>
                    <a href="#">Terms of Use</a>
                    <a href="#">Privacy</a>
                    <a href="#">Cookie Preference</a>
                    <a href="#">Corporate Information</a>
                </div>
            </footer>
        </div>
    </body>
</html>