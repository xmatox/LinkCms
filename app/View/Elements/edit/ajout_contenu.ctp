<div id="zp_contenus" style="display:none;">
		<div id="zp_openclose_contenu" class="zp_close"></div>
		<div id="zp_name_contenu" class="zp_name">CONTENUS</div>
		<div id="zp_cont_contenu" class="zp_cont">
			<?php
			echo "<div style='margin-left:10px'>";
				echo "<br/><label>Type : </label><br/>";
				echo $this->Form->input("Rubriqueelement.contenutype_id",array(
					"options"=>$typec,
					"label"=>"",
					"id"=>"contenutype",
					"onchange"=> "
			                $.get( '" . $this->Html->url( array( 'controller' => 'rubriqueelements', 'action' => 'ajax_getpages', 'admin' => true ), true ) . "',
			                        { id: $( '#contenutype' ).val() },
			                        function( data ) {
			                            var obj = jQuery.parseJSON( data );
										$('#contenupagec').empty();
										$('#contenupagec').append('<option value=\"new\">Nouveau</option>');
										 $.each(obj, function(index, value) {
											$('#contenupagec').append('<option value=\"'+ index +'\">'+ value +'</option>');
										});
			                        }
			                );
			                return false;"
				));
				echo "<br/><label>Page : </label><br/>";
				echo $this->Form->input("Rubriqueelement.contenupage_id",array("options"=>"","label"=>"","id"=>"contenupagec"));
			echo "</div>";
			echo "<div class='ajout' id='ajoutrub'>Ajouter</div>";
			
			?>
		</div>
	</div>