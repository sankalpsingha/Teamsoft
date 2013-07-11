<?php
/* @var $this ComplaintController */
/* @var $model Complaint */

// $this->breadcrumbs=array(
// 	'Complaints'=>array('index'),
// 	'Create',
// );

// $this->menu=array(
// 	array('label'=>'List Complaint', 'url'=>array('index')),
// 	array('label'=>'Manage Complaint', 'url'=>array('admin')),
// );
?>


<div class="span6 offset3" >
	<div class="well">
<h2 class="text-success">Create Complaint</h2>


					
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

	</div>
	
</div>