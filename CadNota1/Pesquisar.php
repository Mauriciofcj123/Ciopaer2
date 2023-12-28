<?php
    require_once('../Conexao.php');

    if(isset($_POST['PesquisarTXT'])){
        $Pesquisar=mysqli_real_escape_string($mysqli,$_POST['PesquisarTXT']);

        $SQLEmpresas="SELECT * FROM empresas WHERE Situacao='ATIVA' AND Nome LIKE '%$Pesquisar%'";
        $RequisicaoEmpresa=mysqli_query($mysqli,$SQLEmpresas);
        $Empresas=$RequisicaoEmpresa->fetch_all();
        $Quantidade=$RequisicaoEmpresa->num_rows;

        if($Quantidade>0){
            echo json_encode($Empresas);
        }else{
            $SQLEmpresas="SELECT * FROM empresas WHERE Situacao='ATIVA' AND Fantasia LIKE '%$Pesquisar%'";
            $RequisicaoEmpresa=mysqli_query($mysqli,$SQLEmpresas);
            $Empresas=$RequisicaoEmpresa->fetch_all();
            $Quantidade=$RequisicaoEmpresa->num_rows;

            echo json_encode($Empresas);

        }
    }
?>