
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO aluno (a_nome, a_nasc, a_nat, a_pai, a_mae, a_sexo, a_end, a_tel1, a_tel2, a_censo, a_sus, a_cert, a_rg, a_cpf) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['a_nome'], "text"),
                       GetSQLValueString($_POST['a_nasc'], "date"),
                       GetSQLValueString($_POST['a_nat'], "text"),
                       GetSQLValueString($_POST['a_pai'], "text"),
                       GetSQLValueString($_POST['a_mae'], "text"),
                       GetSQLValueString($_POST['a_sexo'], "text"),
                       GetSQLValueString($_POST['a_end'], "text"),
                       GetSQLValueString($_POST['a_tel1'], "text"),
                       GetSQLValueString($_POST['a_tel2'], "text"),
                       GetSQLValueString($_POST['a_censo'], "text"),
                       GetSQLValueString($_POST['a_sus'], "text"),
                       GetSQLValueString($_POST['a_cert'], "text"),
                       GetSQLValueString($_POST['a_rg'], "text"),
                       GetSQLValueString($_POST['a_cpf'], "text"));

  mysql_select_db($database_conexao, $conexao);
  $Result1 = mysql_query($insertSQL, $conexao) or die(mysql_error());
}

mysql_select_db($database_conexao, $conexao);
$query_Recordset1 = "SELECT * FROM aluno";
$Recordset1 = mysql_query($query_Recordset1, $conexao) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_free_result($Recordset1);
?>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">A_nome:</td>
      <td><input type="text" name="a_nome" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_nasc:</td>
      <td><input type="date" name="a_nasc" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_nat:</td>
      <td><input type="text" name="a_nat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_pai:</td>
      <td><input type="text" name="a_pai" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_mae:</td>
      <td><input type="text" name="a_mae" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_sexo:</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="a_sexo" value="F" <?php if (!(strcmp($row_Recordset1['a_sexo'],"F"))) {echo "checked=\"checked\"";} ?>>
            Feminino</td>
        </tr>
        <tr>
          <td><input type="radio" name="a_sexo" value="M" <?php if (!(strcmp($row_Recordset1['a_sexo'],"M"))) {echo "checked=\"checked\"";} ?>>
            Masculino</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_end:</td>
      <td><input type="text" name="a_end" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_tel1:</td>
      <td><input type="text" name="a_tel1" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_tel2:</td>
      <td><input type="text" name="a_tel2" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_censo:</td>
      <td><input type="text" name="a_censo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_sus:</td>
      <td><input type="text" name="a_sus" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_cert:</td>
      <td><input type="text" name="a_cert" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_rg:</td>
      <td><input type="text" name="a_rg" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">A_cpf:</td>
      <td><input type="text" name="a_cpf" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
