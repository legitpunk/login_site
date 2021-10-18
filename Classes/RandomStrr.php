<?php

Class RandomStrr
{
	public function Make($length, $keyspace = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM')
	{
		$str = '';
		$max = MB_STRLEN($keyspace, '8BIT') -1;
		if($max < 1)
		{
			throw new Exception('$keyspace must be at least 2 characters long');
		}
		for ($i = 0; $i < $length; ++$i)
		{
			$str .= $keyspace[random_int(0, $max)];
		}
		return $str;
	}
}