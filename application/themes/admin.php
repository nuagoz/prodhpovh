<!DOCTYPE html>
<html lang="fr"> 
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
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
<?php
//Url multi langue
$alternate_url = '';
if($this->uri->segment(2))
	$alternate_url .= '/' . $this->uri->segment(2);
if($this->uri->segment(3))
	$alternate_url .= '/' . $this->uri->segment(3);
//Url multi langue
?>
		<link rel="alternate" href="http://www.rosence.com/fr<?php echo $alternate_url;?>" hreflang="fr" />
		<link rel="alternate" href="http://www.rosence.com/en<?php echo $alternate_url;?>" hreflang="en" />
		<link rel="alternate" href="http://www.rosence.com<?php echo $alternate_url;?>" hreflang="x-default" />
		<style type='text/css'>
			body
			{
				font-family: Arial;
				font-size: 14px;
			}
			a {
			    color: blue;
			    text-decoration: none;
			    font-size: 14px;
			}
			a:hover
			{
				text-decoration: underline;
			}
		</style>
<?php
	echo css('bootstrap.min.css');
	echo css('bootstrap-theme.min.css');
	foreach($css as $url):
		echo $url;
	endforeach;
	echo css('admin.css'); ?>
	</head>

	<body>
		<?php echo $output; ?>
		<?php
			echo js('vendor/jquery-1.11.2.min.js');
			echo js('vendor/bootstrap.min.js');

			foreach($js as $url):
				echo $url;
			endforeach;
		?>
	</body>
</html>