<?php
/**
   ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2023  by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ----------------------------------------------------------------------
 */

// Create a nonce RANDOM_VALUE
$nonce = bin2hex(random_bytes(16));
// Store the nonce RANDOM_VALUE in the session
// $_SESSION['nonce'] = $nonce;
// Send the CSP header with the nonce RANDOM_VALUE

// header("Content-Security-Policy: script-src 'nonce-$nonce' 'unsafe-eval'");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, maximum-scale=1">
    <title>Web-Based Virtual Experiences in the Metaverse</title>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="themes/metaverse/css/vr-commerce.min.css" />

	<!-- Bootstrap JS Dependencies -->
	<script nonce="<?php echo $nonce; ?>" src="themes/metaverse/js/vendor.min.js"></script>

	<!-- Virtual Experiences JS Dependencies -->
   	<script nonce="<?php echo $nonce; ?>" src="static/js/runtime-main.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/572.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/734.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/203.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/434.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/454.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/986.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/58.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/710.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/223.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/850.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/848.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/227.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/569.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/687.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/406.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/477.js"></script>
   	<script nonce="<?php echo $nonce; ?>" src="static/js/main.js"></script>

<style>
body, html {
  width: 100%;
  height: 100%;
}

body {
  background-color: #232323;
}

body.AR-container {
  margin : 0px; 
  overflow: hidden;
  background-color: none;
}

#splash {
  position: fixed;
  z-index: 99999;

  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  
  margin: auto;

  font-size: 14px;
  font-family: sans-serif;
  color: #fff;

  background-color: rgba(0, 0, 0, .99);
  transition: all 1s ease-out;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

#splash .loading {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 0.25rem solid rgba(255, 255, 255, 0.2);
  border-top-color: #fff;
  animation: spin 1s infinite linear;
}

#splash .start-button {
  padding: 10px 30px;
  border-radius: 3px;
  opacity: 0;
  transition: opacity .5s ease;
  cursor: pointer;
  background-color: #292929;
  letter-spacing: 1px;
}

.controlKeys {
  position: absolute;
  width: 7rem;
  left: 5%;
  bottom: 13%;
}

</style>
  </head>
<body>

	<div id="splash">
		<div class="loading"></div>
		<div class="start-button">Start</div>
			<div class="container-fluid ">
				<div class="row">
					<div class="col px-5" style="position: relative; margin-top: 400px;">
						<div style="position: absolute; bottom: 0;">
							<h1>MyOOS Immersive-Showroom</h2>
							<p>Weit hinten, hinter den Wortbergen, fern der Länder Vokalien und Konsonantien leben die 
							Blindtexte. Abgeschieden wohnen sie in Buchstabhausen an der Küste des Semantik, eines 
							großen Sprachozeans. Ein kleines Bächlein namens Duden fließt durch ihren Ort und 
							versorgt sie mit den nötigen Regelialien. Es ist ein paradiesmatisches Land, in dem einem 
							gebratene Satzteile in den Mund fliegen. Nicht einmal von der allmächtigen Interpunktion 
							werden die Blindtexte beherrscht – ein geradezu unorthographisches Leben. Eines Tages aber 
							beschloß eine kleine Zeile Blindtext, ihr Name war Lorem Ipsum, hinaus zu gehen in die 
							weite Grammatik.</p>
						</div>
					</div>
				<div class="col-4">
				</div>
				<div class="col px-5" style="position: relative; margin-top: 400px;">
					<div style="position: absolute; bottom: 0;">
						<img class="controlKeys" src="image/key_controls.png" alt="control keys">
					</div>
				</div>
			</div>
		</div>
	</div>


	<a-scene nonce="<?php echo $nonce; ?>" embedded="false" vr-mode-ui="enabled: true"><!-- creates a UI element for the VR mode -->

		<a-assets>
			<img id="skyTexture" src="texture/kloofendal_43d_clear_puresky.jpg" preload="auto">
			<a-asset-item id="navmesh" src="model/hall-navmesh.glb" preload="auto"></a-asset-item>
			<a-asset-item id="hall" src="model/hall.glb" preload="auto"></a-asset-item>
		<?php
		/*
			<a-asset-item id="gem" src="model/rupee.glb"></a-asset-item>
		*/
		?>
		    <audio id="sound" src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" preload="auto"></audio>
		</a-assets>
		
		<a-sky src="#skyTexture"></a-sky>
	
		<!-- Erstellen Sie ein ambient light mit einer hellgrauen Farbe -->
		<a-entity light="type: ambient; color: #CCC"></a-entity>  
		<!-- Erstellen Sie ein point light mit einer weißen Farbe an der Position -5 10 0 -->
		<a-entity light="type: point; color: #FFF; intensity: 0.8; distance: 20; decay: 2" position="-5 10 0"></a-entity> 
		<!-- Fügen Sie Ihre anderen Entitäten hinzu -->

		<!-- Player. -->
		<a-entity id="rig"
                movement-controls="constrainToNavMesh: true;
                                   controls: checkpoint, gamepad, trackpad, keyboard, touch;"
                position="-7 0 21">
			<a-entity camera
                  position="0 1.6 0"
                  look-controls="pointerLockEnabled: true"
				  rotation="0 -90 0"> 
				<a-cursor></a-cursor>
			</a-entity>
      </a-entity>
<?php
/**
		<audio id="river" src="sound/birds-singing-calm-river-nature-ambient-sound-127411.mp3" preload="auto"></audio>
      <!-- Teleport gems. -->
      <a-entity id="wall-gem"
                checkpoint="offset: 0 -0.8 0;"
                position="-9 7 -6"
                gltf-model="#gem"
                scale="0.05 0.05 0.05"
                glow="color: #33FF66; intensity: 0.5"
                levitate>
        <a-light not-mobile type="point" intensity="0.5" color="#33FF66" distance="2" position="0.5 -0.25 0"></a-light>
      </a-entity>
      <a-entity id="tower-gem"
                checkpoint="offset: 0 -0.8 0;"
                position="0 10.2 -3.5"
                gltf-model="#gem"
                scale="0.05 0.05 0.05"
                glow="color: #33FF66; intensity: 0.5"
                levitate>
        <a-light not-mobile type="point" intensity="0.5" color="#33FF66" distance="2" position="0.5 -0.25 0"></a-light>
      </a-entity>
	  <a-entity position="0 0 20" sound="src: #river; loop: true; positional: false"></a-entity>
    </a-scene>
*/
?>
      <!-- Füge einen Schalter mit der benutzerdefinierten Komponente audiohandler hinzu -->

		<a-sound src="#sound" autoplay="true" playsinline="true" position="0 2 5"></a-sound>
		<a-box sound="src: #sound; on: click"></a-box>
      <!-- Nav mesh. -->
      <a-entity nav-mesh
                visible="false"
                position="0 0 20"
                gltf-model="#navmesh"></a-entity>

      <!-- Scene. -->
      <a-entity position="0 0 20"
                scale="1 1 1"
                gltf-model="#hall">
      </a-entity>
    </a-scene>
	

<script nonce="<?php echo $nonce; ?>">
document.addEventListener('DOMContentLoaded', function() {
    const scene = document.querySelector('a-scene');
    const splash = document.querySelector('#splash');
    const loading = document.querySelector('#splash .loading');
    const startButton = document.querySelector('#splash .start-button');

    const emitEvent = (eventName, listeners) => {
        listeners.forEach((listener) => {
            const el = document.querySelector(listener);
            el.emit(eventName);
        })
    };

    const emitMediaEvent = (eventType, listeners) => {
        listeners.forEach((listener) => {
            const el = document.querySelector(listener);
            el.components.sound[eventType]();
        })
    };

    scene.addEventListener('loaded', function (e) {
        setTimeout(() => {
            loading.style.display = 'none';
            splash.style.backgroundColor = 'rgba(0, 0, 0, 0.85)';
            startButton.style.opacity = 1;
        }, 50);
    });

    startButton.addEventListener('click', function (e) {
        splash.style.display = 'none';
    });
});

var audioContext = new AudioContext();
var soundUrl = "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3";
var soundBuffer = null;
var request = new XMLHttpRequest();
request.open("GET", soundUrl, true);
request.responseType = "arraybuffer";
request.onload = function() {
  audioContext.decodeAudioData(request.response, function(buffer) {
    soundBuffer = buffer;
  });
};
request.send();

var box = document.querySelector("a-box");
box.addEventListener("click", function() {
  if (audioContext.state === "suspended") {
    audioContext.resume().then(function() {
      console.log("AudioContext resumed");
    });
  }
  if (soundBuffer) {
    var source = audioContext.createBufferSource();
    source.buffer = soundBuffer;
    source.connect(audioContext.destination);
    source.start(0);
  }
});
</script>

</body>
</html>
