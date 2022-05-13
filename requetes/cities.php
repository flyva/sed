<?php
// ville patients
function city_patient (){
    global $db;
    $req = $db->query("SELECT patients.id as patients_id, address_street, address_cp, address_city, users_id, mail, first_name, last_name, avatar, ville_slug, ville_longitude_deg as longitude, ville_latitude_deg as latitude FROM patients 
    INNER JOIN users ON patients.users_id = users.id
    INNER JOIN villes ON patients.address_city = villes.ville_nom_reel");
    $city_patients = $req->fetch();

    return $city_patients;
}

// ville practitian
function city_practitian_all (){
    global $db;

    $req = $db->query("SELECT practitian.id as practitian_id, speciality, description, address_street, address_cp, address_city, url_web, users_id, mail, first_name, last_name, avatar, ville_slug, ville_longitude_deg as longitude, ville_latitude_deg as latitude, type FROM practitian 
    INNER JOIN users ON practitian.users_id = users.id
    INNER JOIN villes ON practitian.address_city = villes.ville_nom_reel");
    $city_practitian = $req->fetchAll();


    return $city_practitian;
}