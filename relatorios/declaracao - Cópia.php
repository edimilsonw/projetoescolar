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
$query_query_matricula = "SELECT * FROM matricula inner join escola on matricula.escola=escola.idEscola inner join aluno on matricula.m_id_aluno=aluno.a_id inner join turmas on matricula.m_id_turma=turmas.idTurmas where matricula.escola='$escola' order by a_nome";
$query_matricula = mysql_query($query_query_matricula, $conexao) or die(mysql_error());
$row_query_matricula = mysql_fetch_assoc($query_matricula);
$totalRows_query_matricula = mysql_num_rows($query_matricula);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p><strong>Emitir Declaração Escolar
  </strong>
</p>
<p>&nbsp;</p>
<p>Selecione o aluno:</p>
<p><form action="relatorios/relDeclaracao.php?aluno=<?php echo $row_query_matricula['m_id_aluno']; ?>" method="post" name="aluno" target="_blank" id="aluno">
  <select name="m_id_aluno" size="1" id="m_id_aluno">
    <?php
do {  
?>
    <option value="<?php echo $row_query_matricula['m_id_aluno']?>"<?php if (!(strcmp($row_query_matricula['m_id_aluno'], $row_query_matricula['m_id_aluno']))) {echo "selected=\"selected\"";} ?>><?php echo $row_query_matricula['a_nome']?></option>
    <?php
} while ($row_query_matricula = mysql_fetch_assoc($query_matricula));
  $rows = mysql_num_rows($query_matricula);
  if($rows > 0) {
      mysql_data_seek($query_matricula, 0);
	  $row_query_matricula = mysql_fetch_assoc($query_matricula);
  }
?>
  </select>
  <input type="submit" name="m_id_aluno" id="m_id_aluno" value="Gerar" />
</form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</p>
<p></a></p>




</body>
</html>
<?php
mysql_free_result($query_matricula);

?>
