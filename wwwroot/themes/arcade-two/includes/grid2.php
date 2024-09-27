<?php

$_game_title = get_content_title_translation('game', $game->id, $game->title);

?>
<div class="col-lg-4 col-md-6 grid-2">
	<a href="<?php echo get_permalink('game', $game->slug) ?>">
	<div class="game-item">
		<div class="list-game">
			<div class="list-thumbnail"><img src="<?php echo get_template_path(); ?>/images/thumb-placeholder3.png" data-src="<?php echo get_small_thumb($game) ?>" class="small-thumb img-rounded lazyload" alt="<?php echo $_game_title ?>"></div>
			<div class="list-info">
				<div class="list-title"><?php echo $_game_title ?></div>
				<div class="list-category">
				<?php
				$_arr_category = commas_to_array($game->category);
				$_categories = [];
				foreach ($_arr_category as $_category) {
					$_categories[] = _t($_category);
				}
				echo implode(', ', $_categories);
				?>
				</div>
				<div class="list-rating">
					<i class="bi bi-star-fill"></i>
					<?php echo get_rating('5-decimal', $game) ?>/5
				</div>
			</div>
		</div>
	</div>
	</a>
</div>