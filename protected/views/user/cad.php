<style>
  body{

 background-image:url(<?php echo Yii::app()->baseUrl.'/img/bk.png' ?>);

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

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
 
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/CFInstall.min.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/Three.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/plane.js'); ?>
  <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/thingiview.js'); ?>
  <script>
    window.onload = function() {
      // You may want to place these lines inside an onload handler
      CFInstall.check({
        mode: "inline", // the default
        node: "prompt"
      });

      thingiurlbase = <?php echo "\"".Yii::app()->baseUrl.'/js"' ?>;
      thingiview = new Thingiview("viewer");
      thingiview.setObjectColor('#C0D8F0');
      thingiview.initScene();
      // thingiview.setShowPlane(true);
      if (getUrlVars()["stl"]) {
        thingiview.loadSTL(getUrlVars()["stl"]);
      } else {
        // thingiview.loadSTL("../examples/objects/cube.stl");
       // thingiview.loadPLY("../examples/objects/gnome_ascii.ply");

      }
    }
    
    function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
      });
      return vars;
    }    

  </script>


  <div class="prompt">
  <!-- if IE without GCF, prompt goes here -->
</div>


<header>

  <h1>CADD Models</h1>
  <h2 class="muted">Client Side Ajax Examples</h2>
</header>


<div id="sidebar" style="float:right;width:40%">
  
  <h3 class="text-success" >BINARY STL Files</h3>
      <table class="table table-striped">
      
      <?php foreach ($cad as $key): ?>
         <tr>
        <td> <?php echo $key->original_name; ?></td>
        <td><a href="#" onclick="thingiview.loadSTL(<?php echo '\''.$this->createAbsoluteUrl('/files').'/'.$key->name.'\''; ?>)">render</a> </td>
        <td> <a href=<?php echo '\''.$this->createAbsoluteUrl('/files').'/'.$key->name.'\''; ?>>download</a> </td>
      </tr>
      <?php endforeach ?>
    </table>  
</div>


<p>
  <button class="btn btn-warning " onclick="thingiview.setCameraView('top');">Top</button>
  <button class="btn btn-warning " onclick="thingiview.setCameraView('side');">Side</button>
   <button class="btn btn-primary " onclick="thingiview.setCameraView('bottom');">Bottom</button>
  <button class="btn btn-primary " onclick="thingiview.setCameraView('diagonal');">Diagonal</button>
  <button class="btn btn-success " onclick="thingiview.setCameraZoom(5);">Zoom +</button>
 
  <button class="btn btn-success " onclick="thingiview.setCameraZoom(-5);">Zoom -</button> 
  
 
  Rotation:<button class="btn btn-danger " onclick="thingiview.setRotation(true);">On</button>  | <button class="btn btn-danger " onclick="thingiview.setRotation(false);">Off</button>
</p>


<div id="viewer" style="width:50%;height:400px"></div>

<p style="padding-top:10px;">
  <button class="btn btn-inverse " onclick="thingiview.setObjectMaterial('wireframe');">Wireframe</button> 
  <button class="btn btn-inverse " onclick="thingiview.setObjectMaterial('solid');">Solid</button>
  
  
</p>



<div>
<p>
  Plane: <a href="#" onclick="thingiview.setShowPlane(false)">Hide</a> | <a href="#" onclick="thingiview.setShowPlane(true)">Show</a><br/>
  Background Color: <a href="#" onclick="thingiview.setBackgroundColor('#606060')">Gray</a> | <a href="#" onclick="thingiview.setBackgroundColor('#ffffff')">White</a> | <a href="#" onclick="thingiview.setBackgroundColor('#000000')">Black</a><br/>
  Object Color: <a href="#" onclick="thingiview.setObjectColor('#ffffff')">White</a> | <a href="#" onclick="thingiview.setObjectColor('#aa0000')">Red</a> | <a href="#" onclick="thingiview.setObjectColor('#CDFECD')">Green</a> | <a href="#" onclick="thingiview.setObjectColor('#C0D8F0')">Blue</a><br/>
</p>
</div>

