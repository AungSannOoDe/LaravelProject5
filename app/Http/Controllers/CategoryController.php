<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class CategoryController extends Controller
{
    public function list(){
        $categories=Category::when(request('key'),function($query){
            $query=Category::where('Cate_name','like','%'.request('key').'%');
            return $query;
        })
        ->orderBy('id','desc')
        ->paginate(4);
        $categories->appends(request()->all());
        return view('Admin.category.list',compact('categories'));
    }
    public function createPage(){
        return view('Admin.category.create');
    }
    // admin  create category
    public function create(Request $request){
        $this->validateCheck($request);
$data=$this->requestgetData($request);
   Category::create($data);
   return redirect()->route('admin#cate')->with(['createSuccess'=>'Created Successfully.......']);
    }
    //admin edit function
    public function edit($id){
        $category=Category::where('id',$id)->first();
        return view('Admin.category.edit',compact('category'));
    }
    //admin Category delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Deleted Successfully.....']);
    }
    //admin Category update
    public function update(Request $request){
        $this->validateCheck($request);
      $data=$this->requestgetData($request);
      Category::where('id',$request->categoryID)->update($data);
      return redirect()->route('admin#cate')->with(['updateSuccess'=>'Updated Successfully.....']);
    }
    private function validateCheck($request){
    Validator::make($request->all(),[
        'CategoryName'=>'required|min:4,|unique:categories,Cate_name,'.$request->CategoryID
    ],[
        'CategoryName.required'=>'u need to fill',
        'CategoryName.unique'=>'this name is already exist'
    ])->validate();
    }
    //request get Data
    private function requestgetData($request){
        return [
           'Cate_name'=>$request->CategoryName
        ];
    }

}
