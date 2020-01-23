<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'usersName', 'path', 'size', 'user_id','parent_directory',
    ];
}


