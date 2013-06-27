<?php
/* @var $this PictureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pictures',
);

$this->menu=array(
	array('label'=>'Create Picture', 'url'=>array('create')),
	array('label'=>'Manage Picture', 'url'=>array('admin')),
);
?>

<h1>Pictures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
