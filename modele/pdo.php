<?php

$json = file_get_contents('pdo.json');
$decode = json_decode($json, true);

try {

$pdo = new PDO("mysql:host:3306=".$decode['host'].";dbname=".$decode['dbName'].";charset=utf8;", $decode['user'], $decode['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->exec('SET NAMES utf8');
error_log($pdo);}
catch (Exception $e) {

    die('Erreur : ' . $e->getMessage());

}

?>