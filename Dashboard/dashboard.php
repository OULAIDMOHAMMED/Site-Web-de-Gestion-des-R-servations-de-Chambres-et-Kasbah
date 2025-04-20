<!DOCTYPE html>
<?php
$phone = $_COOKIE["phone_nbr"];
$current_date = date("Y-m-d");
$pdo = new PDO("mysql:host=localhost;dbname=projet_web;", "root");
$enlisted_homes = $pdo->query("select count(phone_nbr) from property where phone_nbr=$phone")->fetch()[0];
$username = $pdo->query("select username from subscriber where phone_nbr=$phone")->fetch()[0];
$currently_rented = $pdo->query("select count(phone_nbr) from reservation where phone_nbr=$phone and reserved_date_from < '$current_date' and reserved_date_until > '$current_date'")->fetch()[0];
$revenu = $pdo->query("SELECT sum(total) from reservation where phone_nbr=$phone ")->fetch()[0];
$revenu = $revenu == 0 ? '0' : $revenu;

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
    <script src="https://kit.fontawesome.com/f7e2b56c18.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <div id="logo">
            <h2>MBik</h2>
        </div>
        <div id="links">
            <div class="link"><a href="../index.php" id="home">Home</a>
                <hr>
            </div>
            <div class="link"><a href="../contact/Contact.html">Contact</a>
                <hr>
            </div>
            <i class="fa fa-globe"></i>
            <div id="nav-menu">
                <button id="nav-menu-button" onclick="show()"><i class="fa-regular fa-user icon" style="font-size: 1.6em;"></i>
                    <i class="fa fa-bars icon"></i></button>
                <div class="profile-items" id="waa">

                    <a href="..\becom_host\hosting_survey.html">List your Property</a>
                    <hr>
                    <a href="#">About Us</a>
                    <hr>
                    <form action="..\signup\logout.php" method="get"><button id="logout">
                            <pre>   Logout</pre>
                        </button></form>
                    <hr>
                </div>
            </div>

        </div>
    </nav>
    <div class="content">
        <div class="data-info">
            <div class="box">
                <i class="fas fa-user"></i>
                <div class="data">
                    <p>user</p>
                    <span> <?php echo $username ?></span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-home"></i>
                <div class="data">
                    <p>total enlisted homes:</p>
                    <span><?php echo $enlisted_homes ?></span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-home"></i>
                <div class="data">
                    <p>Rented homes:</p>
                    <span><?php echo $currently_rented ?></span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-dollar"></i>
                <div class="data">
                    <p>revenue</p>
                    <span> <?php echo $revenu ?></span>
                </div>
            </div>
        </div>
    </div>

    <script src="../showMenu.js"></script>
</body>

</html>