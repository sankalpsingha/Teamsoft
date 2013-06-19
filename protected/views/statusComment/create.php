<?php
/* @var $this StatusCommentController */
/* @var $model StatusComment */

$this->breadcrumbs=array(
	'Status Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StatusComment', 'url'=>array('index')),
	array('label'=>'Manage StatusComment', 'url'=>array('admin')),
);
?>

<h1>Create StatusComment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>