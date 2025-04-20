<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="https://kit.fontawesome.com/f7e2b56c18.js" crossorigin="anonymous"></script>
    <title>MarhbaBik</title>

    <link rel="stylesheet" href="styles/signup.css">
    <link rel="stylesheet" href="styles/side.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/button.css">

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
        <form action="signup/signup.php" method="post" class="sign-form">
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
        <form action="signup/signup.php" method="post" class="sign-form login">
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
                        $("body").removeClass("darken");
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
                <a class="active" href="">
                    <i class="fas fa-home"></i>
                    <p>home</p>
                </a>
            </li>
            <li>
                <a href="Dashboard/dashboard.php">
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
                <a href="">
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
            <li class="Log-out">
                <a href="">
                    <i class="fas fa-sign-out"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
    <nav>
        <div id="logo">
            <h2>MBik</h2>
        </div>
        <div id="links">
            <div class="link"><a href="" id="home">Home</a>
                <hr>
            </div>
            <div class="link"><a href="contact/Contact.html">Contact</a>
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
                        <a href="becom_host\hosting_survey.html">List your Property</a>
                        <hr>
                        <a href="#">About Us</a>
                        <hr>
                        <form action="signup\logout.php" method="get"><button id="logout">
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
        <form action="rooms/get_rooms.php" method="GET">
            <h1>Plan Your Dream Trip Today:</h1>
            <div id="search" class="container">
                <div class="el1">
                    <select type="search" id="where" name="city">
                        <option value=""></option>
                        <script>
                            $.getJSON("ville.json", function(data) {

                                data.forEach(element => {
                                    $("#where").append("<option value='" + element.ville + "' >" + element.ville + "</option>");

                                });
                            })
                        </script>
                    </select>
                    <label for="">Where:</label>
                </div>

                <div class="el1">
                    <input type="text" id="checkin" name="checkin">
                    <label for="checkin">Check in:</label>
                </div>
                <div class="el1">
                    <input type="text" id="checkout" name="checkout">
                    <label for="checkout">Check out:</label>
                </div>

                <div class="el1 guest">
                    <input type="number" name="guests" id="guests" max="10" min="1" value="1">
                    <label for="guests">Guests</label>
                </div>
                <div class="el1">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

            </div>
        </form>
    </article>

    <hr width="90%" style="margin: 1em auto;">
    <section id="sec1">
        <h1>Discover Morroco's emperial cities:</h1>
        <div class="container-grid">
            <div class="img1"><a href="rooms/get_rooms.php?city=Tanger&checkin=&checkout=&guests=1"><img src="assets/tanger.jpg" alt=""></a><span>Tanger</span></div>
            <div class="img2"><a href="rooms/get_rooms.php?city=Marrakech&checkin=&checkout=&guests=1"><img src="assets/marrakech.jpg" alt=""></a><span>Marrakech</span></div>
            <div class="img3"><a href="rooms/get_rooms.php?city=Agadir&checkin=&checkout=&guests=1"><img src="assets/agadir.jpg" alt=""></a><span>Agadir</span></div>
            <div class="img4"><a href="rooms/get_rooms.php?city=Ouarzazate&checkin=&checkout=&guests=1"><img src="assets/Errachidia.webp" alt=""></a><span>Ouarzazate</span></div>
            <!-- <div class="img5"></div> -->
        </div>
    </section>
    <section class="sect2">
        <div class="discription">
            <h2>Where History meets Majesty</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit consequuntur molestias, soluta, nam
                adipisci
                quis consectetur tempora similique vero facere, amet temporibus? Corrupti, odio. Sed voluptatem animi
                necessitatibus natus autem!</p>
            <a href="#"><button class="button">this is button</button></a>
        </div>
        <div class="img-container">
            <img src="assets/jamee.jpg" alt="">
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-column">
                <h4>À propos</h4>
                <p>Nous sommes deux étudiants en ingénierie et nous créons ce site <br> pour la location d'appartements et de chambres au Maroc</p>
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
    <script src="showMenu.js" lang="javascript"></script>
</body>

</html>