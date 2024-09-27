	<div class="container">
		<div class="border-line mt-4"></div>
	</div>
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 mb-5 mb-lg-0">
					<?php widget_aside('footer-1') ?>
				</div>
				<div class="col-lg-3 mb-5 mb-lg-0">
					<?php widget_aside('footer-2') ?>
				</div>
				<div class="col-lg-3 mb-5 mb-lg-0">
					<?php widget_aside('footer-3') ?>
				</div>
				<div class="col-lg-3 mb-5 mb-lg-0">
					<?php widget_aside('footer-4') ?>
				</div>
			</div>
		</div>
	</footer>
	<div class="footer-copyright py-4">
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
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/jquery-3.6.2.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/lazysizes.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/popper.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN ?>js/comment-system.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/script.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN . TEMPLATE_PATH ?>/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN ?>js/stats.js"></script>
	<?php run_hook('footer') ?>
	<?php load_plugin_footers() ?>
  </body>
</html>