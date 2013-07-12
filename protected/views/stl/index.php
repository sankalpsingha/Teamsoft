<?php
/* @var $this StlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Stls',
);

$this->menu=array(
	array('label'=>'Create Stl', 'url'=>array('create')),
	array('label'=>'Manage Stl', 'url'=>array('admin')),
);
?>

<h1>Stls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
