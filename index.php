<?
    require_once("conexao.php");
?>
<html>
    <head>
        <title>Estorno 1199</title>
    </head>
    <body>
        <center>
            <h1>Estorno de report do 1199</h1>
            <form action='index.php' method='post'>
                <table>
                    <tr>
                        <td>Op:<input type='text' name='op'></td>
                        <td>Data:<input type='text' name='data'></td>
                        <td><input type='submit' value='Consultar'></td>
                    </tr>
                </table>
            </form>
        </center>
        <?
            if((!isset($_POST['data']) && !isset($_POST['op'])) || ($_POST['data']=="") || ($_POST['op']=="")){
                echo "<center>Campo Data e/ou Op não informado!</center>";
            }
            else{
                $dt=explode("/",$_POST['data']);
                $dia=$dt[2]."-".$dt[1]."-".$dt[0];
                $sql2="select MESPARCE_C,ANOPARCE_C from t0103 where Cdempre_ge='1'";
                $res2=mssql_query($sql2);
                while($resposta=mssql_fetch_array($res2)){
                    $mes[]=$resposta[0];
                    $ano[]=$resposta[1];
                }
                $mes[0] = (strlen($mes[0])==1) ? "0".$mes[0] : $mes[0];
                if($mes[0]==$dt[1] and $ano[0]==$dt[2]){
                    $op=$_POST['op'];
                    $sql="select * from t0096 with(nolock) where lotemce_ce='".$op."' and datmce_ce0='".$dia."' and codtipesmc='e'";
                    $res=mssql_query($sql);
                    while($linha=mssql_fetch_array($res)){
                        echo "<center>
                                    <form action='excluir.php' method='post'>
                                        <input type='hidden' name='data' value='".$dia."'>
                                        <input type='hidden' name='op' value='".$linha['lotemce_ce']."'>
                                        <input type='hidden' name='qtd_ant' value='".$linha['qtmce_ce05']."'>
                                        <input type='hidden' name='item' value='".$linha['coditmce_c']."'>
                                        <table>
                                            <tr>
                                                <td>Item reportado:</td>
                                                <td><b>".$linha['coditmce_c']."</b></td>
                                            </tr>
                                            <tr>
                                                <td>Quantidade total reportada:</td>
                                                <td><b>".$linha['qtmce_ce05']."</b></td>
                                            </tr>
                                            <tr>
                                                <td>Quantidade para cancelar:</td>
                                                <td><input type='text' name='qtde'></td>
                                            </tr>
                                            <tr>
                                                <td colspan='2' align='center'><input type='submit' value='Excluir'></td>
                                            </tr>
                                        </table>
                                    </form>
                                </center>";
                    }
                }
                else{
                    echo "<center>Não foi possível estornar devido ao parâmetro do sistema, favor contatar Sr. Deusdaci (PCP) no ramal 9437!</center>";
                }
            }
        ?>		
    </body>
</html>
