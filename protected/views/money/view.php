<?php
/* @var $this MoneyController */
/* @var $model Money */

$this->breadcrumbs=array(
	'Moneys'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Money', 'url'=>array('index')),
	array('label'=>'Create Money', 'url'=>array('create')),
	array('label'=>'Update Money', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Money', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Money', 'url'=>array('admin')),
);
?>

<h1>View Money #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'amount',
		'reason',
		'created_on',
		'updated_on',
		'user_id',
	),
)); ?>
