<?php
/* @var $this StatusCommentController */
/* @var $model StatusComment */

$this->breadcrumbs=array(
	'Status Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StatusComment', 'url'=>array('index')),
	array('label'=>'Create StatusComment', 'url'=>array('create')),
	array('label'=>'Update StatusComment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StatusComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StatusComment', 'url'=>array('admin')),
);
?>

<h1>View StatusComment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
		'created_on',
		'updated_on',
		'user_agent',
		'ip',
		'user_id',
		'status_id',
	),
)); ?>
