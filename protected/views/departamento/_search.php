<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDDepartamento'); ?>
		<?php echo $form->textField($model,'CDDepartamento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMDepartamento'); ?>
		<?php echo $form->textField($model,'NMDepartamento',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->