import * as AFRAME from 'aframe';


require('aframe-extras');
require('aframe-physics-system');
require('aframe-blink-controls');
require('super-hands');


// On click, send the NPC to the target location.
AFRAME.registerComponent('nav-pointer', {
  init: function () {
    const el = this.el;
      
      // On click, send the NPC to the target location.
      el.addEventListener('click', (e) => {
        const ctrlEl = el.sceneEl.querySelector('[nav-agent]');
        ctrlEl.setAttribute('nav-agent', {
          active: true,
            destination: e.detail.intersection.point
        });
      });
      
      // When hovering on the nav mesh, show a green cursor.
      el.addEventListener('mouseenter', () => {
        el.setAttribute('material', {color: 'green'});
      });
      el.addEventListener('mouseleave', () => {
        el.setAttribute('material', {color: 'crimson'})
      });
      
      // Refresh the raycaster after models load.
      el.sceneEl.addEventListener('object3dset', () => {
        this.el.components.raycaster.refreshObjects();
      });
    }
});


/**
 * Basic emissive effect.
 */
AFRAME.registerComponent('glow', {
  schema: {
    color: {default: '#ffffff', type: 'color'},
    intensity: {default: 1.0}
  },
  init: function () {
    this.el.addEventListener('object3dset', function () {
      this.update();
    }.bind(this));
  },
  update: function () {
    var data = this.data;
    this.el.object3D.traverse(function (node) {
      if (node.isMesh) {
        node.material.emissive.copy(new THREE.Color(data.color));
        node.material.emissiveIntensity = data.intensity;
      }
    });
  }
});

/**
 * Simple spin-and-levitate animation.
 */
AFRAME.registerComponent('levitate', {
  tick: function (t, dt) {
    var mesh = this.el.getObject3D('mesh');
    if (!mesh) return;
    mesh.rotation.y += 0.1 * dt / 1000;
    mesh.position.y = 0.25 * Math.sin(t / 1000);
  }
});

/**
 * Removes current element if on a mobile device.
 */
AFRAME.registerComponent('not-mobile',  {
  init: function () {
    var el = this.el;
    if (el.sceneEl.isMobile) {
      el.parentEl.remove(el);
    }
  }
});