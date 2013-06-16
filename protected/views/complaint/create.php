<?php
/* @var $this ComplaintController */
/* @var $model Complaint */

$this->breadcrumbs=array(
	'Complaints'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Complaint', 'url'=>array('index')),
	array('label'=>'Manage Complaint', 'url'=>array('admin')),
);
?>

<h1>Create Complaint</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>