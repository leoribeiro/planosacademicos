<style type="text/css">
#myModal .modal-body {
	max-height: 800px;
}
#myModal {
	width: 900px;
	height: 550px; /* SET THE WIDTH OF THE MODAL */
	margin: 0px 100px 0 -450px; /* CHANGE MARGINS TO ACCOMODATE THE NEW WIDTH (original = margin: -250px 0 0 -280px;) */
}
#modalAv .modal-body {
	max-height: 800px;
}
#modalAv {
	width: 900px;
	height: 260px; /* SET THE WIDTH OF THE MODAL */
	margin: 0px 100px 0 -450px; /* CHANGE MARGINS TO ACCOMODATE THE NEW WIDTH (original = margin: -250px 0 0 -280px;) */
}
</style>

<?php $this->beginWidget('bootstrap.widgets.TbModal', 
array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Adicionar Aula</h4>
</div>
 
<div class="modal-body">
	
	<?php echo CHtml::label('Aulas','aula_data'); ?>
	<?php echo CHtml::textField('aula_data', '',array('class'=>'span3 required')); ?>
	<?php //Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
	   //  	$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				// //'model'=>$model, //Model object
				// 'name'=>'aula_data', //attribute name
				// //'mode'=>'date', //use "time","date" or "datetime" (default)
				// //'options'=>array() // jquery plugin options
				// 'language' => 'pt-BR',
				// 'htmlOptions'=>array(
				// 'class'=>'required',
				// 'tabindex'=>4),
	   //  	));
	?>
	
	<?php echo CHtml::label('Conteúdo','aula_conteudo'); ?>
    <?php echo CHtml::textArea('aula_conteudo', '',array('class'=>'span9 required','rows'=>'7')); ?>
	
	<?php echo CHtml::label('Material/Exercícios','aula_material'); ?>
    <?php echo CHtml::textArea('aula_material', '',array('class'=>'span9 required','rows'=>'5')); ?>

</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Salvar aula',
        //'url'=>'#',
        'htmlOptions'=>array(
        	'onClick'=>'validaFormAula()',
        	//'data-dismiss'=>'modal'
        ),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', 
array('id'=>'modalAv')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Adicionar Avaliação</h4>
</div>
 
<div class="modal-body">
	<?php echo CHtml::label('Nome da avaliação','av_nombre'); ?>
    <?php echo CHtml::textArea('av_nombre', '',array('class'=>'span9 required','rows'=>'1')); ?>
	
	<?php echo CHtml::label('Valor','av_valor'); ?>
    <?php echo CHtml::textField('av_valor', '',array('class'=>'span3 required number')); ?>

</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    	'id'=>'clickAv',
        'type'=>'primary',
        'label'=>'Salvar avaliação',
        //'url'=>'#',
        'htmlOptions'=>array(
        	'onClick'=>'validaFormAv();',
        	//'data-dismiss'=>'modal'
        ),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>


<fieldset>
 
    <legend>Planejamento de Etapa</legend>
	<?php 



		$this->widget('bootstrap.widgets.TbTabs', array(
	    'type'=>'tabs', // 'tabs' or 'pills'
	    //'htmlOptions'=>array('style'=>'height: 200px'),
	    'tabs'=>array(
	        array('label'=>'1° Bimestre','id'=>'tab1', 'content'=>'', 'active'=>true),
	        array('label'=>'2° Bimestre','id'=>'tab2', 'content'=>''),
	        array('label'=>'3° Bimestre','id'=>'tab3', 'content'=>''),
	        array('label'=>'4° Bimestre','id'=>'tab4', 'content'=>''),

	    ),
	)); ?>
</fieldset>
<script type="text/javascript">
	$("planoForm").validate();
	$.validator.messages.required = 'Campo obrigatório.';
	$.validator.messages.number = 'Insira um valor válido';
	var bimestreAtual = 1;
	var editar = 'false';
	var idAula = new Array();
	idAula[1] = 0;
	idAula[2] = 0;
	idAula[3] = 0;
	idAula[4] = 0;

	var idAv = new Array();
	idAv[1] = 0;
	idAv[2] = 0;
	idAv[3] = 0;
	idAv[4] = 0;
	var aulas = new Object();
	var viewT = false;

	var idAvMarcada;

	$(document).ready(function()
    {
    	idAvMarcada = 0;
    	<?php
	        if(isset($viewT)){
				echo 'viewT = true;';
        	}
    	?>
    	//$('#myModal').css('width', '750px');
    	//$('#myModal').css('margin', 'auto auto auto auto');
        for(x=1;x<5;x++){
        	botoes(x);
        }
        <?php

			if(!empty($aulas[0])){
				//print_r($aulas);
				for($x=0;$x<count($aulas[0]);$x++){
					for($y=0;$y<count($aulas[0][$x]);$y++){
						echo '$("#aula_data").val('.json_encode($aulas[0][$x][$y]).');';
						echo '$("#aula_conteudo").val('.json_encode($aulas[1][$x][$y]).');';
						echo '$("#aula_material").val('.json_encode($aulas[2][$x][$y]).');';
						echo 'bimestreAtual = '.json_encode($aulas[3][$x]).';';
						echo 'addAula();';
					}
				}
			}

			if(!empty($avs[0])){
				//print_r($aulas);
				for($x=0;$x<count($avs[0]);$x++){
					for($y=0;$y<count($avs[0][$x]);$y++){
						echo '$("#av_nombre").val('.json_encode($avs[0][$x][$y]).');';
						echo '$("#av_valor").val('.json_encode($avs[1][$x][$y]).');';
						echo 'bimestreAtual = '.json_encode($avs[2][$x]).';';
						echo 'idAvMarcada = '.json_encode($avs[3][$x][$y]).';';
						echo 'addAv();';
					}
				}
			}

		?>
		idAvMarcada = 0;
    });

    function botoes(bimestre){
    	var htmlContent = "<a onClick=\"setaBimestre("+bimestre+")\" data-toggle=\"modal\" data-target=\"#myModal\" class=\"btn \">Adicionar Aula</a>&nbsp;&nbsp;";
    	var htmlContent2 = "<a onClick=\"setaBimestre("+bimestre+")\" data-toggle=\"modal\" data-target=\"#modalAv\" class=\"btn \">Adicionar Avaliação</a>";
    	var divs = "<div id=\"div_aulas"+bimestre+"\"></div><div id=\"div_av"+bimestre+"\"></div>";
    	if(!viewT){
    		$("#tab"+bimestre).append(htmlContent);
    		$("#tab"+bimestre).append(htmlContent2);
    	}
    	$("#tab"+bimestre).append(divs);

    }

    function setaBimestre(bimestre){
    	editar = 'false';
    	$("#aula_data").val("");
    	$("#aula_conteudo").val("");
    	$("#aula_material").val("");
    	$("#av_nombre").val("");
    	$("#av_valor").val("");
    	bimestreAtual = bimestre;
    }

    function validaFormAula(){

    	if($("#planoForm").valid()){
    		$('#myModal').modal('hide');
    		if(editar == 'false'){
    			addAula();
    		}
    		else
    			editarAulaD();
    	}
    }

    function validaFormAv(){

    	if($("#planoForm").valid()){
    		$('#modalAv').modal('hide');
    		if(editar == 'false'){
    			addAv();
    		}
    		else
    			editarAvD();
    	}
    }

	function editarAulaD(){


		var idA = editar;
		var b = bimestreAtual;
		idData = 'dataAula'+idA+'bim'+b;
		idConteudo = 'conteudoAula'+idA+'bim'+b;
		idMaterial = 'materialAula'+idA+'bim'+b;

		$('#'+idData).val($("#aula_data").val());
		$('#'+idConteudo).val($("#aula_conteudo").val());
		$('#'+idMaterial).val($("#aula_material").val());

		updateTabla();

	}

	function editarAvD(){

		var idA = editar;
		var b = bimestreAtual;
		idNome = 'nomeAv'+idA+'bim'+b;
		idValor = 'valorAv'+idA+'bim'+b;

		$('#'+idNome).val($("#av_nombre").val());
		$('#'+idValor).val($("#av_valor").val());

		updateTablaAv();

	}

	function updateTabla(){
		var b = bimestreAtual;
		if(idAula[b] > 0){
			$("#div_aulas"+b).html(criaTabelaAula(b));
			for(x=0;x<idAula[b];x++){
				idData = 'dataAula'+x+'bim'+b;
				idConteudo = 'conteudoAula'+x+'bim'+b;
				idMaterial = 'materialAula'+x+'bim'+b;

				var data = $('#'+idData).val();
				var conteudo = $('#'+idConteudo).val();
				var material = $('#'+idMaterial).val();
				addLinhaTabela(x+1,data,conteudo,material,b);
			}
		}
		else{
			$("#div_aulas"+b).empty();
		}
		

	}

	function updateTablaAv(){
		var b = bimestreAtual;
		if(idAv[b] > 0){
			$("#div_av"+b).html(criaTabelaAv(b));
			for(x=0;x<idAv[b];x++){
				idNome = 'nomeAv'+x+'bim'+b;
				idValor = 'valorAv'+x+'bim'+b;
				idId = 'idAv'+x+'bim'+b;

				var nome = $('#'+idNome).val();
				var valor = $('#'+idValor).val();
				var idAid = $('#'+idId).val();
				addLinhaTabelaAv(x+1,nome,valor,b,idAid);
			}
		}
		else{
			$("#div_av"+b).empty();
		}
		

	}

	function addAula(){

		var idA = idAula[bimestreAtual];
		var b = bimestreAtual;
		idData = 'dataAula'+idA+'bim'+bimestreAtual;
		idConteudo = 'conteudoAula'+idA+'bim'+bimestreAtual;
		idMaterial = 'materialAula'+idA+'bim'+bimestreAtual;

		$('<input>').attr({
		    type: 'hidden',
		    id: idData,
		    name: 'dataAula'+b+'bim[]'
		}).appendTo('#planoForm');

		$('<input>').attr({
		    type: 'hidden',
		    id: idConteudo,
		    name: 'conteudoAula'+b+'bim[]'
		}).appendTo('#planoForm');

		$('<input>').attr({
		    type: 'hidden',
		    id: idMaterial,
		    name: 'materialAula'+b+'bim[]'
		}).appendTo('#planoForm');

		if(idA == 0){
			$("#div_aulas"+bimestreAtual).append(criaTabelaAula(b));
		}

		$('#'+idData).val($("#aula_data").val());
		$('#'+idConteudo).val($("#aula_conteudo").val());
		$('#'+idMaterial).val($("#aula_material").val());

		addLinhaTabela(idA+1,$('#'+idData).val(),$('#'+idConteudo).val(),$('#'+idMaterial).val(),b);



		idAula[bimestreAtual]++;

	}

	function addAv(){

		var idA = idAv[bimestreAtual];
		var b = bimestreAtual;
		idNome = 'nomeAv'+idA+'bim'+bimestreAtual;
		idValor = 'valorAv'+idA+'bim'+bimestreAtual;
		idId = 'idAv'+idA+'bim'+bimestreAtual;

		$('<input>').attr({
		    type: 'hidden',
		    id: idNome,
		    name: 'nomeAv'+b+'bim[]'
		}).appendTo('#planoForm');

		$('<input>').attr({
		    type: 'hidden',
		    id: idValor,
		    name: 'valorAv'+b+'bim[]'
		}).appendTo('#planoForm');

		$('<input>').attr({
		    type: 'hidden',
		    id: idId,
		    name: 'idAv'+b+'bim[]'
		}).appendTo('#planoForm');

		if(idA == 0){
			$("#div_av"+bimestreAtual).append(criaTabelaAv(b));
		}

		$('#'+idNome).val($("#av_nombre").val());
		$('#'+idValor).val($("#av_valor").val());
		$('#'+idId).val(idAvMarcada);
		addLinhaTabelaAv(idA+1,$('#'+idNome).val(),$('#'+idValor).val(),b,idAvMarcada);



		idAv[bimestreAtual]++;

	}

	function editarAula(numAula,b){
		//alert(numAula);
		bimestreAtual = b;
		var idA = numAula;
		idData = 'dataAula'+idA+'bim'+b;
		idConteudo = 'conteudoAula'+idA+'bim'+b;
		idMaterial = 'materialAula'+idA+'bim'+b;

		$("#aula_data").val($('#'+idData).val());
		$("#aula_conteudo").val($('#'+idConteudo).val());
		$("#aula_material").val($('#'+idMaterial).val());
		editar = numAula;


	}

	function editarAv(numAv,b){
		//alert(numAula);
		bimestreAtual = b;
		var idA = numAv;
		idNome = 'nomeAv'+idA+'bim'+b;
		idValor = 'valorAv'+idA+'bim'+b;

		$("#av_nombre").val($('#'+idNome).val());
		$("#av_valor").val($('#'+idValor).val());

		editar = numAv;

	}

	function deletarAula(numAula,b){
		//alert(numAula);
		var idA = numAula;
		bimestreAtual = b;
		for(x=idA;x<(idAula[b]-1);x++){
			idData = 'dataAula'+idA+'bim'+b;
			idConteudo = 'conteudoAula'+idA+'bim'+b;
			idMaterial = 'materialAula'+idA+'bim'+b;

			idData2 = 'dataAula'+(idA+1)+'bim'+b;
			idConteudo2 = 'conteudoAula'+(idA+1)+'bim'+b;
			idMaterial2 = 'materialAula'+(idA+1)+'bim'+b;

			$('#'+idData).val($('#'+idData2).val());
			$('#'+idConteudo).val($('#'+idConteudo2).val());
			$('#'+idMaterial).val($('#'+idMaterial2).val());
		}
		idA = idAula[b]-1;
		idData = 'dataAula'+idA+'bim'+b;
		idConteudo = 'conteudoAula'+idA+'bim'+b;
		idMaterial = 'materialAula'+idA+'bim'+b;
		$('#'+idData).remove();
		$('#'+idConteudo).remove();
		$('#'+idMaterial).remove();

		idAula[b]--;

		if(idAula[b] == 0){
			$("#div_aulas"+b).empty();
		}

		updateTabla();

	}

	function deletarAv(numAv,b){
		//alert(numAula);
		var idA = numAv;
		bimestreAtual = b;
		for(x=idA;x<(idAv[b]-1);x++){
			idNome = 'nomeAv'+idA+'bim'+b;
			idValor = 'valorAv'+idA+'bim'+b;
			idId = 'idAv'+idA+'bim'+b;

			idNome2 = 'nomeAv'+(idA+1)+'bim'+b;
			idValor2 = 'valorAv'+(idA+1)+'bim'+b;
			idId2 = 'idAv'+(idA+1)+'bim'+b;

			$('#'+idNome).val($('#'+idNome2).val());
			$('#'+idValor).val($('#'+idValor2).val());
			$('#'+idId).val($('#'+idId2).val());
		}
		idA = idAv[b]-1;
		idNome = 'nomeAv'+idA+'bim'+b;
		idValor = 'valorAv'+idA+'bim'+b;
		idId = 'idAv'+idA+'bim'+b;

		$('#'+idNome).remove();
		$('#'+idValor).remove();
		$('#'+idId).remove();

		idAv[b]--;

		if(idAv[b] == 0){
			$("#div_av"+b).empty();
		}

		updateTablaAv();

	}

	function addLinhaTabela(numAula,data,conteudo,material,b){
		var content = "<tr><td id=\"numAula\">"+numAula+"</td>";
		content += "<td>"+data+"</td>";
		content += "<td>"+conteudo+"</td>";
		content += "<td>"+material+"</td>";
		if(!viewT){
			content += "<td><i class=\"icon-pencil\" style=\"cursor: pointer;\" data-toggle=\"modal\" data-target=\"#myModal\" onClick=\"editarAula("+(numAula-1)+","+b+")\"></i>&nbsp;<i class=\"icon-remove\" style=\"cursor: pointer;\" onClick=\"deletarAula("+(numAula-1)+","+b+")\" ></i></td></tr>";
		}
		$('#tabelaAulas'+b+' > tbody:last').append(content);
	}

	function addLinhaTabelaAv(numAv,nombre,valor,b,idAv){
		var content = "<tr><td id=\"numAv\">"+numAv+"</td>";
		content += "<td>"+nombre+"</td>";
		content += "<td>"+valor+"</td>";
		if(!viewT){
			result = 1;
			//alert(idAv);
			if(idAv != 0){
				$.ajax({
	                  url: '<?php echo $this->createUrl("//PAMarcacaoProva/provaHistorico/");?>',
	                  type: 'GET',
	                  async: false,
	                  data: 'idAv='+idAv,
	                    success: function(r) {
	                        result = r;
	            }});
			}
			if(result == 1){
				content += "<td><i class=\"icon-pencil\" style=\"cursor: pointer;\" data-toggle=\"modal\" data-target=\"#modalAv\" onClick=\"editarAv("+(numAv-1)+","+b+")\"></i>&nbsp;<i class=\"icon-remove\" style=\"cursor: pointer;\" onClick=\"deletarAv("+(numAv-1)+","+b+")\" ></i></td></tr>";
			}
			else{
				content += "<td><div align=center><i class=\"icon-certificate\" title=\"Avaliação não pode ser modificada\"  ></i></div></td></tr>";
			}

		}
		$('#tabelaAv'+b+' > tbody:last').append(content);
	}

	var numW = "60px";
	var dataW = "90px";
	var W = "90px";
	function criaTabelaAv(b){
		var content = "<br /><h4>Avaliações formativas</h4>";
		content += "<table id=\"tabelaAv"+b+"\" class=\"table table-bordered\">";
		content += "<thead><tr><th width=\""+numW+"\">Número</th><th>Avaliações</th><th width=\"220px\">Valor</th>";
		if(!viewT)
			content +="<th width=\"32px\"></th>";
		content += "</tr></thead><tbody></tbody>";
		content += "</table>";
		return content;
	}

	function criaTabelaAula(b){
		var content = "<br /><h4>Planejamento de aulas</h4>";
		content += "<table id=\"tabelaAulas"+b+"\" class=\"table table-bordered\">";
		content += "<thead><tr><th width=\""+numW+"\">Número</th><th width=\""+dataW+"\">Aulas</th><th>Conteúdo</th><th width=\"220px\">Material/Exercícios</th>";
		if(!viewT)
			content +="<th width=\"32px\"></th>";
		content += "</tr></thead><tbody></tbody>";
		content += "</table>";
		return content;
	}
</script>
