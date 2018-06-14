<?php

$scan = scandir('../data');
$list = array();
foreach($scan as $name)
{
	if(is_dir('../data/' . $name))
	{
		if(!in_array($name, array('.', '..')))
		{
			$list[] = $name;
		}
	}
}
echo json_encode($list);