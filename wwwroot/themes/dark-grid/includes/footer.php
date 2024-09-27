	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="">
					<div class="footer-1">
						<?php widget_aside('footer-1') ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<div class="copyright py-4 text-center">
		<div class="container">
			<?php
			if(isset($stored_widgets['footer-copyright'])){
				widget_aside('footer-copyright');
			} else {
				echo SITE_TITLE . ' © '.date('Y').'. All rights reserved.';
			}
			?>
			<span class="dsb-panel">
				<?php
				if(is_login() && USER_ADMIN ){
					echo '<a href="'.DOMAIN.'admin.php">Admin Dashboard</a>';
				} else {
					echo 'V-'.VERSION;
				}
				?>
			</span>
		</div>
	</div>
	</div>
	</div>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/jquery-3.6.2.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/lazysizes.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN ?>js/comment-system.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/script.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN ?>js/stats.js"></script>
	<?php run_hook('footer') ?>
	<?php load_plugin_footers() ?>
  </body>
</html>