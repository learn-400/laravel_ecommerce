<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Slider as Sl;

class SliderController extends Controller
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
        $data= Sl::all();
        $edit = 0;
        return view('backend/slider',compact('data','edit'));
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
        $data['name'] = $request->input('name');
       
        //exit();
        if($request->hasFile('images')){
            $destination = 'images/slider/';
            $file = $request->file('images');
            $file->move($destination, time().$file->getClientOriginalName());
            $data['image']=time().$file->getClientOriginalName();
        }else{
            $data['image']="default_slider.jpg";
        }
        $data['sort_order'] = $request->input('sort_order');
        $data['publication_status'] = $request->input('publication_status');
        //exit();
        Sl::create($data);

        return back()->with('msg','Successfully Slider Added !! ');
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
        $data= Sl::all();
        $edit = 1;
        $edit_data = Sl::findOrFail($id);
        return view('backend/slider',compact('data','edit','edit_data'));
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
        $edit_data = Sl::findOrFail($id);
        $data['name'] = $request->input('name');
        if($request->hasFile('images')){
            if($edit_data->image == '' || $edit_data->image == 'default_slider.jpg'){
                $destination = 'images/slider/';
                $file = $request->file('images');
                $file->move($destination, time().$file->getClientOriginalName());
                $data['image']=time().$file->getClientOriginalName();    
            }else{
                unlink('images/slider/'.$edit_data->image);    
                $destination = 'images/slider/';
                $file = $request->file('images');
                $file->move($destination, time().$file->getClientOriginalName());
                $data['image']=time().$file->getClientOriginalName();   
            }
            
            
        }else{
             //$data['image']="default.png";
        }
        $data['sort_order'] = $request->input('sort_order');
        $data['publication_status'] = $request->input('publication_status');
        $data['publication_status'] = $request->input('publication_status');

        $f_data = Sl::findOrFail($id);
        $f_data->update($data);
        return back()->with('msg','Successfully updated !! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Sl::findOrFail($id);
        if($data->image !='default_slider.jpg'){
        unlink('images/slider/'.$data->image);
        }
        $data->delete();
        return redirect('slider')->with('msg','Successfully Deleted !! ');;
    }

    /* End CRUDE*/



    public function publish($id){
        Sl::where('id',$id)->update(['publication_status'=>1]);
        return back()->with('msg','Successfully publish !! ');;
    }

    public function unpublish($id){
        Sl::where('id',$id)->update(['publication_status'=>0]);
        return back()->with('msg','Successfully unpublish !! ');;
    }
}
