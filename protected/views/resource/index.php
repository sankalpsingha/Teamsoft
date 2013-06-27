<?php
/* @var $this ResourceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Resources',
);

$this->menu=array(
	array('label'=>'Create Resource', 'url'=>array('create')),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>Resources</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
