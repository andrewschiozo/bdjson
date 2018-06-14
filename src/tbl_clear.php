<?php

$_POST['db'] = 'banco1';
$_POST['name'] = 'tabela1';

$dbName = $_POST['db'];
$tblName = $_POST['name'];

$dirDb = '../data/' . $dbName;
$dirTbl = $dirDb . '/' . $tblName . '.json';

if (file_exists($dirDb)) {
	if(file_exists($dirTbl))
	{
		$handle = fopen($dirTbl, 'w+');
	    fwrite($handle, '[]');
	    fclose($handle);
	    echo 'Registros apagados';
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

