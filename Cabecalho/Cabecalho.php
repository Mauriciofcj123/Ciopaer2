
<?php
        echo '<div class="_cabecalho">';
        echo '<div>';
            session_start();

            if(isset($_SESSION["Nome"]))
            {
                echo "<p class='_LogTexto'> Seja Bem Vindo ".$_SESSION['Nome']."</p><br><br>";
                echo '<input type="button" value="Sair" class="_Sair" onClick="window.location.href=\'../Cabecalho/Sair.php\'">';
                echo "<input type='text' value='".$_SESSION['Nome']."' id='NomeUsuario' readonly style='visibility:hidden;position:relative;'></input>";
            } else{
                echo "<a class='_Sair'  href='../Loggin/index.php'>Entrar</a>";
            }
        echo '</div>';
        echo '<div class="_Notificacoes"></div>';
        echo '<div><img src="../Cabecalho/Imgs/Logo.png"></div>';
        echo '</div>';  

        if(isset($_SESSION["Nome"]) && isset($_SESSION['ADM'])){
            if($_SESSION['ADM']==1){
                echo '<div id="_header">
                <nav id="_nav">
                <button id="_BTNMobile">Menu</button>
                <ul id="_Menu">
                    <li><a href="../Inicial/index.php">Inicio</a></li>
                    <li><a href= "../ControleLib/index.php">Controle</a></li>
                    <li><a href="../DeshBoards/index.php">Deshboard</a></li>
                </ul>
                </nav>
                </div>';

            }else{
                echo '<div id="_header">
                <nav id="_nav">
                <button id="_BTNMobile">Menu</button>
                <ul id="_Menu">
                    <li><a href="../Inicial/index.php">Inicio</a></li>
                    <li><a href= "../ControleLib/index.php">Controle</a></li>
                </ul>
                </nav>
                </div>';
            }

        }else{
            echo '<div id="_header">
            <nav id="_nav">
            <button id="_BTNMobile">Menu</button>
            <ul id="_Menu">
                <li><a href="../Inicial/index.php">Inicio</a></li>
                <li><a href= "../ControleLib/index.php">Controle</a></li>
            </ul>
            </nav>
            </div>';
        }
    ?>