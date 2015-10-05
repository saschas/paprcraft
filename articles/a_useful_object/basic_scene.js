jQuery(document).ready(function($){


var main_color = 0x0584C7;

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
    camera.lookAt(new THREE.Vector3(0,50,0));
    camera.position.set(0,50,200);
//////////////////////////////////////////
    //   Renderer
//////////////////////////////////////////
var renderer = new THREE.WebGLRenderer({ alpha: true }); /// { alpha: true }
    renderer.setSize( canvas_width, canvas_height );
    renderer.shadowMapEnabled = true;
    renderer.shadowMapType = THREE.PCFSoftShadowMap;
    renderer.setClearColor(main_color,1);
    renderer.domElement.className = 'header_canvas';
$('header').append( renderer.domElement );


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
  controls.minPolarAngle = 1;
  controls.minDistance = 100;
  controls.maxDistance = 220;
  controls.enabled = false;
  $('canvas').on( "mouseenter", function(e) {
    controls.enabled = true;
  });
  $('canvas').on( "mouseleave", function(e) {
    controls.enabled = false;
  });
//////////////////////////////////////////
    //    Light
//////////////////////////////////////////
var spotLight = new THREE.SpotLight(0xffffff);
    spotLight.position.set( 0, 100, 100 );
    spotLight.intensity = 1;
    spotLight.castShadow = true;
    scene.add(spotLight);

//////////////////////////////////////////
    //    Cubes
//////////////////////////////////////////

var base_material = new THREE.MeshLambertMaterial( { color: 0xffffff } );
var box = new THREE.BoxGeometry( 5, 5, 5 );

var group = new THREE.Object3D();


for ( var i = 0; i < 500; i ++ ) {

          var mesh = new THREE.Mesh( box , base_material );
          mesh.position.x = ( Math.random() - 0.5 ) * 500;
          mesh.position.y = ( Math.random() - 0.5 ) * 500;
          mesh.position.z = ( Math.random() - 0.5 ) * 500;
          mesh.updateMatrix();
          mesh.matrixAutoUpdate = false;
          scene.add( mesh );

        }
//////////////////////////////////////////
    //   Render
//////////////////////////////////////////
var render = function () { 
  requestAnimationFrame( render ); 
  animation();
  renderer.render(scene, camera);
};
//////////////////////////////////////////
    //    Animation
//////////////////////////////////////////
function animation(){
  scene.rotation.y  -= .0005;
}
//////////////////////////////////////////
    //    Start scene
//////////////////////////////////////////
render(); 


//////////////////////////////////////////
/////Text transform
//////////////////////////////////////////
var text_el = $('.overlay .rotate');
var texttorotate = text_el.text();
text_el.empty();
var newtext = texttorotate.split('');
newtext.forEach(function(el){
  text_el.append('<span>'+el+'</span>')
});

});