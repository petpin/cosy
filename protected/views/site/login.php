<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('contentForm','LOGIN');
$this->breadcrumbs=array(
	Yii::t('contentForm','LOGIN'),
);
?>

<!--<h1>Login</h1>-->

<div class="alert alert-block">

	<p><?php echo Yii::t('contentForm','LOGIN_CREDENTIALS'); ?></p>
	
</div>
	
<div class="form">
	
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'login-form',
	    'type'=>'horizontal',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	
	<p class="alert alert-error"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>
	
	<?php echo $form->textFieldRow($model,'username',array('labelOptions'=>array('label'=>Yii::t('contentForm','USERNAME')))); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('labelOptions'=>array('label'=>Yii::t('contentForm','PASSWORD'))
        //'hint'=>'Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>',
    )); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>Yii::t('contentForm','LOGIN'),
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
