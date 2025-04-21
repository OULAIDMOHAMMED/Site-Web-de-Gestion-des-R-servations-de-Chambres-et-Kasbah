<?php

print_r($_COOKIE);
if($_SERVER["REQUEST_METHOD"]=="GET"){
setcookie("logged",false,strtotime("+1 second"),"/");
setcookie("phone_nbr",0,strtotime("+1 second"),"/");
// echo"<script>
// alert('its done'); </script>";
header("location: ../index.php");
}
?>