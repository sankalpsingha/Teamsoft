<?php
/* @var $this ProfilePictureController */
/* @var $model ProfilePicture */

$this->breadcrumbs=array(
	'Profile Pictures'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfilePicture', 'url'=>array('index')),
	array('label'=>'Create ProfilePicture', 'url'=>array('create')),
	array('label'=>'View ProfilePicture', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProfilePicture', 'url'=>array('admin')),
);
?>

<h1>Update ProfilePicture <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>