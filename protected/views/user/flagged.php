<?php if(!isset(Yii::app()->session['flagged'])) {
	$this->redirect(array('site/login'));
} ?>
<?php $this->breadcrumbs=array(
	'Users'=>array('flagged'),
	'Flagged',
); 
?>
<?php foreach ($todo as $value): ?>
	Submitting report for Todo -> <?php echo $value->todocol; ?>
	<?php $this->renderPartial('_taggedTodo', array('model' => $reportTodo, 'id' => $value->id)); ?>
<?php endforeach ?>
<?php 
unset(Yii::app()->session['flagged']);
unset(Yii::app()->session['flagged_id']);
?>