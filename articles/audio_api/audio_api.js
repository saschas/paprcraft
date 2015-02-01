jQuery(document).ready(function($){
///////////////////////////////////////////////
// create Audiocontext for all modern Browser
///////////////////////////////////////////////
var context;
if (typeof AudioContext !== "undefined") {
  context = new AudioContext();
} else if (typeof webkitAudioContext !== "undefined") {
  context = new webkitAudioContext();
} else {
  //return;
}
///////////////////////////////////////////////
// Request AnimationFrame for all modern Browser
// Paul Irish http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/
///////////////////////////////////////////////
var lastTime = 0;
var vendors = ['ms', 'moz', 'webkit', 'o'];

for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
  window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
  window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
  || window[vendors[x] + 'CancelRequestAnimationFrame'];
}

if (!window.requestAnimationFrame)
  window.requestAnimationFrame = function (callback, element) {
    var currTime = new Date().getTime();
    var timeToCall = Math.max(0, 16 - (currTime - lastTime));
    var id = window.setTimeout(function () { callback(currTime + timeToCall); },
      timeToCall);
    lastTime = currTime + timeToCall;
    return id;
  };
///////////////////////////
// clear AnimationFrame
//////////////////////////
if (!window.cancelAnimationFrame)
  window.cancelAnimationFrame = function (id) {
    clearTimeout(id);
  };

///////////////////////////////////////////////
// Animation
// update Function
///////////////////////////////////////////////
// setup some Variables 
// for the Data
//////////////////////////

var $audioData = {};
var $loop;
var $rectWidth = 4;
var $offset = 50;

////////////////////////
// the Loop 
//////////////////////////
function update() {

  $loop = requestAnimationFrame(update);

  ////////////////////////
      // Analyser Data
  //////////////////////////
  analyser.getByteFrequencyData(frequencyData);
console.log(frequencyData)
   //Clear the Canvas for the next Frame
   c.fillStyle = 'rgba(40,157,238,.05)';
   c.fillRect(0,0,window.innerWidth,window.innerHeight);

   ////////////////////////
  // Barchart
  ////////////////////////// 

  var data_count = frequencyData.length;
  c.fillStyle = '#fff';
  
  var barwidth = window.innerWidth/data_count;
  for(var i=0;i<data_count;i++){
    if(frequencyData[i]!=0){
      c.font = "12px serif";
      c.fillStyle = 'rgba(255,255,255,1)';
      c.fillRect(barwidth*i,$midY*2,barwidth,-frequencyData[i]);
      c.fillStyle = 'rgba(40,157,238,1)';
      c.fillText(frequencyData[i],barwidth*i + 15,canvas.height);
      c.fillStyle = 'rgba(255,255,255,1)';
      c.fillRect((window.innerWidth-(barwidth*i)),$midY*2,barwidth,-frequencyData[i]);
      c.fillStyle = 'rgba(40,157,238,1)';
      c.fillText(frequencyData[i],(window.innerWidth-(barwidth*i)) + 15,canvas.height);
    }
  }
 ////////////////////////
  // Path Animation
  // frequencyData is the Array
  //////////////////////////
   
  c.beginPath();
  c.strokeStyle = 'tomato';
  for(var i=0;i<data_count;i++){
    if(frequencyData[i]!=0){
      c.lineTo($midX+ $midX/frequencyData.length*i, $midY + frequencyData[i]);
    }
  }
  c.stroke();

  
  ////////////////////////
  // 2nd Path Animation
  //////////////////////////     
  c.beginPath();
  for(var i=0;i<data_count;i++){
    if(frequencyData[i]!=0){
      c.lineTo($midX - $midX/frequencyData.length*i, $midY + frequencyData[i]);
    }
  }
  c.strokeStyle = 'tomato';
  c.stroke();
 ////////////////////////
  // 3nd Path Animation
  ////////////////////////// 
  c.beginPath();
  c.strokeStyle = '#eeeeee';
  for(var i=0;i<data_count;i++){
    if(frequencyData[i]!=0){
      c.lineTo($midX+ $midX/frequencyData.length*i, $midY - frequencyData[i]);
    }
  }
  c.stroke();

  ////////////////////////
  // 4nd Path Animation
  //////////////////////////  
  c.beginPath();
  c.strokeStyle = '#eeeeee';
  for(var i=0;i<data_count;i++){
    if(frequencyData[i]!=0){
      c.lineTo($midX - $midX/frequencyData.length*i,$midY - frequencyData[i]);
    }
  }
  c.stroke();
      return $loop; //returns loop for canceling
  };

///////////////////////////////////////////////
// Prepare Canvas for first use
///////////////////////////////////////////////  
var canvas = document.getElementById('c');
var $midX,$midY;
var c = canvas.getContext('2d');
////////////////////////
// Set Size for canvas
/////////////////////////
function sizer(){
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight - (window.innerHeight*0.25) + 2;
  $midX = canvas.width/2;
  $midY = canvas.height/2;
}

sizer();
////////////////////////
// onresize
// resize Canvas
/////////////////////////
window.onresize = sizer;

////////////////////////
// Initial Setup for the audio
/////////////////////////
function init(el){
  analyser = context.createAnalyser();
  analyser.fftSize = 64;
  frequencyData = new Uint8Array(analyser.frequencyBinCount);
  barSpacingPercent = 100 / analyser.frequencyBinCount;

  source = context.createMediaElementSource(el);
  source.connect(analyser);
  analyser.connect(context.destination);
  return true;
}
///////////////////////////////////////////////
// Bind to audio
// if audio is ready to play 
///////////////////////////////////////////////
var analyser, frequencyData,barSpacingPercent,source


$("#player").bind({
  progress: function(e){
    console.log(e);
  },
  canplaythrough: function() {
    $('.play-button').addClass('canplay');
  },
  play: function(){
    console.log(this.audioInit);
    if(this.audioInit===undefined){
      this.audioInit = init(this);        
    }
    $loop = update();
  },
  pause : function(){
    cancelAnimationFrame($loop);
  },
  ended :function(){
    $('.play-button').removeClass('on');
  }
});


///////////////////////////////////////////////
// Controller
// Play and Pause Button
///////////////////////////////////////////////

$('.play-button').click(function(){
  if($('#player').get(0).paused){
    $('#player').get(0).play();
    $(this).addClass('on');
  }
  else{
    $('#player').get(0).pause();
    $(this).removeClass('on');
  } 
});

});