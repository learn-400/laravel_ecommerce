<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Category as Cat;

class CategoryController extends Controller
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
        $data= Cat::all();
        $edit = 0;
        return view('backend/categories',compact('data','edit'));
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
        $data['publication_status'] = $request->input('status');
        */
        $input= $request->all();
        Cat::create($input);
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
        $data= Cat::all();
        $edit = 1;
        $edit_data = Cat::findOrFail($id);
        return view('backend/categories',compact('data','edit','edit_data'));
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
        //
         $input= $request->all();
         $data = Cat::findOrFail($id);
         $data->update($input);
         return back()->with('msg','Successfully Updated !! ');;
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
        $data = Cat::findOrFail($id);
        $data->delete();
        return redirect('categories')->with('msg','Successfully Deleted !! ');;
    }

    /* End CRUDE*/



    public function publish($id){
        Cat::where('id',$id)->update(['publication_status'=>1]);
        return back()->with('msg','Successfully publish !! ');;
    }

    public function unpublish($id){
        Cat::where('id',$id)->update(['publication_status'=>0]);
        return back()->with('msg','Successfully unpublish !! ');;
    }
}
