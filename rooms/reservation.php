<?php

if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (empty($_COOKIE["logged"]) or $_COOKIE["logged"] != true) {
        ?>
    <script> 
    alert('You should sign in first to complete this operation');
    window.history.go(-1);
    </script>"
    <?php
    }
    $pdo = new PDO("mysql:host=localhost;dbname=projet_web;", "root");
    $checkin = $_POST["checkin-reserve"];
    $checkout = $_POST["checkout-reserve"];
    $id = $_POST["prop_id"];
    $price = $pdo->query("select price from property where prop_id=$id")->fetch()[0];
    $owner_number = $pdo->query("select phone_nbr from property where prop_id=$id")->fetch()[0];
    $total = dateDiffInDays($checkin, $checkout) * $price + 100;
    $pdo->query("insert into reservation 
    values($id,'$checkin','$checkout',$owner_number,{$_COOKIE["phone_nbr"]},$total)");
    ?>
    <script> 
    alert('the operation was successfully completed')
    window.location.replace("../index.php");
    </script>"
    <?php

}
function dateDiffInDays($date1, $date2)
{

    $diff = strtotime($date2) - strtotime($date1);
    return abs(round($diff / (24 * 60 * 60)));
}
