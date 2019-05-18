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
$query_inicialTOTAL = "SELECT count(*) FROM matricula WHERE m_data BETWEEN '2019-01-01' AND '2019-03-31' AND escola='$escola'";
$inicialTOTAL = mysql_query($query_inicialTOTAL, $conexao) or die(mysql_error());
$row_inicialTOTAL = mysql_fetch_assoc($inicialTOTAL);
$totalRows_inicialTOTAL = mysql_num_rows($inicialTOTAL);

mysql_select_db($database_conexao, $conexao);
$query_inicialPRE1 = "SELECT count(*) FROM matricula WHERE m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='23' or m_id_turma='24' AND matricula.escola='$escola'";
$inicialPRE1 = mysql_query($query_inicialPRE1, $conexao) or die(mysql_error());
$row_inicialPRE1 = mysql_fetch_assoc($inicialPRE1);
$totalRows_inicialPRE1 = mysql_num_rows($inicialPRE1);

mysql_select_db($database_conexao, $conexao);
$query_inicialPRE2 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='25' or m_id_turma='26'";
$inicialPRE2 = mysql_query($query_inicialPRE2, $conexao) or die(mysql_error());
$row_inicialPRE2 = mysql_fetch_assoc($inicialPRE2);
$totalRows_inicialPRE2 = mysql_num_rows($inicialPRE2);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO1 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='1' or m_id_turma='2'";
$inicialANO1 = mysql_query($query_inicialANO1, $conexao) or die(mysql_error());
$row_inicialANO1 = mysql_fetch_assoc($inicialANO1);
$totalRows_inicialANO1 = mysql_num_rows($inicialANO1);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO2 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='3' or m_id_turma='4'";
$inicialANO2 = mysql_query($query_inicialANO2, $conexao) or die(mysql_error());
$row_inicialANO2 = mysql_fetch_assoc($inicialANO2);
$totalRows_inicialANO2 = mysql_num_rows($inicialANO2);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO3 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='5' or m_id_turma='6'";
$inicialANO3 = mysql_query($query_inicialANO3, $conexao) or die(mysql_error());
$row_inicialANO3 = mysql_fetch_assoc($inicialANO3);
$totalRows_inicialANO3 = mysql_num_rows($inicialANO3);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO4 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='7' or m_id_turma='8' or m_id_turma='9'";
$inicialANO4 = mysql_query($query_inicialANO4, $conexao) or die(mysql_error());
$row_inicialANO4 = mysql_fetch_assoc($inicialANO4);
$totalRows_inicialANO4 = mysql_num_rows($inicialANO4);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO5 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='10' or m_id_turma='11' or m_id_turma='12' AND situacao='Cursando'";
$inicialANO5 = mysql_query($query_inicialANO5, $conexao) or die(mysql_error());
$row_inicialANO5 = mysql_fetch_assoc($inicialANO5);
$totalRows_inicialANO5 = mysql_num_rows($inicialANO5);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO6 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='13' or m_id_turma='14' or m_id_turma='15'";
$inicialANO6 = mysql_query($query_inicialANO6, $conexao) or die(mysql_error());
$row_inicialANO6 = mysql_fetch_assoc($inicialANO6);
$totalRows_inicialANO6 = mysql_num_rows($inicialANO6);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO7 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='16' or m_id_turma='17' OR m_id_turma='18'";
$inicialANO7 = mysql_query($query_inicialANO7, $conexao) or die(mysql_error());
$row_inicialANO7 = mysql_fetch_assoc($inicialANO7);
$totalRows_inicialANO7 = mysql_num_rows($inicialANO7);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO8 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='19' or m_id_turma='20'";
$inicialANO8 = mysql_query($query_inicialANO8, $conexao) or die(mysql_error());
$row_inicialANO8 = mysql_fetch_assoc($inicialANO8);
$totalRows_inicialANO8 = mysql_num_rows($inicialANO8);

mysql_select_db($database_conexao, $conexao);
$query_inicialANO9 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-01-01' AND '2019-03-31' AND m_id_turma='21' or m_id_turma='22'";
$inicialANO9 = mysql_query($query_inicialANO9, $conexao) or die(mysql_error());
$row_inicialANO9 = mysql_fetch_assoc($inicialANO9);
$totalRows_inicialANO9 = mysql_num_rows($inicialANO9);

mysql_select_db($database_conexao, $conexao);
$query_query_inform = "SELECT * FROM matricula inner join escola on matricula.escola=escola.idEscola inner join turmas on matricula.m_id_turma=turmas.idTurmas inner join aluno on m_id_aluno=aluno.a_id";
$query_inform = mysql_query($query_query_inform, $conexao) or die(mysql_error());
$row_query_inform = mysql_fetch_assoc($query_inform);
$totalRows_query_inform = mysql_num_rows($query_inform);

mysql_select_db($database_conexao, $conexao);
$query_apos3103PRE1 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='23' or m_id_turma='24'";
$apos3103PRE1 = mysql_query($query_apos3103PRE1, $conexao) or die(mysql_error());
$row_apos3103PRE1 = mysql_fetch_assoc($apos3103PRE1);
$totalRows_apos3103PRE1 = mysql_num_rows($apos3103PRE1);

mysql_select_db($database_conexao, $conexao);
$query_apos3103PRE2 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='25' or m_id_turma='26'";
$apos3103PRE2 = mysql_query($query_apos3103PRE2, $conexao) or die(mysql_error());
$row_apos3103PRE2 = mysql_fetch_assoc($apos3103PRE2);
$totalRows_apos3103PRE2 = mysql_num_rows($apos3103PRE2);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO1 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='1' or m_id_turma='2'";
$apos3103ANO1 = mysql_query($query_apos3103ANO1, $conexao) or die(mysql_error());
$row_apos3103ANO1 = mysql_fetch_assoc($apos3103ANO1);
$totalRows_apos3103ANO1 = mysql_num_rows($apos3103ANO1);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO2 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='3' or m_id_turma='4'";
$apos3103ANO2 = mysql_query($query_apos3103ANO2, $conexao) or die(mysql_error());
$row_apos3103ANO2 = mysql_fetch_assoc($apos3103ANO2);
$totalRows_apos3103ANO2 = mysql_num_rows($apos3103ANO2);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO3 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='5' or m_id_turma='6'";
$apos3103ANO3 = mysql_query($query_apos3103ANO3, $conexao) or die(mysql_error());
$row_apos3103ANO3 = mysql_fetch_assoc($apos3103ANO3);
$totalRows_apos3103ANO3 = mysql_num_rows($apos3103ANO3);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO4 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='7' or m_id_turma='8' or m_id_turma='9'";
$apos3103ANO4 = mysql_query($query_apos3103ANO4, $conexao) or die(mysql_error());
$row_apos3103ANO4 = mysql_fetch_assoc($apos3103ANO4);
$totalRows_apos3103ANO4 = mysql_num_rows($apos3103ANO4);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO5 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='10' or m_id_turma='11' or m_id_turma='12'";
$apos3103ANO5 = mysql_query($query_apos3103ANO5, $conexao) or die(mysql_error());
$row_apos3103ANO5 = mysql_fetch_assoc($apos3103ANO5);
$totalRows_apos3103ANO5 = mysql_num_rows($apos3103ANO5);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO6 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='13' or m_id_turma='14' or m_id_turma='15'";
$apos3103ANO6 = mysql_query($query_apos3103ANO6, $conexao) or die(mysql_error());
$row_apos3103ANO6 = mysql_fetch_assoc($apos3103ANO6);
$totalRows_apos3103ANO6 = mysql_num_rows($apos3103ANO6);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO7 = "SELECT count(*) FROM matricula WHERE matricula.escola='$escola' AND m_data > '2019-03-31' AND '2019-12-31' AND m_id_turma='16' or m_id_turma='17' or m_id_turma='18'";
$apos3103ANO7 = mysql_query($query_apos3103ANO7, $conexao) or die(mysql_error());
$row_apos3103ANO7 = mysql_fetch_assoc($apos3103ANO7);
$totalRows_apos3103ANO7 = mysql_num_rows($apos3103ANO7);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO8 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-31' AND m_id_turma='19' or m_id_turma='20'";
$apos3103ANO8 = mysql_query($query_apos3103ANO8, $conexao) or die(mysql_error());
$row_apos3103ANO8 = mysql_fetch_assoc($apos3103ANO8);
$totalRows_apos3103ANO8 = mysql_num_rows($apos3103ANO8);

mysql_select_db($database_conexao, $conexao);
$query_apos3103ANO9 = "SELECT count(*) FROM matricula WHERE escola='$escola' AND m_data BETWEEN '2019-03-31' AND '2019-12-12' AND m_id_turma='21' or m_id_turma='22'";
$apos3103ANO9 = mysql_query($query_apos3103ANO9, $conexao) or die(mysql_error());
$row_apos3103ANO9 = mysql_fetch_assoc($apos3103ANO9);
$totalRows_apos3103ANO9 = mysql_num_rows($apos3103ANO9);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p align="center"><strong>Relatório Matrícula Inicial - Matrículas realizadas de 01/01/<?php echo $row_query_inform['m_ano_letivo']; ?> até 31/03/<?php echo $row_query_inform['m_ano_letivo']; ?></strong></p>
<table width="95%" border="1">
  <tr>
    <td width="30%"><strong>DADOS</strong></td>
    <td width="6%"><strong>PRE I</strong></td>
    <td width="6%"><strong>PRE II</strong></td>
    <td width="6%"><strong>1º ANO</strong></td>
    <td width="6%"><strong>2º ANO</strong></td>
    <td width="6%"><strong>3º ANO</strong></td>
    <td width="6%"><strong>4º ANO</strong></td>
    <td width="6%"><strong>5º ANO</strong></td>
    <td width="6%"><strong>6º ANO</strong></td>
    <td width="6%"><strong>7º ANO</strong></td>
    <td width="6%"><strong>8º ANO</strong></td>
    <td width="6%"><strong>9º ANO</strong></td>
    <td width="60"><strong>TOTAL</strong></td>
  </tr>
  <tr>
    <td><strong>Matrícula Inicial</strong></td>
    <td><?php echo $row_inicialPRE1['count(*)']; ?></td>
    <td><?php echo $row_inicialPRE2['count(*)']; ?></td>
    <td><?php echo $row_inicialANO1['count(*)']; ?></td>
    <td><?php echo $row_inicialANO2['count(*)']; ?></td>
    <td><?php echo $row_inicialANO3['count(*)']; ?></td>
    <td><?php echo $row_inicialANO4['count(*)']; ?></td>
    <td><?php echo $row_inicialANO5['count(*)']; ?></td>
    <td><?php echo $row_inicialANO6['count(*)']; ?></td>
    <td><?php echo $row_inicialANO7['count(*)']; ?></td>
    <td><?php echo $row_inicialANO8['count(*)']; ?></td>
    <td><?php echo $row_inicialANO9['count(*)']; ?></td>
    <td><strong><?php echo $row_inicialTOTAL['count(*)']; ?></strong></td>
  </tr>
  <tr>
  <td><strong>Admitidos após 31/03/<?php echo $row_query_inform['m_ano_letivo']; ?></strong></td>
    <td><?php echo $row_apos3103PRE1['count(*)']; ?></td>
    <td><?php echo $row_apos3103PRE2['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO1['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO2['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO3['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO4['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO5['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO6['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO7['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO8['count(*)']; ?></td>
    <td><?php echo $row_apos3103ANO9['count(*)']; ?></td>
    <td>&nbsp; </td>
  <tr><td><strong>Afastado por Transferencia</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
  <tr>
    <td><strong>Afastado por Abandono</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
  <tr>
    <td><strong>Alunos Aprovados</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
  <tr>
    <td><strong>Alunos Reprovados</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
  <tr><td><strong>inicialTOTAL DE ALUNOS</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($inicialTOTAL);

mysql_free_result($inicialPRE1);

mysql_free_result($inicialPRE2);

mysql_free_result($inicialANO1);

mysql_free_result($inicialANO2);

mysql_free_result($inicialANO3);

mysql_free_result($inicialANO4);

mysql_free_result($inicialANO5);

mysql_free_result($inicialANO6);

mysql_free_result($inicialANO7);

mysql_free_result($inicialANO8);

mysql_free_result($inicialANO9);

mysql_free_result($query_inform);

mysql_free_result($apos3103PRE1);

mysql_free_result($apos3103PRE2);

mysql_free_result($apos3103ANO1);

mysql_free_result($apos3103ANO2);

mysql_free_result($apos3103ANO3);

mysql_free_result($apos3103ANO4);

mysql_free_result($apos3103ANO5);

mysql_free_result($apos3103ANO6);

mysql_free_result($apos3103ANO7);

mysql_free_result($apos3103ANO8);

mysql_free_result($apos3103ANO9);
?>
			