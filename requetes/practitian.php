<?php
// nombre de patients
function number_practitian (){
    global $db;
    $req = $db->query("SELECT COUNT(*) FROM practitian");
    $count_practitian = $req->fetchColumn();
    return $count_practitian;
}

// afficher pratitian dans dossier patient
function practitian_patient ($users_id){
    global $db;
    $req = $db->query("SELECT recommanded_practitian.id as recommandeds_practitians_id, mail, last_name, first_name, avatar, phone, user_key, type, speciality, practitian.address_street, practitian.address_cp, practitian.address_city, url_web  FROM users INNER JOIN practitian ON users.id = practitian.users_id 
INNER JOIN recommanded_practitian ON recommanded_practitian.practitian_id = practitian.id
INNER JOIN patients ON recommanded_practitian.patients_id = patients.id WHERE patients.users_id ='$users_id'");
    $recommanded_practitian = $req->fetchAll();
    return $recommanded_practitian;
}

// afficher pratitian
function practitian ()
{
    global $db;
    $req = $db->query("SELECT mail, last_name, first_name, avatar, phone, user_key, type, speciality, address_street, address_cp, address_city, url_web, users_id  FROM users INNER JOIN practitian ON users.id = practitian.users_id");
    $practitian = $req->fetchAll();
    return $practitian;
}