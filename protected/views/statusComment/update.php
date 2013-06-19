<?php
/* @var $this StatusCommentController */
/* @var $model StatusComment */

$this->breadcrumbs=array(
	'Status Comments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StatusComment', 'url'=>array('index')),
	array('label'=>'Create StatusComment', 'url'=>array('create')),
	array('label'=>'View StatusComment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StatusComment', 'url'=>array('admin')),
);
?>

<h1>Update StatusComment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>