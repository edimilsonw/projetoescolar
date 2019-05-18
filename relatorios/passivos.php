<?php require_once('../Connections/conexao.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



mysql_select_db($database_conexao, $conexao);
$query_query_passivos = "SELECT * FROM passivos inner join escola on passivos.p_escola=escola.idEscola ";
$query_passivos = mysql_query($query_query_passivos, $conexao) or die(mysql_error());
$row_query_passivos = mysql_fetch_assoc($query_passivos);
$totalRows_query_passivos = mysql_num_rows($query_passivos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listagem Passivo</title>
</head>

<body>
<p align="center"><strong>LISTAGEM GERAL PASSIVO</strong></p>
<p><a href="javascript: abre('relatorios/addPassivo.php?escola=<?php echo $row_query_passivos['idEscola']; ?>','GET','conteudo');">[+] Adicionar</a></p>
<table border="1">
  <tr>
    <td>Nº</td>
    <td>NOME</td>
    <td>ANO</td>
    <td>ESCOLA</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_query_passivos['p_num']; ?></td>
      <td><a href="relatorios/editarPassivo.php?id=<?php echo $row_query_passivos['p_id']; ?>"><?php echo $row_query_passivos['p_nome']; ?></a></td>
      <td><?php echo $row_query_passivos['p_ano']; ?></td>
      <td><?php echo $row_query_passivos['e.nome']; ?></td>
    </tr>
    <?php } while ($row_query_passivos = mysql_fetch_assoc($query_passivos)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($query_passivos);
?>
