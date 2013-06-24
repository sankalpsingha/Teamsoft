<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Gallery',
);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap-image-gallery.min.css');
?>

<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
    </div>
</div>


<div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery">
	<?php foreach ($images as $image): ?>
		<a href="<?php echo '/teamsoft/files/'.$image["file_name"]; ?>" title="Banana" data-gallery="gallery"><img src="<?php echo '/teamsoft/files/'.$image["file_name"]; ?>" alt="Banana"></a>
	<?php endforeach ?>
</div>
<?php //echo __FILE__; ?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/load-image.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-image-gallery.min.js');
?>
