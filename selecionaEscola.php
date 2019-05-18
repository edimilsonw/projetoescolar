<?php require_once('Connections/conexao.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$MM_restrictGoTo = "index.php";
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



mysql_select_db($database_conexao, $conexao);
$query_query_dados = "SELECT * FROM usuarios inner join escola on usuarios.idEscola=escola.idEscola where usuarios.login='$_SESSION[MM_Username]'";
$query_dados = mysql_query($query_query_dados, $conexao) or die(mysql_error());
$row_query_dados = mysql_fetch_assoc($query_dados);
$totalRows_query_dados = mysql_num_rows($query_dados);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="list-group-item-success">
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p align="center" class="badge-secondary">SELECIONE SUA ESCOLA:&nbsp;</p><div align="center"><img src="img/brasao.png" width="106" height="108" /></p></div></p>
  <p align="center">
 <strong><?php
echo '          Seja bem Vindo(a) '.$_SESSION['MM_Username'];
?></strong>
  <p>&nbsp;</p>
  <table class="table-hover" width="50%" border="1" align="center">
    <tr>
      <td width="15"><span class="tab-content"><strong>ID</strong></span></td>
      <td width="243"><span class="tab-content"><strong>Escola</strong></span></td>
      <td width="88"><span class="tab-content"><strong>Seleciona</strong></span></td>
    </tr>
    <?php do { ?>
    <tr>
      <td><span class="tab-content"><?php echo $row_query_dados['idEscola']; ?></span></td>
      <td><span class="tab-content"><?php echo $row_query_dados['e.nome']; ?></span></td>
      <td><a href="info.php?escola=<?php echo $row_query_dados['idEscola']; ?>">ACESSAR</a></td>
    </tr>
    <?php } while ($row_query_dados = mysql_fetch_assoc($query_dados)); ?>
  </table>
  <p>&nbsp;</p>
  <p align="center"><a href="<?php echo $logoutAction ?>">CANCELAR</a></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($query_dados);
?>
