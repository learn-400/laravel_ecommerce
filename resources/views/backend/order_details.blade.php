@extends('backend.layout_backend')
@section('title', 'Home')
@section('content')
<div class="container">
<?php 
    $cart = unserialize($edit_data->order_details); 
    $order_status  = $edit_data->status;
    $id = $edit_data->id;
?>
    <h1>Ordered Details</h1><hr>
    <?php 
                  $msg = Session::get('msg');
                  if($msg){
             ?>
             <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $msg }}</strong> 
              </div>
              <?php } ?>
    <table class="table table-striped table-hover table-bordered">
        <tbody>
            <tr>
                <th>Item</th>
                <th>QTY</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            <?php 
            $total = 0;
            foreach ($cart as $value) { ?>
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->qty }} <a href="#">X</a></td>
                <td>{{ $value->price }}</td>
                <td>{{ $value->subtotal }}</td>
            </tr>
            <?php $total = $total + $value->subtotal; } ?>
            <tr>
                <th colspan="3"><span class="pull-right">Sub Total</span></th>
                <th>{{ $total }}</th>
            </tr>
            <tr>
                <th colspan="3"><span class="pull-right">VAT <?php echo $vat='0'; ?>%</span></th>
                <th>0</th>
            </tr>
            <tr>
                <th colspan="3"><span class="pull-right">Total</span></th>
                <th><?php echo $total+($total*$vat)/100 ?></th>
            </tr>
            <tr>
                <td colspan="4">
                
                <a href="#" class="pull-right btn btn-success" >Cancel</a>
                {{ Form::open(array('route' => ['orders.update',$id],'method'=>'PUT','class'=>'form-horizontal','name'=>'edit')) }}
                <a href="#" class="pull-right  btn btn-primary" style="margin-right: 5px" onclick="this.parentNode.submit()">Update Order</a>
                <select class="pull-right" id="selectError3" name="status" style="margin-right: 5px" required>
                        <option value="pending">Pending</option>
                        <option value="receive">Order Receive</option>
                        <option value="shipped">Order Shipped</option>
                        <option value="successfull">Order Successfull</option>
                        <option value="cancel">Order Cancel</option>
                </select>
                {{ Form::close() }}
                <script type="text/javascript">
                        document.forms['edit'].elements['status'].value="{{$order_status}}";
                </script>
                </td>
            </tr>
        </tbody>
    </table>            
</div>
@endsection












