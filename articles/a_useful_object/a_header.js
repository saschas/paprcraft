jQuery(document).ready(function($){
var main_color = 0x009EF2;

var canvas_height = (window.innerHeight-(window.innerHeight/4));
var canvas_width = window.innerWidth;
//////////////////////////////////////////
    //   Scene
//////////////////////////////////////////
var scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2( main_color, 0.0005 );

//////////////////////////////////////////
    //   Camera
//////////////////////////////////////////
var camera = new THREE.PerspectiveCamera( 75, canvas_width/canvas_height, 0.1, 1000 );
    camera.lookAt(new THREE.Vector3(0,50,0));
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
    spotLight.shadowMapWidth = 1280; // default is 512
	spotLight.shadowMapHeight = 1280; // default is 512
    scene.add(spotLight);
//////////////////////////////////////////
    //    Text
//////////////////////////////////////////
/*
// 3D TEXT    
var materialFront = new THREE.MeshBasicMaterial({
    color: 0xffffff
});
var materialSide = new THREE.MeshBasicMaterial({
    color: 0x000000
});
var materialArray = [materialFront, materialSide];
var textGeom = new THREE.TextGeometry("a", {
    size: 50,
    height: 4,
    curveSegments: 3,
    font: "helvetiker",
    weight: "normal",
    style: "normal",
    bevelThickness: 1,
    bevelSize: 1,
    bevelEnabled: true,
    material: 0,
    extrudeMaterial: 1
});
// font: helvetiker, gentilis, droid sans, droid serif, optimer
// weight: normal, bold

var textMaterial = new THREE.MeshFaceMaterial(materialArray);
var textMesh = new THREE.Mesh(textGeom, textMaterial);

textGeom.computeBoundingBox();
var textWidth = textGeom.boundingBox.max.x - textGeom.boundingBox.min.x;

scene.add(textMesh);
*/
var loader = new THREE.JSONLoader();
// load a
loader.load(
  // resource URL
  "a.js",
  // Function when resource is loaded
  function ( geometry, materials ) {
    var a = new THREE.Mesh( geometry,new THREE.MeshBasicMaterial( {color:0xffffff} ));
     	a.scale.set(12,12,12);
     	a.rotation.x = Math.PI/2;
      	a.position.set(0,130,0);
      	a.receiveShadow = true;
      	a.castShadow = true;
    scene.add(a);

  }
);



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

}
//////////////////////////////////////////
    //    Start scene
//////////////////////////////////////////
render(); 

});