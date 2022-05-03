<?php require_once '../../database/Database.php'; ?>
<?php if (isset($_POST['submit_login']) AND !empty($_POST['submit_login'])) {

    $query = "SELECT * FROM users WHERE mail = '".$_POST['mail']."'";
    $req = $db->query($query);
    $user = $req->fetch();

    $req = $db->query("SELECT * FROM admin WHERE users_id =".$user['id']);
    $admin = $req->fetch();

    $req = $db->query("SELECT * FROM patients WHERE users_id =".$user['id']);
    $patient = $req->fetch();

    $req = $db->query("SELECT * FROM practitian WHERE users_id =".$user['id']);
    $practitian = $req->fetch();

    if (password_verify($_POST['password'], $user['password']) == 1){
        session_start();
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["full_name"] =$user['last_name']." ".$user['first_name'];
       if ($admin['id'] != null){
           header('location:../../page/index.php?p=admin');
           $_SESSION["type"] = "admin";
           $_SESSION["table"] = "admin";
       }elseif ($patient['id'] != null){
           header('location:../../page/index.php?p=patient');
           $_SESSION["type"] = "patient";
           $_SESSION["table"] = "patients";
       }elseif ($practitian['id'] != null){
           header('location:../../page/index.php?p=practitian');
           $_SESSION["type"] = "practitian";
           $_SESSION["table"] = "practitian";
       }
    }
    else{
        $error = 'Identifiant Incorrect';
        header('location:/login.php?error=1');
    }
}


?>