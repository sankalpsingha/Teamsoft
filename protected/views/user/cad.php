<style>
  body{
 background-image:url(bk.png);
  }
  h1{
    text-align: center;
  }
   h2{
    text-align: center;
  }
   /*.chromeFrameInstallDefaultStyle {
     margin-top: 10px;
     width: 800px;
     border: 5px solid blue;
   }*/
  </style>


  <?php 
  $myScript = "<script>
    window.onload = function() {
      // You may want to place these lines inside an onload handler
      CFInstall.check({
        mode: \"inline\", // the default
        node: \"prompt\"
      });

      thingiurlbase = \"../javascripts\";
      thingiview = new Thingiview(\"viewer\");
      thingiview.setObjectColor('#C0D8F0');
      thingiview.initScene();
      // thingiview.setShowPlane(true);
      if (getUrlVars()[\"stl\"]) {
        thingiview.loadSTL(getUrlVars()[\"stl\"]);
      } else {
        // thingiview.loadSTL(\"../examples/objects/cube.stl\");
       // thingiview.loadPLY(\"../examples/objects/gnome_ascii.ply\");
      }
    }
    
    function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
      });
      return vars;
    }    
  </script>";

  Yii::app()->clientScript->registerScript('3dView',$myScript,CClientScript::POS_READY);
   ?>