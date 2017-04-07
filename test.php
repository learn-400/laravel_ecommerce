1. add line on
composer.json 
"require": {
        "php": ">=5.5.9",
        "laravel/framework": "5.1.*",
		"gloudemans/shoppingcart": "~1.3"
    },
now type composer update
2. Now in /config/app.php
provider add
Gloudemans\Shoppingcart\ShoppingcartServiceProvider::class,
and 
allias add 
'Cart'    => Gloudemans\Shoppingcart\Facades\Cart::class,

3.
on rout
Route::post('/cart', 'Front@cart');

4. use form for add cart submit
<form method="POST" action="{{url('cart')}}">
	<input type="hidden" name="product_id" value="{{$product->id}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<button type="submit" class="btn btn-fefault add-to-cart">
		<i class="fa fa-shopping-cart"></i>
		Add to cart
	</button>
</form>

5.
Now use a Front.php Controller similar like 
<?php



use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;

public function add_cart(){
        // here retrive data start
		$cart = Cart::content();
        
		if (Requests::isMethod('post')) {
        foreach ($cart as $value) {
          print_r($value);
        }
		// here retrive data stop
		
        //exit();
        $product_id = Requests::get('product_id');
        //exit();
        $product = Pro::find($product_id);
        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
        }

        $cart = Cart::content();

        
        
    }
?>


6.
for update 

<a class="cart_quantity_up" href='{{url("cart?product_id=$item->id&increment=1")}}'> + </a>
<a class="cart_quantity_down" href='{{url("cart?product_id=$item->id&decrease=1")}}'> - </a>

7.
for update method controller should similar as
<?php
public function cart() {
    //update/ add new item to cart
    if (Request::isMethod('post')) {
        $product_id = Request::get('product_id');
        $product = Product::find($product_id);
        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
    }

    //increment the quantity
    if (Request::get('product_id') && (Request::get('increment')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($rowId[0]);

        Cart::update($rowId[0], $item->qty + 1);
    }

    //decrease the quantity
    if (Request::get('product_id') && (Request::get('decrease')) == 1) {
        $rowId = Cart::search(array('id' => Request::get('product_id')));
        $item = Cart::get($rowId[0]);

        Cart::update($rowId[0], $item->qty - 1);
    }

    $cart = Cart::content();

    return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
}?>

8. remove cart
<?php
$rowId = Cart::search(array('id' => Request::get('product_id')));
Cart::remove($rowId[0]);?>

function willbe 
<?php
Cart::destroy();?>


Done

form
<form method="POST" action="{{url('add_cart')}}">
	<input type="hidden" name="product_id" value="{{$value->id}}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div type="submit" class="button" onclick="this.parentNode.submit()">
		<span><a href="#">Add to cart</a></span>
	</div>
</form>
	
	
