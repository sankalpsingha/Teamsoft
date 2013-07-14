<?php
/* @var $this StatusController */
/* @var $model Status */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'status-form',
	'enableAjaxValidation'=>false,
	//'enableClientValidation'=>true,
)); ?>

		<?php echo $form->textArea($model,'status',array('rows'=>3, 'placeholder'=>'Enter status here','style'=>'margin-top:15px;', 'class'=>'span12')); ?>


			   
    <?php echo $form->error($model,'status'); ?>
    
		

	
	
		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'ajaxSubmit',

                        'ajaxOptions' => array('success' => 'js:function(data){$(data).prependTo("#statuses").hide().each(function(i){var self = $(this); self.slideDown("slow")});}', 'type' => 'post'),
                    	'type'=>'success',
                    	'url' => 'status/create',

                        'label'=>'Send',
                )); ?>

		
	

<?php $this->endWidget(); ?>
</div><!-- form -->