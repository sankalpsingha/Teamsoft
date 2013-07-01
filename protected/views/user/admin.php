<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);


?>

<h1>Admin Page</h1>
<p class="lead">User Management</p>


<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(

	'type' => 'striped bordered hover',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
	'cacheTTLType' => 's', // type can be of seconds, minutes or hours
	//'pager' => array('pageSize' => 1,),

	'columns' => array( 
		array(
			'name'=>'name', 
			'header' => 'First Name',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'text', 
				'mode'=>'inline',
				'url' => $this->createUrl('user/updateinfo'))
			),
		array(
			'name' =>'lastname',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'text', 
				'mode'=>'inline',
				'url' => $this->createUrl('user/updateinfo'))
			),
		array(
			'name'=>'course',
			'header' => 'Course',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'text', 
				'mode'=>'inline',
				'url' => $this->createUrl('user/updateinfo'))
			
			),
		'username',
		array(
			'name'=>'active',
			'header'=>'Banned/Flagged',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'select', 
				//'mode'=>'inline',
				'model'=>$model,
				'attribute' => 'power',
				'source' => $model->getBannedStatus(),
				'url' => $this->createUrl('user/powerchange'),
				)
			),
		array(
			'name'=>'power',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'select', 
				//'mode'=>'inline',
				'model'=>$model,
				'attribute' => 'power',
				'source' => $model->getUserPower(),
				'url' => $this->createUrl('user/powerchange'),
			),

			),
		array(
			'name'=>'ban', 
			'header'=>'Active/Inactive', 
			'class'=>'bootstrap.widgets.TbToggleColumn', 
			'toggleAction'=>'user/toggle'
			),

			
			'email'
		),

)) ?>
