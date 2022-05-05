<?php
require '../composer/vendor/autoload.php';
require '../database/Database.php';
require '../requetes/patient.php';
require '../requetes/practitian.php';
require '../requetes/admin.php';
require '../requetes/communication.php';
require '../requetes/user.php';

session_start();

if (isset($_GET['p'])){
    $page = $_GET['p'];
}

$loader = new Twig_Loader_Filesystem(__DIR__);
$twig = new Twig_Environment($loader, [
    'cache' => false
]);

$req = $db->query("SELECT * FROM ".$_SESSION['table']." INNER JOIN users on users_id =".$_SESSION['user_id']);
$user_patient = $req->fetch();

if (isset($_GET['print'])){
    $print = unique_patient($_GET['print']);
}else{$print = "rien";}

if (isset($_GET['print'])){
    $statut_print = statut_patient($_GET['print']);
}else{$statut_print = "rien";}

switch ($page) {
    case $_GET['p'];
        echo $twig->render($_SESSION['type'] . '/' . $_GET['p'] . '.twig', [
            "type" => $_SESSION["type"],
            "user_patient" => user($_SESSION['table'], $_SESSION['user_id']),
            "count_patient" => number_patient(),
            "count_practitian" => number_practitian(),
            "count_admin" => number_admins(),
            "communication" => communication(),
            "patient" => patient(),
            "adhesion" => adhesion(),
            "interview" => interview(),
            "unique_patient" => $print,
            "statut_patient" => $statut_print

        ]);
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404/404.twig');
        break;
}