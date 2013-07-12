<?php
/* @var $this ProfilePictureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Profile Pictures',
);

$this->menu=array(
	array('label'=>'Create ProfilePicture', 'url'=>array('create')),
	array('label'=>'Manage ProfilePicture', 'url'=>array('admin')),
);
?>

<h1>Profile Pictures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
