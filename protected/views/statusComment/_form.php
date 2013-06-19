<?php
/* @var $this StatusCommentController */
/* @var $model StatusComment */
/* @var $form bootstrap.widgets.TbActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'status-comment-form',
	'enableAjaxValidation'=>false,
	'action' => '/statusComment/create/'.$id,
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php //echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content', array('class' => 'span12', 'placeholder' => 'Enter your comment here...')); ?>
		<?php echo $form->error($model,'content'); ?>

	<!-- <div class="row buttons"> -->
		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'success',
                        'size' => 'mini',
                        'label'=>'Post Comment',
                        'icon' => 'icon-comment',
                )
            ); 
        ?>
	<!-- </div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->