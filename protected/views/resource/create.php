<?php
/* @var $this ResourceController */
/* @var $model Resource */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Resource', 'url'=>array('index')),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>Create Resource</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>