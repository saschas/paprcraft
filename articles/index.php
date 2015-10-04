<?php include '../html_head.php';?>
<header class="article-single-header header-white">
  <nav>
	<a href="<?php echo $root; ?>"><h1 id="single_main_logo"><img id="papr_logo_img" src="<?php echo $root; ?>assets/img/heart-log-black.png" alt="paprcraft logo">paprcraft</h1></a>
	<a href="<?php echo $root; ?>articles" class="active">articles</a>
	<a href="<?php echo $root; ?>analog">analog</a>
	<a href="http://saschas.github.io" target="_blank">experiments</a>
</nav>
<a href="https://twitter.com/share" class="twitter-share-button" data-via="paprcraft" data-related="paprcraft" data-hashtags="paprcraft" data-dnt="true">Tweet</a>

  <h1 id="article-title">articles</h1>
</header>

<section class="content">
  <section class="teaser">
    <?php include '../teaser.php';?>
  </section>
</section>


<?php include '../footer.php';?>
<!--site specific script-->
<script src="js/articles_header.js"></script>

<?php include '../html_footer.php';?>