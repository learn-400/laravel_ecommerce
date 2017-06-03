<!-- Stored in resources/views/child.blade.php -->

@extends('frontend.layout')

@section('title', 'Top Brands')


@section('content')
 <div class="main">
    <div class="content">
    <?php  foreach ($top_brand as $value){
    $pro_by_brand = Helper::get_product_by_brand($value->id);
    if(count($pro_by_brand) !=0  ){
    ?>

    	<div class="content_top">
    		<div class="heading">
    		<h3>{{$value->name}}</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php  
	      		$pro_by_brand = Helper::get_product_by_brand($value->id);
	      		foreach ($pro_by_brand as $value) { ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="images/feature-pic1.png" alt="" /></a>
					 <h2>{{$value->name}}</h2>
					 <p>{{$value->sort_description}}</p>
					 <p><span class="price">${{$value->price}}</span></p>
				     <div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
				</div>
				<?php } ?>
			</div>
		
	<?php }} ?>
    </div>
 </div>


@endsection






