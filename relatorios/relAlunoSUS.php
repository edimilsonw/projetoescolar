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
$escola = $_GET['escola'];
mysql_select_db($database_conexao, $conexao);
$query_sus = "SELECT * FROM matricula inner join aluno on m_id_aluno=aluno.a_id inner join turmas on m_id_turma=turmas.idTurmas where matricula.escola='$escola' order by 'matricula.m_id_turma'";
$sus = mysql_query($query_sus, $conexao) or die(mysql_error());
$row_sus = mysql_fetch_assoc($sus);
$totalRows_sus = mysql_num_rows($sus);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p align="center">LISTA DE ALUNOS POR SÉRIE COM CARTÃO DO SUS</p>
<p align="center">&nbsp;</p>
<table border="2" cellpadding="2">
  <tr>
    <td><strong>ALUNO</strong></td>
    <td><strong>Nº SUS</strong></td>
    <td><strong>SÉRIE</strong></td>
    <td><strong>PERÍODO</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_sus['a_nome']; ?></td>
      <td><?php echo $row_sus['a_sus']; ?></td>
      <td><?php echo $row_sus['serie']; ?></td>
      <td><?php echo $row_sus['periodo']; ?></td>
    </tr>
    <?php } while ($row_sus = mysql_fetch_assoc($sus)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($sus);
?>
