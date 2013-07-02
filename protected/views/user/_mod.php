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
            'user_id',
        ),
    ));
}
?>