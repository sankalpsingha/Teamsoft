<?php
/* @var $this MoneyController */
/* @var $model Money */

$this->breadcrumbs=array(
	'Moneys'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Money', 'url'=>array('index')),
	array('label'=>'Create Money', 'url'=>array('create')),
	array('label'=>'View Money', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Money', 'url'=>array('admin')),
);
?>

<h1>Update Money <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>