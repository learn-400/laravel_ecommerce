<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    //
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
    public function myadmin(){
    	return view('backend/dashboard');
    }
    
    public function slider()
    {
        
    }
    public function categories(){
    	return view('backend/categories');
    }

    public function brands(){
    	return view('backend/brands');
    }


    public function products(){
    	return view('backend/products');
    }

    public function order(){
    	return view('backend/order');
    }
    
}
