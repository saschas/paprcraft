<?php include '../../html_head.php';?>
<header class="article-single-header">
  <?php include '../../header_module_article.php';?>
  <h1 id="article-title">å useful object</h1>
</header>



<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <p><a href="#what-is-å?">What is å?</a><br>
        <a href="#how-to-use-it">How to use it</a><br>
        <a href="#å.store_data(data)">å.store_data(data)</a><br>
        <a href="#å.stripes(n)">å.stripes(n)</a><br>
        <a href="#å.methods()">å.methods()</a><br>
        <a href="#i-want-to-learn-it">I want to learn it</a><br></p>

        <h3 id="what-is-å?">What is å?</h3>

        <p>I have a json Object with more than <em>100.000</em> data sets and I want to loop through each of them. I want to split the large json data response into smaller <em>more consumable</em> pieces (I call them <strong>"stripes"</strong>).</p>
        <p>To write less code in future I try to make use of my <strong>å</strong> object with some useful functions like <span class="code">.get_next_stripe();</span> or <span class="code">.get_prev_stripe();</span> to easily get the <em>next</em> or the <em>prev</em> <strong>stripe</strong> (Array with sliced data of the original json response).</p>
        <h2 id="how-to-use-it">å object</h2>
        <p><em>Note: You can type the character å by</em> <span class="code">alt-a</span> <em>on mac and windows</em></p>
        </div>
        <div class="col-4 aside">
        <?php include '../../download_info.php';?>
        <a href="https://gist.github.com/paprcraft/91785c2aa2bebe3a6978" class="button-github" target="_blank">Github</a>
        <?php include '../../codepen_info.php';?>
        <a href="http://codepen.io/SaschaSigl/pen/GgWapR/?editors=001" class="button-codepen" target="_blank">Codepen</a>
      </div>
    </div>

  </section>
  <section class="code-breaker">
    <div class="code-breaker-inner">
      <textarea class="code-block" data-code-type="javascript">var å = {
  data: {},
  size: 10,
  store_data : function(data){
    this.data = data;
  },
  calculate_stripes : function(count){
    if(!count){
      console.warn('Missing Number! How many stripes do you wanna have?')
      return false;
    }
    var i,j,single_stripe,chunk = count;
      var stripes = [];

      for (i=0,j= this.data.length; i<j; i+=chunk) {
        single_stripe = this.data.slice(i,i+chunk);
        stripes.push(single_stripe);
      }
    return stripes;
  },
  stripes_count : 0,
  stripes_data : [],
  ////////////////////////////////////////
  ///// Get the audio data in smaller chunks
  ////////////////////////////////////////
  stripes : function(slice){
    if(!stripes){
      if(slice){
        if(slice != last_slice){
          last_slice = slice;
        }
        else{
          var last_slice = slice;
        }        
      }
      else{
        var last_slice = this.size;
      }
      var stripes = this.calculate_stripes(last_slice);
      this.stripes_count = stripes.length;
      this.stripes_data = stripes;
      console.log('stripes count: '+ this.stripes_count)
      return false;
    }
    else{
      return false;
    }
  },
  loop : true,
  // Get the next stripes of data
  get_next_stripe : function () {
    var curr = 0;
    if(this.stripes_count != 0){
      curr = this.stripes_data.length - this.stripes_count;
     
      this.stripes_count--;
      if(this.stripes_data[curr]){
        console.log('get_next_stripe(): ' + curr);
        return this.stripes_data[curr];
      }
      else{
        console.log('there are no prev data stripes');
        return false;
      }
    }
    else{
      if(this.loop){        
        this.stripes_count = this.stripes_data.length;
        if(!this.stripes_data[0]){
          console.warn('No stripes! Generate new .stripes() first!');
          return false;
        }
        else{
          console.log('looop')
          return this.stripes_data[0];
        }
      }
      else{
        console.warn('No stripes! Generate new .stripes() first or loop the stripes');
        return false;
      }
    }   
  },
  // Get the prev stripes of data
  get_prev_stripe : function () {
    if(this.stripes_count != 0){
      if(this.stripes_count === this.stripes_data.length ){
        console.warn('there are no prev data stripes');
      }
      else{
        this.stripes_count++;
        var curr = this.stripes_data.length-this.stripes_count;
        console.log('get_prev_stripe(): ' + curr);
        return this.stripes_data[curr];
      }
    }
    else{
      console.warn('run .stripes() first!');
    }   
  },
  get_stripe : function(curr){
    this.stripes_count = this.stripes_data.length-curr;
    console.log('get_stripe(): '+curr);
    return this.stripes_data[curr];
  }
}

//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
$.ajax({
  dataType: "json",
  url: "https://s3-us-west-2.amazonaws.com/s.cdpn.io/61062/audioData_4.json",
  success: function(data){
  // 1. Store data in å
    å.store_data(data);
  // 2. split json obj array in consumable stripes
     å.stripes(10);
  // Have a look in your console 
  // you should have about 147 stripes, right?
    
 //  3. now you can call .get_next_stripe() 
 // to get the next stripe...index is 0 based
  å.get_next_stripe();
    // Output would be stripes count: 147
    
  // 4. Or you call .get_stripe(n) function
  // to get an specific part of stripes
    å.get_stripe(2);
    
  // Of course you can call 
  // .get_prev_stripe() function as well...
  // keep in mind: if you call 
  // the get_stripe(2) function to get 
  // a specific stripe your prev and next 
  // stripe will be 1 and 3
    å.get_prev_stripe();
    
   }
});</textarea>
  </div>
</section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">

        <p>Your Console should say <span class="code">stripes count: 147...</span> Jep? Fine!</p>

        <p>
          <strong>If you see nothing or something like this:</strong>
        </p>
        <p><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/61062/Bildschirmfoto_2015-01-16_um_22.55.15.png" alt="console errow"> </p>

        <p><strong>You might switch to the</strong> <span class="code">&lt;result-iframe&gt;</span>.</p>

        <p>
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/61062/Bildschirmfoto_2015-01-16_um_23.01.26.png" alt="switch to result iframe">
        </p>

        <h2 id="å.store_data(data)">å.store_data(data)</h2>

        <p>I initialize <strong>å</strong> by calling the <span class="code">.store_data(data)</span> function and pass a json object as argument. Like this:</p>
      </div>
    </div>
  </section>
  <section class="code-breaker">
    <div class="code-breaker-inner">
      <textarea class="code-block" data-code-type="javascript">$.ajax({
        dataType: "json",
        url: "*** YOUR URL ***",
        success: function(data){
        // 1. Store data in å
        å.store_data(data);
      }
    });</textarea>
  </div>
</section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">

      <h3 id="å.stripes(n)">å.stripes(n)</h3>

      <p>I want to split the original data into <em>n</em> <strong>stripes</strong>.I can do that by calling <span class="code">.stripes(n)</span> function where <em>n is the length of one stripe</em>.</p>
    </div>
  </div>
</section>
<section class="code-breaker">
  <div class="code-breaker-inner">
    <textarea class="code-block" data-code-type="javascript">$.ajax({
      dataType: "json",
      url: "https://s3-us-west-2.amazonaws.com/s.cdpn.io/61062/audioData_4.json",
      success: function(data){
      // 1. Store data in å
      å.store_data(data);
      // 2. split json obj array in consumable stripes
      å.stripes(10);
      // Have a look in your console 
      // you should have about 147 stripes, right?
    }
  });</textarea>
</div>
</section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <p>Fine! I'm ready now to call the first <strong>stripe</strong> by calling the <span class="code">å.get_next_stripe()</span>. Result should be the first <strong>stripe</strong>. Yeah!</p>

      <h3 id="å.methods()">å.methods()</h3>

      <p><strong><span class="code">å.stripes(n);</span></strong><br>
        split the data into multiple stripes. The length of each stripes is <em>n</em>. Default for <em>n</em> is <span class="code">10</span>. </p>

        <p><strong><span class="code">å.get_prev_stripe();</span></strong><br>
          returns the previous stripe.</p>

          <p><strong><span class="code">å.get_next_stripe();</span></strong><br>
            returns the next stripe.</p>

            <p><strong><span class="code">å.get_stripe(n);</span></strong><br>
              returns the n-th stripe.<br> <em>Keep in mind that</em> <span class="code">.get_prev_stripe()</span> <em>and</em> <span class="code">.get_next_stripe()</span> <em>change too!</em></p>

              <p><strong><span class="code">å.loop</span></strong><br>
                Default is true. If there is no next <em>stripe</em> <strong>å</strong> will return the first stripe again (index is 0 based).</p>
              </div>
            </div>
          </section>
          <section class="content">
            <div class="content-inner conclusion">
              <div class="col-6">
                <?php include '../../download_info.php';?>
        <a href="https://gist.github.com/paprcraft/91785c2aa2bebe3a6978" class="button-github" target="_blank">Github</a>
        
              </div>
              <div class="col-6">
                <?php include '../../codepen_info.php';?>
        <a href="http://codepen.io/SaschaSigl/pen/GgWapR/?editors=001" class="button-codepen" target="_blank">Codepen</a>
              </div>
            </div>
          </div>
        </section>
        <?php include '../../footer.php';?>

        <!--This is the script you are looking for-->
        <script src="helvetica.js"></script>
        <script src="a_header.js"></script>
        <?php include '../../html_footer.php';?>


















































