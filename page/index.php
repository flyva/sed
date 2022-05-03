<?php
require '../composer/vendor/autoload.php';
require '../database/Database.php';
require '../requetes/patient.php';
require '../requetes/practitian.php';
require '../requetes/admin.php';
require '../requetes/communication.php';

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

switch ($page) {
    case $_GET['p'];
        echo $twig->render($_SESSION['type'] . '/' . $_GET['p'] . '.twig', [
            "type" => $_SESSION["type"],
            "user_patient" => $user_patient,
            "count_patient" => number_patient(),
            "count_practitian" => number_practitian(),
            "count_admin" => number_admins(),
            "communication" => communication(),
            "patient" => patient(),
            "adhesion" => adhesion(),
            "interview" => interview()

        ]);
        break;
}