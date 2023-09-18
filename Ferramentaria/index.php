<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js" defer></script>
</head>
<body id='Corpo'>

    <?php
        require_once("../Conexao.php");
        require_once("../Cabecalho/Cabecalho.php");

        $SQLSecoes='SELECT * FROM secoes';
        $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);
    
        if(isset($_POST['PesquisarBTN'])){
            $PesquisarTXT=$_POST['Pesquisar'];
            $Secao=$_POST['SecaoTXT'];
            $Grupo=$_POST['GrupoTXT'];

            if($Grupo=='Todas'){
                $Grupo='';
            }
    
            if($Secao==''){
                $Secao='';
            }

                if($Grupo=='Todas' && $Secao=='Todas'){
                    $SQLPesquisa="SELECT * FROM ferramentaria WHERE Descricao LIKE '%$PesquisarTXT%'";
                }else if($Grupo!='Todas' && $Secao=='Todas'){
                    $SQLPesquisa="SELECT * FROM ferramentaria WHERE Descricao LIKE '%$PesquisarTXT%' AND Tipo LIKE '%$Grupo%' ";
                }else if($Grupo=='Todas' && $Secao!='Todas'){
                    $SQLPesquisa="SELECT * FROM ferramentaria WHERE Descricao LIKE '%$PesquisarTXT%' AND Secao LIKE '%$Secao%'";
                }else if($Grupo!='Todas' && $Secao!='Todas'){
                    $SQLPesquisa="SELECT * FROM ferramentaria WHERE Descricao LIKE '%$PesquisarTXT%' AND Secao LIKE '%$Secao%' AND Tipo LIKE '%$Grupo%' ";
                }

                $RequisicaoPesquisa=mysqli_query($mysqli,$SQLPesquisa);

    
        }else{
            
            $SQLPesquisa="SELECT * FROM ferramentaria";
            $RequisicaoPesquisa=mysqli_query($mysqli,$SQLPesquisa);
        }
    ?>
    <div>
        <form action="" method="post" id='Formulario'>
            <input type="text" name='Pesquisar' id="PesquisarTXT" placeholder='Pesquisar'>
            <button type="submit" name='PesquisarBTN' id='PesquisarBTN'>Pesquisar</button>
            <button class='FiltrosBTN' type='button' onclick='Filtros()' id='FiltrosBTN'>Mais Filtros</button>
            <div id="FiltrosDIV">
                <select name="SecaoTXT" id="SecaoTXT" class='Filtro'>
                    <option>Todas</option>
                    <?php

                        while($Secao=$RequisicaoSecoes->fetch_assoc()){
                            echo '<option>'.$Secao['Secao'].'</option>';
                        }
                    ?>
                </select>

                <select name="GrupoTXT" id="GrupoTXT" class='Filtro'>
                    <option>Todas</option>
                    <option>Peças</option>
                    <option>Ferramentas</option>
                    <option>Materiais Permanentes</option>
                    <option>Consumíveis</option>
                </select>
            </div>
        </form>
    </div>
    <div id='TabelaDIV'>
        <div id='MenuTabela'>
            <button id='Adicionar' onclick='AbrirModal()'><img src="imgs/adicionar.png" title='Adicionar'></button>
            <button id='Editar' onclick='DecisaoEdit()'></button>
            <button id='Remover' onclick='Deletar()'><img src="imgs/remover.png" title='Remover Linhas Selecionadas'></button>
        </div>
        <table id='Tabela' class='Tabela'>
            <thead>
                <th></th>
                <th>Id</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Local</th>
                <th>QTD</th>
                <th>Tipo</th>
                <th>Secao</th>
            </thead>
            <?php

                if(isset($RequisicaoPesquisa)){
                    while($Pesquisar=$RequisicaoPesquisa->fetch_assoc()){
                        if($Pesquisar['QTD']>=5){
                            echo '<tr name="Linha" style="background:white;">';
                        }else if($Pesquisar['QTD']<5 && $Pesquisar['Tipo']=='Consumíveis'){
                            echo '<tr name="Linha" style="background:rgb(251, 255, 195);">';
                        }
                            echo "<td><input type='checkbox' name='LinhaCB'></td>";
                            echo "<td><input type='text' value='".$Pesquisar['ID']."' name='LinhaID' readonly></td>";
                            echo "<td><input type='text' value='".$Pesquisar['Codigo']."' name='LinhaCOD' readonly></td>";
                            echo "<td><input type='text' value='".$Pesquisar['Descricao']."' name='LinhaDesc' readonly></td>";
                            echo "<td><input type='text' value='".$Pesquisar['Local']."' name='LinhaLocal' readonly></td>";
                            echo "<td><input type='number' value='".$Pesquisar['QTD']."' name='LinhaQTD' readonly></td>";
                            echo "<td><select name='LinhaTipo' tabindex='-1' aria-disabled='true' readonly='true'>";
                            echo '<option>'.$Pesquisar['Tipo'].'</option>';
                                echo '<option>Serviço</option>';
                                echo '<option>Peças</option>';
                                echo '<option>Materiais Permanetes</option>';
                                echo '<option>Consumiveis</option>';
                            echo "</select></td>";
                            echo "<td><select name='LinhaSecao' tabindex='-1' aria-disabled='true' readonly='true'>";
                                    echo '<option>'.$Pesquisar['Secao'].'</option>';
                                    $SQLSecoes='SELECT * FROM secoes WHERE Secao!="'.$Pesquisar['Secao'].'"' ;
                                    $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

                                    while($Secao=$RequisicaoSecoes->fetch_assoc()){
                                        echo '<option>'.$Secao['Secao'].'</option>';
                                    }
                            echo "</select></td>";
                        echo '</tr>';
                    }
                }
            ?>
        </table>
        
    </div>
    <div id='Fundo'>
        <div id='Modal'>
            <button id='Fechar' onclick='FecharModal()'><img src="imgs/Fechar.png" alt=""></button>
                <form action="Salvar.php" method="post" id='AdicionarForm'>
                <label>Código:</label><input type="text" name='Codigo'>
                <label>Descrição do Produto:*</label><input type="text" name='Descricao' style="height:200px">
                <label>Local Atual:*</label><input type="text" name='Local'>
                <label>Quantidade:*</label><input type="number" name='QTD'>

                <label>Grupo:*</label><select name="Tipo" id="TipoTXT">
                            <option>Peças</option>
                            <option>Ferramentas</option>
                            <option>Materiais Permanentes</option>
                            <option>Consumíveis</option>
                        </select>

                <label>Secao:*</label><select name="Secao" id="SecaoTXT">
                            <?php
                                $SQLSecoes='SELECT * FROM secoes';
                                $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

                                while($Secao=$RequisicaoSecoes->fetch_assoc()){
                                    echo '<option>'.$Secao['Secao'].'</option>';
                                }
                            ?>
                        </select>
                    <input type="submit" value="Adicionar" name='Adicionar' class="SubmitBTN">
                </form>
        </div>
    </div>

</body>
</html>