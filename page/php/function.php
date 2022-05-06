<?php
function delete($table, $id){
global $db;
// Supprimer

    $req = $db->query('DELETE FROM '. "$table" .' WHERE id = ' .$id);
}

function delete_foreach($table, $id){
    require "../../database.php";

// Supprimer

    $req = $db->query('DELETE FROM '. "$table" .' WHERE id = ' .$id);
}


function update_table($table, $id,  $parameter) {
global $db;
    $parameter_prepare = "";
    foreach ($parameter as $index => $params):

        $parameter_prepare .= $params." = :".$params;
        if (count($parameter)-1 == $index){
            $parameter_prepare .= "";
        }else{
            $parameter_prepare .= " , ";
        }

    endforeach;

    foreach ($parameter as $index => $params):
        $parameter_execute["$params"] = $_POST["$params"];
    endforeach;


    $req = $db->prepare('UPDATE '.$table.' SET '.$parameter_prepare.' WHERE id ='.$id);
    $req->execute($parameter_execute);

}

function insert_table($table, $parameter){
global $db;
    $parameter_prepare = "";
    foreach ($parameter as $index => $params):

        $parameter_prepare .= $params." = :".$params;
        if (count($parameter)-1 == $index){
            $parameter_prepare .= "";
        }else{
            $parameter_prepare .= " , ";
        }

    endforeach;

    foreach ($parameter as $index => $params):
        $parameter_execute["$params"] = $_POST["$params"];
    endforeach;

    $req = $db->prepare('INSERT INTO '.$table.' SET '.$parameter_prepare);
    $req->execute($parameter_execute);
}

function log_db($log, $id_user){
    require "../../database.php";

    $req = $db->prepare('INSERT INTO log SET label = :label, date = :date, id_user = :id_user');
    $req->execute([
        'label' => $log,
        'date' => date("d-m-Y H:i"),
        'id_user' => $id_user
    ]);
}


function get_db($table, $test){
    require "../../database.php";
    $req = $db->query('SELECT * FROM '.$table);

    $test = $req->fetch();
}

function curl_delete($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    echo $error;
}

?>

