<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=[
      'category_id','name','description','image','price','waiting_time'
    ];
    public static  function countCategory($id){
        $Catcount=product::select('product.*')->where('categories.id',$id)
        ->join('categories','categories.id','products.category_id')
        ->count();
        return $Catcount;
    }
}
