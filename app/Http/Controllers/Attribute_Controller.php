<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Attribute as Att;
use App\Helpers\Helper;
class Attribute_Controller extends Controller
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
        $data= Att::all();
        $edit = 0;
        return view('backend/Attribute',compact('data','edit','test'));
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
        $data['name'] = $request->input('name');
        $data['value'] = explode('|',$request->input('value'));
        $data['value'] = serialize($data['value']);
        Att::create($data);
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
        $data= Att::all();
        $edit = 1;
        $edit_data = Att::findOrFail($id);
        return view('backend/attribute',compact('data','edit','edit_data'));
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
        $input['value'] = explode('|',$request->input('value'));
        $input['value'] = serialize($input['value']);
        $data = Att::findOrFail($id);
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
        $data = Att::findOrFail($id);
        $data->delete();
        return redirect('attribute')->with('msg','Successfully Deleted !! ');;
    }

    /* End CRUDE*/

}
