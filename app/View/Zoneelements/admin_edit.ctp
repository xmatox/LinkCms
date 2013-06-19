<?php
echo $this->Html->script("/js/jquery/colorpicker/js/colorpicker.js");
echo $this->Html->script("/js/jquery/colorpicker/js/eye.js");
echo $this->Html->script("/js/jquery/colorpicker/js/utils.js");
echo $this->Html->script("/js/jquery/colorpicker/js/layout.js?ver=1.0.2");
echo $this->Html->css("/js/jquery/colorpicker/css/colorpicker.css");
echo $this->Html->css("/js/jquery/colorpicker/css/layout.css");

echo $this->Html->script("/js/multiupload/dropfile.js");
echo $this->Html->css("/js/multiupload/style.css");

echo $this->Html->script("/js/graph/zone.js");
echo $this->Html->css("/admin/graph.css");



echo "<h1>";
	echo "Graphisme";
echo "</h1>";

?>


<br/>
<i>Cliquez sur une zone pour la sélectionner.<br/>
<div id="zonevisu">
	<div id="zbody" class="">
		<div id="zcontenu">
			<div id="tete" class="zheader selectit zoneselect">
				
			</div>
			<div id="gauche" class="znav selectit">
				
			</div>
			<div id="centre" class="zcontent ">
				
			</div>
			<div id="droite" class="znav selectit">
				
			</div>
			<div class="clear"></div>
			<div id="pied" class="zfooter selectit">
				
			</div>
		</div>
	</div>
</div>
<fieldset style="width:310px;margin-left:8px;float:left">
<legend> 
Eléments :
</legend> 
<?php
echo "<div style='margin-left:70px'>";
	echo "<br/><label>Type : </label><br/>";
	echo $this->Form->input("Zoneelement.contenutype_id",array(
		"options"=>$type,
		"label"=>"",
		"id"=>"elementtype",
		"onchange"=> "
                $.get( '" . $this->Html->url( array( 'controller' => 'zoneelements', 'action' => 'ajax_getpages' ), true ) . "',
                        { id: $( '#elementtype' ).val() },
                        function( data ) {
                            var obj = jQuery.parseJSON( data );
							$('#contenupage').empty();
							 $.each(obj, function(index, value) {
								$('#contenupage').append('<option value=\"'+ index +'\">'+ value +'</option>');
							});
                        }
                );
                return false;"
	));
	echo "<br/><label>Page : </label><br/>";
	echo $this->Form->input("Zoneelement.contenupage_id",array("options"=>$pages,"label"=>"","id"=>"contenupage"));
echo "</div>";
echo "<div class='ajout' id='ajoutelement'>Ajouter</div>";

?>
</fieldset>
<div id="zoneparam" style="height:auto">
	<div id="zp_css"></div><br/>
	<div id="zp_name"></div><br/>
	<div id="zp_el"></div><br/>
</div>
<div class="clear"></div>
