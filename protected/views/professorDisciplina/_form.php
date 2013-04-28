<?php $this->widget( 'ext.EChosen.EChosen' ); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'discForm',
	'enableAjaxValidation'=>false,
)); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal',
array('id'=>'modalAddDisc')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Adicionar Disciplina</h4>
</div>

<div class="modal-body">

	<?php echo CHtml::label('Disciplina','disc'); ?>
	<?php
		$modelAux = Disciplina::model()->findAll(array('order'=>'NMDisciplina'));
		$data = CHtml::listData($modelAux,'CDDisciplina','NMDisciplina');
		echo CHtml::dropDownList('disc', '',$data,array('style'=>'width:300px','empty'=>'Selecione uma disciplina','class'=>'required'));
	?>
	<br /><br />
	<?php echo CHtml::label('Turma','turma'); ?>
	<?php
		$modelAux = Turma::model()->findAll(array('order'=>'NMTurma'));
		$data = CHtml::listData($modelAux,'CDTurma','NMTurma');
		echo CHtml::dropDownList('turma', '',$data,array('style'=>'width:300px','empty'=>'Selecione uma turma','class'=>'required'));
	?>

</div>
<br />

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Adicionar disciplina',
        'htmlOptions'=>array(
        	'onClick'=>'AdicionaDisciplina()',
        ),
    )); ?>
</div>
<?php $this->endWidget(); ?>


	<?php echo $form->errorSummary($model); ?>

	<?php
		if(!empty($model->id_professor)){
			echo '<strong>Professor:</strong> '.$model->relProfessor->relServidor->NMServidor;
			echo $form->hiddenField($model,'id_professor',array('value'=>$model->id_professor));
		}
		else{
			$criteria = new CDbCriteria;
			$criteria->distinct = true;
        	$criteria->select = 'id_professor';
			$modelP = ProfessorDisciplina::model()->findAll();
			$idsP = array();
			foreach($modelP as $m){
				$idsP[] = $m->id_professor;
			}
			$criteria = new CDbCriteria;
			$criteria->with = array('relServidor');
			$criteria->order = 'relServidor.NMServidor';
			$criteria->addNotInCondition('CDProfessor',$idsP);
			$modelAux = Professor::model()->findAll($criteria);
			$data = CHtml::listData($modelAux,'CDProfessor','relServidor.NMServidor');

			echo $form->dropDownListRow($model,'id_professor',$data,array('class'=>'chzn-select','style'=>'width:300px','empty'=>'Selecione um professor'));
		}
	?>
	<?php if(!isset($viewT)){
		echo '<br /><br /><a data-toggle="modal" data-target="#modalAddDisc" onClick="resetaSelects()" class="btn">Adicionar disciplina</a>';
	}
	?>
	<div id="divDisc">

	</div>

	<div class="form-actions">
		<?php
			if(!isset($viewT)){
				$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Salvar' : 'Salvar',
				));
			}
			else{
				$this->widget('bootstrap.widgets.TbButton', array(
				'url'=>$this->createUrl("ProfessorDisciplina/admin"),
				'label'=>'Voltar',
				));
			}
		?>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
	$("discForm").validate();
	var id = 1;
	$.validator.messages.required = 'Campo obrigatório.';
	$.validator.messages.number = 'Insira um valor válido.';
	$(document).ready(function()
    {
        <?php
        if(isset($viewT)){
        	echo 'viewT = true;';
        }
        else{
        	echo 'viewT = false;';
        }
        if(!empty($dados[0])){
			for($x=0;$x<count($dados[0]);$x++){
					echo '$("#disc").val('.json_encode($dados[0][$x]).');';
					echo '$("#turma").val('.json_encode($dados[1][$x]).');';
					echo 'AdicionaDisciplina();';
			}
        }
		?>
    });

	function AdicionaDisciplina(){
		if($("#discForm").valid()){
			$('#modalAddDisc').modal('hide');
			if(id == 1){
				$("#divDisc").html(criaTabela());
			}
			var idDisc = $('#disc').val();
			var idTurma = $('#turma').val();

			$('<input>').attr({
		    type: 'hidden',
		    id: 'adisc'+id,
		    name: 'discS[]'
			}).appendTo('#discForm');

			$('<input>').attr({
			    type: 'hidden',
			    id: 'aturma'+id,
			    name: 'turmaS[]'
			}).appendTo('#discForm');

			$('<input>').attr({
		    type: 'hidden',
		    id: 'ndisc'+id,
		    name: 'ndisc[]'
			}).appendTo('#discForm');

			$('<input>').attr({
			    type: 'hidden',
			    id: 'nturma'+id,
			    name: 'nturma[]'
			}).appendTo('#discForm');

			$('#adisc'+id).val(idDisc);
			$('#aturma'+id).val(idTurma);

			var disc = $("#disc :selected").text();
			var turma = $("#turma :selected").text();

			$('#ndisc'+id).val(disc);
			$('#nturma'+id).val(turma);

			addLinhaTabela(id,disc,turma);
			id++;
		}
	}

	function criaTabela(){
		var content = "<br /><h4>Disciplinas</h4>";
		content += "<table id=\"tabelaDisc\" class=\"table table-bordered\">";
		content += "<thead><tr><th width=\"20px\">Número</th><th width=\"70%\">Disciplina</th><th>Turma</th>";
		if(!viewT){
			content += "<th width=\"20px\"></th>";
		}
		content += "</tr></thead><tbody></tbody>";
		content += "</table>";
		return content;
	}

	function addLinhaTabela(num,disc,turma){
		var content = "<tr><td id=\"num\">"+num+"</td>";
		content += "<td>"+disc+"</td>";
		content += "<td>"+turma+"</td>";
		if(!viewT){
			content += "<td><div align=\"center\"><i class=\"icon-remove\" style=\"cursor: pointer;\" onClick=\"deletar("+num+")\" ></i></div></td>";
		}
		content += "</tr>";
		$('#tabelaDisc > tbody:last').append(content);
	}

	function updateTabla(){
		if(id > 1){
			$("#divDisc").html(criaTabela());
			for(x=1;x<id;x++){
				var disc = $('#ndisc'+x).val();
				var turma = $('#nturma'+x).val();
				addLinhaTabela(x,disc,turma);
			}
		}
		else{
			$("#divDisc").empty();
		}

	}

	function deletar(num){

		for(x=num;x<(id-1);x++){
			idDisc = '#adisc'+x;
			idTurma = '#aturma'+x;
			nDisc = '#ndisc'+x;
			nTurma = '#nturma'+x;

			idDisc2 = '#adisc'+(x+1);
			idTurma2 = '#aturma'+(x+1);
			nDisc2 = '#ndisc'+(x+1);
			nTurma2 = '#nturma'+(x+1);
			$(idDisc).val($(idDisc2).val());
			$(idTurma).val($(idTurma2).val());
			$(nDisc).val($(nDisc2).val());
			$(nTurma).val($(nTurma2).val());
		}
		id--;
		idDisc = '#adisc'+id;
		idTurma = '#aturma'+id;
		nDisc = '#ndisc'+id;
		nTurma = '#nturma'+id;
		$(idDisc).remove();
		$(idTurma).remove();
		$(nDisc).remove();
		$(nTurma).remove();

		updateTabla();

	}

	function resetaSelects(){
		$("#turma").val("");
		$("#disc").val("");
	}


</script>
