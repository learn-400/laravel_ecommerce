<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Attribute as Att;
use App\Attribute_set as Attribute_set;
class Attribute_set_Controller extends Controller
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
        $data= Attribute_set::all();
        $att= Att::all();
        $edit = 0;
        return view('backend/Attribute_set',compact('data','edit','att'));
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
        $data['publiAttibute_setion_status'] = $request->input('status');
        */
        $input['name'] = $request->input('name');
		$input['value'] = serialize($request->input('attribute'));
        Attribute_set::create($input);
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
        $att= Att::all();
        $data= Attribute_set::all();
        $edit = 1;
        $edit_data = Attribute_set::findOrFail($id);
        return view('backend/Attribute_set',compact('data','edit','edit_data','att'));
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
        $input['name'] = $request->input('name');
		$input['value'] = serialize($request->input('attribute'));
        $data = Attribute_set::findOrFail($id);
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
        $data = Attribute_set::findOrFail($id);
        $data->delete();
        return redirect('attribute_set')->with('msg','Successfully Deleted !! ');;
    }

    /* End CRUDE*/

}
