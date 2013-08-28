<?
    require_once("conexao.php");
    $op=$_POST['op'];
    $dt=$_POST['data'];
    $dt2=explode("-",$dt);
    $mes=$dt2[1];
    $ano=$dt2[0];
    $qt=$_POST['qtde'];
    $item=$_POST['item'];
    if($qt<=$_POST['qtd_ant']){
        $sql="update t0096 set qtmce_ce05=qtmce_ce05-".$qt." where lotemce_ce='".$op."' and datmce_ce0='".$dt."' and codtipesmc='e'";
        $res=mssql_query($sql);
        $sql_118="update t0118 set qtentce_ce=qtentce_ce-".$qt.", salqtce_ce=salqtce_ce-".$qt." where coddepsal_='1199' and lotesal_ce='".$op."' and messalce_c='".$mes."' and anosalce_c='".$ano."' and coditsal_c='".$item."'";
        $res_118=mssql_query($sql_118);
        $status_sql="select stsordpro_ from t0122 where nrordpro_p='".$op."'";
        $status_res=mssql_query($status_sql);
        $status=mssql_fetch_array($status_res);
        if($status[0]=="T"){
            $sql2="update t0122 set qtusordpro=qtusordpro-".$qt.", stsordpro_='I' where nrordpro_p='".$op."'";
            $res2=mssql_query($sql2);
        }
        if($status[0]=="I"){
            $sql2="update t0122 set qtusordpro=qtusordpro-".$qt." where nrordpro_p='".$op."'";
            $res2=mssql_query($sql2);
        }

        echo"
        <html>
            <head>
                <title>Estorno 1199</title>
            </head>
            <body>
                <center>
                    <h1>Estorno de report do 1199</h1>
                    Report cancelado com sucesso!<br>
                    <a href='index.php'>Voltar</a>
                </center>
            </body>
        </html>
        ";

    }
    else{
        echo "
        <html>
            <head>
                <title>Estorno 1199</title>
            </head>
            <body>
                <center>
                    <h1>Estorno de report do 1199 não concluido</h1>
                    Quantidade maior do que estoque!<br>
                    <a href='index.php'>Voltar</a>
                </center>
            </body>
        </html>
        ";
    }
?>
