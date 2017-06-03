

<!-- Stored in resources/views/child.blade.php -->

@extends('frontend.layout')

@section('title', 'Home')

<?php  
            $i = 1;
            foreach ($front_cate as $value){
                }

            ?>
@section('content')
<?php 
                $msg = Session::get('msg');
                if($msg){
           ?>
           <div class="alert alert-success" style="margin-top:10px ">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{$msg}}</strong> 
            </div>
            <?php } ?>

    <div class="header_bottom">
        <div class="header_bottom_left">
        <?php   
            $i = 1;
            foreach ($front_cate as $value){
                
        ?>
        <?php   
        if($i == 1 || $i == 2){   
        if ($i == 1 ) {
            echo '<div class="section group">';
        } 
        ?>
                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                         <a href="details/{{ $value->id }}"> <img src="images/uploads/{{ $value->image }}" alt="" /></a>
                    </div>
                    <div class="text list_2_of_1">
                        <h2>{{ $value->name }}</h2>
                        <p>{{ $value->sort_description }}</p>
                        <form method="POST" action="{{ url('add_cart') }}">
                           <input type="hidden" name="product_id" value="{{$value->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">         
                            <div type="submit" class="button" onclick="this.parentNode.submit()"><span><a href="#">Add to cart</a></span></div>
                        </form>
                        

                        
                   </div>
               </div>           
            <?php   if ($i == 2 ) {
            echo '</div>';
            } 
            } 
            elseif ($i == 3 || $i==4) {
            if ($i == 3 ) {
            echo '<div class="section group">';
            }           
            ?>

                <div class="listview_1_of_2 images_1_of_2">
                    <div class="listimg listimg_2_of_1">
                         <a href="details/{{ $value->id }}"> <img src="images/uploads/{{ $value->image }}" alt="" /></a>
                    </div>
                    <div class="text list_2_of_1">
                        <h2>{{ $value->name }}</h2>
                        <p>{{ $value->sort_description }}</p>
                        <form method="POST" action="{{ url('add_cart') }}">
                           <input type="hidden" name="product_id" value="{{$value->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">         
                            <div type="submit" class="button" onclick="this.parentNode.submit()"><span><a href="#">Add to cart</a></span></div>

                        </form>
                   </div>
               </div>           
            <?php 
                if ($i == 4 ) {
                    echo '</div>';
                } 
                }  
                $i++;
                } 
            ?>
          <div class="clear"></div>
        </div>
             <div class="header_bottom_right_images">
           <!-- FlexSlider -->
             
            <section class="slider">
                  <div class="flexslider">
                    <ul class="slides">
                        <?php foreach ($slider as $value) {
                            echo '<li><img src="images/slider/'.$value->image.'" alt=""/></li>';
                        } ?>
                    </ul>
                  </div>
          </section>
<!-- FlexSlider -->
        </div>
      <div class="clear"></div>
  </div>    

 <div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
            <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
          <div class="section group">
          <?php  foreach ($feature as $value){ ?>
                <div class="grid_1_of_4 images_1_of_4">
                     <a href="details/{{ $value->id }}"><img src="images/feature-pic1.png" alt="" /></a>
                     <h2>{{ $value->name }}</h2>
                     <p>{{ $value->sort_description }}</p>
                     <p><span class="price">${{ $value->price }}</span></p>
                     <div class="button"><span><a href="details/{{ $value->id }}" class="details">Details</a></span></div>
                </div>
                <?php } ?>
            </div>
            <div class="content_bottom">
                <div class="heading">
                    <h3>New Products</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
            <?php    
                foreach ($new_product as $value) {
                
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                     <a href="details/{{ $value->id }}"><img src="images/uploads/{{ $value->image }}" alt="" width="250" height="250" /></a>
                     <h2>{{ $value->name }}</h2>
                     <p><span class="price">${{ $value->price }}</span></p>
                     <div class="button"><span><a href="details/{{ $value->id }}" class="details">Details</a></span></div>
                </div>
            <?php   } ?>
            </div>
    </div>
 </div>
@endsection






