jQuery(document).ready(function($){
var main_color = 0xffffff;
var light_color = 0xffffff;
var stroke_color  = 0x000000;
var canvas_height = (window.innerHeight-(window.innerHeight/4));
var canvas_width = window.innerWidth;
//////////////////////////////////////////
    //   Scene
//////////////////////////////////////////
var scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2( main_color, 0.0045 );

//////////////////////////////////////////
    //   Camera
//////////////////////////////////////////
var camera = new THREE.PerspectiveCamera( 75, canvas_width/canvas_height, 0.1, 1000 );
    camera.lookAt(new THREE.Vector3(0,20,0));
    camera.position.set(0,0,200);
//////////////////////////////////////////
    //   Renderer
//////////////////////////////////////////
var renderer = new THREE.WebGLRenderer({ alpha: true }); /// { alpha: true }
    renderer.setSize( canvas_width, canvas_height );
    renderer.shadowMapEnabled = true;
    renderer.shadowMapType = THREE.PCFSoftShadowMap;
    renderer.setClearColor(main_color,1);
    renderer.domElement.className = 'header_canvas';
$('header').append( renderer.domElement ).addClass('loaded');


//////////////////////////////////////////
    //   Resize
//////////////////////////////////////////
window.onresize = function(){
  canvas_height = (window.innerHeight-(window.innerHeight/4));
  canvas_width = window.innerWidth;
  camera.aspect = canvas_width / canvas_height;
  camera.updateProjectionMatrix();
  renderer.setSize( canvas_width, canvas_height );
}
//////////////////////////////////////////
    //   Controls
//////////////////////////////////////////

  controls = new THREE.OrbitControls( camera );
  controls.damping = 0.2;
  controls.maxPolarAngle = Math.PI/2;
  controls.minPolarAngle = 50*Math.PI/180;
  controls.maxDistance = 200;
  controls.enabled = false;
  $('canvas').on( "mouseenter", function(e) {
    controls.enabled = true;
  });
  $('canvas').on( "mouseleave", function(e) {
    controls.enabled = false;
  });

//////////////////////////////////////////
    //   Heart
//////////////////////////////////////////

var loader = new THREE.JSONLoader();
var heart_options = {
  emissive : 0x222222,
  color: 0x000000,
  opacity: .5,
 // transparent:true
}
// load hirsch
loader.load(
  // resource URL
  "schere.js",
  // Function when resource is loaded
  function ( geometry, materials ) {
    var schere = new THREE.Mesh( geometry,new THREE.MeshBasicMaterial( {color:0xffffff} ));
      schere.scale.set(15,15,15);
      schere.position.set(0,0,50);
    var schere_wire = new THREE.Mesh( geometry.clone(),new THREE.MeshBasicMaterial( {color:stroke_color,wireframe:true} ));
      schere_wire.scale.set(15,15,15);
      schere_wire.position.set(0,0,50);
    scene.add(schere,schere_wire);
  }
);
//////////////////////////////////////////
    //   Render
//////////////////////////////////////////
function animate(){
//  scene.rotation.y += .001;
}

var render = function () { 
  requestAnimationFrame( render ); 
 
  animate();
  
  renderer.render(scene, camera);
};

//////////////////////////////////////////
    //    Start scene
//////////////////////////////////////////
render(); 


});