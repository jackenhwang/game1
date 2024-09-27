<?php

$_game_title = get_content_title_translation('game', $game->id, $game->title);

?>
<div class="col-lg-2 col-md-4 col-6 grid-3">
	<a href="<?php echo get_permalink('game', $game->slug) ?>">
	<div class="game-item">
		<div class="list-game">
			<div class="list-thumbnail"><img src="<?php echo get_template_path(); ?>/images/thumb-placeholder2.png" data-src="<?php echo $game->thumb_1 ?>" class="lazyload" alt="<?php echo $_game_title ?>"></div>
			<div class="list-info">
				<div class="list-title"><?php echo $_game_title ?></div>
				<span><?php _e('%a plays', $game->views) ?></span>
			</div>
		</div>
	</div>
	</a>
</div>