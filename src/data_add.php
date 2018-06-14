<?php

$_POST['dbName'] = 'banco1';
$_POST['tblName'] = 'tabela1';

class Noticia{
	public function __construct($titulo, $tema, $noticia)
	{
		$this->titulo = $titulo;
		$this->tema = $tema;
		$this->noticia = $noticia;
	}
}

$_POST['data'] = array(new Noticia('Caminhoneirada de greve', 'Cotidiano', 'Caminhoneiros resolveram entrar em greve só proque o preço do diesel subil.. Tá de sacanagem né?'),
						new Noticia('Mundo animal endoida', 'Saúde', 'Animais surtam após perceber a presença de muitos caminhoneiros nas estradas próximas as suas residências'));

$dbName = $_POST['dbName'];
$tblName = $_POST['tblName'];
$data = $_POST['data'];

$dirDb = '../data/' . $dbName;
$dirTbl = $dirDb . '/' . $tblName . '.json';

if (file_exists($dirDb)) {
	if(file_exists($dirTbl))
	{
		$contentString 	= file_get_contents($dirTbl);
		$contentArray 	= json_decode($contentString);
		$contentArray[date('YmdHis')] = $data;
	    $contentString 	= json_encode($contentArray);
	    $handle = fopen($dirTbl, 'w+');
	    fwrite($handle, $contentString);
	    fclose($handle);
	    echo 'Dados salvos';
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