<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<?php
if(Yii::app()->session['flagged'] === 1) {
	$this->redirect(array('user/flagged'));
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>


</head>
<body>




<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/login.css'); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
								//'htmlOptions' => array('class'=>'form-horizontal'),
								'id'=>'login-form',
								//'enableClientValidation'=>true,
								'clientOptions'=>array(
								'validateOnSubmit'=>true,
								),
							)
	); 
?>
		<div class="container-fluid"><div class="row-fluid">					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a  style="text-decoration:none; margin-top:-5px;" href="#forgotPass" role="button"  data-toggle="modal">Forgot Password</a>
						<i class="icon-group"></i>
						<?php echo CHtml::link('Register',array('user/create')); ?>
					</div>
						<h2 class="offset2" style="color: #99253b;"><i class="icon-unlock icon-2x"></i>Fahrenheit</h2>

								<div class="input-prepend" title="Username">
								<span class="add-on"><i class=" icon-user icon-large"></i></span>
								
								<?php echo $form->textField($model,'username',array('class'=>"input-large span10",'placeholder'=>'Your username')); ?>
								</div>

								<div class="clearfix"></div>
	
								<div class="input-prepend" title="Password">
								<span class="add-on"><i class=" icon-lock icon-large"></i></span>
								<?php echo $form->passwordField($model,'password',array('class'=>"input-large span10",'placeholder'=>'Your Password')); ?>
								<?php //echo $form->error($model,'password'); ?>
								</div>
								
								<?php //echo $form->errorSummary($model); ?>
								<?php if ($form->error($model,'username')): ?>
									<div class="row-fluid">
										<div class="span10 offset1">
											<?php echo '<div class="alert alert-error alert-block"> <strong style="text-align:center;">'.$form->error($model,'username').'</strong></div>'; ?>
										</div>
									</div>
								<?php endif ?>

								<label class="checkbox remember">
								<?php echo $form->checkBox($model,'rememberMe'); ?> Remember me
								</label>
	
								
	
								<div class="row-fluid">
                           		 <div class="span10 offset1">
								<?php $this->widget('bootstrap.widgets.TbButton', array(
                        			'buttonType'=>'submit',
                        			'block' => true,
                        			'type'=>'info',
                        			'label'=>'Enter',
                				)); ?>
                				</div>
								</div>
								<div class="clearfix"></div> 
	

								<?php $this->endWidget(); ?>

					
					<hr>					                    
				</div>
			</div>			
			</div></div>



			<footer></footer>
				

			<div id="forgotPass" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Enter Username :</h3>
				</div>
 				<div class="modal-body">
				<?php $this->renderPartial('/user/_question'); ?>
				</div>
				<div id="forgot_pass"></div>
				<div class="modal-footer">
				<a href="#" class="btn">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
				</div>


			</div>

<!-- Other stuffs -->

</body>
</html>