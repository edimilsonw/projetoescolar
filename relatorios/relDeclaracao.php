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
$aluno = $_GET['aluno'];


mysql_select_db($database_conexao, $conexao);
$query_query_declaracao = "select * from matricula inner join escola on matricula.escola=escola.idEscola inner join turmas on m_id_turma=turmas.idTurmas inner join aluno on matricula.m_id_aluno=aluno.a_id where aluno.a_id = $aluno";
$query_declaracao = mysql_query($query_query_declaracao, $conexao) or die(mysql_error());
$row_query_declaracao = mysql_fetch_assoc($query_declaracao);
$totalRows_query_declaracao = mysql_num_rows($query_declaracao);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> </title>
<div id="principal">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<style>
/* The customcheck */
.customcheck {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.customcheck input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 5px;
}

/* On mouse-over, add a grey background color */
.customcheck:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.customcheck input:checked ~ .checkmark {
    background-color: #02cf32;
    border-radius: 5px;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.customcheck input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.customcheck .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}</style>


</head>
<body><h5>
<p align="center"><img src="../img/brasao.png" width="116" height="118" alt="ROLIM DE MOURA" /><br /><strong>ESTADO DE RONDÔNIA<br />PODER EXECUTIVO<br />
  MUNICÍPIO DE ROLIM DE MOURA<br />
  SECRETARIA MUNICIPAL DE EDUCAÇÃO E CULTURA</strong><br />
  <strong><?php echo $row_query_declaracao['e.nome']; ?></strong></h5>
<h1>
  <p align="center" class="bg-info">ENSINO FUNDAMENTAL</span></p>
</h1>
<h2> <p align="center">DECLARAÇÃO</p>
</h2>
<table width="100%" border="2" align="center">
  <tr>
    <td width="221"><h4><strong>Nome do Aluno(a):</strong></h4></td>
    <td width="654"><h4><strong><?php echo $row_query_declaracao['a_nome']; ?></strong></h4></td>
  </tr>
  <tr>
    <td><h4><strong>Data de Nascimento:</strong></h4></td>
    <td><h4><strong><?php echo date ("d/m/Y", strtotime($row_query_declaracao['a_nasc'])); ?> - Naturalidade: <?php echo $row_query_declaracao['a_nat']; ?></strong></h4></td>
  </tr>
  <tr>
    <td><h4><strong>Filiação:</strong></h4></td>
    <td><h4><strong><?php echo $row_query_declaracao['a_mae']; ?><br />
    </strong><strong><?php echo $row_query_declaracao['a_pai']; ?></strong></h4></td>
  </tr>
  <tr>
    <td><h4><strong>ID Censo</strong></h4></td>
    <td><h4><strong><?php echo $row_query_declaracao['a_censo']; ?></strong></h4></td>
  </tr>
</table>
<p></font></div>
<h3 align="center"><strong>Ano Letivo <?php echo $row_query_declaracao['m_ano_letivo']; ?></strong></h3>
<h4 align="right">Conforme Resolução Nº. 131/06/CEE/RO<br /></h4>
<h4 align="right"> Implantação-2007 </h4>
<h4 align="right">Tabela de Equivalência</h4>
<h6>&nbsp;</h6>
<table width="200" border="2" align="right">
  <tr>
    <td><h5><strong>PRE I</strong></h5></td>
    <td><h5><strong>04 ANOS</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>PRE II</strong></h5></td>
    <td><h5><strong>05 ANOS</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>1º ANO </strong></h5></td>
    <td><h5><strong>06 ANOS</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>2º ANO</strong></h5></td>
    <td><h5><strong>1ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>3º ANO</strong></h5></td>
    <td><h5><strong>2ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>4º ANO</strong></h5></td>
    <td><h5><strong>3ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>5º ANO</strong></h5></td>
    <td><h5><strong>4ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>6º ANO</strong></h5></td>
    <td><h5><strong>5ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>7º ANO</strong></h5></td>
    <td><h5><strong>6ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>8º ANO</strong></h5></td>
    <td><h5><strong>7ª SÉRIE</strong></h5></td>
  </tr>
  <tr>
    <td><h5><strong>9º ANO</strong></h5></td>
    <td><h5><strong>8ª SÉRIE</strong></h5></td>
  </tr>
</table>
<h4><p align="center">CONSTA EM NOSOS ARQUIVOS COMO:<br /><strong>  <?php echo $row_query_declaracao['situacao']; ?></strong> o(a) <strong><?php echo $row_query_declaracao['serie']; ?></strong> do Ensino Fundamental de 09 anos</h4><p>&nbsp;</p>
<h5>
  	<strong> 
    <label class="customcheck">Declaração para fins de Transferência
          <input type="checkbox">
          <span class="checkmark"></span>
    </label>
            <label class="customcheck">Declaração para fins de Trabalho
          <input type="checkbox">
          <span class="checkmark"></span>
        </label>
            <label class="customcheck">Declaração para fins de Bolsa Família
          <input type="checkbox">
          <span class="checkmark"></span>
        </label>
            <label class="customcheck">Declaração para outros fins
          <input type="checkbox">
          <span class="checkmark"></span>
        </label>
  </strong></p>
</h5>
<h4><strong>Observação:</strong> Aluno(a) está apto(a) a matricular-se no(a) <strong><?php echo $row_query_declaracao['serie']; ?></strong>  ano do Ensino Fundamental de 09 anos.</h4>
<h5>A Transferência será entregue no prazo máximo de
  <input name="textfield" type="text" id="textfield" size="1" />
  <label for="textfield"></label>
dias a contar da data de expedição desta declaração.</h5>
<h4><i><p>Esta declaração só é válida com apenas (01) uma alternativa assinalada e não contendo rasuras.</p></i></h4>
<table width="40%" border="2">
  <tr>
    <td width="45%"><h5 align="center"><strong>CONFORME RESOLUÇÃO Nº 131/06-CEE/RO</strong></h5></td>
  </tr>
      <td><h5 align="center"><em>Implantação: 2007<br />
      Tabela de Equivalência</em></h5></td>
</table>
<table width="40%" border="2">
  <tr>
    <td width="143"><h5>Idade Própria</h5></td>
    <td width="13"><h5>6</h5></td>
    <td width="21"><h5>7</h5></td>
    <td width="21"><h5>8</h5></td>
    <td width="21"><h5>9</h5></td>
    <td width="22"><h5>10</h5></td>
    <td width="21"><h5>11</h5></td>
    <td width="21"><h5>12</h5></td>
    <td width="21"><h5>13</h5></td>
    <td width="28"><h5>14</h5></td>
  </tr>
  <tr>
    <td><h5>Duração 08 anos</h5></td>
    <td><h5>-</h5></td>
    <td><h5>1ª</h5></td>
    <td><h5>2ª</h5></td>
    <td><h5>3ª</h5></td>
    <td><h5>4ª</h5></td>
    <td><h5>5ª</h5></td>
    <td><h5>6ª</h5></td>
    <td><h5>7ª</h5></td>
    <td><h5>8ª</h5></td>
  </tr>
  <tr>
    <td><h5>Duração 09 anos</h5></td>
    <td><h5>1º</h5></td>
    <td><h5>2º</h5></td>
    <td><h5>3º</h5></td>
    <td><h5>4º</h5></td>
    <td><h5>5º</h5></td>
    <td><h5>6º</h5></td>
    <td><h5>7º</h5></td>
    <td><h5>8º</h5></td>
    <td><h5>9º</h5></td>
  </tr>
</table>

<h4><div align="right"><p aling="right"> Rolim de Moura, 
  <?php
echo date('d/m/Y') . '<br />';

?>
</div>
</p></div></h4>
<div></div>
</body>
</html>
<?php
mysql_free_result($query_declaracao);
?>
