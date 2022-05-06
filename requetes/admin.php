<?php
// nombre des admins
function number_admins (){
    global $db;
    $req = $db->query("SELECT COUNT(*) FROM admin");
    $count_admins = $req->fetchColumn();
    return $count_admins;
}

// admin via $_GET
function admin_get ($user_key){
    global $db;
    $req = $db->query("SELECT * FROM users INNER JOIN patients WHERE users.user_key = '$user_key'");
    $user = $req->fetch();
    unset($user['password']);
    unset($user['2']);

    $req = $db->query("SELECT * FROM interviews WHERE patients_id = ".$user['id']);
    $interview = $req->fetch();

    $req = $db->query("SELECT mail, first_name, last_name, avatar, phone FROM users INNER JOIN admin ON admin.id=".$interview['admin_id']);
    $admin_get = $req->fetch();
    return $admin_get;
}