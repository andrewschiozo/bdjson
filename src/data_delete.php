<?php

$_POST['dbName'] = 'banco1';
$_POST['tblName'] = 'tabela1';
$_POST['index'] = 1;
$_POST['data'] = 'seis';

$dbName = $_POST['dbName'];
$tblName = $_POST['tblName'];
$data = $_POST['data'];
$index = $_POST['index'];

$dirDb = '../data/' . $dbName;
$dirTbl = $dirDb . '/' . $tblName . '.json';

if (file_exists($dirDb)) {
	if(file_exists($dirTbl))
	{
		$contentString 	= file_get_contents($dirTbl);
		$contentArray 	= json_decode($contentString);
		if(array_key_exists($index, $contentArray))
		{
			unset($contentArray[$index]);
			$contentString 	= json_encode(array($contentArray));
		    $handle = fopen($dirTbl, 'w+');
		    fwrite($handle, $contentString);
		    fclose($handle);
		    echo 'Dados apagados';
		}
		else
		{
			echo 'Índice inválido';
		}
	}
	else
	{
		echo 'Tabela não existe';
	}
}
else
{
	echo 'Banco não existe';
}