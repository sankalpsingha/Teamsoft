<?php
/* @var $this ProfilePictureController */
/* @var $model ProfilePicture */

$this->breadcrumbs=array(
	'Profile Pictures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProfilePicture', 'url'=>array('index')),
	array('label'=>'Manage ProfilePicture', 'url'=>array('admin')),
);
?>

<h1>Create ProfilePicture</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>