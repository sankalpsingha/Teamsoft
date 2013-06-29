<?php echo CHtml::textField('security'); ?>
<?php echo CHtml::ajaxButton('Reset',array('user/reset'), array('update' => '#forgot_pass', 'data' => array('username' => 'js: $("#email").val()'))); ?>