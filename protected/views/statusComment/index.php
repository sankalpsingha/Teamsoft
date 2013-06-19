<?php
/* @var $this StatusCommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Status Comments',
);

$this->menu=array(
	array('label'=>'Create StatusComment', 'url'=>array('create')),
	array('label'=>'Manage StatusComment', 'url'=>array('admin')),
);
?>

<h1>Status Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
