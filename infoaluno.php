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
$id = $_GET['id']; 
mysql_select_db($database_conexao, $conexao);
$query_query_infoalunos = "SELECT * FROM aluno where a_id='$id'";
$query_infoalunos = mysql_query($query_query_infoalunos, $conexao) or die(mysql_error());
$row_query_infoalunos = mysql_fetch_assoc($query_infoalunos);
$totalRows_query_infoalunos = mysql_num_rows($query_infoalunos);

mysql_select_db($database_conexao, $conexao);
$query_query_2 = "SELECT * FROM matricula inner join escola on matricula.escola=escola.idEscola inner join turmas on matricula.m_id_turma=turmas.idTurmas inner join aluno on matricula.m_id_aluno=aluno.a_id WHERE a_id='$id'";
$query_2 = mysql_query($query_query_2, $conexao) or die(mysql_error());
$row_query_2 = mysql_fetch_assoc($query_2);
$totalRows_query_2 = mysql_num_rows($query_2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informações do Aluno</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
    #form1 p {
	font-weight: bold;
	font-size: 16px;
}
    </style>
    

</head>


<body>
<form id="form1" name="form1" method="post" action="">
  <p align="center">INFORMAÇÕES DO ALUNO</p>
  <table border="2" class="table-hover" >
  <tr>
  <p>
  <td><strong>NOME: <?php echo $row_query_infoalunos['a_nome']; ?></td></p>
  </tr>
  <tr>
  <p>
  <td><strong>FILIAÇÃO:</strong> <?php echo $row_query_infoalunos['a_mae']; ?> e <?php echo $row_query_infoalunos['a_pai']; ?></td></tr></p>
  
  <p><tr>
    <td><strong>NASCIMENTO:</strong> <?php echo date ("d/m/Y", strtotime($row_query_infoalunos['a_nasc'])) ?></td></tr></p>
  
  <p><tr>
    <td><strong>NATURALIDADE:</strong> <?php echo $row_query_infoalunos['a_nat']; ?></td></tr></p>
  <p><tr>
    <td><strong>SEXO:</strong> <?php echo $row_query_infoalunos['a_sexo']; ?></td></tr></p>
  <p><tr>
    <td><strong>ENDEREÇO:</strong> <?php echo $row_query_infoalunos['a_end']; ?></td></tr></p>
  <p><tr>
    <td><strong>TELEFONES:</strong> <a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $row_query_infoalunos['a_tel1']; ?>"><?php echo $row_query_infoalunos['a_tel1']; ?></a> e <a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $row_query_infoalunos['a_tel2']; ?>"><?php echo $row_query_infoalunos['a_tel2']; ?></a></td></tr></p>
  <p><tr>
    <td><strong>CENSO:</strong> <?php echo $row_query_infoalunos['a_censo']; ?></td></tr></p>
  <p><tr>
    <td><strong>SUS:</strong> <?php echo $row_query_infoalunos['a_sus']; ?></td></tr></p>
  <p><tr>
    <td><strong>Nº CERTIDÃO:</strong> <?php echo $row_query_infoalunos['a_cert']; ?></td></tr></p>
  <p><tr>
    <td><strong>RG:</strong> <?php echo $row_query_infoalunos['a_rg']; ?></td></tr></p>
  <p><tr>
    <td><strong>CPF:</strong> <?php echo $row_query_infoalunos['a_cpf']; ?></td></tr></p> </table>
  <p>&nbsp;</p><hr />
  
  <p align="center">INFORMAÇÕES DA MATRÍCULA</p>
  <p>ESCOLA: <?php echo $row_query_2['e.nome']; ?><br />
  SÉRIE: <?php echo $row_query_2['serie']; ?>  <?php echo $row_query_2['periodo']; ?><br />
  DATA MATRÍCULA:  <?php echo date('d/m/Y', strtotime ($row_query_2['m_data'])); ?></p>
</form>
</body>
</html>
<?php
mysql_free_result($query_infoalunos);

mysql_free_result($query_2);
?>
