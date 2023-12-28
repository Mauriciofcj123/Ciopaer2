<?php
        session_start();

function ContaBloqueada($Usuario,$Conn){
        $Bloqueada=true;

        if(!isset($_SESSION['QTD'])){
                $_SESSION['QTD']=3;
        }

                $SQL="SELECT * FROM cadastros where BINARY Loggin='$Usuario' AND Bloqueada=1 LIMIT 1";
                $Requisicao=mysqli_query($Conn,$SQL);
                $Quantidade=$Requisicao->num_rows;

                if($Quantidade==1){
                        $Registro=$Requisicao->fetch_assoc();
                        $DataAtual=new DateTime();
                        $DA=$DataAtual->format('Y-m-d');
                        $DataDesbloq=new DateTime($Registro['DataBloq']);
                        $DD=$DataDesbloq->format('Y-m-d');
                        $DataDif=date_diff($DataAtual,$DataDesbloq);

                        if($DataDif->days<=0){
                                $Bloqueada=false;

                                $SQLBloq="UPDATE cadastros SET Bloqueada=0 WHERE Loggin='$Usuario'";
                                $RequisicaoBloq=mysqli_query($Conn,$SQLBloq);
                        }else{
                                $Bloqueada=true;
                        }
                        
                }else{
                        $Bloqueada=false;
                }

                return $Bloqueada;
}

function VerificarUsuario($Usuario,$Conn){
        $SQL="SELECT * FROM cadastros where BINARY Loggin='$Usuario' LIMIT 1";
        $Requisicao=mysqli_query($Conn,$SQL);
        $Quantidade=$Requisicao->num_rows;
        $Existe=false;

        if($Quantidade==1){
                $Existe=true;
        }else{
                $Existe=false;
        }

        return $Existe;
}
function VerificarSenha($Senha,$Hash){
        $Correta=false;

        if(password_verify($Senha,$Hash)){
                $Correta=true;
        }else{
                $Correta=false;
        }

        return $Correta;        
        
}
function DefinirPrioridade($Patente,$Nome,$Sobrenome,$Prioridade,$NomeUser){
                if($Patente=="Sem Patente"){

                $_SESSION["Nome"]=$Nome." ".$Sobrenome;
                $_SESSION['ADM']=$Prioridade;
                $_SESSION['Loggin']=$NomeUser;

                }else{

                $_SESSION["Nome"]=$Sobrenome;
                $_SESSION['ADM']=$Prioridade;
                $_SESSION['Loggin']=$NomeUser;
                }

                $_SESSION['QTD']=3;
                header('Location: ../Inicial/index.php');
        
}



        if(isset($_POST['LogarBTN'])){
             include_once("../Conexao.php");
             $Erro='';


            if(!empty($_POST['Usuario']) && !empty($_POST['Senha'])){
                $Usuario=mysqli_escape_string($mysqli, $_POST['Usuario']);
                $Senha=mysqli_escape_string($mysqli, $_POST['Senha']);
    
                        if(ContaBloqueada($Usuario,$mysqli)==false){
                                if(VerificarUsuario($Usuario,$mysqli)){
                                        $SQL="SELECT * FROM cadastros where BINARY Loggin='$Usuario' LIMIT 1";
                                        $Requisicao=mysqli_query($mysqli,$SQL);
                                        $Linha=$Requisicao->fetch_assoc();

                                        if(VerificarSenha($Senha,$Linha['Senha'])){
                                                DefinirPrioridade($Linha['Patente'],$Linha['Nome'],$Linha['Sobrenome'],$Linha['Admin'],$Linha['Loggin']);
                                        }else{
                                                echo '<a href="../RecuperarConta/index.php">Esqueci a Senha</a>';

                                                $_SESSION['QTD']--;
                                
                                                if($_SESSION['QTD']==2){
                                                    $Erro="Usuario ou senha incorretos. ";
                                                }else if($_SESSION['QTD']==1){
                                                    $Erro="A Proxima tentativa incorreta irá bloquear essa conta.";
                                                }else{
                                                        $DataAtual=new DateTime();
                                                        $DA=$DataAtual->format('Y-m-d');
                                                        $DataNova=date('Y-m-d',strtotime($DA."+2 days"));
                                                        $SQLBloq="UPDATE cadastros SET Bloqueada=1, DataBloq='$DataNova' WHERE Loggin='$Usuario'";
                                                        $RequisicaoBloq=mysqli_query($mysqli,$SQLBloq);
                                
                                                    $Erro="Conta bloqueada temporariamente durante 24 horas.";
                                                }
                                                
                                            }
                                }else{
                                        $Erro="Usuario ou senha incorretos. ";
                                }
                        }else{
                                echo '<a href="../RecuperarConta/index.php">Esqueci a Senha</a><br>';
                                $Erro="Conta bloqueada temporariamente durante 24 horas.";
                        }
                }else{
                    $Erro="Campos Obrigatórios Faltando.";
                }
        }

    ?>