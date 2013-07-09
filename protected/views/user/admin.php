<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);


?>

<h1>Admin Page</h1>

<hr>

<h2>Complaints :</h2>
<p class="lead">View all the complaints :</p>
<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(
	'type' => 'striped bordered hover',
	'dataProvider' => $complaints,
	// 'filter' => $complaints,
	'json' => true,
	'columns' => array(
		'complaint',
		'created_on',
		array(
			'name' => 'user.name',
			'header' => 'User'
			),
		)
	));
?>

<h2>Users</h2>
<p class="lead">User Management</p>

<div class="pull-right" style="margin-bottom:10px;">
	<?php $this->widget('bootstrap.widgets.TbButton',array(
	'buttonType' => 'link',
	'type' => 'primary',
	'url' => $this->createUrl('module/create'),
	'label' => 'Create Module',
	'icon' => 'tag',
	)) ?>
</div>

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

<hr>

<h2>Modules</h2>
<p class="lead">Module Management</p>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(

	'type' => 'striped bordered hover',
	'dataProvider' => $module,
	'columns' => array(
		'category',
		'description',
		'created_on',
		array(
			'header' => 'Moderator',
			'name' => 'user.name',
		),
		array(
			'header' => 'Add Users',
			'class' => 'CButtonColumn',
			'template' => '{users}',
			'buttons' => array(
				'users' => array(
					'label' => 'Add Users',
					'url' => 'CHtml::normalizeUrl(array(\'module/addusers\', \'id\' => $data->id))',
				),
			),
		),
		array(
			'header' => 'Add ToDo',
			'class' => 'CButtonColumn',
			'template' => '{todo}',
			'buttons' => array(
				'todo' => array(
					'label' => 'Add Todo',
					'url' => 'CHtml::normalizeUrl(array(\'todo/create\', \'id\' => $data->id))',
				),
			),
		),
	)
));
?>

	<hr>

<h2>To Do's</h2>
<p class="lead">To Do Management</p>

<?php $this->widget('bootstrap.widgets.TbJsonGridView',array(

	'type' => 'striped bordered hover',
	'dataProvider' => $todo->search(),
	'columns' => array(
		'todocol',
		'created_on',
		'deadline',
		'module_id',
		'description',
		array(
			'name'=>'completed',
			'header'=>'Incomplete/Complete',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'select', 
				//'mode'=>'inline',
				'model'=>$todo,
				'attribute' => 'completed',
				'source' => $todo->getTodoStatus(),
				'url' => $this->createUrl('todo/statuschange'),
				)
			),
		)
	));
	?>