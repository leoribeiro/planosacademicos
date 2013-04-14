<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'modalidade-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMModalidade'); ?>
		<?php echo $form->textField($model,'NMModalidade',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NMModalidade'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->