<?php
require "../../database/Database.php";
require "../php/function.php";

if (isset($_GET['modify_user_patient'])){
    $array_parameter_users = array("last_name", "first_name", "phone", "mail");
    update_table("users", $_GET['id'] ,$array_parameter_users);

    $array_parameter_patients = array("birthdate", "address_street", "address_cp", "address_city");
    update_table("patients", $_GET['patients_id'], $array_parameter_patients);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&edit=1");
}

if (isset($_GET['add_statut'])){

    $_POST['patients_id'] = $_GET['patients_id'];

    $array_parameter_users = array("date", "subject", "message", "patients_id");
    insert_table("statut_patient", $array_parameter_users);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&add=1");
}

if (isset($_GET['edit_statut'])){

    $_POST['id'] = $_GET['id'];

    $array_parameter_users = array("date", "subject", "message");
    update_table("statut_patient", $_GET['statut_id'], $array_parameter_users);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&edit=1");
}

if (isset($_GET['delete_statut'])){

    delete("statut_patient", $_GET['statut_id']);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&delete=1");
}

if (isset($_GET['add_interviews'])){

    session_start();

    $_POST['patients_id'] = $_GET['patients_id'];
    $_POST['admin_id'] = $_SESSION['admin_id'];

    $array_parameter_users = array("date", "time", "subject", "message", "url", "situation", "statut", "admin_id", "patients_id");
    insert_table("interviews", $array_parameter_users);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&add=1");
}

if (isset($_GET['edit_interviews'])){

    session_start();

    $_POST['admin_id'] = $_SESSION['user_id'];

    $array_parameter_users = array("date", "time", "subject", "message", "url", "situation", "statut", "admin_id");
    update_table("interviews", $_GET['interviews_id'], $array_parameter_users);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&edit=1");
}

if (isset($_GET['delete_interviews'])){

    delete("interviews", $_GET['interviews_id']);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&delete=1");
}

if (isset($_GET['delete_recommandeds_practitians'])){

    delete("recommanded_practitian", $_GET['recommandeds_practitians_id']);

    header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&delete=1");
}

if (isset($_GET['practitian'])){
    $req = $db->query("SELECT practitian.id as id, users_id FROM practitian 
    INNER JOIN users ON practitian.users_id = users.id");
    $practitian = $req->fetchAll();

    foreach ($practitian as $practitian_id){
        $req = $db->query("SELECT patients.id as id FROM patients 
    INNER JOIN users ON patients.users_id = users.id WHERE users.id = ".$_GET['id']);
        $patient = $req->fetch();

        if (isset($_POST['practitian_'.$practitian_id['id']]) && $_POST['practitian_'.$practitian_id['id']] === "1"){
            $_POST['patients_id'] = $patient['id'];
            $_POST['practitian_id'] = $practitian_id['id'];

            $array_parameter_recommanded_practitian = array("patients_id", "practitian_id");
            insert_table("recommanded_practitian", $array_parameter_recommanded_practitian);
        }else{

        }

       header("Location: ../index.php?p=unique_patient&id=".$_GET['id']."&add=1");

    }
}