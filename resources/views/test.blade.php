<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Multiple Image Upload</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
           <meta name="csrf-token" content="{{ csrf_token() }}" /> 
      </head>  
      <body>  
      <center>
      	{{ HTML::image('images/ajax-loader.gif','',array('style'=>'display:none','class'=>'loading')) }}
      </center>
           <br /><br />  
           <div class="container">  
                <h3>  
                     <select name="brand" id="brand">  
                          <option value="">Show</option>  
                          <option value="1">Cate 1</option>  
                          <option value="2">Cate 2</option>  
                          
                     </select>  
                     <br /><br />  
                     <div class="row" id="show_product">  
                            
                     </div>  
                </h3>  
           </div>  
      </body>  
 </html>  
 <script>  
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 $(document).ready(function(){  
      $('#brand').change(function(){  
           var brand_id = $(this).val(); 
           $('.loading').show();
           
           $.ajax({  
                url:"/test_ajax",  
                method:"POST",  
                data:{brand_id:brand_id},  
                success:function(data){  
                	$('.loading').hide();
                     $('#show_product').html(data);  
                }  
           });  
      });  
 });  
 </script> 
