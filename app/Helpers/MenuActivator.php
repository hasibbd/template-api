<?php

namespace App\Helpers;

class MenuActivator
{
    public static function check($data, $url, $className)
    {
     foreach ($data as $d){
       if (str_replace( array( '\'', '/','"', ',' , ';', '<', '>' ), '', $d['href']) == str_replace( array( '\'','/', '"', ',' , ';', '<', '>' ), '', $url)){
           return $className;
       }
     }
    }
    public static function active($url, $url2)
    {
            if (str_replace( array( '\'', '/','"', ',' , ';', '<', '>' ), '', $url) == str_replace( array( '\'','/', '"', ',' , ';', '<', '>' ), '', $url2)){
                return 'active';
            }
    }
}
