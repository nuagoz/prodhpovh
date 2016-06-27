<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php //echo $this->lang->lang(); ?>"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="<?php //echo $this->lang->lang(); ?>"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="<?php //echo $this->lang->lang(); ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php //echo $this->lang->lang(); ?>"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
	if(!empty($meta['type'])) {
		foreach($meta['type'] as $key => $name):
				echo '<meta ' . $name . '="' . $meta['name'][$key] . '" content="' . $meta['content'][$key] . '">';
		endforeach;
	}
	?>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=<?php echo base_url("assets/css/bootstrap.min.css"); ?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/bootstrap-theme.min.css"); ?>>

    <?php
    foreach($css as $url):
		echo $url;
	endforeach;
	?>
    
    <link rel="stylesheet" href=<?php echo base_url("assets/css/main.css"); ?>>

	<?php
	//Url multi langue
	$alternate_url = '';
	if($this->uri->segment(2))
		$alternate_url .= '/' . $this->uri->segment(2);
	if($this->uri->segment(3))
		$alternate_url .= '/' . $this->uri->segment(3);
	//Url multi langue
	if($alternate_url !== '')
	{
	?>
	<link rel="alternate" href=<?php echo base_url($alternate_url); ?> hreflang="fr" />
	<link rel="alternate" href=<?php echo base_url($alternate_url); ?> hreflang="en" />
	<link rel="alternate" href=<?php echo base_url($alternate_url); ?> hreflang="x-default" />
	<?php 
	}
	?>

    <script src=<?php echo base_url("assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"); ?>></script>
</head>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <?php echo $output; ?>
    

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?=base_url("assets/js/vendor/jquery-1.11.2.min.js")?>"><\/script>')</script>

    <script src=<?php echo base_url("assets/js/vendor/bootstrap.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/main.js"); ?>></script>
    <?php 
    foreach($js as $url):
		echo $url;
	endforeach;
    ?>

</body>
</html>