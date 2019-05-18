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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['senha'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "selecionaEscola.php";
  $MM_redirectLoginFailed = "erro.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_conexao, $conexao);
  
  $LoginRS__query=sprintf("SELECT login, senha FROM usuarios WHERE login=%s AND senha=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexao) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<link rel="stylesheet" type="text/css" href="css/stylelogin.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<!<?php require_once('Connections/conexao.php'); ?>
DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA ESCOLAR - SEMEC ROLIM DE MOURA</title>
</head>
<body>
<div class="container" >
<div id="cadastrar">
    
     <div class="content"><br>
      <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>"> 
      <br /><p><p>
<div id="login" align="center">
<h5><img src="img/brasao.png" width="119" height="121"> <br>
  <span class="overflow-auto">SEMEC </span>
  <p class="overflow-auto"> SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA</h5><hr>
<h1>Login</h1>
<p>
  <label for="email_login">Usuario:</label>
  <input name="usuario" type="text" id="usuario" />
</p>
<p><p>
<span>Senha:</span>
<input name="senha" type="password" id="senha" />
<input type="submit" name="logar" id="logar" value="Entrar" class="btn" />

<a href="https://api.whatsapp.com/send?phone=5569984321882">Esqueceu sua senha? (69) 9 8432-1882</a></form></div>
</body>
</html>