<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDTurno'); ?>
		<?php echo $form->textField($model,'CDTurno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMTurno'); ?>
		<?php echo $form->textField($model,'NMTurno',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->