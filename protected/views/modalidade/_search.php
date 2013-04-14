<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDModalidade'); ?>
		<?php echo $form->textField($model,'CDModalidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMModalidade'); ?>
		<?php echo $form->textField($model,'NMModalidade',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Pesquisar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->