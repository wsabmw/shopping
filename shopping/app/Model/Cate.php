<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    public function subMenuLevel2() { 
        return $this->hasMany(Cate::class,'pid','id') ->select(['id','cft_name','pid']); 
    } 
    public function subMenuLevel1() { 
        return $this->hasMany('App\Model\Cate','pid','id') ->select(['id','cft_name','pid']) ->with('subMenuLevel2'); 
    } 
    public  function getCategoryMenu() { 
        return Cate::where('pid',0) ->with('subMenuLevel1') ->get(['id','cft_name'])->toArray(); 
    } 
}
