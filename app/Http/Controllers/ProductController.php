<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    //admin list

    public function productlist(){
         $pizza= product::select('products.*','categories.Cate_name as Cat_name')->when(request('key'),function($query){
           $query->where('name','like','%'.request('key').'%');
         })
         ->join('categories','categories.id','products.category_id')
         ->orderBy('created_at','desc')->paginate(5);
         $pizza->appends(request()->all());
        return view('Admin.products.pizzalist',compact('pizza'));
    }
    //delete Controller
    public function delete($id){
      product::where('id',$id)->delete();
      return redirect()->route('product#list')->with(['deleteSuccess'=>'Your product is deleted Successful']);
    }
    public function createPage(){
        $categories=Category::select('id','Cate_name')->get();

        return view('Admin.products.create',compact('categories'));
    }
    public function create(Request $request){
   $this->CheckProductValidation($request,"create");
   $data=$this->getData($request);
   if($request->hasFile('pizzaImage')){
    $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
    $request->file('pizzaImage')->storeAs('public',$fileName);
    $data['image']=$fileName;
    product::create($data);
    return redirect()->route('product#list');
   }
    }
    public function editPage($id){
       $pizza=product::where('id',$id)->first();
       $category=Category::all();
       return view('Admin.products.edit',compact('pizza','category'));
    }
    public function details($id){
        $p=product::select('products.*','categories.Cate_name as Cat_name')
        ->where('products.id',$id)
        ->join('categories','categories.id','products.category_id')
        ->first();

        return view('Admin.products.details',compact('p'));
     }
     //product Details

     //product Update
     public function update(Request $request){
        $this->CheckProductValidation($request,"update");
        $data=$this->getData($request);
  if($request->hasFile('pizzaImage')){
    $oldImageName=product::where('id',$request->pizzaId)->first();
    $oldImageName=$oldImageName->image;
    if($oldImageName !=null){
        Storage::delete('public/'.$oldImageName);
    }
    $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
    $request->file('pizzaImage')->storeAs('public',$fileName);
    $data['image']= $fileName;
  }
  product::where('id',$request->pizzaId)->update($data);
  return redirect()->route('product#list')->with(['updateSuccess'=>'Product Updated Successful']);
     }

    //product Validation
    private function CheckProductValidation($request,$status){
        $validationRule=[
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaImage'=>'required|mimes:,jpeg|file',
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaPrice'=>'required',
            'pizzaWaiting'=>'required'
        ];
        $validationRule['pizzaImage']=$status=="create"?'required|mimes:,jpeg|file':"mimes:,jpeg|file";

     Validator::make($request->all(),$validationRule)->validate();
    }
    private function getData($request){
        return [
        'category_id'=>$request->pizzaCategory,
         'name'=>$request->pizzaName,
         'description'=>$request->pizzaDescription,
         'price'=>$request->pizzaPrice,
         'waiting_time'=>$request->pizzaWaiting
        ];
    }
}
