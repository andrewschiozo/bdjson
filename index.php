<?php

require_once 'src/config.php';
require_once 'src/Table.php';
require_once 'src/DB.php';
echo '<pre>';
try
{
	$db = new DB('meubanco');
	$db->addTable('cliente');

	echo '<br>Data add<br>';
	$db->getTable('cliente')->addData('cliente 1');
	$db->getTable('cliente')->addData('cliente 2');
	$db->getTable('cliente')->addData('cliente 3');
	print_r($db->getTable('cliente')->getData());

	echo '<br>Data update<br>';
	$db->getTable('cliente')->updateData(1, 'Segundo cliente');
	print_r($db->getTable('cliente')->getData());

	$db->getTable('cliente')->clear();
	$db->getTable('cliente')->delete();
}
catch(Exception $e)
{
	echo $e->getMessage();
}

echo "\n\r";