<?php require_once('Connections/conexao.php'); ?>

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

$order = isset($_GET['sort'])?$_GET['sort']:'a_nome';
$quantidade = 50;
    $pagina     = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    $inicio     = ($quantidade * $pagina) - $quantidade;
	mysql_select_db($database_conexao, $conexao);
	$query_query_info = "SELECT * FROM matricula  inner join turmas on matricula.m_id_turma=turmas.idTurmas inner join aluno on matricula.m_id_aluno=aluno.a_id inner join escola on matricula.escola=escola.idEscola order by $order ASC LIMIT $inicio, $quantidade";
	
$query_info = mysql_query($query_query_info, $conexao) or die(mysql_error());
$row_query_info = mysql_fetch_assoc($query_info);
$totalRows_query_info = mysql_num_rows($query_info);
    
{
?>

<?php require_once('Connections/conexao.php');



include('header.php'); 



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Gerenciamento Escolar</title>

<link rel="stylesheet" type="text/css" href="css/style.css" media="print,screen">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <script type="text/script">
function abrePopup()
{
	window.open("infoaluno.php", "nome", "width='100%', height='100%', scrollbars=no, location=no, directories=no, status=no, menubar=no, toolbar=no, resizable=no");
}
</script>

</head>



<body>



<main class="page-content">

<div id="conteudo" class="container-fluid" style="table-layout:auto">

<h4><p align="center"><strong><strong>LISTA GERAL DE ALUNOS MATRICULADOS</strong></h4>



<p align="center">
<form method="POST" action="">
  <label>Buscar: </label>
			<input type="text" name="nome" placeholder="Digite o nome do Aluno">
			<input name="SendPesqUser" type="submit" value="Pesquisar" />
			 <label for="select"></label>
			 
             
             <select id="link">
   <option value="" selected>Ordenar Lista</option>
   <option value="?sort=a_end">Endereço</option>
   <option value="?sort=a_nome">Aluno</option>
   <option value="?sort=matricula.m_id_turma">Série</option>
</select>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
 $(document).ready(function(){

    $('#link').on('change', function () {
         var url = $(this).val(); 
         if (url) { 
             window.open(this.value);
          }
          return false;
        });
     });</script>
     <a href="#" onclick="window.open('cadastroAluno.php', 'Informações detalhadas do aluno', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=50, LEFT=500, WIDTH=590, HEIGHT=400');"> [+] Cadastrar Novo Aluno</a><br>
</form><br>

		
<?php
		$SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
		if($SendPesqUser){
			$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$result_usuario = "SELECT * FROM aluno WHERE a_nome LIKE '%$nome%'";
			$resultado_usuario = mysql_query($result_usuario);
			while($row_usuario = mysql_fetch_assoc($resultado_usuario)){
				echo "ID: " . $row_usuario['a_id'] . "<br>";
				echo "Nome: " . $row_usuario['a_nome'] . "<br>";
				echo "Mãe: " . $row_usuario['a_mae'] . "<br>";
				echo "<a href='infoaluno.php?id=" . $row_usuario['a_id'] . "'>Mais Detalhes</a><br>";
				echo "<br><hr>";
			}
		}
		?></body>

<table width="100%" border="2">

  <tr>

   <td><font color="#000000"> <strong><a href='?sort=a_nome'>ALUNO</strong></td>

    <td><strong><a href='?sort=a_end'>ENDEREÇO</strong></a></td>

    <td><strong><a href='?sort=a_censo'>CENSO</strong></a></td>

    <td><strong><a href='?sort=m_id_turma'>SÉRIE</strong></a></td>

    <td><strong><a href='?sort=matricula.escola'>ESCOLA</strong></a></td>

    <td><strong><a href='?sort=matricula.situacao'>SITUAÇÃO</strong></a></td>

  </tr>

  <?php do { ?>

    <tr>
<td><a href="#" onclick="window.open('infoaluno.php?id=<?php echo $row_query_info['a_id']; ?>', 'Informações detalhadas do aluno', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=50, LEFT=500, WIDTH=590, HEIGHT=400');"> <?php echo $row_query_info['a_nome']; ?></a></td>

      <td><?php echo $row_query_info['a_end']; ?></td>

      <td><?php echo $row_query_info['a_censo']; ?></td>

      <td><?php echo $row_query_info['serie']; ?></td>

      <td><?php echo $row_query_info['e.nome']; ?></td>

      <td><?php echo $row_query_info['situacao']; ?></td>

      </tr>

    <?php } while ($row_query_info = mysql_fetch_assoc($query_info)); ?>

</table>




<p align="center">  <?php

?>  
 <?php
  $sqlTotal   = "SELECT m_id_aluno FROM matricula";
  //Executa o SQL
  $qrTotal    = mysql_query($sqlTotal) or die(mysql_error());
  //Total de Registro na tabela
  $numTotal   = mysql_num_rows($qrTotal);
  //O calculo do Total de página ser exibido
  $totalPagina= ceil($numTotal/$quantidade);
   /**
    * Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
    */
   $exibir = 3;
   /**
    * Aqui montará o link que voltará uma pagina
    * Caso o valor seja zero, por padrão ficará o valor 1
    */
   $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
   /**
    * Aqui montará o link que ir para proxima pagina
    * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
    * caso contrario, ele pegar o valor da página + 1
    */
   $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;
   /**
    * Agora monta o Link paar Primeira Página
    * Depois O link para voltar uma página
    */
  /**
    * Agora monta o Link para Próxima Página
    * Depois O link para Última Página
    */
    ?>
    <div id="navegacao">
        <?php
        echo '<a href="?pagina=1\">primeira</a> | ';
        echo "<a href=\"?pagina=$anterior&sort=$order\">anterior</a> | ";
    ?>
        <?php
         /**
    * O loop para exibir os valores à esquerda
    */
   for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
       if($i > 0)
        echo '<a href="?pagina='.$i.'&sort='.$order.'"> '.$i.' </a>';
  }

  echo '<a href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a>';

  for($i = $pagina+1; $i < $pagina+$exibir; $i++){
       if($i <= $totalPagina)
        echo '<a href="?pagina='.$i.'&sort='.$order.'"> '.$i.' </a>';
  }

   /**
    * Depois o link da página atual
    */
   /**
    * O loop para exibir os valores à direita
    */

    ?>
    <?php echo " | <a href=\"?pagina=$posterior&sort=$order\">próxima</a> | ";
    echo "  <a href=\"?pagina=$totalPagina&sort=$order\">última</a>";
    ?>

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

<p align="center">

</div>

</body>

    
    </div>

</div>

</html>

<?php

mysql_free_result($query_info);
	}
?>


