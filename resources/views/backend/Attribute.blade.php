

<!-- Stored in resources/views/child.blade.php -->

@extends('backend.layout_backend')

@section('title', 'Home')


@section('content')
<?php  
if($edit==0){
    $name = '';
    $value = '';
    $action=array('route' => 'attribute.store','class'=>'form-horizontal','name'=>'edit');
}
elseif ($edit ==1) {
    $id = $edit_data->id;
    $name = $edit_data->name;
    $value = unserialize($edit_data->value);
    foreach ($value as $val)
    {
        $result2[]=ltrim(rtrim($val," "));
    }
    $value = implode( ' | ', $result2 );
    $action=array('route' => ['attribute.update',$id],'method'=>'PUT','class'=>'form-horizontal','name'=>'edit');
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
                <a href="#">Attribute</a>
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
                <h2><i class="icon-edit"></i>Add New Attribute</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
           
                {{ Form::open($action) }}
                  <fieldset>
                    <legend>Add Attribute</legend>
                    <div class="control-group">
                      <label class="control-label" for="typeahead">Name</label>
                        <div class="controls">
                        {{ Form::text('name', $name, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Attribute Name','style'=>'width: 90%;padding-left: 2%;','required')) }}
                        </div>
                    </div>
                
                <div class="control-group">
                    <label class="control-label" for="selectError3">Value</label>
                    <div class="controls">
                    {{ Form::textarea('value', $value, array('type'=>'text','class'=>'span7 typeahead', 'id'=>'typeahead','data-provide'=>'typeahead','data-items'=>'4','data-source'=>'','placeholder'=>'Enter some text, or some attributes by "|" separating values.','rows'=>'3','cols'=>'80','style'=>'width: 90%;padding-left: 2%;','required')) }}
                    </div>
                </div>

            <script type="text/javascript">
                    document.forms['edit'].elements['publication_status'].value="{{$value}}";
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
                             $value_serialize = $v->value;
                             $value_unserialize = unserialize($value_serialize);
                             foreach ($value_unserialize as $val) {
                                 $result[]=ltrim(rtrim($val," "));
                             }
                             echo implode( ', ', $result );
                             unset($result);
                            ?>
                        </td>
                        <td class="center">
                        
                        {{Form::open(array('url'=>['attribute/'.$value.'/'.$v->id],'method'=>'put','style'=>'float:left'))}} 

                        {{Form::hidden('id',$v->id)}}
                        
                        {{ Form::close() }}


                        <a class="btn btn-info" href="{{Route('attribute.edit',$v->id)}}" style="float:left">
                            <i class="icon-edit icon-white"></i>                      
                        </a>

                         {{ Form::open(array('route' => ['attribute.destroy',$v->id],'method'=>'delete','style'=>'float: left;')) }}
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






