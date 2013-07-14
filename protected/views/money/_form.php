<?php
/* @var $this MoneyController */
/* @var $model Money */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'money-form',
	// 'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'amount'); ?>
	

	
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'reason'); ?>
	
<div class="row-fluid">
	
		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'success',
                        'label'=>'Submit Amount',
                        'url' => $this->createUrl('money/create'),
                )); ?>
</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->