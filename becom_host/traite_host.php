<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_name = $_POST["property_name"];
    $Marker_p = $_POST["Marker_p"];
    $address = $_POST["address"];
    $zip_code = (int)$_POST["zip_code"];
    $city = $_POST["city"];
    $guests = $_POST["guests"];
    $home = $_POST["home_type"];
    $price = (float)$_POST["price"];
    $images = array();
    $amenities = $_POST["amenities"];
    $am = array();
    $am[] = in_array('Wifi', $amenities) ? 1 : 0;
    $am[] = in_array('Air-conditioning', $amenities) ? 1 : 0;
    $am[] = in_array('Kitchen', $amenities) ? 1 : 0;
    $am[] = in_array('Heating', $amenities) ? 1 : 0;
    $am[] = in_array('Workspace', $amenities) ? 1 : 0;
    $am[] = in_array('Washer', $amenities) ? 1 : 0;



    for ($i = 1; $i <= 5; $i++) {

        if (!empty($_FILES["tswira{$i}"]["name"]))
            $images[] = file_get_contents($_FILES["tswira{$i}"]["tmp_name"]);
        else $images[] = null;
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web;", "root");

        $stmt = $pdo->prepare("INSERT INTO property (Prop_Name, Prop_type, nbr_guest, city, zip_code, address, Marker_pos, Price, img1,img2,img3,img4,img5,phone_nbr) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->execute([
            $property_name,
            $home[0],
            $guests,
            $city,
            $zip_code,
            $address,
            $Marker_p,
            $price,
            // Assuming $images[0] contains the raw image data
            $images[0],
            $images[1],
            $images[2],
            $images[3],
            $images[4],
            $_COOKIE["phone_nbr"]
        ]);

        $id = $pdo->query("select max(prop_id) from property")->fetch()[0];
        $stmt = $pdo->prepare("INSERT INTO property_attributs values(?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $am[0],
            $am[1],
            $am[2],
            $am[3],
            $am[4],
            $am[5]
        ]);
?>
        <script>
            alert('the operation was successfully completed')
            window.location.replace("../index.php");
        </script>"
<?php
    } catch (\Throwable $th) {
        echo "problem has occurred: $th";
    }
}
