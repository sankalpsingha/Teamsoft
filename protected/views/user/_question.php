<?php echo CHtml::textField('email'); ?>
<?php //echo CHtml::submitButton('Reset'); ?>
<?php echo CHtml::ajaxButton('Reset',array('user/reset'), array('update' => '#forgot_pass', 'data' => array('username' => 'js: $("#email").val()'))); ?>