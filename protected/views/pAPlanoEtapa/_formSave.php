<div class="form-actions">
	<div align="center">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		//'buttonType'=>'submit',
		'type'=>'',
		'label'=>'Voltar',
		'url' => $this->createUrl("pAPlanoEtapa/admin"),
	)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Salvar plano' : 'Salvar plano',
	)); ?>

	</div>
</div>

