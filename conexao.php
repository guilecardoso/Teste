<?
  mssql_connect('192.168.1.1','sa','') or die ('erro ao conectar '.mssql_error());  //Base quente
  //mssql_connect('192.168.1.39','sa','') or die ('erro ao conectar '.mssql_error());  //Base teste
  mssql_select_db('SIAWDB') or die ('Base de dados não encontrada '.mssql_error());
?>
