<?php
/* @var $this MoneyController */
/* @var $model Money */

$this->breadcrumbs=array(
	'Moneys'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Money', 'url'=>array('index')),
	array('label'=>'Manage Money', 'url'=>array('admin')),
);
?>

<h1>Create Money</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>