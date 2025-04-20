<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) and isset($_POST["email"]) and isset($_POST["phone"]) and isset($_POST["CreatePassword"])) {
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone = intval(htmlspecialchars($_POST["phone"]));
        $CreatePassword = htmlspecialchars($_POST["CreatePassword"]);
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root");
        $result = $pdo->query("SELECT * FROM subscriber WHERE phone_nbr=$phone")->fetch();
        if (empty($result)) {

            $stmt = $pdo->query("INSERT INTO subscriber (phone_nbr,username,password,email) values
        ('$phone','$username', '$CreatePassword', '$email')");
            // session_start();
            // $_SESSION["logged"] = true;
            // $_SESSION["phone"] = $phone;
            setcookie("logged",true,strtotime("+1 day"),"/");
            setcookie("phone_nbr",$phone,strtotime("+1 day"),"/");
            header("location: ../index.php");
        } else {
            ?>
            <script>
                alert("it seems this phone number is already used");
                window.history.go(-1);
            </script>
            <?php
            
        }
    }
    elseif (isset($_POST["EnterPassword"]) and isset($_POST["phone"])) {
        $phone=$_POST["phone"];
        $password=$_POST["EnterPassword"];
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root");
        $result = $pdo->query("SELECT * FROM subscriber WHERE phone_nbr=$phone and password='$password'")->fetch();
        if (!empty($result)){
            // session_start();
            setcookie("logged",true,strtotime("+1 day"),"/");
            setcookie("phone_nbr",$phone,strtotime("+1 day"),"/");
            header("location: ../index.php");
        }
        else {
            ?>
            <script>
                alert("The phone number or the password is incorrect");
                window.history.go(-1);
            </script>
            <?php
            
        }
    }
}
