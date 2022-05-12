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
    $req = $db->query("SELECT users.id as users_id, mail, first_name, last_name, avatar, phone, user_key, address_city, expiration_date, address_street, address_cp, patients.id as patients_id, date FROM users INNER JOIN patients ON users.id = patients.users_id
                                INNER JOIN adhesions ON users.id = adhesions.users_id 
                                INNER JOIN interviews ON interviews.patients_id = patients.id LIMIT 1
");
    $patient = $req->fetchAll();

    return $patient;
}

// adhésions des patients
//function adhesion ($user_id){
  //  global $db;
    //$req = $db->query("SELECT * FROM adhesions WHERE users_id = ".$user_id);
    //$adhesion = $req->fetchAll();
    //return $adhesion;
//}

// entretiens des patients
function interview ($users_id){
    global $db;

    $req = $db->query("SELECT interviews.id as interviews_id, date, subject, message, url, situation, statut, patients_id, admin_id, time, last_name, first_name FROM interviews INNER JOIN patients ON patients.users_id = '$users_id'
    LEFT JOIN admin ON interviews.admin_id = admin.id
    LEFT JOIN users ON admin.users_id = users.id");
    $interview = $req->fetchAll();

    return $interview;
}

// afficher le patient avec la clé
function unique_patient ($users_id){
    global $db;
    $req = $db->query("SELECT * FROM users INNER JOIN patients ON patients.users_id = users.id WHERE users.id = '$users_id'");
    $unique_patient = $req->fetch();
    unset($unique_patient['password']);
    unset($unique_patient['2']);

    return $unique_patient;
}

// Statut patients
function statut_patient ($users_id){
    global $db;

    $req = $db->query("SELECT statut_patient.id as statut_patient_id, date, subject, message, users_id, patients_id FROM statut_patient INNER JOIN patients ON statut_patient.patients_id = patients.id WHERE patients.users_id = '$users_id'");
    $statut_patient = $req->fetchAll();

    return $statut_patient;
}