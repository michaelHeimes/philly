<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title('|', true, 'right'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>

	<link rel="shortcut icon" href="<?= get_stylesheet_directory_uri()?>/assets/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?= get_stylesheet_directory_uri()?>/assets/img/favicon.ico" type="image/x-icon">
	<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
	<style>
	header.header { background: #000!important;}
	footer.footer { background: #000!important;}
	.button, button {
    background-color: #000;
    color: #FFF;}
			.button:focus, .button:hover, button:focus, button:hover {
    background-color: #777;
    color: #FFF;}
        .c2a_button a.button{
            background-color: #fff!important;
            color: #000!important;
        }
        .c2a_button a.button:hover{
            background-color: #aaa!important;
            color: #000!important;
        }
        @media screen and (min-width: 1200px) {
          header.header .logo a {
            margin-left: calc(600px - 50vw);
          }
        }
	</style>

</head>
