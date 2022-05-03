<?php
// nombre de patients
function number_practitian (){
    global $db;
    $req = $db->query("SELECT COUNT(*) FROM practitian");
    $count_practitian = $req->fetchColumn();
    return $count_practitian;
}