

<!-- Stored in resources/views/child.blade.php -->

@extends('backend.layout_backend')

@section('title', 'Home')


@section('content')
<?php  
if($edit==0){
    $name = '';
    $sort_description='';
    $long_description='';
    $image = 'default.png';
    $attribute_set = '';
    $price = '';
    $qty = '';
    $category = '';
    $brand = '';
    $status = '';
    $action=array('route' => 'products-management.store','class'=>'form-horizontal','name'=>'edit','enctype'=>'multipart/form-data');
}
elseif ($edit ==1) {
    $id = $edit_data->id;
    $name = $edit_data->name;
    $sort_description = $edit_data->sort_description;
    $long_description = $edit_data->long_description;
    $image = $edit_data->image;
    if ($image == '' || $image == null) {
        $image = 'default.png';
    }
    $attribute_set = $edit_data->attribute_set;
    $attribute = $edit_data->attribute;
    $price = $edit_data->price;
    $qty = $edit_data->qty;
    $category = $edit_data->category_id;
    $brand = $edit_data->brand_id;
    $status = $edit_data->publication_status;
    $action=array('route' => ['products-management.update',$id],'method'=>'PUT','class'=>'form-horizontal','name'=>'edit','enctype'=>'multipart/form-data');

}
?>
<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Product</a>
            </li>
        </ul>
    </div>
    <?php 
        $msg = Session::get('msg');
        if($msg){
   ?>
   <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $msg }}</strong> 
    </div>
    <?php } ?>



    <div class="row-fluid sortable">  

        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i>Add New Product</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>

            <div class="box-content">
                {{ Form::open($action) }}

                  <fieldset>
                    <legend>Add Product</legend>
                    <div class="control-group">
                      <label class="control-label" for="typeahead">Name</label>
                      <div class="controls">
                            {{ Form::text('name', $name, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Product Name','required')) }}

                        </div>
                    </div>
                    <div class="control-group">
                              <label class="control-label" for="textarea2">Short Description</label>
                              <div class="controls">
                                <textarea class="" name="sort_description" id="textarea2" rows="1" style="width: 380px;">{{$sort_description}}</textarea>
                              </div>
                    </div>

                    <div class="control-group">
                              <label class="control-label" for="textarea2">Long Description</label>
                              <div class="controls">
                                <textarea name="long_description" class="cleditor" id="textarea2" rows="8" style="width: 380px;">{{$long_description}}</textarea>
                              </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="typeahead">Product Image</label>
                      <div class="controls">
                            {{ Form::image("images/uploads/$image", 'btnSub', ['class' => 'btn','width'=>'200','height'=>'150']) }}<br>
                            {{ Form::file('images','', array('type'=>'file','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Product Name','required')) }}

                       </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Attribute Set</label>
                        <div class="controls">
                        <select id="attribute_set" name="attribute_set">
                            <option value="">None</option>
                            
                            <?php  
                                foreach ($Attribute_set as $v) {
                                    echo '<option value="'.$v->id.'">'.$v->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    </div>
                    <script type="text/javascript">
                        document.forms['edit'].elements['attribute_set'].value="{{$attribute_set}}";
                    </script>

                    <div class="" id="show_product">  
                            <?php  
                                if($edit == 1){
                            ?>
                            <?php 




//$test = Helper::attribute_by_id(8)->id; 

foreach ($Attribute_set_by_id as $v) {

         $a_set_value = unserialize($v->value);

         foreach ($a_set_value  as $key => $Attribute_id) {?>

            

             
             <div class="control-group" >
                <label class="control-label" for="selectError3"><?php echo Helper::attribute_by_id($Attribute_id)->name; ?></label>


<?php
foreach ($Attribute as $v) {

    if ($v->id == $Attribute_id) { ?>

    <div class="controls">
        <select data-placeholder="None" multiple class="chosen-select" tabindex="8" 
        name="<?php echo $v->id; ?>[]">
        <option value="">No Color</option>
        <?php  

                $attribute_values = unserialize($v->value);
                for($i = 0 ; $i < count($attribute_values) ; $i++){
                    $match = Helper::matching_attribute($edit_data->attribute,$Attribute_id,$i);
                    if ($match =='match') {
                        echo '<option value="'.$i.'" selected>'.$attribute_values[$i].'</option>';
                    }else{
                        echo '<option value="'.$i.'">'.$attribute_values[$i].'</option>';
                    }
                
                }
        ?>
        </select>
    </div>
</div>
       
<?php                       
    }
}

}
}

?>


                           <?php  
                                $product_attribute  = unserialize($attribute); 
                                foreach ($product_attribute as $product_attribute) {
                                    //print_r($product_attribute);
                                    foreach ($product_attribute as $key => $value) {
                                        
                                        //print_r($value);
                                    }
                                }
                           ?>
                            <?php        
                                }
                            ?>
                     </div>  
                    


                    <div class="control-group">
                      <label class="control-label" for="typeahead">Price</label>
                      <div class="controls">
                            {{ Form::text('price', $price, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Product Name','required')) }}
                        </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="typeahead">Quantity</label>
                      <div class="controls">
                            {{ Form::text('qty', $qty, array('type'=>'number','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Product Name','required')) }}
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="selectError3">Category</label>
                        <div class="controls">
                        <select id="category_id" name="category_id">
                            <option value="">Select</option>
                            <?php foreach($category_data as $v) {
                                echo '<option value="'.$v->id.'">'.$v->name.'</option>';
                            } ?>
                        </select>
                    </div>
                    </div>
                    <script type="text/javascript">
                        document.forms['edit'].elements['category_id'].value="{{$category}}";
                    </script>

                    <div class="control-group">
                        <label class="control-label" for="selectError3">Brands</label>
                        <div class="controls">
                        <select id="brand_id" name="brand_id">
                            <option value="">Select</option>
                            <?php foreach($brands_data as $v) {
                                echo '<option value="'.$v->id.'">'.$v->name.'</option>';
                            } ?>
                        </select>
                    </div>
                    </div>
                    <script type="text/javascript">
                        document.forms['edit'].elements['brand_id'].value="{{$brand}}";
                    </script>
                
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Publication Status</label>
                        <div class="controls">
                        <select id="selectError3" name="publication_status" required>
                            <option value="">Select</option>
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                        </select>
                    </div>
                    </div>

            <script type="text/javascript">
                    document.forms['edit'].elements['publication_status'].value="{{$status}}";
            </script>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save Product</button>
              <button type="reset" class="btn">Cancel</button>
          </div>
      </fieldset>
                {{ Form::close() }}

    </div>
    </div><!--/span-->      
        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Products</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                  <thead>
                      <tr>
                          <th>SL</th>
                          <th>Product Name</th>
                          <th>Publication Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>   
                  <tbody>
                    <?php $i = 0; ?>
                    @foreach ($data as $v)
                   <?php $i++; ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td class="center">{{ $v->name }}</td>
                        <td class="center">
                        <?php 
                            if($v->publication_status == 1){
                                echo '<span class="label label-success">Published</span>';
                            }
                            else if ($v->publication_status == 0){
                                echo '<span class="label btn-danger">Unpublished</span>';
                            }
                        ?>
                            
                        </td>
                        <td class="center">
                        <?php  if($v->publication_status == 1){
                                $status = 'unpublish';
                                $button_type = 'danger';
                                $arrow = 'down';
                            }
                            else if($v->publication_status == 0){
                                $status = 'publish';
                                $button_type = 'success';
                                $arrow = 'up';
                            }
                        ?>
                        {{Form::open(array('url'=>['product/'.$status.'/'.$v->id],'method'=>'put','style'=>'float:left'))}} 

                        {{Form::hidden('id',$v->id)}}
                        <button type="submit" class="btn btn-{{ $button_type }}" style="float:left">
                            <i class="icon-arrow-{{$arrow}} icon-white"></i>
                        </button>
                        {{ Form::close() }}


                        <a class="btn btn-info" href="{{Route('products-management.edit',$v->id)}}" style="float:left">
                            <i class="icon-edit icon-white"></i>                      
                        </a>

                         {{ Form::open(array('route' => ['products-management.destroy',$v->id],'method'=>'delete','style'=>'float: left;')) }}
                         {{Form::hidden('id',$v->id)}}
                        <button type="submit" class="btn btn-danger">
                            <i class="icon-trash icon-white"></i> 
                        </button>
                        {{ Form::close() }}
                            
                        </td>
                    </tr>

                     @endforeach
                    

                </tbody>
            </table>            
        </div>
    </div><!--/span-->


</div><!--/row-->



</div>

@endsection

