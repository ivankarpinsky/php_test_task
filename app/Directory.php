<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    protected $fillable = [
        'name', 'user_id','parent_directory',
    ];

    public static function getBreadCrumbs($id) {
        $res=[];

        while ($id!=0) {
            $d = Directory::find($id);
            $a['name'] = $d->getAttribute('name');
            $a['id'] = $d->getAttribute('id');
            array_push($res, $a);
            $a = [];
            $id = $d->getAttribute('parent_directory');
        }

        return $res;
    }
}
