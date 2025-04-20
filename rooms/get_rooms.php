<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="../styles/room.css">
    <link rel="stylesheet" href="../styles/room_infos.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" href="../styles/side.css">
    <script src="https://kit.fontawesome.com/f7e2b56c18.js" crossorigin="anonymous"></script>
    <title>ShowRoom</title>
</head>
<style>
    <?php
    if (empty($_COOKIE["logged"]) or $_COOKIE["logged"] != true) {
        echo ".side_menu{
            display:none;
        }";
    } else {
        echo ".side_menu{
            display:block;
        }";
    }
    ?>
</style>

<body>
    <div class="signup-form-container">
        <form action="../signup/signup.php" method="post" class="sign-form">
            <h1>Signup</h1>
            <div class="signup_form">
                <input type="text" name="username" required id="username" onchange="verify()">
                <label for="username">Username:</label>
            </div>
            <p id="availability" style="display: none"></p>
            <div class="signup_form">
                <input type="number" name="phone" id="phone" required>
                <label for="phone">phone number:</label>
            </div>
            <div class="signup_form">
                <input type="text" name="email" id="email" required>
                <label for="email">Email:</label>
            </div>
            <p id="error" style="display: none;color: red;">Entered email is not valid</p>
            <div class="signup_form">
                <input type="password" name="CreatePassword" required id="CreatePassword">
                <label for="CreatePassword">Create Password:</label>
            </div>

            <button type="submit" class="submit_button">Create Account</button>
            <button id="close_signup" onclick="hidesignup()">X</button>
        </form>
    </div>
    <div class="signup-form-container">
        <form action="../signup/signup.php" method="post" class="sign-form login">
            <h1>Login</h1>
            <div class="signup_form">
                <input type="number" name="phone" required>
                <label for="phone">phone number:</label>
            </div>

            <div class="signup_form">
                <input type="password" name="EnterPassword" required id="EnterPassword">
                <label for="EnterPassword">Enter Password:</label>
            </div>
            <button type="submit" class="submit_button">Login</button>
            <button id="close_login">X</button>
        </form>
    </div>
    <script>
        $(document).ready(
            function() {
                $(".sign-form").click(function(param) {
                    if ($(param.target).is("#close_signup") || $(param.target).is("#close_login")) {
                        param.preventDefault();
                        $(param.target).parent().css("display", "none");
                        $(param.target).parent().css("animation", "none");
                        $("body").removeClass("darken")
                    }
                })
            }
        )
        $(document).ready(
            $("#email").focusout(function(param) {
                const regex =
                    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(param.target.value)) {
                    $("#error").css("display", "block")
                } else $("#error").css("display", "none")
            })
        )
    </script>
    <div class="side_menu">
        <ul>
            <li>
                <a class="active" href="../index.php">
                    <i class="fas fa-home"></i>
                    <p>home</p>
                </a>
            </li>
            <li>
                <a href="../Dashboard/dashboard.php">
                    <i class="fas fa-chart-pie"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fas fa-star"></i>
                    <p>favorites</p>
                </a>
            </li>
            <li>
                <a href="../becom_host/hosting_survey.html">
                    <i class="fas fa-pen"></i>
                    <p>List a property</p>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fas fa-cog"></i>
                    <p>setting</p>
                </a>
            </li>

        </ul>
    </div>
    <nav>
        <div id="logo">
            <h2>MBik</h2>
        </div>
        <div id="links">
            <div class="link"><a href="../index.php">Home</a>
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
                    <?php
                    if (!empty($_COOKIE["logged"]) and $_COOKIE["logged"] == true) {
                    ?>
                        <a href="..\becom_host\hosting_survey.html">List your Property</a>
                        <hr>
                        <a href="#">About Us</a>
                        <hr>
                        <form action="..\signup\logout.php" method="get"><button id="logout">
                                <pre>   Logout</pre>
                            </button></form>
                        <hr>
                    <?php
                    } else {
                    ?>
                        <button onclick="showsignform('signup')">
                            <pre>  Sign up</pre>
                        </button>
                        <hr>
                        <button onclick="showsignform('login')">
                            <pre>  Login</pre>
                        </button>
                        <hr>
                        <button onclick="alert('you should sign up first')">
                            <pre>  List your Property</pre>
                        </button>
                        <hr>
                        <button>
                            <pre>  About Us</pre>
                        </button>
                        <hr>
                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>
    </nav>

    <article>
        <form action="get_rooms.php" method="get">
            <h1>Plan Your Dream Trip Today:</h1>
            <div id="search">
                <div class="el1">
                    <select type="search" id="where" name="city">
                        <option value="none"></option>
                        <script>
                            $.getJSON("../ville.json", function(data) {

                                data.forEach(element => {
                                    $("#where").append("<option value='" + element.ville + "' >" + element.ville + "</option>");

                                });
                            })
                        </script>
                    </select>
                    <label for="where">Where:</label>
                </div>

                <div class="el1">
                    <input type="text" id="checkin" class="date-reserve-from" name="checkin" autocomplete="off">
                    <label for="date">Check in:</label>
                </div>
                <div class="el1">
                    <input type="text" id="checkout" class="date-reserve-until" name="checkout" autocomplete="off">
                    <label for="checkout">Check out:</label>
                </div>

                <div class="el1">
                    <input type="number" name="guests" id="guests" min="1" max="10" value="1">
                    <label for="guests">Guests:</label>
                </div>
                <div class="el1">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

            </div>
        </form>
    </article>

    <script>
        var ALLimages = {};
        var imageIndex = 0;
    </script>
    <div class="rooms">

        <?php
        $wanted_properties = filter();
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=projet_web;", "root");
        } catch (\Throwable $th) {
            echo "error occurred: " . $th;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $properties = array();
            foreach ($wanted_properties as $wanted_property) {
                // if (!$wanted_property) continue;     
                $property = $pdo->query("SELECT Prop_Name, Prop_type, nbr_guest, city, zip_code, address, Marker_pos, Price, img1 FROM property WHERE Prop_id =$wanted_property")->fetch();
                echo "<div class=\"room-container\" onclick='show_room($wanted_property)'>
            <div class=\"room-img\">
                <img src=\"data:image/jpeg;base64," . base64_encode($property['img1']) . "\" alt=\"\">
            </div>
            <div class=\"room-discription\">
                <span id=\"room-title\">
                    {$property['Prop_Name']}
                </span>
                <p class=\"room-price\">Price: <strong>{$property['Price']}dhs</strong> / <em>night</em></p>
            </div>
        </div>";
        ?><div id="Prop_id<?php echo "$wanted_property"; ?>" class="room-infos">
                    <div class="pro">
                        <button class="btanulle" onclick="anuller(<?php echo $wanted_property; ?>)"><i class="fa-solid fa-circle-xmark"></i></button>
                        <div class="pro1">

                            <?php
                            try {
                                $conn = new PDO("mysql:host=localhost;dbname=projet_web", "root");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->query("SELECT img1,img2,img3,img4,img5 FROM property where Prop_id=$wanted_property");
                                $images = [];
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                foreach ($row as $image) {
                                    if (empty($image)) continue;
                                    $images[] = 'data:image/jpeg;base64,' . base64_encode($image);
                                }

                                $images_json = json_encode($images);
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            ?>
                            <img id="image<?php echo $wanted_property; ?>" src="<?php echo $images[0]; ?>" alt="">
                            <button class="botsuiv" onclick="imageSuivante(<?php echo $wanted_property; ?>)"><i class="fa-solid fa-arrow-right"></i></button>
                            <button class="botprec" onclick="imagePrecedente(<?php echo $wanted_property; ?>)"><i class="fa-solid fa-arrow-left"></i></button>
                            <script>
                                ALLimages[<?php echo $wanted_property; ?>] = <?php echo $images_json; ?>;
                            </script>

                            <?php

                            try {
                                $conn = new PDO("mysql:host=localhost;dbname=projet_web", "root");
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $conn->query("SELECT price,Prop_Name,city,address,Prop_type,nbr_guest,Marker_pos,phone_nbr FROM property where Prop_id=$wanted_property");
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $prop_price = $row['price'];
                                $Prop_Name = $row['Prop_Name'];
                                $city = $row['city'];
                                $adress = $row['address'];
                                $Marker_pos = $row["Marker_pos"];
                                $phone_nbr = $row["phone_nbr"];
                                if ($row['Prop_type'] == 'A') {
                                    $Prop_type = 'appartement';
                                } else {
                                    $Prop_type = 'room';
                                }
                                $nbr_guest = $row['nbr_guest'];
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                            $amenities = $conn->query("SELECT * FROM property_attributs where Prop_id=$wanted_property")->fetch();
                            ?>

                        </div>
                        <div class="prin">
                            <div class="pro2" id="room-infos<?php echo "$wanted_property"; ?>">
                                <h3><?php echo $Prop_Name; ?></h3>
                                <br>
                                <div class="inline-info">
                                    <span><i class="fa-solid fa-location-dot"></i><?php echo $city . ', ' . $adress; ?></span>
                                    <span><i class="fa-solid fa-phone"></i>0<?php echo $phone_nbr ?></span>
                                </div>
                                <div class="inline-info">
                                    <span><i class="fa-regular fa-building"></i><?php echo $Prop_type; ?></span>
                                    <span><i class="fa-solid fa-people-group"></i>Guests:<?php echo $nbr_guest; ?></span>
                                </div>
                                <hr>
                                <div class="pro21">
                                    <?php
                                    $labels = array();
                                    $labels[] = "<label for=\"\"><i class=\"fa-solid fa-wifi\"></i> Wifi</label>";
                                    $labels[] = "<label for=\"\"><i class=\"fa-solid fa-kitchen-set\"></i> Kitchen</label>";
                                    $labels[] = "<label for=\"\"><img width=\"24\" height=\"24\" src=\"https://img.icons8.com/fluency-systems-regular/48/under-computer.png\" alt=\"under-computer\" /> Workspace</label>";
                                    $labels[] = "<label for=\"\"><i class=\"fa-regular fa-snowflake\"></i> Air-conditioning</label>";
                                    $labels[] = "<label for=''><img width=\"24\" height=\"24\" src=\"https://img.icons8.com/fluency-systems-regular/48/heating.png\" alt=\"heating\" /> Heating</label>";
                                    $labels[] = "<label for=\"\"><img width=\"24\" height=\"24\" src=\"https://img.icons8.com/material-outlined/24/washing.png\" alt=\"washing\" /> Washer</label>";

                                    for ($i = 0; $i <= 5; $i++) {
                                        if ($amenities[$i + 1] == 1)
                                            echo $labels[$i];
                                    }
                                    ?>




                                    <!-- <label for="" style="><i class="fa-solid fa-wifi"></i> Wifi</label>
                                    <label for=""><i class="fa-regular fa-snowflake"></i> Air-conditioning</label>
                                    <label for=""><i class="fa-solid fa-kitchen-set"></i> Kitchen</label>
                                    <label for=""><img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/heating.png" alt="heating" /> Heating</label>
                                    <label for=""><img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/under-computer.png" alt="under-computer" /> Workspace</label>
                                    <label for=""><img width="24" height="24" src="https://img.icons8.com/material-outlined/24/washing.png" alt="washing" /> Washer</label> -->
                                </div>
                                <h1 id="prix"><?php echo $prop_price ?> MAD</h1>
                                <button class="pro22" onclick="suivant(<?php echo $wanted_property; ?>)">go to reserve</button>
                            </div>
                            <div class="pro3" id="room-reserve<?php echo $wanted_property; ?>">
                                <button class="btreturn" onclick="prec(<?php echo $wanted_property; ?>)"><i class="fa-solid fa-backward"></i></button>
                                <form action="reservation.php" method="post" class="reserve-form">
                                    <div class="table1">
                                        <table>
                                            <tr>
                                                <td>
                                                    <input type="text" style="display: none;" name="prop_id" value="<?php echo $wanted_property; ?>">
                                                    <p>CHECK-IN</p>
                                                    <input class="date-reserve-from" name="checkin-reserve" id="checkin-reserve<?php echo $wanted_property; ?>" type="date">
                                                </td>
                                                <td>
                                                    <p>CHECKOUT</p>
                                                    <input class="date-reserve-until" name="checkout-reserve" id="checkout-reserve<?php echo $wanted_property; ?>" type="date">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p>GUESTS</p>
                                                    <p><input type="number" class="guests-reserve"> guest</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div id="difference">
                                        <div class="price-info">
                                            <span id="priceNight<?php echo $wanted_property; ?>"><?php echo $prop_price; ?>MAD x 2 nuits :</span>
                                            <span id="nights<?php echo $wanted_property; ?>"><?php echo $prop_price * 2; ?> MAD</span>
                                            <input style="display: none;" id="price<?php echo $wanted_property; ?>" value="<?php echo $prop_price; ?>">
                                        </div>
                                        <div class="price-info">
                                            <span>Frais de service:</span>
                                            <span>100 MAD</span>
                                        </div>
                                        <hr>
                                        <div class="price-info">
                                            <span id="total1<?php echo $wanted_property; ?>">Total:</span>
                                            <span id="total2<?php echo $wanted_property; ?>">0MAD</span>
                                        </div>
                                    </div>
                                    <button class="bt1">reserve</button>
                                </form>
                                <script>
                                    var nuit = 2;

                                    function calculeprixtotal() {
                                        var price = document.getElementById("price<?php echo $wanted_property; ?>").value;
                                        var checkinDate = new Date(document.getElementById("checkin-reserve<?php echo $wanted_property; ?>").value);
                                        var checkoutDate = new Date(document.getElementById("checkout-reserve<?php echo $wanted_property; ?>").value);

                                        var difference = Math.ceil((checkoutDate - checkinDate) / (1000 * 3600 * 24));
                                        var fullprice = !difference ? 0 : price * difference;
                                        document.getElementById("nights<?php echo $wanted_property; ?>").innerHTML = `${fullprice} MAD`;

                                        if (difference > 0) {
                                            document.getElementById("priceNight<?php echo $wanted_property; ?>").innerHTML = `${price}MAD x${difference} nuits`;
                                            document.getElementById("total1<?php echo $wanted_property; ?>").innerText = "Total:";
                                            document.getElementById("total2<?php echo $wanted_property; ?>").innerText = +(price * difference + 100) + " MAD";
                                        } else {
                                            document.getElementById("total1<?php echo $wanted_property; ?>").innerText = "Total:";
                                            document.getElementById("total2<?php echo $wanted_property; ?>").innerText = "0 MAD";
                                        }
                                    }

                                    document.getElementById("checkin-reserve<?php echo $wanted_property; ?>").addEventListener("change", calculeprixtotal);
                                    document.getElementById("checkout-reserve<?php echo $wanted_property; ?>").addEventListener("change", calculeprixtotal);
                                </script>
                            </div>
                        </div>
                    </div>
                    <a class="bot" href="https://www.google.com/maps/place/<?php echo $Marker_pos; ?>" target="_blank"><i class="fa-solid fa-map-location-dot" id="mapIcon<?php echo $wanted_property ?>"></i> Show on map</a>
                </div><?php
                    }
                }

                        ?>

    </div>

    <script>
        function anuller(id) {
            // var btonanuler=document.getElementById("room-infos");
            // btonanuler.style.display='none';
            document.getElementById(`Prop_id${id}`).style.display = "none";
            // document.body.classList.remove('darken');
            $("body").removeClass("darken");
            imageIndex = 0;
        }

        function imagePrecedente(id) {
            imageIndex--;
            if (imageIndex < 0) {
                imageIndex = ALLimages[id].length - 1;
            }
            afficherImage(imageIndex, id);
        }

        function imageSuivante(id) {
            imageIndex++;
            if (imageIndex >= ALLimages[id].length) {
                imageIndex = 0;
            }
            afficherImage(imageIndex, id);
        }

        function afficherImage(index, id) {
            var imageElement = document.getElementById("image" + id);
            imageElement.style.opacity = 0;
            setTimeout(function() {
                imageElement.src = ALLimages[id][index];
                imageElement.style.opacity = 1;
                imageIndex = index;
            }, 100);
        }
    </script>

    <footer>
        <div class="container">
            <div class="footer-column">
                <h4>About</h4>
                <p>
                    "We are two software engineering students who created this site to facilitate the rental of apartments and rooms in Morocco."</p>
            </div>
            <div class="footer-column">
                <h4>Contact</h4>
                <ul>
                    <li>Email: mohamedoulaid93@gmail.com/akharraz2003@gmail.com</li>
                    <li>Téléphone: +212693380325/+212770497400</li>
                    <li>Adresse: Ainatti2, Errachidia, Maroc</li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Suivez-nous</h4>
                <section class="contact">
                    <div class="item">
                        <i class="fa-brands fa-instagram icon"></i>
                    </div>
                    <div class="item">
                        <i class="fa-brands fa-linkedin icon"></i>
                    </div>
                    <div class="item">
                        <i class="fa-brands fa-youtube icon"></i>
                    </div>
                    <div class="item">
                        <i class="fa-brands fa-x-twitter icon"></i>
                    </div>
                </section>
            </div>
        </div>
    </footer>
    <script src="javascript.js"></script>
    <script src="../showMenu.js"></script>

</body>

</html>
<?php
function filter()
{
    $wanted_properties = array();
    $city = !empty($_GET["city"]) ? $_GET["city"] : 'none';
    $checkin = !empty($_GET["checkin"]) ? $_GET["checkin"] : '2020-1-1';
    $checkout = !empty($_GET["checkin"]) ? $_GET["checkout"] : '2020-1-1';
    $guests = !empty($_GET["guests"]) ? intval($_GET["guests"]) : 1;
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web;", "root");
    } catch (\Throwable $th) {
        echo "error occurred: " . $th;
        exit();
    }
    if ($city != 'none') {
        $reusult = $pdo->query("SELECT Prop_id from property WHERE nbr_guest>='$guests' and city ='$city'")->fetchAll();
    } else
        // echo"somthine happend";
        $reusult = $pdo->query("SELECT Prop_id from property WHERE nbr_guest>='$guests'")->fetchAll();

    foreach ($reusult as  $line) {
        $search = $pdo->query("SELECT * FROM reservation WHERE (Prop_id={$line['Prop_id']}) AND   ('$checkin'> ALL (SELECT reserved_date_until FROM reservation WHERE Prop_id={$line['Prop_id']}) OR '$checkout' < ALL ( SELECT reserved_date_from FROM reservation WHERE Prop_id={$line['Prop_id']})   )")->fetch();

        if (!empty($search)) $wanted_properties[] = $search["Prop_id"];
        if (empty($pdo->query("select * from reservation where Prop_id={$line['Prop_id']}")->fetch())) {
            $wanted_properties[] = $line['Prop_id'];
        }
    }
    return $wanted_properties;
}
?>