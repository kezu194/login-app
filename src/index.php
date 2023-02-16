<?php 
    session_start();

    // Initialize the number of try to login and the last time the user tried to connect
    if (!isset($_SESSION['number_of_try'], $_SESSION['last_try_login'])) {
        $_SESSION['number_of_try'] = 0;
        $_SESSION['last_try_login'] = time();
    }

    // Reset the number of try after the unban time passed
    if(isset($_SESSION['unban_time']) && !empty($_SESSION['unban_time']) && ($_SESSION['unban_time'] - time()) <= 0){
        $_SESSION['unban_time'] = NULL;
        $_SESSION['number_of_try'] = 0;
    }

    // Check if the user unsuccessfully tried to connect more than 5 times
    if($_SESSION['number_of_try']>5){
        $_SESSION['unban_time'] = $_SESSION['last_try_login'] + 60;
        $time_left = $_SESSION['unban_time'] - time();
        exit('You try too many time to login. You can retry to connect in 1 min ('. $time_left .' seconds)');
    }
    require("index/header.html");
    
    // Display the logo image as a b64 encoding
    $imagedata = file_get_contents("assets/logo.png");
    $base64 = base64_encode($imagedata);
    echo "<body>";
?>

<div class="logo"><img src="data:image/jpeg;base64,<?= $base64; ?>" /></div>

<?php
    require("index/footer.html")
?>