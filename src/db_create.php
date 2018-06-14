<?php

$_POST['name'] = 'banco1';

$dbName = $_POST['name'];

$dir = '../data/' . $dbName;

if (file_exists($dir)) {
	echo 'Banco já existe';
}
else
{
    mkdir($dir);
    echo 'Banco criado';
}