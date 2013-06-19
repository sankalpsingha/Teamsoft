<?php
/* @var $this ComplaintController */
/* @var $model Complaint */

$this->breadcrumbs=array(
	'Complaints'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Complaint', 'url'=>array('index')),
	array('label'=>'Create Complaint', 'url'=>array('create')),
	array('label'=>'Update Complaint', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Complaint', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Complaint', 'url'=>array('admin')),
);
?>

<h1>View Complaint #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'complaint',
		'created_on',
		'updated_on',
		'user_agent',
		'ip',
		'user_id',
	),
)); ?>
