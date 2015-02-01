<?php include '../../html_head.php';?>
<header class="article-single-header header-blue">
  <?php include '../../header_module_article.php';?>
  <h1 id="article-title">Web audio API</h1>
  <audio id="player" preload="auto">
    <source type="audio/mpeg" src="sound_awakener_poetic_motion.mp3">
    <source type="audio/ogg" src="Sound_Awakener_-_Poetic_motion.mp3">
    <source type="audio/webm" src="Sound_Awakener_-_Poetic_motion.mp3">
  </audio>
<div class="play-button"></div>
<canvas id='c' class="header_canvas"></canvas>
<div class="music_tribute">
  Sound: <a target="_blank" href="http://soundawakener.bandcamp.com/track/looking-back-looking-glass">Looking back, Looking glass</a> by <a target="_blank" href="http://soundawakener.weebly.com/">Sound Awakener</a>
</div>
</header>



<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium dolorem soluta quaerat, doloribus numquam quisquam quibusdam impedit itaque, vel dolores ducimus, architecto minus omnis sequi, aliquam illo nemo deserunt repellat.</p>
      </div>
    <div class="col-4 aside">
      <?php include '../../download_info.php';?>
      <a href="https://gist.github.com/paprcraft/9ac5efe152ddab0cb72e" class="button-github" target="_blank">Github</a>
      <?php include '../../codepen_info.php';?>
        <a href="http://codepen.io/SaschaSigl/pen/dc2f9e1443f8ef4eb81bd87d148a2451?editors=001" class="button-codepen" target="_blank">Codepen</a>
    </div>
  </div>
</section>
<section class="code-breaker">
  <div class="code-breaker-inner">
    <textarea class="code-block" data-code-type="html"><script src="http://threejs.org/build/three.min.js"></script></textarea>
    </div>
</section>


  <?php include '../../footer.php';?>

  <!--This is the script you are looking for-->
  <script src="audio_api.js"></script>
  <?php include '../../html_footer.php';?>


















































