<?php include '../../html_head.php';?>
<header class="article-single-header">
  <?php include '../../header_module_article.php';?>
  <h1 id="article-title">Basic scene with three.js</h1>
</header>



<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <p>If you haven't get in touch with three.js already this is for you! In this article I'll give you a quick introduction to the fantastic world of 3D in the web with three.js. Be sure to visit the website of <a href="http://ricardocabello.com/blog">ricardocabellov</a> aka <a href="http://mrdoob.com/">mr.doob</a> the bright mind behind three.js.</p>
      <h2>First things first!</h2>
      <p>To get yourself up and running the first thing you have to do is include the three.js Library into your html file. <span class="quick-note">Note: Load your scripts always at the bottom of your html file.</span></p>
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
  <section class="content">
    <div class="content-inner">
      <div class="col-12">
        <h3>renderer</h3>
        <p>Okay! With three.js in place we can start building our first scene. To intitialize the three.js renderer we create a new renderer Object like this: <span class="code">new THREE.WebGLRenderer();</span> and append it to the DOM. We have some options at this point, e.g. if we want shadows in our scene we have to enable it through the renderer manually. We can control the background Color with the .<span class="code">setClearColor();</span> method of the renderer. There is also the Canvas renderer available but it should only be used for simple scenes and if the Browser doesn't support WebGL.</p>
      </div>
    </div>
  </section>
</section>
<section class="code-breaker">
<div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
// Init the renderer
var renderer = new THREE.WebGLRenderer();
  //and set the size to your window dimensions
    renderer.setSize(window.innerWidth, window.innerHeight );
  //if you want shadows this should be true
    renderer.shadowMapEnabled = true;
  //soften the shadows but slower
    renderer.shadowMapType = THREE.PCFSoftShadowMap;
  //actual background color
    renderer.setClearColor(0x000000,1);

// Append the renderer to your DOM Element of choice
    document.body.appendChild( renderer.domElement );</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h3>scene and camera</h3>
      <p>Now we have a renderer for our 3D scene, let's create the actual scene where we can place our models and a camera to see these models. I want to have some perspective in the scene so I setup a perspective camera with a field of view(fov) 75.
    </div>
    <div class="col-4 merk-info">
      <p>The higher the fov the more distortion on the edges will appear. Human eyes have a fov ~75 (this depends on your viewport dimensions).</p>
    </div>
  </div>
</section>
<section class="code-breaker">
  <div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
// This is our scene 
var scene = new THREE.Scene();
/*
*Camera Setup**
Perspective Options (fov,aspect,near,far)
  fov - The field of view (~75 Human Eyes)
  aspect - aspect of renderer (window.innerWidth / window.innerHeight)
  near - how close can we get to an object
  far - how far can we see objects in space

Orthographic Options
  left,right,top,bottom - position in space
  near - how close can we get to an object
  far - how far can we see objects in space
*/
// (fov=75,aspect=window.innerWidth/window.innerHeight,near,far)
var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );
    camera.position.set(0,50,200); // Position
    camera.lookAt(new THREE.Vector3(0,50,0)); // Target

    //Our first object in space : )
    scene.add(camera);</textarea>
    </div>
</section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h3>Our first cube!</h3>
      <p>We are now ready to rock the stage aka scene. Everything is there and we can show our first cube. <span class="quick-note">Note: Objects in three.js have always two components. The <strong>geometry</strong> and the <strong>material</strong>.</span></p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
//Setup the material first
var base_material = new THREE.MeshLambertMaterial( { color: 0xffffff } );
//and the geometry
var box = new THREE.BoxGeometry( 5, 5, 5 ); // dimensions x,y,z

// combine the geometry and the material to one Mesh
var mesh = new THREE.Mesh( box , base_material );

// Add the created cube to the scene
scene.add( mesh );</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h2>Lights on!</h2>
      <p>A Spotlight will light our cubes (if you want to have shadows you turn them on manually).</p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
var spotLight = new THREE.SpotLight(0xffffff);
    spotLight.position.set( 0, 100, 100 );
    spotLight.intensity = 1;
    //Turn on shadows manually
    spotLight.castShadow = true;
    //add the light to scene
    scene.add(spotLight);</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h3>runtime</h3>
      <p>Yeah! The first cube in space. We can add a render function to add a runtime to our scene. The Computer tries to run the render function at 60fps. If the machine is too slow for 60 it will automatically slow down. At 50fps the scene feels a bit sloppy and everything below &gt;40fps is slow. Try to stay close to 60fps for a smooth Animation.</p>
    </div>
    <div class="col-4 aside">
      <p><a href="https://github.com/paulirish">@paulirish</a> wrote a great article about <a href="http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/">requestAnimationFrame</a> and why you should use it.<a href="#link-requestAnimationFrame">[1]</a></p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
//the render function 
var render = function () { 
    requestAnimationFrame( render );
    // Our own function to play
    // with the cube later on
    animation();
    //Update the scene and camera
    renderer.render(scene, camera);
};

  //Start everything once and it keeps going
  render();</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h2>animate</h2>
      <p>Before we can call the animation function inside the render function we have to define it. I rotate the whole scene each time the animation runs(60fps) for 0.0005 increments around the y-Axis for a nice turntable effect.</p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
function animation(){
  scene.rotation.y  -= .0005;
}</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h2>That's it!</h2>
      <p>Your first 3D scene in the web, great! You are now ready to create your own scene with three.js. The base setup looks always like this but to give you some more useful tips right at the start I want to show you some methods how you can add multiple objects in a performant way.</p>
      <h2>Multiple Objects</h2>
      <p>Reminder: Meshes have always two parts: geometry and the material. If you want to add multiple cubes you don't have to create these two parts each time again, instead you can store the geometry and the material in a <span class="code">variable</span> outside the for loop (e.g. geometry,material) to save some memory.</p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
// Create 500 cubes
for ( var i = 0; i < 500; i ++ ) {
// A new Mesh with the same geometry and material
var mesh = new THREE.Mesh( box , base_material );
  // with a random position
    mesh.position.x = ( Math.random() - 0.5 ) * 500;
    mesh.position.y = ( Math.random() - 0.5 ) * 500;
    mesh.position.z = ( Math.random() - 0.5 ) * 500;
    mesh.updateMatrix();
    mesh.matrixAutoUpdate = false;
    scene.add( mesh );
}</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h3>mesh.updateMatrix();</h3>
      <p>Did you see the <span class="code">mesh.updateMatrix();</span> and the <span class="code">mesh.matrixAutoUpdate = false;</span>? This is for performance reasons. Every mesh updates itself frame by frame unless you are telling it not to do. Because our cubes are only static at this point we don't need that update and we can set the matrixAutoUpdate to false. But because we are adding multiple cubes in a for loop to the scene we have to update the cube before the next cube is added, otherwise we would end up with just one cube visually (500 cubes with the same position).</p>
    </div>
  </div>
</section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h2>Control the camera</h2>
      <p>We have a bunch of cubes now but we can't control our camera to move in space. Three.js offers multiple ways to control the camera. For this scene I want to add an OrbitControl. Include the script for the OrbitControls.js in your document first and then you can add the controls to the camera.</p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="html">
<script src="http://cdn.rawgit.com/mrdoob/three.js/master/examples/js/controls/OrbitControls.js"></script></textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <p>The camera is an argument for the OrbitControls. This is important to note because if we want to switch the camera later on we have to update the controls, too! To prevent that the controls can go through the floor (we don't have one in our scene yet but maybe you add one later) we have to define a min and maxPolarAngle. Set the <span class="code">minPolarAngle</span> to <span class="code">Math.PI/2</span>.</p>
    </div>
    <div class="col-8">
      <h3>Math what?! — Quaternions</h3>
      <p>Rotation in 3d space is not always as you might expect. Three.js works with Quaternions which tries to represent the <strong>orientation</strong> and <strong>rotation</strong> of objects in threedimensional space<a href="#link-quaternions">[2]</a>. To calculate the correct values it takes 4 values <strong>x,y,z</strong> and <strong>w</strong>.</p>
    </div>
    <div class="col-4 aside">
      <p>Rotation with Quaternions<br>
      90 * Math.PI/180 //=== 90°<br>
      30 * Math.PI/180 //=== 30°…</p>
    </div>
  </div>
</section>
<section class="code-breaker"><div class="code-breaker-inner">
<textarea class="code-block" data-code-type="javascript">
  // our actual camera as argument
var controls = new THREE.OrbitControls( camera ); 
    controls.damping = 0.2; //slows down the movement
    controls.maxPolarAngle = Math.PI/2; //Quaternion rotation
    controls.minPolarAngle = 1;
    controls.minDistance = 100;
    controls.maxDistance = 220;</textarea>
</div></section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h2>Pro Tip! Use your Console.</h2>
      <p>Have a look in your Dev Tools they provide us a great way to inspect our scene and helps us with properties of the objects. Especially when you're not familiar with the objects of three.js yet.</p>
      <p>Hit 'alt'+'cmd'+'i' to open the devTools in Chrome and type in the name of your Mesh and you get the hole list of properties and methods.</p>
    </div>
  </div>
</section>
<section class="image-full">
 <img src="console.jpg" alt="console">
</section>
<section class="content">
  <div class="content-inner">
    <div class="col-8">
      <h2>Reference</h2>
      <p id="link-requestAnimationFrame">[1] <a target="_blank" href="http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/">requestAnimationFrame</a></p>
      <p id="link-quaternion">[2] <a target="_blank" href="http://de.wikipedia.org/wiki/Quaternion">Quaternions</a></p>
      <h2>Also have a look at</h2>
      <p><a href="http://threejs.org/">Official Website three.js</a></p>
      <p><a href="http://threejs.org/docs/">three.js Documentation</a></p>
      <p><a href="http://ricardocabello.com/blog">ricardocabellov</a> aka <a href="http://mrdoob.com/">mr.doob</a></p>
    </div>
  </div>
</section>
<section class="content">
  <div class="content-inner conclusion">
      <div class="col-6">
        <?php include '../../download_info.php';?>
        <a href="https://gist.github.com/paprcraft/9ac5efe152ddab0cb72e" class="button-github" target="_blank">Github</a>
      </div>
      <div class="col-6">
        <?php include '../../codepen_info.php';?>
        <a href="http://codepen.io/SaschaSigl/pen/dc2f9e1443f8ef4eb81bd87d148a2451?editors=001" class="button-codepen" target="_blank">Codepen</a>
      </div>
    </div>
  </div>
</section>
  <?php include '../../footer.php';?>

  <!--This is the script you are looking for-->
  <script src="basic_scene.js"></script>
  <?php include '../../html_footer.php';?>


















































