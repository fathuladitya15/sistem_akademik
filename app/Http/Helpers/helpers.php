<?php 

use Carbon\Carbon;

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

if (!function_exists('tahun_ajaran')) {
	function tahun_ajaran($status = null)  {
		$tahun_sekarang 			= Carbon::now()->format('Y');
		$tahun_kemarin 				= Carbon::now()->subYear()->format('Y');
		$tahun_besok 				= Carbon::now()->addYear(1)->format('Y');
		$tanggal_skarang 			= Carbon::now()->format('d m Y');
		$penentuan_ajaran_baru  	= '10-07-'.$tahun_sekarang;

		if ($status == 'baru') {
			$date = '10-07-'.$tahun_sekarang;
			$tanggal_lengkap_sekarang 	= Carbon::parse($date)->format('d-m-Y');
		}else {
			$tanggal_lengkap_sekarang 	= Carbon::now()->format('d-m-Y');
		}
		
		$tahun_ajaran 				= $tanggal_lengkap_sekarang >= $penentuan_ajaran_baru ? $tahun_sekarang.'/'.$tahun_besok : $tahun_kemarin.'/'.$tahun_sekarang;

		return $tahun_ajaran;
	}
}

if (!function_exists('mod')) {
	function mod($nilai,$pembagi,$plus)  
	{
		$Pembagian = $nilai / $pembagi;
		
		if ($Pembagian == 0) {
			$res  = $Pembagian;
		}else {
			$res = (int) $Pembagian + $plus;
		}

		return $res;
	}
}

?>