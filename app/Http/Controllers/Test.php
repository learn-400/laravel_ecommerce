<?php

namespace App\Http\Controllers;

class Test extends Controller
{
	public function ajax(){
		return view('test');
	}
	public function test_ajax(){
		echo $_POST['brand_id'];
	}


}
