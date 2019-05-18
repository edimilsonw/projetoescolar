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
$query_query_endereco = "SELECT * FROM matricula inner join aluno on matricula.m_id_aluno=aluno.a_id inner join turmas on matricula.m_id_turma=turmas.idTurmas ORDER BY turmas.periodo, aluno.a_end, aluno.a_nome";
$query_endereco = mysql_query($query_query_endereco, $conexao) or die(mysql_error());
$row_query_endereco = mysql_fetch_assoc($query_endereco);
$totalRows_query_endereco = mysql_num_rows($query_endereco);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTA TRANSPORTE - FRANCISCA DURAN COSTA</title>
</head>

<body>
<table border="1">
  <tr>
    <td>ALUNO</td>
    <td>ENDEREÇO</td>
    <td>TURMA</td>
    <td>Período</td>
    <td>situacao</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_query_endereco['a_nome']; ?></td>
      <td><?php echo $row_query_endereco['a_end']; ?></td>
      <td><?php echo $row_query_endereco['serie']; ?></td>
      <td><?php echo $row_query_endereco['periodo']; ?></td>
      <td><?php echo $row_query_endereco['situacao']; ?></td>
    </tr>
    <?php } while ($row_query_endereco = mysql_fetch_assoc($query_endereco)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($query_endereco);
?>
