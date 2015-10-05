jQuery(document).ready(function($){
var å = {
  data: {},
  size: 10,
  store_data : function(data){
    this.data = data;
  },
  calculate_stripes : function(count){
    if(!count){
      //console.warn('Missing Number! How many stripes do you wanna have?')
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
      //console.log('stripes count: '+ this.stripes_count)
      return false;
    }
    else{
      return false;
    }
  },
  loop : false,
  // Get the next stripes of data
  get_next_stripe : function () {
    var curr = 0;
    if(this.stripes_count != 0){
      curr = this.stripes_data.length - this.stripes_count;
     // console.log(curr, this.stripes_data.length,this.stripes_count,this.stripes_data[curr]);
      this.stripes_count--;
      if(this.stripes_data[curr]){
        return this.stripes_data[curr];
      }
      else{
        //console.log('there are no prev data stripes');
        return false;
      }
    }
    else{
      if(this.loop){        
        this.stripes_count = this.stripes_data.length;
        if(!this.stripes_data[0]){
          //console.warn('No stripes! Generate new .stripes() first!');
          return false;
        }
        else{
          //console.log('looop')
          return this.stripes_data[0];
        }
      }
      else{
        //console.log('ende');
        return false;
      }
    }   
  },
  // Get the prev stripes of data
  get_prev_stripe : function () {
    if(this.stripes_count != 0){
      if(this.stripes_count === this.stripes_data.length ){
       // console.warn('there are no prev data stripes');
      }
      else{
        this.stripes_count++;
        var curr = this.stripes_data.length-this.stripes_count;
        //console.log(this.stripes_data[curr]);
        return this.stripes_data[curr];
      }
    }
    else{
      //console.warn('run .stripes() first!');
    }   
  }
}
//////////////////////////////////////////////////////
//// User Option
//////////////////////////////////////////////////////
var userOpts  = {
  ready       : false,
  play        : false,
  range   : 1,
  duration  : 2500,
  delay   : 200,
  easing    : 'Elastic.EaseInOut',
  camera : {
    x : 0,
    y : 20,
    z : 50,
    target : {
     x : 0,
     y : 10,
     z : -40,
   },
   orbit : {
    rotateSpeed : 0.1,
    keyPanSpeed : 0.001,
    maxPolarAngle : Math.PI/2,
    center : new THREE.Vector3(0,0,0)
  },
  fly : {
    movementSpeed : 1,
    rollSpeed : 0.01,
    autoForward : false,
    dragToLook : true
  }
},

};
//////////////////////////////////////////////////////
////Loading Stack
//////////////////////////////////////////////////////
var models_to_update = [];
function loading_stack(audioData){
  
 
  //var particle = new particle_obj(audioData,100);
  var terrain = new terrain_obj(audioData,10);

  models_to_update = [
  // particle
     terrain
  ]
  //console.log(models_to_update);


}
//////////////////////////////////////////////////////
//// Audio Data
//////////////////////////////////////////////////////

var audioData = {}

$.ajax({
  dataType: "json",
  url: "js/audioData_4.json",
  success: function(data){

  userOpts.ready = true;

  å.store_data(data);

  // übergibt das gesamte Object Array[1468];  
  loading_stack(å);
  
  }
});


var main_color = 0xffffff;

var canvas_height = (window.innerHeight-(window.innerHeight/4));
var canvas_width = window.innerWidth;
//////////////////////////////////////////
    //   Scene
//////////////////////////////////////////
var scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2( main_color, 0.015 );

//////////////////////////////////////////
    //   Camera
//////////////////////////////////////////
var camera = new THREE.PerspectiveCamera( 55, canvas_width/canvas_height, 0.1, 1000 );
    camera.lookAt(new THREE.Vector3(0,0,0));
    camera.position.set(80,10,20);

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
  //controls.minPolarAngle = 1;
  controls.minDistance = 100;
  controls.maxDistance = 400;
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

function terrain_obj(data,count){
  
  data.stripes(count);
  this.terrain_geometry =  new THREE.PlaneGeometry(100, å.data.length * 1.5, 63,å.data.length);
  this.terrain_material = new THREE.MeshBasicMaterial({
    color: 0x222222
  });
  this.terrain_wire_material = new THREE.MeshBasicMaterial({
    color: 0x666666, 
    wireframe: true
  });
  this.total = 0;
  this.stripe_count = count;
  this.color_count = 0;
  this.set_vertices = true;
  this.colors = [];
  this.terrain_wire = null;
  this.generate = function(){
   
    this.stripes = data.get_next_stripe();
    if(this.stripes){
      for(var i=0;i<this.stripes.length;i++){
        for(var j=32;j>0;j--){
          this.total++;
          this.terrain_geometry.vertices[this.total].z = this.stripes[i][j] * .05;
        }       
        for(var k=0;k<32;k++){
          this.total++;
           this.terrain_geometry.vertices[this.total].z = this.stripes[i][k] * .05;
        }
      }
      this.generate();
    }
    else{
      this.terrain =  new THREE.Mesh(this.terrain_geometry,this.terrain_material);
      this.terrain_wire =  new THREE.Mesh(this.terrain_geometry.clone(),this.terrain_wire_material);
      this.terrain.rotation.x = -Math.PI / 2;
      this.terrain.rotation.z = -Math.PI / 2;
      this.terrain.scale.set(.8,.8,.8);
      this.terrain_wire.scale.set(.8,.8,.8);
      this.terrain_wire.rotation.x = -Math.PI / 2;
      this.terrain_wire.rotation.z = -Math.PI / 2;
      
      this.terrain_wire.position.y = .01;
      
      this.terrain.position.x = 90;
      this.terrain_wire.position.x = 90;
      scene.add(this.terrain,this.terrain_wire);
      return this;
    }

  //  console.log(this.total);
  };

  

  this.update = function(){   
  };
  this.generate();
  return this;
}
//////////////////////////////////////////
    //   Floor
//////////////////////////////////////////
var plane_options = {
  width : window.innerWidth,
  height : window.innerHeight,
  position : {
    x : 0,
    y : .25,
    z : 0
  }
}
var $phongMaterialOptions = {
  color : 0xffffff,
  //ambient : 0xffffff,
  // specular : 0,
  // shininess : 0x000000,
  // wireframe : false
}

var plane_geometry = new THREE.PlaneBufferGeometry( plane_options.width, plane_options.height, 32 );
var plane_material = new THREE.MeshBasicMaterial($phongMaterialOptions); 
var plane = new THREE.Mesh( plane_geometry, plane_material ); 
  plane.rotation.x = -Math.PI/2;
  plane.position.x = plane_options.position.x;
  plane.position.y = plane_options.position.y;
  plane.position.z = plane_options.position.z;
  plane.receiveShadow = true;
  scene.add( plane );
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