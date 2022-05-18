<?php
global $db;
$db = new PDO('mysql:host=localhost:3306;dbname=zebres_sed;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>
