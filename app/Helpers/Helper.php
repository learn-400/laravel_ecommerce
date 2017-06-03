<?php  

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Attribute as Attribute;
use App\Products as Pro;
use App\Orders as Orders;
use App\User as User;
use Cart;
class Helper{
	public static function hello($x){
		//return 'my name is: '.$x;
	}



	public static function attribute_by_id($id){		
		$Attribute_by_id = Attribute::findOrFail($id);
		return $Attribute_by_id;
	}

	public static function get_by_id($model,$id){		
		$Attribute_by_id = $model::findOrFail($id);
		return $Attribute_by_id;
	}


	public static function matching_attribute($edit_data,$id,$i){
		foreach (unserialize($edit_data) as $edit_data ) {
	    //print_r($edit_data);
	    
	    foreach ($edit_data as $key1 => $value1) {
	        if($key1 == $id){
	            foreach ($value1 as $value2) {
	                if($i == $value2){
	                	return 'match';
	                }
	            }
	        }
	    }
		}
	}


	public static function total_qty(){
		$cart = Cart::content();
	    $total=0;
	    foreach ($cart as $value) {
     		//print_r($value);
        	$total=$total+$value->qty;
	    }
	    return $total;
	}

	public static function product_info_by_id($id){
		return Pro::findOrFail($id);
	}

	public static function user_check(){
		if(!empty(Auth::user()->rules)){
            $user_check=1;
        }else{
           $user_check=0;
        }
        return $user_check;
	}

	public static function customer_by_id($id){
		return User::findOrFail($id);
	}


	public static function get_product_by_brand($id){
		$result = Pro::where('brand_id',$id)->get();
		return $result;
	}

	public static function test(){
		echo "tested";
	}

}	
