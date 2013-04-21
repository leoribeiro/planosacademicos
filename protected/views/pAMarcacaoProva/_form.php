<?
	echo CHtml::ajaxLink('',CController::createUrl('site/GeraCalendario'),
	  array( // ajaxOptions
	    'type' => 'POST',
	'data' => array('ControleAntProx' => '1'),
	    'update'=>'#calendar_wrapper',
	  ),
	array( //htmlOptions
	    'class' => 'monthnav'
	  )
	);
	echo CHtml::ajaxLink('',CController::createUrl('site/GeraCalendario'),
	  array( // ajaxOptions
	    'type' => 'POST',
	'data' => array('ControleAntProx' => '2'),
	    'update'=>'#calendar_wrapper',
	  ),
	array( //htmlOptions
	    'class' => 'monthnav'
	  )
	);
?>

<table  cellpadding="0" cellspacing="0">
	<tr>
	<td width="20%">
		<?php // Tipos de turmas
		$lista =CHtml::listData(TipoTurma::model()->findAll(),'CDTipoTurma','NMTipoTurma');
	?>
	<? $model->isNewRecord ? $model->CDTipoTurma = 1 : null; //Valor default para tipo de turma  ?>
	<?php echo $form->radioButtonListInlineRow($model,'CDTipoTurma',$lista); ?>
	</td>
	<td width="20%">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'data', //attribute name
				'language' => 'pt-BR',
				'htmlOptions'=>array('tabindex'=>4),
	    	));
		?>
		<?php echo $form->error($model,'data'); ?>

	</td>
	<td width="10%">
		<?php echo $form->labelEx($model,'inicio'); ?>
		<?php 
			$data=Horario::model()->findAllBySql('select H.CDHorario,H.NMHorario from Horario H,Turma T where T.CDTurno = H.CDTurno and T.CDTurma='.$modelP->turma.' ORDER BY H.NMHorario');
		    $data=CHtml::listData($data,'CDHorario','NMHorario');

			echo CHtml::activeDropDownList($model,'inicio',$data,array('style'=>'width:100px',
				'empty'=>'',
				'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('atualizahorariosForm'),
					'update'=>'#PAMarcacaoProva_fim',
					'data'=>'js:{inicio: $("#PAMarcacaoProva_inicio option:selected").text(),
					turma: '.$modelP->turma.' }',
					),
				)); 
		?>
	</td>
	<td>
		<?php echo $form->labelEx($model,'fim'); ?>
		<?php 

			$data=Horario::model()->findAllBySql('select H.CDHorario,H.NMHorario from Horario H,Turma T where T.CDTurno = H.CDTurno and T.CDTurma='.$modelP->turma.' ORDER BY H.NMHorario LIMIT 100 OFFSET 1');
	    	$data=CHtml::listData($data,'CDHorario','NMHorario');
	    	echo CHtml::activeDropDownList($model,'fim',$data,array('style'=>'width:100px','empty'=>'')); 
		?>
	</td>
	</tr>
	</table>

	<div class="form-actions">
		<div align="center">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'type'=>'',
			'label'=>'Voltar',
			'url' => $this->createUrl("pAAvaliacao/admin",array("marcada"=>"false")),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Marcar avaliação' : 'Marcar avaliação',
		)); ?>

		</div>
	</div>
