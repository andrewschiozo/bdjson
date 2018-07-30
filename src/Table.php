<?php

class Table
{
	private $name;
	private $db;
	private $data;

	public function __construct($name, DB $db)
	{
		$this->name = $name;
		$this->db = $db;
	}

	protected function getFilePath()
	{
		return DATA_PATH . $this->db->getName() . '/' . $this->name . '.json';
	}

	public function getName()
	{
		return $this->name;
	}

	public function create()
	{
		if (file_exists($this->getFilePath())) {
			if(file_exists($this->getFilePath()))
			{
		    	throw new Exception('Tabela ' . $this->name . ' já existe', 1);
			}
			else
			{
			    $handle = fopen($this->getFilePath(), 'w+');
			    fwrite($handle, '[]');
			    fclose($handle);
			    return true;
			}
		}
		else
		{
			throw new Exception('Banco não existe', 1);
		}
	}

	public function clear()
	{
		if (file_exists($this->getFilePath())) {
			if(file_exists($this->getFilePath()))
			{
				$handle = fopen($this->getFilePath(), 'w+');
			    fwrite($handle, '[]');
			    fclose($handle);
			    return true;
			}
			else
			{
			    throw new Exception('Tabela ' . $this->getFilePath() . ' não existe', 1);
			}
		}
		else
		{
			throw new Exception('Banco não existe', 1);
		}
	}

	public function delete()
	{
		if(file_exists($this->getFilePath()))
		{
	    	unlink($this->getFilePath());
	    	return true;
		}
		else
		{
		    throw new Exception('Tabela não existe', 1);
		}
	}

	public function addData($data)
	{
		$fileData = $this->getData();

		if(is_array($fileData))
		{
			$fileData[] = $data;
			$contentString 	= json_encode($fileData);
		    $handle = fopen($this->getFilePath(), 'w+');
		    fwrite($handle, $contentString);
		    fclose($handle);
		    return true;
		}
		else
		{
			throw new Exception('Conteúdo não é array');
		}
	}

	public function getData()
	{
		if (file_exists($this->getFilePath())) {
			$contentString 	= file_get_contents($this->getFilePath());
			return json_decode($contentString);
		}
		else
		{
			throw new Exception('Arquivo ' . $this->getFilePath() . ' não existe', 1);
		}
	}

	public function updateData($index, $data)
	{
		$fileData = $this->getData();

		if(is_array($fileData))
		{
			if(array_key_exists($index, $fileData))
			{
				$fileData[$index] = $data;
				$contentString 	= json_encode($fileData);
			    $handle = fopen($this->getFilePath(), 'w+');
			    fwrite($handle, $contentString);
			    fclose($handle);
			    return true;
			}
			else
			{
				throw new Exception('Índice inválido');
			}
		}
		else
		{
			throw new Exception('Conteúdo não é array');
		}
	}
}