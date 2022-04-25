<?php
session_start();

try{
    $pod = new PDO("mysql:dbname=classificados;host=localhost", "root", "");
}catch(PDOException $e){
    echo "FALHOU!".$e->getMessage();
    exit;
}