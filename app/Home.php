<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public static function exclCAT()
    {
        $exclCAT = array(11);

        return $exclCAT;
    }
}
