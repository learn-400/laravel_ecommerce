<!-- Stored in resources/views/child.blade.php -->

@extends('frontend.layout')

@section('title', 'Products')


@section('content')
    <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>All Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group clearfix">
	      <?php foreach ($products as $value) { ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="images/feature-pic1.png" alt="" /></a>
					 <h2>{{$value->name}}</h2>
					 <p>{{$value->sort_description}}</p>
					 <p><span class="price">${{$value->price}}</span></p>
				     <div class="button"><span><a href="details/{{$value->id}}" class="details">Details</a></span></div>
				</div>
		<?php } ?>
			</div>

	
	
    </div>
 </div>

@endsection






