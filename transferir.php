<?php require_once('Connections/conexao.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE matricula SET m_id_aluno=%s, m_cod_matricula=%s, situacao=%s, data_transf=%s WHERE idMatricula=%s",
                       GetSQLValueString($_POST['m_id_aluno'], "int"),
                       GetSQLValueString($_POST['m_cod_matricula'], "int"),
                       GetSQLValueString($_POST['situacao'], "text"),
                       GetSQLValueString($_POST['data_transf'], "date"),
                       GetSQLValueString($_POST['idMatricula'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE matricula SET m_id_aluno=%s, m_cod_matricula=%s, situacao=%s, data_transf=%s WHERE idMatricula=%s",
                       GetSQLValueString($_POST['m_id_aluno'], "int"),
                       GetSQLValueString($_POST['m_cod_matricula'], "int"),
                       GetSQLValueString($_POST['situacao'], "text"),
                       GetSQLValueString($_POST['data_transf'], "date"),
                       GetSQLValueString($_POST['idMatricula'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($updateSQL, $conexao) or die(mysql_error());
}

$escola = $_GET['escola'];
$turma = $_GET['turma'];

mysql_select_db($database_conexao, $conexao);
$query_query_transferencia = "SELECT * FROM matricula inner join turmas on m_id_turma=turmas.idTurmas inner join aluno on m_id_aluno=aluno.a_id inner join escola on matricula.escola=escola.idEscola WHERE matricula.escola='$escola' AND matricula.m_id_turma='$turma' order by aluno.a_nome";
$query_transferencia = mysql_query($query_query_transferencia, $conexao) or die(mysql_error());
$row_query_transferencia = mysql_fetch_assoc($query_transferencia);
$totalRows_query_transferencia = mysql_num_rows($query_transferencia);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>TRANSFERIR ALUNO 
<?php echo $row_query_transferencia['serie']; ?></p>
<form id="form1" name="form1" method="post" action="">
  <label for="select"></label>
  Aluno:
  <select name="select" id="select">
    <?php
do {  
?>
    <option value="<?php echo $row_query_transferencia['m_id_aluno']?>"<?php if (!(strcmp($row_query_transferencia['m_id_aluno'], $row_query_transferencia['m_id_aluno']))) {echo "selected=\"selected\"";} ?>><?php echo $row_query_transferencia['a_nome']?></option>
    <?php
} while ($row_query_transferencia = mysql_fetch_assoc($query_transferencia));
  $rows = mysql_num_rows($query_transferencia);
  if($rows > 0) {
      mysql_data_seek($query_transferencia, 0);
	  $row_query_transferencia = mysql_fetch_assoc($query_transferencia);
  }
?>
  </select>
  <label for="select2"></label>
  Turma:
  <select name="select2" id="select2">
  </select>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p><? echo $turma ?>
</body>
</html>
<?php
mysql_free_result($query_transferencia);
?>
