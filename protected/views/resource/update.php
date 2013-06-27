<?php
/* @var $this ResourceController */
/* @var $model Resource */

$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Resource', 'url'=>array('index')),
	array('label'=>'Create Resource', 'url'=>array('create')),
	array('label'=>'View Resource', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>Update Resource <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>