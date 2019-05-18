<?php
// ligação à base de dados (não esquecer de trocar pelos dados correctos)
mysql_connect('localhost', 'root', '') or die(mysql_error());
mysql_select_db('geresc_semec');
 
// definir a constante com quantos registos queremos por página
define('POR_PAGINA', 10);
 
// contar o total de registos da nossa tabela e total de páginas
$sqlTotalRegistos = mysql_query('SELECT COUNT(*) FROM aluno') or die(mysql_query());
$totalRegistos = mysql_result($sqlTotalRegistos, 0, 0);
 
$totalPaginas = ceil($totalRegistos / POR_PAGINA);
 
// obter o número de página actual, é a primeira por omissão
$pagina = 1;
if( !empty($_GET['pagina']) ){
	$p = intval($_GET['pagina']);
 
	if( $p <= 0 || $p > $totalPaginas ){
		header('Location: ?pagina=1');
		exit();
	}
 
	$pagina = $p;
}
 
// obter os registos para esta página, usando a consulta SQL genérica
$sqlPagina = mysql_query('SELECT * FROM aluno LIMIT '.(($pagina - 1) * POR_PAGINA).' , '.POR_PAGINA) or die(mysql_error());
 
echo '<ul>';
while( $linha = mysql_fetch_row($sqlPagina) )
	echo '<li>'.$linha[0].'</li>';
 
echo '</ul>';
 
// gerar ligações para saltar entre páginas
for( $i = 1 ; $i <= $totalPaginas ; $i++ ){
 
	// Não criar uma ligação para a própria página que estamos a visualizar
	if( $i == $pagina )
		echo $i.' ';
	else
		echo '<a href="?pagina='.$i.'">'.$i.'</a> ';
}	
?>