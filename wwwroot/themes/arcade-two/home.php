<?php include  TEMPLATE_PATH . "/includes/header.php" ?>
<?php widget_aside('header') ?>
<div class="container">
	<?php widget_aside('top-content') ?>
	<!-- Trending section -->
	<?php
	$games = fetch_games_by_type('trending', 12, 0, false)['results'];
	if(count($games) > 3){
	?>
	<h3 class="section-title"><?php _e('Trending') ?></h3>
	<div class="row-list-1 grid-container">
		<div class="list-1-wrapper">
			<?php
			foreach ( $games as $game ) { ?>
				<?php include  TEMPLATE_PATH . "/includes/list1.php" ?>
			<?php } ?>
		</div>
			<button type="button" class="b-left btn btn-default btn-circle btn-lg" id="t-prev">
				<i class="bi bi-caret-left-fill"></i>
			</button>
			<button type="button" class="b-right btn btn-default btn-circle btn-lg" id="t-next">
				<i class="bi bi-caret-right-fill"></i>
			</button>
	</div>
	<?php } ?>
	<!-- New games section -->
	<h3 class="section-title"><?php _e('New games') ?></h3>
	<div class="row grid-container" id="new-games-section">
		<?php
		$games = fetch_games_by_type('new', 18, 0, false)['results'];
		foreach ( $games as $game ) { ?>
			<?php include  TEMPLATE_PATH . "/includes/grid1.php" ?>
		<?php } ?>
	</div>
	<!-- Load more games -->
	<div class="load-more-games-wrapper">
		<!-- Template -->
		<div class="item-append-template" style="display: none;">
			<div class="col-md-2 col-sm-3 col-4 grid-1">
				<a href="<?php echo get_permalink('game') ?>{{slug}}">
				<div class="game-item">
					<div class="list-game">
						<div class="list-thumbnail"><img src="<?php echo get_template_path(); ?>/images/thumb-placeholder1.png" data-src="{{thumbnail}}" class="small-thumb img-rounded lazyload" alt="{{title}}" class="small-thumb img-rounded"></div>
						<div class="list-info">
							<div class="list-title">{{title}}</div>
						</div>
					</div>
				</div>
				</a>
			</div>
		</div>
		<!-- The button -->
		<div class="text-center b-load-more">
			<div class="btn btn-load-more btn-load-more-games btn-md">
				<?php _e('Load More') ?> <i class="fa fa-chevron-down" aria-hidden="true"></i>
			</div>
		</div>
	</div>
	<!-- Popular games section -->
	<h3 class="section-title"><?php _e('Popular games') ?></h3>
	<div class="row grid-container">
		<?php
		$games = fetch_games_by_type('popular', 12, 0, false)['results'];
		foreach ( $games as $game ) { ?>
			<?php include  TEMPLATE_PATH . "/includes/grid2.php" ?>
		<?php } ?>
	</div>
	<!-- Random games section -->
	<h3 class="section-title"><?php _e('You may like') ?></h3>
	<div class="row grid-container">
		<?php
		$games = fetch_games_by_type('random', 12, 0, false)['results'];
		foreach ( $games as $game ) { ?>
			<?php include  TEMPLATE_PATH . "/includes/grid3.php" ?>
		<?php } ?>
	</div>
	<div class="category-list-global">
		<?php
		$categories = fetch_all_categories();
		echo '<ul class="category-list-wrapper">';
		foreach ($categories as $cat) {
			$icon = get_category_icon($cat->slug, $category_icons);
			echo '<a href="'. get_permalink('category', $cat->slug) .'">';
			echo '<li class="cat-item"><span class="icon-category"><img src="'.get_template_path().'/images/icon/'.$icon.'.svg" alt="'._t($cat->name).'" width="40" height="40"></span><div class="cat-info text-ellipsis"><span class="cat-name">'. _t(esc_string($cat->name)) .'</span><div class="cat-game-amount">'._t('%a games', Category::getCategoryCount($cat->id)).'</div></div></li>';
			echo '</a>';
		}
		echo '</ul>';
		?>
	</div>

	<?php widget_aside('bottom-content') ?>
	<?php widget_aside('homepage-bottom') ?>
</div>
<?php include  TEMPLATE_PATH . "/includes/footer.php" ?>