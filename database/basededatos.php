<?php
function conectarBD(){
    $mysqli= new mysqli('127.0.0.1','root','','laravel');
    if ($mysqli->connect_errno){
        die($mysqli->connect_errno);
    }
}
?>