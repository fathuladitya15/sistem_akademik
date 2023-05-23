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

?>