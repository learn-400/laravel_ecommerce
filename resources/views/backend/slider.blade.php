

<!-- Stored in resources/views/child.blade.php -->

@extends('backend.layout_backend')

@section('title', 'Home')


@section('content')
<?php  
if($edit==0){
    $name = '';
    $image = 'default_slider.jpg';
    $status = '';
    $sort = '';
    $action=array('route' => 'slider.store','class'=>'form-horizontal','name'=>'edit','enctype'=>'multipart/form-data');
}
elseif ($edit ==1) {
    $id = $edit_data->id;
    $name = $edit_data->name;
    $image = $edit_data->image;
    $status = $edit_data->publication_status;
    $sort = $edit_data->sort_order;
    $action=array('route' => ['slider.update',$id],'method'=>'PUT','class'=>'form-horizontal','name'=>'edit','enctype'=>'multipart/form-data');
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
                <a href="#">Slider</a>
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
                <h2><i class="icon-edit"></i>Add New Slider</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                {{ Form::open($action) }}
                  <fieldset>
                    <legend>Add Slider</legend>
                <div class="control-group">
                      <label class="control-label" for="typeahead">Name</label>
                      <div class="controls">
                        {{ Form::text('name', $name, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Slider Name','required')) }}

                    </div>
                </div>

                <div class="control-group">
                      <label class="control-label" for="typeahead">Sort Order</label>
                      <div class="controls">
                        {{ Form::text('sort_order', $sort, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Sort Order','required')) }}

                    </div>
                </div>
                
                <div class="control-group">
                      <label class="control-label" for="typeahead">Product Image</label>
                      <div class="controls">
                            {{ Form::image("images/slider/$image", 'btnSub', ['class' => 'btn','width'=>'200','height'=>'150']) }}<br>
                            {{ Form::file('images','', array('type'=>'file','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Product Name','required')) }}

                       </div>
                </div>

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
              <button type="submit" class="btn btn-primary">Save Slider</button>
              <button type="reset" class="btn">Cancel</button>
          </div>
      </fieldset>
                {{ Form::close() }}

    </div>
    </div><!--/span-->      
        <div class="box span6">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> slider</h2>
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
                          <th>Slider Name</th>
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
                        {{Form::open(array('url'=>['slider/'.$status.'/'.$v->id],'method'=>'put','style'=>'float:left'))}} 

                        {{Form::hidden('id',$v->id)}}
                        <button type="submit" class="btn btn-{{ $button_type }}" style="float:left">
                            <i class="icon-arrow-{{$arrow}} icon-white"></i>
                        </button>
                        {{ Form::close() }}


                        <a class="btn btn-info" href="{{Route('slider.edit',$v->id)}}" style="float:left">
                            <i class="icon-edit icon-white"></i>                      
                        </a>

                         {{ Form::open(array('route' => ['slider.destroy',$v->id],'method'=>'delete','style'=>'float: left;')) }}
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






