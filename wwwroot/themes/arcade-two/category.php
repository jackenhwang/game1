<?php include  TEMPLATE_PATH . "/includes/header.php" ?>
<div class="container">
	<div class="game-container">
		<?php widget_aside('top-content') ?>
		<div class="content-wrapper">
			<h3 class="item-title">
				<?php
				$icon = get_category_icon($active_category, $category_icons);
				?>
				<span class="g-icon"><img src="<?php echo get_template_path(); ?>/images/icon/<?php echo $icon; ?>.svg" alt=""></span>
				<?php _e('%a Games', esc_string($archive_title)) ?>
			</h3>
			<p><?php _e('%a games in total.', esc_int($total_games)) ?> <?php _e('Page %a of %b', esc_int($cur_page), esc_int($total_page)) ?></p>
			<?php
			if($category->description != ''){
				echo '<p class="category-description">';
				echo nl2br($category->description)."</p>";
			}
			?>
			<div class="game-container">
				<div class="row">
					<?php
					foreach ( $games as $game ) {
						include  TEMPLATE_PATH . "/includes/grid3.php";
					}
					?>
				</div>
			</div>
			<div class="pagination-wrapper">
				<nav aria-label="Page navigation">
					<?php
					$cur_page = 1;
					if(isset($_GET['page'])){
						$cur_page = esc_int($_GET['page']);
					}
					render_pagination($total_page, $cur_page, 8, 'category', $_GET['slug']);
					?>
				</nav>
			</div>
		</div>
		<?php widget_aside('bottom-content') ?>
	</div>
</div>
<?php include  TEMPLATE_PATH . "/includes/footer.php" ?>