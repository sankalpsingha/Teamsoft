<?php
/* @var $this ComplaintController */
/* @var $model Complaint */

$this->breadcrumbs=array(
	'Complaints'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Complaint', 'url'=>array('index')),
	array('label'=>'Create Complaint', 'url'=>array('create')),
	array('label'=>'View Complaint', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Complaint', 'url'=>array('admin')),
);
?>

<h1>Update Complaint <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>