<?php if(!isset(Yii::app()->session['flagged'])) {
	$this->redirect(array('site/login'));
} ?>
<?php $this->breadcrumbs=array(
	'Users'=>array('flagged'),
	'Flagged',
); 
?>
<?php if($todo != null): ?>
Submitting report for Todo -> <?php echo $todo->todocol; ?>
<?php $this->renderPartial('_taggedTodo', array('model' => $reportTodo)); ?>
<?php endif; ?>
<?php if($todo == null): ?>
	Wait for your Todo report's approval from the Moderator.
<?php endif; ?>
<?php 
unset(Yii::app()->session['flagged']);
?>