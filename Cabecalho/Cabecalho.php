<?php
        echo '<div class="cabecalho">';
        echo '<div>';
            session_start();

            if(isset($_SESSION["Nome"]))
            {
                echo "<p class='LogTexto'> Seja Bem Vindo ".$_SESSION['Nome']."</p><br><br>";
                echo '<input type="button" value="Sair" class="Sair" onClick="window.location.href=\'Sair.php\'">';
            } else{
                echo "<a class='Sair'  href='../Loggin/index.php'>Entrar</a>";
            }
        echo '</div>';
        echo '<div><img src="../Cabecalho/Imgs/Logo.png"></div>';
        echo '</div>';  

        if(isset($_SESSION["Nome"]) && isset($_SESSION['ADM'])){
            if($_SESSION['ADM']==1){
                echo '<div class="Menu">
                <button id="MenuBTN">Menu</button>
                <ul>
                    <li><a href="../Inicial/index.php">Inicio</a></li>
                    <li><a href= "../MapaComponentes/MapaComponente.php">Mapa de Componentes</a></li>
                    <li>Relatórios
                        <ul>
                            <li><a href="../RelatorioDiarioLib/index.php">Relatórios Diário</a></li>
                        </ul>
                    </li>

                    <li>Controle
                        <ul>
                            <li><a href="/Horimetro/Horimetro.php">Horímetros</a></li>
                            <li><a href="">Estoque</a></li>
                        </ul>
                    </li>
                    <li><a href="">DeshBoard</a></li>
                </ul>
                </div>';
            }else{
                echo '<div class="Menu">
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../MapaComponentes/MapaComponente.php">Mapa de Componentes</a></li>
                    <li>Relatórios
                        <ul>
                            <li><a href="../RelatorioDiarioLib/index.php">Relatórios Diário</a></li>
                        </ul>
                    </li>

                    <li>Controle
                        <ul>
                            <li><a href="/Horimetro/Horimetro.php">Horímetros</a></li>
                        </ul>
                            <li><a href="">Estoque</a></li>
                    </li>
                </ul>
                </div>';
            }

        }else{
            echo '<div class="Menu">
                        <ul>
                            <li><a href="">Inicio</a></li>
                        </ul>
                </div>';
        }
    ?>