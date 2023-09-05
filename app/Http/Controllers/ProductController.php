<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like',"%".request('key')."%");
        })
        ->leftjoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //create  Page
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //create product
    public function create(Request $request){
       $this->productValidationCheck($request,'create');
       $data=$this->requestProductInfo($request);

       if($request->hasfile('pizzaImage')){
        $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;
       }

       Product::create($data);
       return redirect()->route('product#list');
    }

    //delete product

    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Deleted Success...']);
    }
    //edit product
    public function edit($id){
        $pizza=Product::select('products.*','categories.name as category_name')
        ->leftjoin('categories','products.category_id','categories.id')
         ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //update pizza page
    public function updatePage($id){
        $pizzas=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.update',compact('pizzas','category'));
    }

     //update Pizza
    public function update(Request $request){

        $this-> productValidationCheck($request,'update');
        $data=$this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName=Product::where('id',$request->pizzaId)->first();
            $oldImageName=$oldImageName->image;

            if($oldImageName != null){
               Storage::delete('public/'.$oldImageName);
            }
            $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/'.$fileName);
            $data['image']=$fileName;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }

    //productInfo
    private function requestProductInfo($request){
        return[

            'category_id'=>$request->pizzaCategory,
             'name'=>$request->pizzaName,
             'description'=>$request->pizzaDescription,
             'waiting_time'=>$request->pizzaWaitingTime,
             'price'=>$request->pizzaPrice

        ];
    }

    private function productValidationCheck($request,$action){
        $validationRule= [
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
             'pizzaCategory'=>'required',
              'pizzaDescription'=>'required|min:10',
               'pizzaImage'=>'required|mimes:jpg,jpeg,png,jiff|file',
                'pizzaPrice'=>'required',
                'pizzaWaitingTime'=>'required'
    ];

    $validationRule['pizzaImage']=$action=='create' ? 'required|mimes:jpg,jpeg,png,jiff|file': 'mimes:jpg,jpeg,png,jiff|file';
        Validator::make($request->all(),$validationRule )->validate();
    }



}
