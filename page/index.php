<?php
require '../composer/vendor/autoload.php';
require '../database/Database.php';
require '../requetes/patient.php';
require '../requetes/practitian.php';
require '../requetes/admin.php';
require '../requetes/communication.php';
require '../requetes/user.php';
require '../requetes/cities.php';

session_start();

if (isset($_GET['p'])){
    $page = $_GET['p'];
}

$loader = new Twig_Loader_Filesystem(__DIR__);
$twig = new Twig_Environment($loader, [
    'cache' => false
]);

if (isset($_GET['print'])) {
    $print = unique_patient($_GET['print']);
    $statut_print = statut_patient($_GET['print']);
    $admin_get = admin_get($_GET['print']);
    if ($_GET['p'] !== "unique_patient"){
        $city_practitian = city_practitian_all();
        $city_patient= city_patient();

    }else{
        $city_practitian = "rien";
        $city_patient = "rien";

    }



}else{$print = "rien";
    $statut_print = "rien";
    $admin_get = "rien";
    $city_practitian = "rien";
    $city_patient = "rien";

}

if (isset($_GET['print'])){
    $recommanded_practitian = practitian_patient($print['id']);
}else{$recommanded_practitian = "rien";}

if (isset($_GET['edit'])){
    $edit = $_GET['edit'];
}else{$edit = "rien";}

if (isset($_GET['delete'])){
    $delete = $_GET['delete'];
}else{$delete = "delete";}

if (isset($_GET['add'])){
    $add = $_GET['add'];
}else{$add = "add";}


switch ($page) {
    case $_GET['p'];
        echo $twig->render($_SESSION['type'] . '/' . $_GET['p'] . '.twig', [

            // Session
            "type" => $_SESSION["type"],
            "user_patient" => user($_SESSION['table'], $_SESSION['user_id']),

            // COUNT USERS
            "count_patient" => number_patient(),
            "count_practitian" => number_practitian(),
            "count_admin" => number_admins(),

            // COMMUNICATION
            "communication" => communication(),

            // PATIENTS
            "patients" => patient(),
            //"adhesion" => adhesion(),
            "interview" => interview(),
            "unique_patient" => $print,
            "statut_patient" => $statut_print,
            "recommanded_practitian" => $recommanded_practitian,
            "city_patient" => $city_patient,

            //PRACTITIAN
            "city_practitian" => $city_practitian,
            "practitians" => practitian(),

            // ADMIN
            "admin_get" => $admin_get,

            // ERRORS
            "edit" => $edit,
            "delete" => $delete,
            "add" => $add,

            // GET PAGE
            "page" => $_GET['p']
        ]);
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404/404.twig');
        break;
}