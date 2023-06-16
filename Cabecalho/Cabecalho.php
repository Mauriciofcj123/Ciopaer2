
<?php
        echo '<div class="cabecalho">';
        echo '<div>';
            session_start();

            if(isset($_SESSION["Nome"]))
            {
                echo "<p class='LogTexto'> Seja Bem Vindo ".$_SESSION['Nome']."</p><br><br>";
                echo '<input type="button" value="Sair" class="Sair" onClick="window.location.href=\'../Cabecalho/Sair.php\'">';
            } else{
                echo "<a class='Sair'  href='../Loggin/index.php'>Entrar</a>";
            }
        echo '</div>';
        echo '<div><img src="../Cabecalho/Imgs/Logo.png"></div>';
        echo '</div>';  

        if(isset($_SESSION["Nome"]) && isset($_SESSION['ADM'])){
            if($_SESSION['ADM']==1){
                echo '<div id="header">
                <nav id="nav">
                <button id="BTNMobile">Menu</button>
                <ul id="Menu">
                    <li><a href="../Inicial/index.php">Inicio</a></li>
                    <li><a href= "../Erro/index.php">Mapa de Componentes</a></li>
                    <li><a href= "../Relatorios/index.php">Relatórios</a></li>
                    <li><a href= "../Erro/index.php">Controle</a></li>
                    <li><a href="../Erro/index.php">DeshBoard</a></li>
                </ul>
                </nav>
                </div>';

            }else{
                echo '<div id="header">
                <nav id="nav">
                <button id="BTNMobile">Menu</button>
                <ul id="Menu">
                    <li><a href="../Inicial/index.php">Inicio</a></li>
                    <li><a href= "../Erro/index.php">Mapa de Componentes</a></li>
                    <li><a href= "../Relatorios/index.php">Relatórios</a></li>
                    <li><a href= "../Erro/index.php">Controle</a></li>
                </ul>
                </nav>
                </div>';
            }

        }else{
            echo '<div id="header">
            <nav id="nav">
            <button id="BTNMobile">Menu</button>
            <ul id="Menu">
                <li><a href="../Inicial/index.php">Inicio</a></li>
            </ul>
            </nav>
            </div>';
        }
    ?>