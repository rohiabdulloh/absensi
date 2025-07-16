<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{    
    protected $fillable = ['key', 'value'];

    public static function getvalue($param){
        $data = Self::query()->where('key','=',$param)->first();
        if($data) return $data->value;
        else return null;
    }

    public static function setvalue($param, $value){
        $data = Self::query()->where('key','=',$param)->first();
        if($data){
            $data->value = $value;
            $data->update();
        }
    }
}
