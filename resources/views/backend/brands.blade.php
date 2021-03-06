

<!-- Stored in resources/views/child.blade.php -->

@extends('backend.layout_backend')

@section('title', 'Home')


@section('content')
<?php  
if($edit==0){
    $name = '';
    $status = '';
    $action=array('route' => 'brands.store','class'=>'form-horizontal','name'=>'edit');
}
elseif ($edit ==1) {
    $id = $edit_data->id;
    $name = $edit_data->name;
    $status = $edit_data->publication_status;
    $action=array('route' => ['brands.update',$id],'method'=>'PUT','class'=>'form-horizontal','name'=>'edit');
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
                <a href="#">Brand</a>
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
                <h2><i class="icon-edit"></i>Add New Brand</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
           
                {{ Form::open($action) }}
                  <fieldset>
                    <legend>Add Brands</legend>
                    <div class="control-group">
                      <label class="control-label" for="typeahead">Name</label>
                      <div class="controls">
                        {{ Form::text('name', $name, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Brands Name','required')) }}
                    </div>
                </div>
                <div class="control-group">
                                <label class="control-label">Top Brand</label>
                                <div class="controls">
                                  <label class="checkbox inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="top_brand"> Do you want it as a Top Brand product?
                                  </label>
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
                          <th>Brands Name</th>
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
                        {{Form::open(array('url'=>['brands/'.$status.'/'.$v->id],'method'=>'put','style'=>'float:left'))}} 

                        {{Form::hidden('id',$v->id)}}
                        <button type="submit" class="btn btn-{{ $button_type }}" style="float:left">
                            <i class="icon-arrow-{{$arrow}} icon-white"></i>
                        </button>
                        {{ Form::close() }}


                        <a class="btn btn-info" href="{{Route('brands.edit',$v->id)}}" style="float:left">
                            <i class="icon-edit icon-white"></i>                      
                        </a>

                         {{ Form::open(array('route' => ['brands.destroy',$v->id],'method'=>'delete','style'=>'float: left;')) }}
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






