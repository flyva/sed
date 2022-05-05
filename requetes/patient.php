<?php
// nombre de patients
function number_patient (){
    global $db;
    $req = $db->query("SELECT COUNT(*) FROM patients");
    $count_patient = $req->fetchColumn();
    return $count_patient;
}

// afficher tous les patients
function patient (){
    global $db;
    $req = $db->query("SELECT mail, first_name, last_name, avatar, phone, user_key FROM users INNER JOIN patients ON users.id = patients.users_id");
    $patient = $req->fetchAll();

    return $patient;
}

// adhésions des patients
function adhesion (){
    global $db;
    $req = $db->query("SELECT * FROM adhesions");
    $adhesion = $req->fetchAll();
    return $adhesion;
}

// entretiens des patients
function interview (){
    global $db;
    $req = $db->query("SELECT * FROM interviews INNER JOIN patients ON interviews.patients_id = patients.id");
    $interview = $req->fetchAll();

    return $interview;
}

// afficher le patient avec la clé
function unique_patient ($key){
    global $db;
    $req = $db->query("SELECT * FROM users INNER JOIN patients ON patients.users_id = users.id WHERE users.user_key = '$key'");
    $unique_patient = $req->fetch();
    unset($unique_patient['password']);
    unset($unique_patient['2']);

    return $unique_patient;
}

// Statut patients
function statut_patient ($user_key){
    global $db;
    $req = $db->query("SELECT * FROM users  WHERE user_key = '$user_key'");
    $user = $req->fetch();

    $req = $db->query("SELECT * FROM statut_patient INNER JOIN patients ON statut_patient.patients_id = patients.id WHERE patients.users_id =".$user['id']);
    $statut_patient = $req->fetchAll();

    return $statut_patient;
}