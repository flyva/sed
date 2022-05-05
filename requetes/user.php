<?php
function user ($table, $user_id) {
    global $db;
    $req = $db->query("SELECT * FROM ".$table." INNER JOIN users on users_id =".$user_id);
    $user_patient = $req->fetch();

    unset($user_patient['password']);
    unset($user_patient['5']);


    return $user_patient;
}