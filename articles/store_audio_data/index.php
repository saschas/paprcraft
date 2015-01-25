<?php include '../../html_head.php';?>
<header class="article-single-header blue">
  <?php include '../../header_module_article.php';?>
  <h1 id="article-title">Store audio Data to json</h1>
  <audio id="player">
    <source src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/61062/170417__eelke__bang-03-clean.mp3">
  </audio>
  <div class="audio-navi">
    <div class="play-button"></div>
  </div>
</header>

<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <p>With the Web Audio API we have access to audio Data in Realtime. In this article I'll show you how to generate the data and store it for later use.</p>
      <h2>Open your Console</h2>
      <p>Have a look in your Console to see the actual data. <span class="quick-note">Note: You can access the Console by opening the Chrome DevTools with cmd-alt-j on mac and strg-shift-j on windows.</span>. The Console should be empty otherwise you can clear it by type in the command<span class="code">clear();</span> and hit enter.</p>
      <p>Now we can start processing the data by <strong>click the play Button</strong> you see in the Headersection. If the Audio API is available in your Browser you will see a message <span class="code">//Wait for the data to be processed...</span> When the audio is finished or you pause it the processed data show up in the console.</p>
    </div>
    <div class="col-4 aside">
      <?php include '../../download_info.php';?>
      <a href="https://gist.github.com/paprcraft/9ac5efe152ddab0cb72e" class="button-github" target="_blank">Github</a>
    </div>
  </div>
</section>
<section class="code-breaker">
  <div class="code-breaker-inner">
    <textarea class="code-block" data-code-type="javascript">//Wait for the data to be processed...</textarea>
    </div>
</section>
  <section class="content">
    <div class="content-inner">
      <div class="col-12">
        
      </div>
    </div>
  </section>
</section>

  <?php include '../../footer.php';?>

  <!--This is the script you are looking for-->
  <script src="store_audio_data.js"></script>
  <?php include '../../html_footer.php';?>


















































