<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category;
use App\Brands as Brands;
use App\Products as Pro;
use App\Attribute_set as Attribute_set;
use App\Attribute as Attribute;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* Start CRUDE*/
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if(!empty(Auth::user()->rules)){
            $this->rules = Auth::user()->rules;
            if($this->rules!='administrator'){
                return redirect('/customer/index');
            }else{

            }
            }else{
                return redirect('/myadmin/login');
            }

            return $next($request);
        });
    }
    public function index()
    {
        $category_data = Category::all();
        $brands_data = Brands::all();
        $Attribute_set = Attribute_set::all();
        $data= Pro::all();
        $edit = 0;
        return view('backend/products',compact('data','edit','category_data','brands_data','Attribute_set'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $data['name'] = $request->input('name');
        $data['publiProion_status'] = $request->input('status');
        */
        $data['name'] = $request->input('name');
        $data['sort_description'] = $request->input('sort_description');
        $data['long_description'] = $request->input('long_description');
        $data['attribute_set'] = $request->input('attribute_set');
        $Attribute_set = Attribute_set::where('id',$data['attribute_set'])->get();
        $Attribute = Attribute::all();


        foreach ($Attribute_set as $v) {

             $a_set_value = unserialize($v->value);
             foreach ($a_set_value  as $key => $Attribute_id) {
                foreach ($Attribute as $v) {
                    if ($v->id == $Attribute_id) {
                        //$data['attribute_set'] = $request->input($v->id);
                        //$result[]= array('attrute_id'=>$v->id,'value'=>$request->input($v->id));
                        $result[]= array($v->id=>$request->input($v->id));
                        //print_r($request->input($v->id));
                       
                    }
                }
                $data['attribute'] = serialize($result);
            }
        }

        //exit();
        if($request->hasFile('images')){
            $destination = 'images/uploads/';
            $file = $request->file('images');
            $file->move($destination, time().$file->getClientOriginalName());
            $data['image']=time().$file->getClientOriginalName();
        }else{
             $data['image']="default.png";
        }
        $data['price'] = $request->input('price');
        $data['qty'] = $request->input('qty');
        $data['category_id'] = $request->input('category_id');
        $data['brand_id'] = $request->input('brand_id');
        $data['publication_status'] = $request->input('publication_status');



        Pro::create($data);
        return back()->with('msg','Successfully Added !! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data= Pro::all();
        $edit = 1;
        $brands_data = Brands::all();
        $category_data = Category::all();
        $Attribute_set = Attribute_set::all();
        $edit_data = Pro::findOrFail($id);

        //echo $edit_data->id;
        //exit();
        $Attribute_set_by_id = Attribute_set::where('id',$edit_data->attribute_set)->get();
        $Attribute = Attribute::all();
        return view('backend/products',compact('data','edit','edit_data','brands_data','Attribute_set','category_data','Attribute_set_by_id','Attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data['name'] = $request->input('name');
        $data['sort_description'] = $request->input('sort_description');
        $data['long_description'] = $request->input('long_description');
        $data['attribute_set'] = $request->input('attribute_set');
        $Attribute_set = Attribute_set::where('id',$data['attribute_set'])->get();
        $Attribute = Attribute::all();
        $edit_data = Pro::findOrFail($id);
        foreach ($Attribute_set as $v) {

             $a_set_value = unserialize($v->value);
             foreach ($a_set_value  as $key => $Attribute_id) {
                foreach ($Attribute as $v) {
                    if ($v->id == $Attribute_id) {
                        $result[]= array($v->id=>$request->input($v->id));
                    }
                }
                $data['attribute'] = serialize($result);
            }
        }

        //exit();
        if($request->hasFile('images')){
            if($edit_data->image == '' || $edit_data->image == 'default.png'){
                $destination = 'images/uploads/';
                $file = $request->file('images');
                $file->move($destination, time().$file->getClientOriginalName());
                $data['image']=time().$file->getClientOriginalName();    
            }else{
                unlink('images/uploads/'.$edit_data->image);    
                $destination = 'images/uploads/';
                $file = $request->file('images');
                $file->move($destination, time().$file->getClientOriginalName());
                $data['image']=time().$file->getClientOriginalName();   
            }
            
            
        }else{
             //$data['image']="default.png";
        }
        $data['price'] = $request->input('price');
        $data['qty'] = $request->input('qty');
        $data['category_id'] = $request->input('category_id');
        $data['brand_id'] = $request->input('brand_id');
        $data['publication_status'] = $request->input('publication_status');

        $f_data = Pro::findOrFail($id);
        $f_data->update($data);
        return back()->with('msg','Successfully Added !! ');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Pro::findOrFail($id);
        
        if($data->image !='default.png'){
            unlink('images/uploads/'.$data->image);
        }

        $data->delete();
        return redirect('products-management')->with('msg','Successfully Deleted !! ');;
    }

    /* End CRUDE*/



    public function publish($id){
        Pro::where('id',$id)->update(['publication_status'=>1]);
        return back()->with('msg','Successfully publish !! ');;
    }

    public function unpublish($id){
        Pro::where('id',$id)->update(['publication_status'=>0]);
        return back()->with('msg','Successfully unpublish !! ');;
    }

    public function attribute_ajax(){
        $attribute_set_id = $_POST['attribute_set_id'];
        //$Attribute = Attribute::where('id',5)->get();
        $Attribute_set = Attribute_set::where('id',$attribute_set_id)->get();
        $Attribute = Attribute::all();
        /*foreach ($Attribute_set as $v) {
             $a_set_value = unserialize($v->value);
             foreach ($a_set_value  as $key => $value) {
                echo $value;
             }
        }*/


        //echo $Attribute->name;

        return view('backend/attribute_ajax',compact('attribute_set_id','Attribute_set','Attribute'));
    }
}
