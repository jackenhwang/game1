<?php

$_game_title = get_content_title_translation('game', $game->id, $game->title);

?>
<div class="col-md-2 col-sm-3 col-4 grid-1">
	<a href="<?php echo get_permalink('game', $game->slug) ?>">
	<div class="game-item">
		<div class="list-game">
			<div class="list-thumbnail"><img src="<?php echo get_template_path(); ?>/images/thumb-placeholder1.png" data-src="<?php echo get_small_thumb($game) ?>" class="small-thumb img-rounded lazyload" alt="<?php echo $_game_title ?>"></div>
			<div class="list-info">
				<div class="list-title"><?php echo $_game_title ?></div>
			</div>
		</div>
	</div>
	</a>
</div>