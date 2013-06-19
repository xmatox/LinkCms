<div id="zp_elements" style="display:none;">
		<div id="zp_openclose_element" class="zp_close"></div>
		<div id="zp_name_element" class="zp_name">ELEMENTS</div>
		<div id="zp_cont_element" class="zp_cont">
			<?php
			echo "<div style='margin-left:10px'>";
				echo "<br/><label>Type : </label><br/>";
				echo $this->Form->input("Zoneelement.contenutype_id",array(
					"options"=>$type,
					"label"=>"",
					"id"=>"elementtype",
					"onchange"=> "
			                $.get( '" . $this->Html->url( array( 'controller' => 'zoneelements', 'action' => 'ajax_getpages', 'admin' => true ), true ) . "',
			                        { id: $( '#elementtype' ).val() },
			                        function( data ) {
			                            var obj = jQuery.parseJSON( data );
										$('#contenupage').empty();
										$('#contenupage').append('<option value=\"new\">Nouveau</option>');
										 $.each(obj, function(index, value) {
											$('#contenupage').append('<option value=\"'+ index +'\">'+ value +'</option>');
										});
			                        }
			                );
			                return false;"
				));
				echo "<br/><label>Page : </label><br/>";
				echo $this->Form->input("Zoneelement.contenupage_id",array("options"=>"","label"=>"","id"=>"contenupage"));
			echo "</div>";
			echo "<div class='ajout' id='ajoutelement'>Ajouter</div>";
			
			?>
		</div>
	</div>