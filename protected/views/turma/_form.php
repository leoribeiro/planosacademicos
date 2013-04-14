<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'turma-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php
 //Remove variável de sessão responsável pelo controle das Disciplinas no Controller Turma
 unset(Yii::app()->session['DisciplinasEscolhidas']);
?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMTurma'); ?>
		<?php echo $form->textField($model,'NMTurma',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NMTurma'); ?>
	</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'relModalidade.NMModalidade'); ?>
		<?php $lista =CHtml::listData(Modalidade::model()->findAll(), 'CDModalidade', 'NMModalidade');
		echo CHtml::activeDropDownList($model,'CDModalidade',$lista,
			array('empty'=>'Escolha a modalidade',
				  'style'=>'width:150px')); ?>
			<?php echo $form->error($model,'relModalidade.NMModalidade'); ?>
			
			<?php echo CHtml::link( CHtml::image($this->createUrl('images/b_newtbl.png'),'Nova Modalidade'), array( 'Modalidade/create' ), array( 
		    'class' => 'update-dialog-create') 
		     ); ?>

			
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'relTurno.NMTurno'); ?>
		<?php $lista =CHtml::listData(Turno::model()->findAll(), 'CDTurno', 'NMTurno');
		echo CHtml::activeDropDownList($model,'CDTurno',$lista,
			array('empty'=>'Escolha um turno',
				  'style'=>'width:150px')); ?>
			<?php echo $form->error($model,'relTurno.NMTurno'); ?>
			
			<?php echo CHtml::link(CHtml::image($this->createUrl('images/b_newtbl.png'),'Novo Turno'), array( 'Turno/create' ), array( 
		    'class' => 'update-dialog-create' ) 
		     ); ?>			
		</div>
		
		<div class="row">
		<table>
			<tr>
			<td width="25%">
				<?php echo $form->labelEx($model,'relTurmaDisciplina2'); ?>
				<?php $lista =CHtml::listData(Departamento::model()->findAll(array('order'=>'NMDepartamento')), 'CDDepartamento', 'NMDepartamento');
				echo CHtml::DropDownList('CDDepartamento','',$lista,
					array('empty'=>'Escolha o departamento',
						  'style'=>'width:200px',
						  'ajax' => array(
						  'type'=>'POST', 
						  'url'=>CController::createUrl('Turma/UpdateDisciplina'), 
						  'update'=>'#DisciplinasDisponiveis', 
						  ))
				); 
				?>

				<?php $lista =CHtml::listData(Disciplina::model()->findAll(array('order'=>'NMDisciplina')), 'CDDisciplina', 'NMDisciplina');
				echo CHtml::dropDownList('DisciplinasDisponiveis[]','',$lista,
					array('multiple'=>'multiple',
			      	'size'=>7,
				  	'style'=>'width:200px')); ?>
				<?php echo $form->error($model,'relTurmaDisciplina'); ?>
			</td>
			<td>
				<?php echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/item_ltr.png'),'Adicionar Disciplina'), 
				$this->createUrl('Turma/AdicionaDisciplina'),
				array(
					'type' =>'POST',
				    'update'=>'#Turma_relTurmaDisciplina', //selector to update
				)
				); ?>
				<br /><br />
				<?php echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/item_rtl.png'),'Remover Disciplina'), 
				$this->createUrl('Turma/RemoveDisciplina'),
				array(
					'type' =>'POST',
				    'update'=>'#Turma_relTurmaDisciplina', //selector to update
				)
				); ?>
				<div id="teste1"></div>
			</td>
			<td>
			    <?
					
				?>
				<?php echo $form->labelEx($model,'relTurmaDisciplina'); ?>
				<?php
				     	$resultado = Disciplina::model()->with('relTurmaDisciplina')->findAll(
						 array('order'=>'NMDisciplina','condition'=>'relTurmaDisciplina.CDTurma=:TUR',
					    'params'=>array(':TUR'=>$model->CDTurma))); 
					
						//Trata as diciplinas em um update
					    $DisciplinasEscolhidas = array();
					    foreach($resultado as $registro){
							$DisciplinasEscolhidas[] = $registro->CDDisciplina;
						}
						Yii::app()->session['DisciplinasEscolhidas'] = $DisciplinasEscolhidas;
						//
						
						
				     $lista =CHtml::listData($resultado, 'CDDisciplina', 'NMDisciplina');
				     echo CHtml::activeDropDownList($model,'relTurmaDisciplina',$lista,
					array('multiple'=>'multiple',
					      'size'=>8,
						  'style'=>'width:200px')); ?>
					<?php echo $form->error($model,'relTurmaDisciplina'); ?>

			</td>
			</tr>
		</table>
		
		
		</div>
		


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->


<!-- Importa modulo para utilização de Janelas para create/update -->
<?php $this->widget( 'ext.EUpdateDialog.EUpdateDialog', array(
  'height' => 200,
  'resizable' => false,
  'width' => 550,
)); ?>