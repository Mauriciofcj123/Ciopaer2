<?php
    require_once("../Conexao.php");

    if(isset($_POST['Salvar'])){
        $ID=$_POST['ID'];
        $Cod=$_POST['Codigo'];
        $Desc=$_POST['Descricao'];
        $Local=$_POST['Local'];
        $QTD=$_POST['QTD'];
        $Tipo=$_POST['Tipo'];
        $Secao=$_POST['Secao'];

        $SQL="SELECT * FROM ferramentaria WHERE Codigo='$Cod'";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $QTD=$Requisicao->num_rows;

        if($QTD>0){
            $SQLUpdate="UPDATE ferramentaria SET Codigo='$Cod',Descricao='$Desc',Local='$Local',QTD='$QTD',Tipo='$Tipo',Secao='$Secao' WHERE ID='$ID'";
            $RequisicaoUpdate=mysqli_query($mysqli,$SQLUpdate);

        }else{
            $SQLInsert="INSERT INTO ferramentaria (Codigo,Descricao,Local,QTD,Tipo,Secao) VALUES ('$Cod','$Desc','$Local','$QTD','$Tipo','$Secao')";
            $RequisicaoInsert=mysqli_query($mysqli,$SQLInsert);
        }

    }

    if(isset($_POST['Adicionar'])){
        $Cod=$_POST['Codigo'];
        $Desc=$_POST['Descricao'];
        $Local=$_POST['Local'];
        $QTD=$_POST['QTD'];
        $Tipo=$_POST['Tipo'];
        $Secao=$_POST['Secao'];

        $SQLInsert="INSERT INTO ferramentaria (Codigo,Descricao,Local,QTD,Tipo,Secao) VALUES ('$Cod','$Desc','$Local','$QTD','$Tipo','$Secao')";
        $RequisicaoInsert=mysqli_query($mysqli,$SQLInsert);

        header('location: index.php');

    }

    if(isset($_POST['Deletar'])){
        $ID=$_POST['ID'];

        $SQLDelete="DELETE FROM ferramentaria WHERE ID='$ID'";
        $RequisicaoDelete=mysqli_query($mysqli,$SQLDelete);
    }



?>