<?php 
function current_page($uri = "/")
{
    return request()->path() == $uri;
}
?>

<!-- Stored in resources/views/layouts/app.blade.php -->
<!DOCTYPE HTML>
<head>
<title>Shop - @yield('title')</title>
<link href="/css/app.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
 <link rel="shortcut icon" href="images/cart.jpg">
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="/home"><img src="images/logo.png" alt="" /></a>
            </div>
              <div class="header_top_right">
                <div class="search_box">
                    <form action="/search">
                        <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="{{url('cart')}}" title="View my shopping cart" rel="nofollow">
                                <span class="cart_title">Cart:</span>
                                <span class="no_product">{{Helper::total_qty()}}</span>
                                <span class="cart_title">Total:</span>
                                <span class="no_product">{{Cart::total()}} Tk</span>
                            </a>
                        </div>
                  </div>
           <?php if(Helper::user_check() == 0){
            echo '<div class="login"><a href="/register">Sign in</a></div>';
           }else{

           ?>       
           
           <div class="login"><a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form></div>
                            <?php } ?>
         <div class="clear"></div>
     </div>
     <div class="clear"></div>
 </div>
<div class="menu">
    <ul id="dc_mega-menu-orange" class="dc_mm-orange">
      <li class=" {{ current_page('home') ? 'active': '' }} {{ current_page('/') ? 'active': '' }}"><a href="/home">Home</a></li>
      <li class=" {{ current_page('products') ? 'active': '' }}"><a href="/products">Products</a> </li>
      <li class=" {{ current_page('topbrands') ? 'active': '' }}"><a href="/topbrands">Top Brands</a></li>
      <li class=" {{ current_page('cart') ? 'active': '' }}"><a href="/cart">Cart</a></li>
       <?php if(Helper::user_check() == 0){
            
           }else{
           ?> 
      <li class=" {{ current_page('myaccount') ? 'active': '' }}"><a href="/myaccount">My Account</a></li>
      <?php } ?>


      <li class=" {{ current_page('contact') ? 'active': '' }}"><a href="/contact">Contact</a> </li>
      <div class="clear"></div>
    </ul>
</div>


@yield('content')
    
</div>
   <div class="footer">
      <div class="wrapper"> 
         <div class="section group">
                <div class="col_1_of_4 span_1_of_4">
                        <h4>Information</h4>
                        <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Customer Service</a></li>
                        <li><a href="#"><span>Advanced Search</span></a></li>
                        <li><a href="#">Orders and Returns</a></li>
                        <li><a href="#"><span>Contact Us</span></a></li>
                        </ul>
                    </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Why buy from us</h4>
                        <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="faq.html">Customer Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="contact.html"><span>Site Map</span></a></li>
                        <li><a href="preview.html"><span>Search Terms</span></a></li>
                        </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>My account</h4>
                        <ul>
                            <li><a href="contact.html">Sign In</a></li>
                            <li><a href="index.html">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="faq.html">Help</a></li>
                        </ul>
                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <h4>Contact</h4>
                        <ul>
                            <li><span>+88-01713458599</span></li>
                            <li><span>+88-01813458552</span></li>
                        </ul>
                        <div class="social-icons">
                            <h4>Follow Us</h4>
                              <ul>
                                  <li class="facebook"><a href="#" target="_blank"> </a></li>
                                  <li class="twitter"><a href="#" target="_blank"> </a></li>
                                  <li class="googleplus"><a href="#" target="_blank"> </a></li>
                                  <li class="contact"><a href="#" target="_blank"> </a></li>
                                  <div class="clear"></div>
                             </ul>
                        </div>
                </div>
            </div>
            <div class="copy_right">
                <p>Training with live project &amp; All rights Reseverd </p>
           </div>
     </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */
            
            $().UItoTop({ easingType: 'easeOutQuart' });
            
        });
    </script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
      <script defer src="js/jquery.flexslider.js"></script>
      <script type="text/javascript">
        $(function(){
          SyntaxHighlighter.all();
        });
        $(window).load(function(){
          $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
              $('body').removeClass('loading');
            }
          });
        });
      </script>
</body>
</html>
