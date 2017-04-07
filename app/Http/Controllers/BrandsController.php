<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Brands as Brands;
class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data= Brands::all();
        $edit = 0;
        return view('backend/Brands',compact('data','edit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "hi";
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
        $data['publiBrandsion_status'] = $request->input('status');
        */
        $input= $request->all();
        Brands::create($input);
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
        $data= Brands::all();
        $edit = 1;
        $edit_data = Brands::findOrFail($id);
        return view('backend/Brands',compact('data','edit','edit_data'));
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
         $data = Brands::findOrFail($id);
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
        $data = Brands::findOrFail($id);
        $data->delete();
        return redirect('brands')->with('msg','Successfully Deleted !! ');;
    }

    /* End CRUDE*/



    public function publish($id){
        Brands::where('id',$id)->update(['publication_status'=>1]);
        return back()->with('msg','Successfully Published !! ');;
    }

    public function unpublish($id){
        Brands::where('id',$id)->update(['publication_status'=>0]);
        return back()->with('msg','Successfully Unpublished !! ');;
    }
}
