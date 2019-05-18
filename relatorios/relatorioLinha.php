<?php require_once('../Connections/conexao.php'); ?>
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
$periodo = $_GET['periodo'];
$escola = $_GET['escola'];
mysql_select_db($database_conexao, $conexao);
$query_matutino = "SELECT * FROM matricula inner join aluno on matricula.m_id_aluno=aluno.a_id inner join turmas on matricula.m_id_turma=turmas.idTurmas inner join escola on matricula.escola=escola.idEscola WHERE turmas.periodo='$periodo' order by aluno.a_end";
$matutino = mysql_query($query_matutino, $conexao) or die(mysql_error());
$row_matutino = mysql_fetch_assoc($matutino);
$totalRows_matutino = mysql_num_rows($matutino);
$order = isset($_GET['sort'])?$_GET['sort']:'a_nome';
?>
<?php require_once('../Connections/conexao.php'); ?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>	
<h3><p align="center"><strong>RELATÓRIO DE ALUNOS POR LINHA</h3>
<table border="2" cellpadding="2">
  <tr>
    <td><strong>ALUNO</strong></td>
    <td><strong>ENDEREÇO</strong></td>
    <td><strong>SÉRIE</strong></td>
    <td><strong>PERÍODO</strong></td>
    <td><strong>ESCOLA</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_matutino['a_nome']; ?></td>
      <td><?php echo $row_matutino['a_end']; ?></td>
      <td><?php echo $row_matutino['serie']; ?></td>
      <td><?php echo $row_matutino['periodo']; ?></td>
      <td><?php echo $row_matutino['e.nome']; ?></td>
    </tr>
    <?php } while ($row_matutino = mysql_fetch_assoc($matutino)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($matutino);
?>
