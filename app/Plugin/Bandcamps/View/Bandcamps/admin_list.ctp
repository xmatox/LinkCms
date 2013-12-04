<?php
echo $this->Html->css("/bandcamps/css/bandcamp");
echo "<h1>";
	echo $titre;
echo "</h1>";
if(!empty($this->Form->data[$tablename]["nom"])){ 
echo "<div class='ajout'>";
	echo $this->Js->link(
		"Nouveau",
		array(
			'action'=>'list'
		),
		array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
	);
echo "</div>";
}

?>
<div style="margin-left:20px;margin-top:20px;">
<?php
if(empty($thecontent)){
	echo "<div class='error'>".$titre." est vide.</div>";
}else{
	echo "<ul class='tabtitre'>";
		echo "<li class='tab_li_titre'>Titre</li>";
		echo "<li class='tab_li_int'>Supprimer</li>";
		echo "<li class='tab_li_int'>Editer</li>";
	echo "</ul>";
	$nColor = 0;
	foreach($thecontent as $c){
		$nColor++;
		if($nColor%2==0){
			echo "<ul class='tab1'>";
		}else{
			echo "<ul class='tab2'>";
		}
			
			echo "<li class='tab_li_titre'>";
				echo $this->Js->link(
					$c[$tablename]['nom'],
					array(
						'action'=>'list',
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
				$this->Html->image('/admin/suprim_h20.png', array(
					"alt" => "Supprimer"
				)),
				array(
					'action'=>'suprim', 
					$c[$tablename]["id"]
				),
				array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
			);
			echo "</li>";
			echo "<li class='tab_li_img'>";
				echo $this->Js->link(
					$this->Html->image('/admin/modif_h20.png', array(
						"alt" => "Modifier"
					)),
					array(
						'action'=>'list', 
						$c[$tablename]["id"]
					),
					array('escape'=>false,'buffer'=>false,'update' => '#popup_edit_cont')
				);
			echo "</li>";
			
		echo "</ul>";
	}
	echo "<ul class='tabpied'></ul>";
}
?>
</div>
<div >
	<fieldset style="width:290px;margin:10px;border:1px #999 solid; background-color:#fff;">
	<legend> 
	<?php if(!empty($this->Form->data[$tablename]["nom"])){ 
		echo $this->Form->data[$tablename]["nom"];
	}else{ 
		echo "Nouveau";
	} ?>
	 </legend>
	 
	<?php
		echo $this->Form->create($tablename);
		echo $this->Form->input('id');
		
		echo "<br/><label>Nom : </label><br/>";
		echo $this->Form->input('nom',array("label"=>"","size" => "30px"));
		echo "<br/><label>Band ID : </label><br/>";
		echo $this->Form->input('bandid',array("label"=>"","id"=>"band_id","size" => "30px"));
		
		echo $this->Js->submit(__("Sauvegarder"),array('update' => '#popup_edit_cont'));
		echo $this->Js->writeBuffer();
		
		echo "<br/><label>Rechercher un groupe : </label><br/>";
		echo $this->Form->input('nomband',array("label"=>"","id"=>"nomband","size" => "30px","onkeyup" => "searchband(this.value);"));
	?>
	<ul id='resultband'></ul>
	</fieldset>
	<script type="text/javascript">
	function searchband(name){

		if (name.length>4) {
			var my_url = 'http://api.bandcamp.com/api/band/3/search?key=vatnajokull&name='+name+'&callback=?';

			$.ajax({
			    'url': my_url,
			    'type': "GET",
			    'dataType': 'jsonp',
			    success: function(res) {
			    	if(res) {
				       
				        $("#resultband").html("");
				        var i=0;
				        var col = "";
				        for ( var cle in res.results ) {
				        	if (i%2==0) { col = "#f8f8f8"; }else{ col = "#ebebeb"; }
				        	$("#resultband").append("<li id='resultband_"+i+"' data-value='"+res.results[cle].band_id+"' style='background-color:"+col+"'><b>"+res.results[cle].name+"</b> <i>("+res.results[cle].subdomain+")</i></li>");
				        	$("#resultband_"+i).click(function(e){
				        		$("#band_id").attr("value",$(this).attr("data-value"));
				        	});
				        	i++;
				        }
				    }else{$("#resultband").html("");}
			    }
			});
		}
	}
	</script>
</div>
<div class="clear"></div>