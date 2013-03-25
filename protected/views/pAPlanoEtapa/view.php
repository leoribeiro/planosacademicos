<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>

<div id="titlePages">
		Plano de Etapa
</div>
<?php 
	$url = $this->createUrl("pAPlanoEtapa/".$userUrl);
	$this->widget('bootstrap.widgets.TbButton', array(
	//'buttonType'=>'submit',
	'type'=>'',
	'label'=>'Voltar',
	'url' => $url,
)); 
?>
<br /><br />

<?php echo $this->renderPartial('_formView', array('model'=>$model)); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'planoForm',
	//'type'=>'inline',
    //'htmlOptions'=>array('class'=>'well'),
	//'enableAjaxValidation'=>false,
)); ?>
<br /><br />

<?php echo $this->renderPartial('_formPlanoAula', array('model'=>$model,'aulas'=>$aulas,'avs'=>$avs,'viewT'=>true)); ?>
<?php $this->endWidget(); ?>

<?php 
	$this->widget('bootstrap.widgets.TbButton', array(
	//'buttonType'=>'submit',
	'type'=>'',
	'label'=>'Voltar',
	'url' => $url,
)); ?>
