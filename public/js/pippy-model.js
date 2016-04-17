console.log('loading html5.js');

function initHTML5() {
  var container, $container;
  var renderer, camera, scene, light;
  var shield;
  var shieldRotation;

  init();
  animate();

  function init() {
    container = document.getElementById('pippy-model');
    $container = $(container);
      console.log($container);

    camera = new THREE.PerspectiveCamera( 20, $container.width() / $container.height(), 1, 10000 );
    camera.position.z = 700;
    camera.position.x = 1700;

    scene = new THREE.Scene();

    light = new THREE.DirectionalLight( 0xffffff );
    light.position.set( 0, 0, 1 );
    scene.add( light );

    var loader = new THREE.JSONLoader();
    loader.load("public/models/pippy_v1.js", function(geometry, materials) {
      var material = new THREE.MeshFaceMaterial(materials).materials[0];
      material.color.setHex(0xffffff);
      material.ambient.setHex(0x000000);
      material.shininess = 100;
      material.shading = THREE.FlatShading;

      material.map.minFilter = THREE.LinearFilter;
      material.map.magFilter = THREE.LinearFilter;

      shield = new THREE.Mesh(geometry, material);
      shield.scale.set(0.8, 0.8, 0.8);
      scene.add(shield);
    });

    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize($container.width(), $container.height());

    container.appendChild( renderer.domElement );

    var $pippyform = $('#pippy-app');
    var anim = new Tweenable();
      
    $pippyform.focusout(function(){
      var destAngle = shield.rotation.y > Math.PI ? 2 * Math.PI : 0;
      var currentScale = shield.scale.x;

      anim.stop();
      anim.tween({
        from: { scale: currentScale, angle: shield.rotation.y },
        to: { scale: 0.8, angle: destAngle },
        duration: 500,
        easing: 'easeOutQuad',
        step: function() {
          shield.scale.set(this.scale, this.scale, this.scale);
          shield.rotation.y = this.angle;
        }
      });
      shieldRotation = false;
    });
      
    $pippyform.focusin(function() {
      anim.stop();
      anim.tween({
        from: { scale: 0.8 },
        to: { scale: 1.5 },
        duration: 500,
        easing: 'easeOutQuad',
        step: function() {
          shield.scale.set(this.scale, this.scale, this.scale);
        }
      });
      shieldRotation = true;
    });
      
    $('#showhide').click(function(){
        $('#pippy-app').slideToggle();
    });
  }

  function animate() {
    requestAnimationFrame( animate );
    if (shieldRotation) {
      shield.rotation.y += deg2rad(0.5);
      if (shield.rotation.y > 2 * Math.PI) {
        shield.rotation.y = 0;
      }
    }
    render();
  }

  function render() {
    camera.lookAt( scene.position );

    renderer.render( scene, camera );
  }
}
    
console.log('html5.js loaded');