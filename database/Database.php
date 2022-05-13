<?php
global $db;
$db = new PDO('mysql:host=localhost:3306;dbname=zebres_sed', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>
