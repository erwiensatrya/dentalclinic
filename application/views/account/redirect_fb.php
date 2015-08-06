<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<?php echo $this->load->view('head'); ?>
<body>
	<?php echo $this->load->view('header'); ?>
	<div class="container">
	<center>
	<?php if (!$this->facebook_lib->user) : ?>
		<fb:login-button></fb:login-button>
	<?php endif; ?>
	<div id="fb-root"></div>
	</center>
	</div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId: '<?php echo $this->facebook_lib->fb->getAppID() ?>',
				cookie: true,
				xfbml: true,
				oauth: true
			});
			FB.Event.subscribe('auth.login', function(response) {
				window.location.reload();
			});
			FB.Event.subscribe('auth.logout', function(response) {
				window.location.reload();
			});
		};
		(function() {
			var e = document.createElement('script'); e.async = true;
			e.src = document.location.protocol +
			'//connect.facebook.net/en_US/all.js';
			document.getElementById('fb-root').appendChild(e);
		}());
	</script>
	<?php echo $this->load->view('footer'); ?>
</body>
</html>
