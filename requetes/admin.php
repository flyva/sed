<?php
// nombre des admins
function number_admins (){
    global $db;
    $req = $db->query("SELECT COUNT(*) FROM admin");
    $count_admins = $req->fetchColumn();
    return $count_admins;
}