<?php

class DB
{
	private $name;
	protected $tables;

	public function __construct($name = null)
	{
		$this->name = $name;
		if(!is_null($name))
		{
			try{
				$this->create();
			} catch(Exception $e){
			} finally{
				$this->listTables();
			}
		}
	}

	public function getFilePath()
	{
		return DATA_PATH . $this->name . '/';
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTable($name)
	{
		if(is_null($this->tables))
		{
			throw new Exception("Não há tabelas cadastradas", 1);
		}else
		{
			if(array_key_exists($name, $this->tables))
			{
				return $this->tables[$name];
			}
			else
			{
				throw new Exception('Tabela não existe', 1);
			}
		}
	}

	public function listTables()
	{
		if(is_null($this->name))
		{
			throw new Exception('Banco não selecionado', 1);
		}
		else
		{
			$scan = scandir(DATA_PATH . $this->name);
			$list = array();
			foreach($scan as $name)
			{
				if(is_dir(DATA_PATH . $this->name))
				{
					if(!in_array($name, array('.', '..')))
					{
						$name = str_replace('.json', '', $name);
						$this->addTable($name);
					}
				}
			}
			return $this->tables;
		}
	}

	public function addTable($name)
	{
		$table = new Table($name, $this);
		try{
			$table->create();
		} catch(Exception $e){
		} finally{
			$this->tables[$name] = $table;
		}
	}

	public function create()
	{
		$dir = DATA_PATH . $this->name;
		if (file_exists($dir)) {
			throw new Exception("Banco já existe", 1);
		}
		else
		{
		    mkdir($dir);
		    return true;
		}
	}

	public function list()
	{
		$scan = scandir(DATA_PATH);
		$list = array();
		foreach($scan as $name)
		{
			if(is_dir(DATA_PATH . $name))
			{
				$folderIgnore = array('.', '..');
				if(!in_array($name, $folderIgnore))
				{
					$list[] = $name;
				}
			}
		}
		return $list;
	}
}