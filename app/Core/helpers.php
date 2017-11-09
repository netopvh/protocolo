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

if(! function_exists('selected')){
    function selected($base,$next)
    {    
        if($base==$next){
            return ' selected';
        }
        
    }
}


