<?php

$hostname="localhost";
$bancodedados="u534616872_ciopaer";
$usuario="root";
$senha="";

$mysqli=new mysqli($hostname,$usuario,$senha,$bancodedados);
if($mysqli->connect_errno){
    echo "Falha ao Conectar: (". $mysqli->connect_errno .") ". $mysqli->connect_error;
}

?>