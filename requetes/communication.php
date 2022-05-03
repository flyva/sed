<?php
// afficher la communication
function communication (){
    global $db;
    $req = $db->query("SELECT * FROM communication");
    $communication = $req->fetchAll();
    return $communication;
}