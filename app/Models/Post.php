<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;

class Post extends Model
{
    public function relation(){
        $array=['1','2','3'];
        return $array;
    }
}
