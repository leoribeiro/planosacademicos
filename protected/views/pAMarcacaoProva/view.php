<div id="titlePages">
		Detalhe da avaliação
</div>
<?php 
	$url = $this->createUrl("PAAvaliacao/".$userUrl);
	$this->widget('bootstrap.widgets.TbButton', array(
	//'buttonType'=>'submit',
	'type'=>'',
	'label'=>'Voltar',
	'url' => $url,
)); 
?>
<br /><br />
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'marcacaoprova-form',
)); ?>

<?php echo $this->renderPartial('_dadosPlano', array('model'=>$modelP)); ?>

<?php echo $this->renderPartial('_dadosAvaliacaoView', array('modelT'=>$model,'model'=>$modelAv,'form'=>$form)); ?>

<?php $this->endWidget(); ?>

<?php 
	$url = $this->createUrl("PAAvaliacao/".$userUrl);
	$this->widget('bootstrap.widgets.TbButton', array(
	//'buttonType'=>'submit',
	'type'=>'',
	'label'=>'Voltar',
	'url' => $url,
)); 
?>