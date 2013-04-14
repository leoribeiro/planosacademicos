<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'horario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMHorario'); ?>
		<?php echo $form->textField($model,'NMHorario'); ?>
		<?php echo $form->error($model,'NMHorario'); ?>
	</div>

		<div class="row">
			<?php echo $form->labelEx($model,'relTurno.NMTurno'); ?>
		<?php $lista =CHtml::listData(Turno::model()->findAll(), 'CDTurno', 'NMTurno');
		echo CHtml::activeDropDownList($model,'CDTurno',$lista,array('empty'=>'Escolha o turno')); ?>
			<?php echo $form->error($model,'relTurno.NMTurno'); ?>

			<?php echo CHtml::link(CHtml::image($this->createUrl('images/b_newtbl.png'),'Novo Turno'), array( 'turno/create' ), array( 
		    'class' => 'update-dialog-create' ) 
		     ); ?>
			

			
		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->