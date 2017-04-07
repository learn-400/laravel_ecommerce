

<!-- Stored in resources/views/child.blade.php -->

@extends('backend.layout_backend')

@section('title', 'Home')


@section('content')
<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Category</a>
            </li>
        </ul>
    </div>




    <div class="row-fluid sortable">  

    
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Categories</h2>
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
                          <th>Customer Name</th>
                          <th>Email</th>
                          <th>Order Qty</th>
                          <th>Total Price</th>
                          <th>Publication Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>   
                  <tbody>
                  <?php 
                  $i = 0;
                  foreach ($category_data as $value) {
                      # code...
                  ?>
                    <tr>
                        <td>{{$i =$i+1}}</td>
                        <td class="center">{{Helper::customer_by_id($value->customer_id)->name}}</td>
                        <td class="center">{{Helper::customer_by_id($value->customer_id)->email}}</td>
                        <td class="center">
                            <?php  
                                    $cart = unserialize($value->order_details);
                                    echo count($cart);
                                    
                            ?>
                        </td>
                        <td class="center">
                            
                            <?php  
                                    $cart = unserialize($value->order_details);
                                    $total = 0;
                                    foreach ($cart as $value2) {
                                        $total= $total+$value2->price;
                                    }
                                    echo $total;
                            ?>
                        </td>
                        <td class="center">
                            <span class="label label-<?php if($value->status=='pending'){echo 'btn btn-danger';}?>">{{$value->status}}</span>
                        </td>
                        <td class="center">
                            <a class="btn btn-success" href="#">
                                <i class="icon-zoom-in icon-white"></i>  
                                View                                            
                            </a>
                            <a class="btn btn-info" href="#">
                                <i class="icon-edit icon-white"></i>  
                                Edit                                            
                            </a>
                            <a class="btn btn-danger" href="#">
                                <i class="icon-trash icon-white"></i> 
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>            
        </div>
    </div><!--/span-->


</div><!--/row-->



</div>

@endsection






