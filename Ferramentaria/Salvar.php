<?php
        require_once("../Conexao.php");
    if(isset($_POST['SalvarBTN'])){
        $Cod=$_POST['Codigo'];
        $Desc=$_POST['Descricao'];
        $Local=$_POST['Local'];
        $Tipo=$_POST['Tipo'];
        $Secao=$_POST['Secao'];

        $SQL="SELECT * FROM ferramentaria WHERE Codigo='$Cod'";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $QTD=$Requisicao->num_rows;

        if($QTD>0){
            echo 'Produto Já Cadastrado';
        }else{
            $SQLInsert="INSERT INTO ferramentaria (Codigo,Descricao,Local,Tipo,Secao) VALUES ('$Cod','$Desc','$Local','$Tipo','$Secao')";
            $RequisicaoInsert=mysqli_query($mysqli,$SQLInsert);
        }
        header('location:index.php');
    }
?>