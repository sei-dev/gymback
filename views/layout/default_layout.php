<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>INTECH - Elastic</title>
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">

<!--Stylesheets-->
<link href="/theme/bower_components/bootstrap/dist/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="/theme/bower_components/font-awesome/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="/theme/dist/css/AdminLTE.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="/theme/dist/css/skins/_all-skins.min.css" media="screen" rel="stylesheet" type="text/css">
<link href="/theme/dist/css/style.css" media="screen" rel="stylesheet" type="text/css">
<link href="/theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" media="screen" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/js/main.js"> </script>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!--Header-->
        <header class="main-header">
            <?php echo $this->partial('header'); ?>
        </header>
        
        
        <!-- Left side column -->
  		<aside class="main-sidebar">
            <!-- sidebar -->
    		<section class="sidebar">
    			<?php echo $this->partial('menu'); ?>
			</section>
		</aside> 


    	<!-- content -->
        <div class="content-wrapper">
        	<section class="content">
    		<?php echo $this->content; ?>
    		</section>
        </div>
        
        
        <!--Footer-->
        <footer>
            <?php echo $this->partial('footer'); ?>
    	</footer>
	</div>
</body>
</html>