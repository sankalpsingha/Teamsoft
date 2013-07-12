<?php
/* @var $this ProfilePictureController */
/* @var $model ProfilePicture */

$this->breadcrumbs=array(
	'Profile Pictures'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProfilePicture', 'url'=>array('index')),
	array('label'=>'Create ProfilePicture', 'url'=>array('create')),
	array('label'=>'Update ProfilePicture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProfilePicture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfilePicture', 'url'=>array('admin')),
);
?>

<h1>View ProfilePicture #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'profile_picture',
		'user_id',
		'created_on',
		'updated_on',
	),
)); ?>
