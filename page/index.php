<?php
setlocale(LC_CTYPE, 'fr_FR.UTF-8');
header( 'content-type: text/html; charset=utf-8' );
?>
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

if (isset($_GET['id'])) {
    $unique_patient = unique_patient($_GET['id']);
    $statut_patients = statut_patient($_GET['id']);
   // $admin_get = admin_get($_GET['id']);
    $interviews = interview($_GET['id']);
    $recommanded_practitian = practitian_patient($_GET['id']);
    $city_practitian = city_practitian_all();
    $city_patients = city_patient($_GET['id']);
    $practitian =practitian();
    $id = $_GET['id'];

}else{$unique_patient = "rien";
    $statut_patients = "rien";
   // $admin_get = "rien";
    $city_practitian = "rien";
    $city_patients = "rien";
    $interviews = "riens";
    $recommanded_practitian = "rien";
    $practitian = "rien";
    $id = "rien";

}
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
            "interview" => $interviews,
            "unique_patient" => $unique_patient,
            "statut_patient" => $statut_patients,
            "recommanded_practitian" => $recommanded_practitian,
            "city_patient" => $city_patients,

            //PRACTITIAN
            "city_practitian" => $city_practitian,
            "practitians" => $practitian,

            // ADMIN
           // "admin_get" => $admin_get,

            // ERRORS
            "edit" => $edit,
            "delete" => $delete,
            "add" => $add,

            // GET PAGE
            "page" => $_GET['p'],
            "id" => $id
        ]);
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404/404.twig');
        break;
}