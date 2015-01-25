<footer>
	<div class="footer-inner">
		<div class="footer-col">
			<?php include 'contact.php';?>
		</div>
		<div class="footer-col">
			
		</div> 
		<div class="footer-col">
			<?php include 'about.php';?>
		</div>		
	</div>
  <div class="footer-bottom">
  	 <p>Made with <span class="heart-ico"></span> by Sascha Sigl.</p><a href="impressum.php" class="impressum-link">Impressum</a>
  </div>
</footer>
<!--Load scripts at the bottom at the page.-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/three.js/r69/three.min.js'></script>
<script src='<?php echo $root; ?>js/orbit_controls.js'></script>

<script src="<?php echo $root; ?>js/codemirror.js"></script>
<script src="<?php echo $root; ?>js/codemirror_styles.js"></script>

<script src="<?php echo $root; ?>js/modernizr.js"></script>
<script src="<?php echo $root; ?>js/main_script.js"></script>