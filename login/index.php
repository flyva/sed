<?php
require '../composer/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__);
$twig = new Twig_Environment($loader, [
    'cache' => false
]);

if (isset($_GET['error'])){
    echo $twig->render("login.twig", ["error" => $_GET['error']]);
}else{
    echo $twig->render("login.twig");
}

//$req = $db->query("SELECT * FROM patients INNER JOIN users on users_id = 3");
//$practitian = $req->fetch();