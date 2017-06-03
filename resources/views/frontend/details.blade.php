<!-- Stored in resources/views/child.blade.php -->

@extends('frontend.layout')

@section('title', 'Contact')


@section('content')
<style type="text/css">
  .pad-left-bottom-30{    padding-left: 30px;    padding-bottom: 10px;}
</style>
 <div class="main">
    <div class="content">
        <div class="section group">
                <div class="cont-desc span_1_of_2">             
                    <div class="grid images_3_of_2">
                        <img src="{{url('/')}}/images/uploads/{{$edit_data->image}}" alt="" />
                    </div>
                <div class="desc span_3_of_2">
                    <h2>{{$edit_data->name}}</h2>
                    <p><?php echo $edit_data->sort_description ?></p>                  
                    <div class="price">
<table>
<tr>
  <td>Price:</td>
  <td class="pad-left-bottom-30"><p><span>${{$edit_data->price}}</span></p></td>
</tr>
<tr>
  <td>Category:</td>
  <td class="pad-left-bottom-30"><p><span>{{$category_by_id}}</span></p></td>
</tr>
<tr>
  <td>Brand:</td>
  <td class="pad-left-bottom-30"><p><span>{{$Brands_by_id}}</span></p></td>
</tr>
<?php
//$test = Helper::attribute_by_id(8)->id; 

foreach ($Attribute_set_by_id as $v) {

         $a_set_value = unserialize($v->value);

         foreach ($a_set_value  as $key => $Attribute_id) {?>
             <tr class="control-group" >
                <td>
                <label class="control-label" for="selectError3"><?php echo Helper::attribute_by_id($Attribute_id)->name; ?></label>
                </td>


<?php
foreach ($Attribute as $v) {

    if ($v->id == $Attribute_id) { ?>

      <td class="pad-left-bottom-30">
        <select data-placeholder="None" tabindex="8" 
        name="<?php echo $v->id; ?>[]">
        <?php  

                $attribute_values = unserialize($v->value);
                for($i = 0 ; $i < count($attribute_values) ; $i++){
                    $match = Helper::matching_attribute($edit_data->attribute,$Attribute_id,$i);
                    if ($match =='match') {
                        echo '<option value="'.$i.'">'.$attribute_values[$i].'</option>';
                    }else{
                        
                    }
                
                }
        ?>
        </select>
        </td>
</tr>
       
<?php                       
    }
}

}
}

?>
</table>






















                        </span></p>
                    </div>
                <div class="add-cart">
                    <form action="cart.html" method="post">
                        <input type="number" class="buyfield" name="" value="1"/>
                        <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                    </form>             
                </div>
            </div>
            <div class="product-desc">
            <h2>Product Details</h2>
            <?php echo $edit_data->long_description ?>
        </div>
                
    </div>
                <div class="rightsidebar span_3_of_1">
                    <h2>CATEGORIES</h2>
                    <ul>
                      <li><a href="productbycat.html">Mobile Phones</a></li>
                      <li><a href="productbycat.html">Desktop</a></li>
                      <li><a href="productbycat.html">Laptop</a></li>
                      <li><a href="productbycat.html">Accessories</a></li>
                      <li><a href="productbycat.html#">Software</a></li>
                       <li><a href="productbycat.html">Sports & Fitness</a></li>
                       <li><a href="productbycat.html">Footwear</a></li>
                       <li><a href="productbycat.html">Jewellery</a></li>
                       <li><a href="productbycat.html">Clothing</a></li>
                       <li><a href="productbycat.html">Home Decor & Kitchen</a></li>
                       <li><a href="productbycat.html">Beauty & Healthcare</a></li>
                       <li><a href="productbycat.html">Toys, Kids & Babies</a></li>
                    </ul>
        
                </div>
        </div>
    </div>
 </div>

@endsection






