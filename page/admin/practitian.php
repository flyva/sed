<?php

require '../../database/Database.php';

global $db;
$req = $db->query("SELECT * FROM practitian 
    INNER JOIN users ON practitian.users_id = users.id WHERE users.id = 5");
$practitian = $req->fetch();
unset($practitian['password'], $practitian['11']);
$array = array(
    "type" => $practitian['type'],
    "speciality" => $practitian['speciality'],
    "description" => $practitian['description'],
    "address_street" => $practitian['address_street'],
    "address_cp" => $practitian['address_cp'],
    "address_city" => $practitian['address_city'],
    "url_web" => $practitian['url_web'],
    "users_id" => $practitian['users_id'],
    "mail" => $practitian['mail'],
    "first_name" => $practitian['first_name'],
    "last_name" => $practitian['last_name'],
    "avatar" => $practitian['avatar'],
    "phone" => $practitian['phone']
);
var_dump($array);

$json_practitian = json_encode($array);

echo $json_practitian;
?>