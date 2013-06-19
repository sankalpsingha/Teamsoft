<?php
/* @var $this ModuleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Modules',
);

$this->menu=array(
	array('label'=>'Create Module', 'url'=>array('create')),
	array('label'=>'Manage Module', 'url'=>array('admin')),
);
?>

<h1>Modules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
