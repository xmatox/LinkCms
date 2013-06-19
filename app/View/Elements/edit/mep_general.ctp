	<!--<div id="zp_save_general" class="zp_save"></div>-->
	<div id="zp_openclose_general" class="zp_close"></div>
	<div id="zp_name_general" class="zp_name">MISE EN PAGE général</div>
	<div id="zp_cont_general" class="zp_cont">
		Largeur : <br/><input type="text" id="zp_width_g" /><br/><br/>
		Nombre de colone : <br/>
		<?php 
		$options = array('0'=>'Aucune', 'G'=>'A gauche', 'D'=>'A droite', 'DG'=>'A gauche et à droite');
	    echo $this->Form->select('zp_col_g', $options, array(
			'default' => '0',
			"label"=>"",
			"id"=>"nbcol",
			"onchange"=> "
			        $.get( '" . $this->Html->url( array( 'controller' => 'graphelements', 'action' => 'ajax_settype', 'admin' => true ), true ) . "',
			                { typegraph: $( '#nbcol' ).val() },
			                function( data ) {
			                     location.reload();
			                }
			        );
			        return false;"
	    )); 
		 ?><br/><br/>
	</div>