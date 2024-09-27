<?php

$category_icons = json_decode( file_get_contents(ABSPATH . TEMPLATE_PATH . '/includes/category-icons.json'), true);
$active_category = '';
if(isset($category)){
	$active_category = $url_params[1];
}

?>
<!DOCTYPE html>
<html <?php the_html_attrs() ?>>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<title><?php echo apply_filters('site_title', get_page_title()) ?></title>
		<?php the_canonical_link() ?>
		<meta name="description" content="<?php echo apply_filters('meta_description',substr($meta_description, 0, 360)) ?>">
		<?php the_head('top') ?>
		<?php
			if(is_game()){ //Game page
				?>
				<meta property="og:type" content="game">
				<meta property="og:url" content="<?php echo get_canonical_url() ?>">
				<meta property="og:title" content="<?php echo apply_filters('site_title', get_page_title()) ?>">
				<meta property="og:description" content="<?php echo substr(esc_string($meta_description), 0, 200) ?>">
				<meta property="og:image" content="<?php echo (substr($game->thumb_1, 0, 1) == '/') ? home_url() . $game->thumb_1 : $game->thumb_1 ?>">
				<?php
			}
		?>
		<?php load_plugin_headers() ?>
		<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN . TEMPLATE_PATH; ?>/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN . TEMPLATE_PATH; ?>/css/user.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN . TEMPLATE_PATH; ?>/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN . TEMPLATE_PATH; ?>/css/custom.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
		<!-- Font Awesome icons (free version)-->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<!-- Google fonts-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
		<?php the_head('bottom') ?>
		<?php widget_aside('head') ?>
	</head>
	<body id="page-top" <?php the_body_background() ?>>
		<!-- Navigation-->
		<nav class="navbar navbar-expand-lg navbar-dark top-nav <?php /* Modified by Jacken */ if(is_game())echo 'nav-gamepage'?>" id="mainNav">
			<div class="container">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-menu" aria-controls="nav-menu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand js-scroll-trigger" href="<?php echo DOMAIN ?>"><img src="<?php echo DOMAIN .SITE_LOGO ?>" class="site-logo" alt="site-logo"></a>
				<div class="d-lg-none">
					<?php
					if(is_null($login_user)){
						if(get_setting_value('show_login')){
							echo('<a class="nav-link" href="'.get_permalink('login').'"><div class="btn btn-circle b-white b-login"><i class="bi bi-person"></i></div></a>');
						}
					}
					?>
					<?php show_user_profile_header() ?>
				</div>
				<div class="navbar-collapse collapse" id="nav-menu">
					<ul class="navbar-nav">
					<?php render_nav_menu('top_nav', array(
								'no_ul'	=> true,
								'li_class' => 'nav-item',
								'a_class' => 'nav-link',
							)); ?>
					</ul>
					<form class="form-inline my-2 my-lg-0 search-bar" action="/index.php">
						<div class="input-group">
							<input type="hidden" name="viewpage" value="search" />
							<i class="bi bi-search"></i>
							<input type="text" class="form-control search" placeholder="<?php _e('Search game') ?>" name="slug" minlength="2" required />
						</div>
					</form>
				</div>
				<div class="d-none d-lg-block">
					<?php
					if(is_null($login_user)){
						if(get_setting_value('show_login')){
							echo('<a class="nav-link" href="'.get_permalink('login').'"><div class="btn btn-circle b-white b-login"><i class="bi bi-person"></i></div></a>');
						}
					}
					?>
					<?php show_user_profile_header() ?>
				</div>
			</div>
		</nav>