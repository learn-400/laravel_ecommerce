<!-- Stored in resources/views/child.blade.php -->

@extends('frontend.layout')

@section('title', 'Cart')


@section('content')
<style type="text/css">
	.cart-empty{
	font-size: 20px;
    font-family: monospace;
    color: red;
    font-weight: 700;
    padding: 0px 0 60px 4px;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php if(count($cart) == 0){
								echo '<h4 class="cart-empty">Your Cart is empty</h4>' ;
						}else{ 
					?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							
							<?php foreach ($cart as $value) 
								{
							?>
							<tr>
								<td>{{$value->name}}</td>
								<td><img src="images/uploads/{{Helper::product_info_by_id($value->id)->image}}" alt=""/></td>
								<td>Tk. {{$value->price}}</td>
								<td>
									<form action="update_cart/{{$value->id}}/update" method="post">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="number" name="update_qty" value="{{$value->qty}}"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>Tk. {{$value->subtotal}}</td>
								<td>
									<form action="update_cart/{{$value->id}}/delete" method="post">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<div type="submit" class="button" onclick="this.parentNode.submit()"><span><a href="#">X</a></span></div>
									</form>
								</td>
							</tr>
							
							<?php } ?>
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. {{Cart::total()}}</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>TK. <?php $vat='0'; ?> %</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?php echo Cart::total()+(Cart::total()*$vat)/100 ?></td>
							</tr>
					   </table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.html"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
						<?php if(Helper::user_check() == 0){
				           	echo '<a href="/register"> <img src="images/check.png" alt="" /></a>';
				           }else{
				           ?>
				           <form method="POST" action="{{ url('order') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">         
                            <div type="submit" class="button" onclick="this.parentNode.submit()"><span><a href="#"><img src="images/check.png" alt="" /></a></span></div>

                        	</form>
							

							<?php } ?>
						</div>
					</div>
					<?php } ?>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

@endsection






