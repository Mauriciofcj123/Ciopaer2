<?php

$hostname="localhost";
$bancodedados="u534616872_ciopaer";
$usuario="u534616872_Ciopaer";
$senha="07021998Mfcj@";

$mysqli=new mysqli($hostname,$usuario,$senha,$bancodedados);
if($mysqli->connect_errno){
    echo "Falha ao Conectar: (". $mysqli->connect_errno .") ". $mysqli->connect_error;
}

?>