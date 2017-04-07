<?php 
function current_page($uri = "/")
{
    return request()->path() == $uri;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">
	<meta name="csrf-token" content="{{ csrf_token() }}" /> 
	<!-- The styles -->
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	{{ HTML::style('css/bootstrap-cerulean.css') }}
	{{ HTML::style('css/bootstrap-responsive.css') }}
	{{ HTML::style('css/charisma-app.css') }}
	{{ HTML::style('css/jquery-ui-1.8.21.custom.css') }}
	{{ HTML::style('css/fullcalendar.css') }}
	{{ HTML::style('css/fullcalendar.print.css') }}
	{{ HTML::style('css/chosen.css') }}
	{{ HTML::style('css/uniform.default.css') }}
	{{ HTML::style('css/colorbox.css') }}
	{{ HTML::style('css/jquery.cleditor.css') }}
	{{ HTML::style('css/jquery.noty.css') }}
	{{ HTML::style('css/noty_theme_default.css') }}
	{{ HTML::style('css/elfinder.min.css') }}
	{{ HTML::style('css/elfinder.theme.css') }}
	{{ HTML::style('css/jquery.iphone.toggle.css') }}
	{{ HTML::style('css/opa-icons.css') }}
	{{ HTML::style('css/uploadify.css') }}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
	<script>
	  $(function() {
	    $('.chosen-select').chosen();
	    $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
	  });
	  $("#refresh").load(location.href + " #refresh");
	</script>
    	
	<style type="text/css">
	#selXGS_chzn{width: 92%!important}
	</style>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/myadmin"> 
				{{ HTML::image('img/logo20.png', 'Charisma Logo', array('class' => 'thumb')) }}
				<span>Charisma</span></a>
				
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >

					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li>
							<a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                    Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>  
						</li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="/">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="/myadmin"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						<li><a class="ajax-link" href="/slider"><i class="icon-eye-open"></i><span class="hidden-tablet"> Slider</span></a></li>
						<li><a class="ajax-link" href="/categories"><i class="icon-eye-open"></i><span class="hidden-tablet"> Categories</span></a></li>
						<li><a class="ajax-link" href="/brands"><i class="icon-edit"></i><span class="hidden-tablet"> Brands</span></a></li>
						<li><a class="ajax-link" href="/attribute"><i class="icon-list-alt"></i><span class="hidden-tablet"> Attribute</span></a></li>
						<li><a class="ajax-link" href="/attribute_set"><i class="icon-list-alt"></i><span class="hidden-tablet"> Attribute Set</span></a></li>
						<li><a class="ajax-link" href="/products-management"><i class="icon-list-alt"></i><span class="hidden-tablet"> Products</span></a></li>
						<li><a class="ajax-link" href="/orders"><i class="icon-font"></i><span class="hidden-tablet"> Orders</span></a></li>
						<li><a class="ajax-link" href="/settings"><i class="icon-picture"></i><span class="hidden-tablet"> Theme Settings</span></a></li>
						
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<!-- content area -->
			@yield('content')
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://usman.it" target="_blank">Muhammad Usman</a> 2012</p>
			<p class="pull-right">Powered by: <a href="http://usman.it/free-responsive-admin-template">Charisma</a></p>
		</footer>
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	{{ HTML::script('js/jquery-1.7.2.min.js') }}
	{{ HTML::script('js/jquery-ui-1.8.21.custom.min.js') }}
	{{ HTML::script('js/bootstrap-transition.js') }}
	{{ HTML::script('js/bootstrap-alert.js') }}
	{{ HTML::script('js/bootstrap-modal.js') }}
	{{ HTML::script('js/bootstrap-dropdown.js') }}
	{{ HTML::script('js/bootstrap-scrollspy.js') }}
	{{ HTML::script('js/bootstrap-tab.js') }}
	{{ HTML::script('js/bootstrap-tooltip.js') }}
	{{ HTML::script('js/bootstrap-popover.js') }}
	{{ HTML::script('js/bootstrap-button.js') }}
	{{ HTML::script('js/bootstrap-collapse.js') }}
	{{ HTML::script('js/bootstrap-carousel.js') }}
	{{ HTML::script('js/bootstrap-typeahead.js') }}
	{{ HTML::script('js/bootstrap-tour.js') }}
	{{ HTML::script('js/jquery.cookie.js') }}
	{{ HTML::script('js/fullcalendar.min.js') }}
	{{ HTML::script('js/jquery.dataTables.min.js') }}
	{{ HTML::script('js/excanvas.js') }}
	{{ HTML::script('js/jquery.flot.min.js') }}
	{{ HTML::script('js/jquery.flot.pie.min.js') }}
	{{ HTML::script('js/jquery.flot.stack.js') }}
	{{ HTML::script('js/jquery.flot.resize.min.js') }}
	{{ HTML::script('js/jquery.chosen.min.js') }}
	{{ HTML::script('js/jquery.uniform.min.js') }}
	{{ HTML::script('js/jquery.colorbox.min.js') }}
	{{ HTML::script('js/jquery.cleditor.min.js') }}
	{{ HTML::script('js/jquery.noty.js') }}
	{{ HTML::script('js/jquery.elfinder.min.js') }}
	{{ HTML::script('js/jquery.raty.min.js') }}
	{{ HTML::script('js/jquery.iphone.toggle.js') }}
	{{ HTML::script('js/jquery.autogrow-textarea.js') }}
	{{ HTML::script('js/jquery.uploadify-3.1.min.js') }}
	{{ HTML::script('js/jquery.history.js') }}
	{{ HTML::script('js/charisma.js') }}

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    <script type="text/javascript">
		var JQ = $.noConflict(true);
	</script>
	
		
</body>
</html>


<script>  
 JQ.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': JQ('meta[name="csrf-token"]').attr('content')
    }
});
 JQ(document).ready(function(){  
      JQ('#attribute_set').change(function(){

           var attribute_set_id = JQ(this).val(); 
           JQ('.loading').show();
           
           JQ.ajax({  
                url:"/attribute_ajax",  
                method:"POST",  
                data:{attribute_set_id:attribute_set_id},  
                success:function(data){  
                	JQ('.loading').hide();
                     JQ('#show_product').html(data);  
                }  
           });  
      });  
 });  
 </script> 



