<?php
/* @var $this PictureController */
/* @var $model Picture */

$this->breadcrumbs=array(
	'Pictures'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Picture', 'url'=>array('index')),
	array('label'=>'Create Picture', 'url'=>array('create')),
	array('label'=>'Update Picture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Picture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Picture', 'url'=>array('admin')),
);
?>

<h1>View Picture #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'created_on',
		'updated_on',
		'name',
		'size',
		'file_name',
	),
)); ?>
