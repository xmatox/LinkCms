<div id="zp_openclose_menu" class="zp_close"></div>
	<div id="zp_name_menu" class="zp_name">MENUS</div>
	<div id="zp_cont_menu" class="zp_cont">
		<?php 
		echo "<div class='ajout showiframe' data-value='admin/menugroupes/edit' style='margin:5px 10px 10px 10px'>Ajouter un menu</div>";
		$nColor = 0;
		foreach($groupe as $c){
			$nColor++;
			if($nColor%2==0){
				echo "<ul class='tab1'>";
			}else{
				echo "<ul class='tab2'>";
			}
				echo "<li class='tab_li_titre'>";
					echo $this->Html->link(
						$c['Menugroupe']['nom'],
						'',
						array(
							'onclick' => "show_iframe('admin/menus/list/".$c["Menugroupe"]["id"]."'); return false;",
							'escape'=>false
						)
					);
				echo "</li>";
				
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/suprim_h20.png', array(
							"alt" => "Supprimer",
							"title" => "Supprimer"
						)),
						'',
						array(
							'onclick' => "if(confirm('Etes-vous sür de vouloir supprimer ce menu ?')) show_iframe('admin/menugroupes/suprim/".$c["Menugroupe"]["id"]."'); return false;",
							'escape'=>false
						)
					);
				echo "</li>";
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/param.png', array(
							"alt" => "Modifier",
							"title" => "Configurer"
						)),
						'',
						array(
							'onclick' => "show_iframe('admin/menugroupes/edit/".$c["Menugroupe"]["id"]."'); return false;",
							'escape'=>false
						)
					);
				echo "</li>";
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/modif_h20.png', array(
							"alt" => "Ecrire",
							"title" => "Editer"
						)),
						'',
						array(
							'onclick' => "show_iframe('admin/menus/list/".$c["Menugroupe"]["id"]."'); return false;",
							'escape'=>false
						)
					);
				echo "</li>";
				echo "<li class='tab_li_img'>";
				if($c["Menugroupe"]["mobile"]==true) $checkmobile = "checked";
				else $checkmobile = "";
				echo $this->Form->radio('mobile',array($c["Menugroupe"]["id"]=>" "), 
					array(
						"label"=>"",
						"checked"=>$checkmobile,
						"onclick"=>
							"$.ajax({
							type: 'POST',
							url: '" . $this->Html->url( array( 'controller' => 'menugroupes', 'action' => 'ajax_setmobile', 'admin' => false ), true ) . "',
		                    data:{id: ".$c["Menugroupe"]["id"]." },
		                    success: function( data ) {}
			                });
			                return true;",
						"title" => "Mobile"
	                ));
				echo "</li>";
				
			echo "</ul>";
		}
		 ?>
	</div>