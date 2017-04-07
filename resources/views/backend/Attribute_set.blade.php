

<!-- Stored in resources/views/child.blade.php -->

@extends('backend.layout_backend')

@section('title', 'Home')


@section('content')
<?php  
if($edit==0){
    $name = '';
    $status = '';
    $action=array('route' => 'attribute_set.store','class'=>'form-horizontal','name'=>'edit');
}
elseif ($edit ==1) {
    $id = $edit_data->id;
    $name = $edit_data->name;
    $status = $edit_data->publication_status;
    $action=array('route' => ['attribute_set.update',$id],'method'=>'PUT','class'=>'form-horizontal','name'=>'edit');
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
                <a href="#">Attribute Set</a>
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
                <h2><i class="icon-edit"></i>Add New Attribute Set</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
           
                {{ Form::open($action) }}
                  <fieldset>
                    <legend>Add Attribute Set</legend>
                    <div class="control-group">
                      <label class="control-label" for="typeahead">Attribute Set Name</label>
                      <div class="controls">
                        {{ Form::text('name', $name, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Attribute Set Name','required')) }}
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="selectError3">Select Attributes</label>
                    <div class="controls">
                        <select data-placeholder="Select Your Attributes" multiple class="chosen-select" tabindex="8" name="attribute[]">
                        <?php 
                            if($edit==1){
                             
                            $set_val_array = unserialize($edit_data->value);
                            foreach ($att as $value) {
                                $attribute_id_array[] = $value->id;
                            }
                            $selected = array_intersect($set_val_array, $attribute_id_array);
                            $not_selected = array_diff($attribute_id_array, $set_val_array);
                            foreach ($att as $value1) {
                                foreach ($selected as $selected_val) {
                                   if ($value1->id == $selected_val) {
                                    echo "<option value='{$value1->id}' selected>{$value1->name}</option>";
                                    }
                                }
                                
                            }
                            
                            foreach ($att as $value2) {
                                foreach ($not_selected as $not_selected_val) {
                                   if ($value2->id == $not_selected_val) {
                                    echo "<option value='{$value2->id}'>{$value2->name}</option>";
                                    }
                                }
                            }    
                                
                            }else{
                                foreach ($att as $value) {
                                echo "<option value='{$value->id}'>{$value->name}</option>";
                                }
                            }
                            
                         ?>
                          
                          <!-- <option selected>Polar Bear</option>
                          <option disabled>Spectacled Bear</option> -->
                        </select>
                </div>
                </div>

            <script type="text/javascript">
                    document.forms['edit'].elements['publication_status'].value="{{$status}}";
            </script>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Save Brands</button>
              <button type="reset" class="btn">Cancel</button>
          </div>
      </fieldset>
                {{ Form::close() }}

    </div>
    </div><!--/span-->      
        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> brands</h2>
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
                          <th>Attribute Set Name</th>
                          <th>Attribute Name</th>
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
                            foreach (unserialize($v->value) as $att_id) {
                                    foreach ($att as $value) {
                                        if($value->id==$att_id){
                                            $result[] = $value->name;
                                        }
                                    }
                                }
                                echo implode( ', ', $result );
                                unset($result);
                            ?>
                        </td>
                        <td class="center">
                        <a class="btn btn-info" href="{{Route('attribute_set.edit',$v->id)}}" style="float:left">
                            <i class="icon-edit icon-white"></i>                      
                        </a>

                         {{ Form::open(array('route' => ['attribute_set.destroy',$v->id],'method'=>'delete','style'=>'float: left;')) }}
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






