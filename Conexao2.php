<?php

$hostname="localhost";
$bancodedados="u413889508_Ciopaer";
$usuario="u413889508_Ciopaer";
$senha="07021998Mfcj@";

$mysqli=new mysqli($hostname,$usuario,$senha,$bancodedados);
if($mysqli->connect_errno){
    echo "Falha ao Conectar: (". $mysqli->connect_errno .") ". $mysqli->connect_error;
}

?>