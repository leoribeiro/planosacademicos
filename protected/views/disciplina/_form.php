<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'disciplina-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMDisciplina'); ?>
		<?php echo $form->textField($model,'NMDisciplina',array('size'=>30,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NMDisciplina'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'SGDisciplina'); ?>
		<?php echo $form->textField($model,'SGDisciplina',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'SGDisciplina'); ?>
	</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'relCoordenacao.NMCoordenacao'); ?>
		    <?php $lista =CHtml::listData(Coordenacao::model()->findAll(), 'CDCoordenacao', 'NMCoordenacao');
		    echo CHtml::activeDropDownList($model,'CDCoordenacao',$lista,
			array('empty'=>'Escolha uma coordenação',
				  'style'=>'width:220px')); ?>
			<?php echo $form->error($model,'relCoordenacao.NMCoordenacao'); ?>		
		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->