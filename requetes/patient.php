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
    $req = $db->query("SELECT * FROM patients INNER JOIN users ON patients.users_id = users.id");
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