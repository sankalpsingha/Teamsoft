<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Module Users',
);

// $status = new CActiveDataProvider('Status', array('pagination' => array('pageSize' => 5),));
if($module != null) {
    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        'dataProvider'=>$data,
        'columns' => array(
            'id',
            'name',
            array(
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name' => 'active',
                'editable' => array(
                    'type' => 'select',
                    'attribute' => 'active',
                    'source' =>  array('Normal', 'Tagged'),
                    'url' => $this->createUrl('user/toggle'),
                ),
            ),
        ),
    ));

    echo "Modules <br>";
    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        'dataProvider'=>$module,
        'columns' => array(
            'id',
            'category',
            array(
                'header' => 'Create ToDo',
                'class' => 'CButtonColumn',
                'template' => '{todo}',
                'buttons' => array(
                    'todo' => array(
                        'label' => 'Create ToDo',
                        'url' => 'CHtml::normalizeUrl(array(\'/todo/create\', \'id\' => $data->id))',
                    ),
                ),
            ),
            array(
                'header' => 'Add Users',
                'class' => 'CButtonColumn',
                'template' => '{users}',
                'buttons' => array(
                    'users' => array(
                        'label' => 'Add Users',
                        'url' => 'CHtml::normalizeUrl(array(\'/todo/create\', \'id\' => $data->id))',
                    ),
                ),
            ),
        ),        
    ));
} else {
    echo 'There is no module under you right now';
}

if($complaints != null) {
    echo "Complaints";
    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
        'dataProvider' => $complaints,
        'columns' => array(
            'complaint',
            'id',
            'user.name',
        ),
    ));
}
?>