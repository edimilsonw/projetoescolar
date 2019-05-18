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
<script type="text/javascript">
try{
xmlhttp = new XMLHttpRequest();
}
catch(ee){
try{
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e){
try{
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
catch(E){
xmlhttp = false;
}
}
}
div_base = "";
function abre(arquivo,metodo,div){
div_base = div;
xmlhttp.open(metodo,arquivo);
xmlhttp.onreadystatechange=conteudo
xmlhttp.send(null)
}
function conteudo() {
nova_div = div_base;
document.getElementById(nova_div).innerHTML="<div style='top:50%;left:50%;position:absolute;'>carregando...</div>"
if (xmlhttp.readyState==4){
document.getElementById(nova_div).innerHTML=xmlhttp.responseText
}
}
</script>
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
$query_Recordset1 = "SELECT * FROM usuarios inner join escola on usuarios.idEscola=escola.idEscola inner join matricula WHERE usuarios.login='$_SESSION[MM_Username]'";
$Recordset1 = mysql_query($query_Recordset1, $conexao) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"><style type="text/css">
.bg-danger a span {
	color: #FFFFFF;
}
</style>
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js" ></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>Gerenciador Escolar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="js.js" ></script>
 

</head>

<body>

<? 
$pegaid = (int) $_GET['escola'];

$escola = "$pegaid";
?>
<p>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">Gerenciador Escolar  SEMEC</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">

        <div class="user-info"><?php
echo 'Seja bem Vindo(a) '.$_SESSION['MM_Username'];
?>
        <p></div>
      </div>
      <!-- sidebar-header  -->

      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">

 

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
   <div class="wrapper">
     <nav id="sidebar">
   	  <ul class="list-unstyled components">
		  <li class="active">
          <li>
   				<a href="info.php?escola=<?php echo $row_Recordset1['idEscola']; ?>"><i class="fas fa-home"></i>Inicio</a>
		</li>
   				<a href="#turmas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user-graduate"></i>Turmas</a>
   				<ul class="collapse list-unstyled" id="turmas">
               <li>
<a href="javascript: abre('turmas/pmatricula.php?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=1','GET','conteudo');">* Primeira matricula</a>
   					</li>
   					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=1','GET','conteudo');">1º ANO A</a>
   					</li>
   					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=2','GET','conteudo');">1º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=3','GET','conteudo');">2º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=4','GET','conteudo');">2º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=5','GET','conteudo');">3º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=6','GET','conteudo');">3º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=7','GET','conteudo');">4º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=8','GET','conteudo');">4º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=10','GET','conteudo');">5º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=11','GET','conteudo');">5º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=13','GET','conteudo');">6º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=14','GET','conteudo');">6º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=15','GET','conteudo');">6º ANO C</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=16','GET','conteudo');">7º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=17','GET','conteudo');">7º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=19','GET','conteudo');">8º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=20','GET','conteudo');">8º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=21','GET','conteudo');">9º ANO A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=22','GET','conteudo');">9º ANO B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=23','GET','conteudo');">PRE I A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=24','GET','conteudo');">PRE I B</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=25','GET','conteudo');">PRE II A</a>
   					</li>
                       					<li>
<a href="javascript: abre('turmas/?escola=<?php echo $row_Recordset1['idEscola']; ?>&turma=26','GET','conteudo');">PRE II B</a>
   					</li>
               				</ul>
			<li>
   				<a href="#relatorios" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="far fa-file-pdf"></i>Relatórios</a>
   				<ul class="collapse list-unstyled" id="relatorios">
   					<li>
   						<a href="javascript: abre('relatorios/declaracao.php?escola=<?php echo $row_Recordset1['idEscola']; ?>','GET','conteudo');">Declaração</a>
				  </li>
   					<li>
   						<a href="javascript: abre('relatorios/relatorio.php?escola=<?php echo $row_Recordset1['idEscola']; ?>','GET','conteudo');">Matrícula Inicial</a>
   					</li>
   					<li>
   						<a href="javascript: abre('relatorios/passivos.php','GET','conteudo');">Passivo</a>
   					</li>
                    <li>
   						<a href="javascript: abre('relatorios/relAlunoSUS.php?escola=<?php echo $row_Recordset1['idEscola']; ?>','GET','conteudo');">Relatório Alunos SUS</a>
				  </li>
                    <a href="#transporte" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-bus-alt"></i>Transporte</a>
   				<ul class="collapse list-unstyled" id="transporte">
  <li>
   						<a href="javascript: abre('relatorios/relatorioLinha.php?escola=<?php echo $row_Recordset1['idEscola']; ?>&periodo=matutino','GET','conteudo');">Lista de Alunos por Linha Matutino</a>
   					</li>
                     <li>
   						<a href="javascript: abre('relatorios/relatorioLinha.php?escola=<?php echo $row_Recordset1['idEscola']; ?>&periodo=vespertino','GET','conteudo');">Lista de Alunos por Linha Vespertino</a>
   					</li>
			  </ul> 
	</ul>
   			<li>
   				<a href="turmas/principal.php?escola=<?php echo $row_Recordset1['idEscola']; ?>">Services</a>
   			</li>
   			<li>
   				<a href="#">Contact Us</a>
   			</li>
	  </ul>
   		
   	</nav>
   	
   </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script>
	    $(document).ready(function(){
			$('#sidebarCollapse').on('click',function(){
				$('#sidebar').toggleClass('active');
			});
		});  
	</script>
          <li> .</li>
          <li> .</li>
           <li>. </li>
          <li> .</li>
           <li>. </li>
          <li> .</li>
          <li class="bg-danger">
           <a href="<?php echo $logoutAction ?>">
              <i class="fas fa-times"></i>
              <span>Sair do Sistema</span>
            </a>        
          </li>    
      <!-- sidebar-menu  -->
    </div>

  </nav>
<?php
mysql_free_result($Recordset1);
?>

