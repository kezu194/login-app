<?php 
    require("index/header.html");
    
    $imagedata = file_get_contents("assets/logo.png");
    $base64 = base64_encode($imagedata);
    echo "<body>";
?>

<div class="logo"><img src="data:image/jpeg;base64,<?= $base64; ?>" /></div>

<?php
    require("index/footer.html")
?>