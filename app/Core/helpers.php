<?php

if (! function_exists('array_last_value')) {

    function array_last_value($string,$delimiter,$last = true)
    {
        $result = explode($delimiter,$string);

        if($last){
            return ucwords(array_last($result));
        }else{
            return array_first($result);
        }
    }
}

if(! function_exists('user_in_cgm')){

	function user_in_cgm()
	{

		return dd(auth()->user()->ldap);
	}

}

if(! function_exists('mask')){

    function mask($val, $mask)
    {
     $maskared = '';
     $k = 0;
     for($i = 0; $i<=strlen($mask)-1; $i++)
     {
       if($mask[$i] == '#')
       {
          if(isset($val[$k]))
           $maskared .= $val[$k++];
       }
       else
     {
         if(isset($mask[$i]))
         $maskared .= $mask[$i];
         }
     }
     return $maskared;
    }
}

if(! function_exists('get_sec')){
    function get_sec($id){
        $retorno = \App\Domains\Comissionado\Models\Secretarias::find($id);
        return $retorno->descricao;
    }
}

if(! function_exists('in_admin_group')){
    function in_admin_group(){
        return in_array(auth()->user()->roles->toArray()[0]['id'],['1','2']);
    }
}

if(! function_exists('convert_dn')){
    function convert_dn($dn)
    {    
        $array = explode(',', $dn, 3);

        $dn = array_pop($array);

        $arDn = explode(',',$dn);

        $dnF = array_first($arDn);

        $bOrg = explode('=',$dnF);

        return array_pop($bOrg);
        
    }
}

if(! function_exists('selected')){
    function selected($base,$next)
    {    
        if($base==$next){
            return ' selected';
        }
        
    }
}


