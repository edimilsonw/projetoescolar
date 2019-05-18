<?php require_once('../Connections/conexao.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>

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

$idEscola = $_GET['escola'];
$turma = $_GET['turma'];
mysql_select_db($database_conexao, $conexao);
$query_query_alunos = "SELECT * FROM matricula  inner join turmas on matricula.m_id_turma=turmas.idTurmas inner join aluno on matricula.m_id_aluno=aluno.a_id inner join escola on matricula.escola=escola.idEscola where matricula.m_id_turma='$turma' and matricula.escola='$idEscola' ORDER BY m_cod_matricula";
$query_alunos = mysql_query($query_query_alunos, $conexao) or die(mysql_error());
$row_query_alunos = mysql_fetch_assoc($query_alunos);
$totalRows_query_alunos = mysql_num_rows($query_alunos);
$regtotal = mysql_num_rows($query_alunos);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

 <p><h2 align="center"><strong><?php echo 'LISTA DE ALUNOS DO ' .$row_query_alunos['serie']; echo ' ' .$row_query_alunos['periodo']; ?> </strong></h2></p>
 </p>
 <p><a href="#" onclick="window.open('turmas/matricular.php?escola=<?php echo $row_query_alunos['idEscola']; ?>&amp;turma=<?php echo $row_query_alunos['idTurmas']; ?>', 'Informações detalhadas do aluno', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=50, LEFT=500, WIDTH=590, HEIGHT=400');">[+] Matricular</a></p>
 
 <!-- Botão para acionar modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#matricular">
  Abrir modal de demonstração
</button>

<!-- Modal -->
<div class="modal fade" id="matricular" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">Nova Matrícula</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO matricula (idMatricula, m_id_aluno, m_id_turma, m_data, m_cod_matricula, situacao, escola) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['idMatricula'], "int"),
                       GetSQLValueString($_POST['m_id_aluno'], "int"),
                       GetSQLValueString($_GET['turma'], "int"),
                       GetSQLValueString($_POST['m_data'], "date"),
                       GetSQLValueString($_POST['m_cod_matricula'], "int"),
                       GetSQLValueString($_POST['situacao'], "text"),
                       GetSQLValueString($_GET['escola'], "int"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());

  $insertGoTo = "matricular.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexao, $conexao);
$query_Recordset1 = "SELECT * FROM matricula";
$Recordset1 = mysql_query($query_Recordset1, $conexao) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_conexao, $conexao);
$query_Recordset2 = "SELECT * FROM aluno order by a_nome";
$Recordset2 = mysql_query($query_Recordset2, $conexao) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 ALUNO:<select name="m_id_aluno" id="m_id_aluno">
        <?php
do {  
?>
        <option value="<?php echo $row_Recordset2['a_id']?>"<?php if (!(strcmp($row_Recordset2['a_id'], $row_Recordset1['m_id_aluno']))) {echo "selected=\"selected\"";} ?>><?php echo $row_Recordset2['a_nome']?></option>
        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
      </select><p>
      <p>DATA DE MATRICULA:
        <input type="date" name="m_data" value="" size="32" />
    
     <p>
  <p> Nº CHAMADA:
      <input type="text" name="m_cod_matricula" value="" size="5" />
   <p>SITUAÇÃO:
    <input type="text" name="situacao" value="Cursando" size="32" />
<p align="center">
<input type="submit" class="btn btn-primary" value="Matricular" />
  <input type="hidden" name="MM_insert" value="form1" />
     </form>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
      </div>

     
      </div>
    </div>
  </div>
</div>
 
 
 
 
 
<table border="1">
   <tr>
     <td>Nº</td>
     <td>NOME ALUNO</td>
     <td>DATA NASCIMENTO</td>
     <td>ENDEREÇO</td>
     <td>SITUAÇÃO</td>
   </tr>
   <?php do { ?>
     <tr>
       <td><?php echo $row_query_alunos['m_cod_matricula']; ?></td>
       <td><a href="#" onclick="window.open('infoaluno.php?id=<?php echo $row_query_alunos['a_id']; ?>', 'Informações detalhadas do aluno', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=50, LEFT=500, WIDTH=590, HEIGHT=400');"> <?php echo $row_query_alunos['a_nome']; ?></a></td>
       <td><?php echo date('d/m/Y', strtotime ($row_query_alunos['a_nasc'])); ?></td>
       <td><?php echo $row_query_alunos['a_end']; ?></td>
       <td><?php echo $row_query_alunos['situacao']; ?></td>
     </tr>
     <?php } while ($row_query_alunos = mysql_fetch_assoc($query_alunos)); ?>
</table>
<p align="center">

</body>
</html>
<?php

echo '        <strong>  <blockquote><br>Total de Registros:</strong> ' .$regtotal;

?>  
<?php
mysql_free_result($query_alunos);
?>
