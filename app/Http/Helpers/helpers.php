<?php 

if (!function_exists('inisial')) {
    function inisial($name)
    {
        $words = explode(" ", $name);
		$firtsName = reset($words); 
		return substr($firtsName,0,1);
	}
}

if (!function_exists('menuActive')) {
    function menuActive($routeName)
    {
        $class = 'active';

        if (is_array($routeName)) {
            foreach ($routeName as $key => $value) {
                if (request()->routeIs($value)) {
                    return $class;
                }
            }
        } elseif (request()->routeIs($routeName)) {
            return $class;
        }
    }
}

if (!function_exists('menuShow')) {
    function menuShow($routeName)
    {
        $class = 'show';

        if (is_array($routeName)) {
            foreach ($routeName as $key => $value) {
                if (request()->routeIs($value)) {
                    return $class;
                }
            }
        } elseif (request()->routeIs($routeName)) {
            return $class;
        }
	}
}

if (!function_exists('regex')) {
	function regex($pass)
	{
		$re = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
		$match = preg_match($re,$pass);
		if ($match) {
			return TRUE;
		}else {
			return FALSE;
		}
		// return $res;
	}
}

?>