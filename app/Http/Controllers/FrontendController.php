<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Slider as Sl;
use App\Category;
use App\Brands as Brands;
use Illuminate\Support\Facades\Session;
use App\Products as Pro;
use App\Attribute_set as Attribute_set;
use App\Attribute as Attribute;
use App\Orders as Order;

use Illuminate\Support\Facades\Request as Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Helpers\Helper;


class FrontendController extends Controller
{
    //

    public function myhome(){
        $slider= Sl::where('publication_status',1)->orderBy('sort_order')->get();
        $front_cate= Pro::take(4)->inRandomOrder()->get();
        $new_product= Pro::paginate(4);
        $feature= Pro::where('feature',1)->take(4)->get();
    	return view('frontend/home',compact('slider','front_cate','new_product','user_check','feature'));
    }

    public function products(){
        $products= Pro::paginate(8);
    	return view('frontend/products',compact('products'));
    }
    public function topbrands(){
        $top_brand= Brands::where('top_brand',1)->take(4)->get();
    	return view('frontend/topbrands',compact('top_brand'));
    }

    public function cart(){
      $cart = Cart::content();
      
    	return view('frontend/cart',compact('cart'));
    }
    public function contact(){
    	return view('frontend/contact');
    }

    public function login(){
    	return view('frontend/signin');
    }
    public function search(){
    	return view('frontend/search');
    }
    public function add_cart(){


      /*
        $cart = Cart::content();

        foreach ($cart as $value) {
          print_r($value);
        }
        //Cart::destroy();
      */
      if(Requests::isMethod('post')){
        $product_id = Requests::get('product_id');
        $product = Pro::find($product_id);
        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
        return back();
      }
    }
    public function update_cart($id,$method){
        if ($method=='update') {
          $rowId = Cart::search(array('id' => $id));
          $item = Cart::get($rowId[0]);
          $update_qty = Requests::input('update_qty');
          Cart::update($rowId[0], $update_qty);
          return back();
        }

        if ($method == 'delete') {
          $rowId = Cart::search(array('id' => $id));
          Cart::remove($rowId[0]);
          return back();
        } 
    }

    public function myaccount(){
        return view('frontend/myaccount');
    }

    public function order(){
        if(!empty(Auth::user()->id)){
            $user_id = Auth::user()->id;
            $cart = Cart::content();
            print_r($cart);
            $data['customer_id']=$user_id;
            $data['order_details']=serialize($cart);
            $data['status']='pending';
            Order::create($data);
            Cart::destroy();
            return redirect('/')->with('msg','your order Successfully submited! Please wait for confirmation...');
            }else{
                return redirect('/');
            }
        //return view('frontend/order');
    }
    public function details($id){
        $edit_data = Pro::findOrFail($id);
        $category = Category::all();
        $category_by_id = Category::findOrFail($edit_data->category_id)->name;
        $Brands_by_id= Brands::findOrFail($edit_data->brand_id)->name;
        $Attribute = Attribute::all();
        $Attribute_set_by_id = Attribute_set::where('id',$edit_data->attribute_set)->get();
        return view('frontend/details',compact('edit_data','category_by_id','Brands_by_id','category','Attribute_set_by_id','Attribute'));
    }
}
