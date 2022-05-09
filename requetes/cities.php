<?php
// ville patients
function city (){
    global $db;

    $print = $_GET['print'];
    $req = $db->query("SELECT * FROM patients INNER JOIN users ON patients.users_id = users.id WHERE users.user_key = '$print' ");
    $city_patient = $req->fetch();

    $city = $city_patient['address_city'];

    $req = $db->query("SELECT * FROM villes WHERE ville_slug = '$city'");
    $city_coordonate = $req->fetch();
    return $city_coordonate;
}

// ville patients
function city (){
    global $db;

    $print = $_GET['print'];
    $req = $db->query("SELECT * FROM patients INNER JOIN users ON patients.users_id = users.id WHERE users.user_key = '$print' ");
    $city_patient = $req->fetch();

    $city = $city_patient['address_city'];

    $req = $db->query("SELECT * FROM villes WHERE ville_slug = '$city'");
    $city_coordonate = $req->fetch();
    return $city_coordonate;
}