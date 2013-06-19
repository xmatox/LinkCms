<div id="zp_openclose_rubrique" class="zp_close"></div>
	<div id="zp_name_rubrique" class="zp_name">RUBRIQUES</div>
	<div id="zp_cont_rubrique" class="zp_cont">
		<?php 
		echo "<div class='ajout showiframe' data-value='admin/rubriques/edit/cat:0' style='margin:5px 10px 10px 10px'>Ajouter une rubrique</div>";
		$nColor = 0;
		foreach($allrub as $ar){
			$c = $ar["rub"];
			
			$nColor++;
			if($nColor%2==0){
				echo "<ul class='tab1'>";
			}else{
				echo "<ul class='tab2'>";
			}
				echo "<li class='tab_li_titre'>";
					echo $c['Rubrique']['nom'];
				echo "</li>";
				echo "<li class='tab_li_img'>";
				if($c["Rubrique"]["id"]!=1){
					
					echo $this->Html->link(
						$this->Html->image('/admin/suprim_h20.png', array(
							"alt" => "Supprimer",
							"title" => "Supprimer"
						)),
						'',
						array(
							'onclick' => "if(confirm('Etes-vous sür de vouloir supprimer cette page ?')) show_iframe('admin/rubriques/suprim/".$c["Rubrique"]["id"]."'); return false;",
							'escape'=>false
						)
					);
					
				}
				echo "</li>";
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/param.png', array(
							"alt" => "Modifier",
							"title" => "Modifier paramètre"
						)),
						'',
						array(
							'onclick' => "show_iframe('admin/rubriques/edit/".$c["Rubrique"]["id"]."'); return false;",
							'escape'=>false
						)
					);
				echo "</li>";
				if ($c["Rubrique"]["contenutype_id"]!=0) {
					echo "<li class='tab_li_img'>";
						echo $this->Html->link(
							$this->Html->image('/admin/voir_h20.png', array(
								"alt" => "Voir",
								"title" => "Aller sur cette rubrique"
							)),
							array(
								'controller'=>'rubriques', 
								'action'=>'view', 
								$c["Rubrique"]["id"],
								'admin'=>false
							),
							array('escape'=>false)
						);
					echo "</li>";
				}
				echo "<li class='tab_li_img'>";
					echo $this->Html->link(
						$this->Html->image('/admin/add.png', array(
							"alt" => "Ajouter une sous rubrique",
							"title" => "Ajouter une sous rubrique"
						)),
						'',
						array(
							'onclick' => "show_iframe('admin/rubriques/edit/cat:".$c["Rubrique"]["id"]."'); return false;",
							'escape'=>false
						)
					);
				echo "</li>";
				
			echo "</ul>";
			if (isset($ar["sousrub"])){
				$sc = $ar["sousrub"];
				
				foreach($sc as $c){
					
					//$nColor++;
					if($nColor%2==0){
						echo "<ul class='tab1 tab3'>";
					}else{
						echo "<ul class='tab2 tab4'>";
					}

						echo "<li class='tab_li_titre'>";
							echo $c['Rubrique']['nom'];
						echo "</li>";
						echo "<li class='tab_li_img'>";
						if($c["Rubrique"]["id"]!=1){
							
							echo $this->Html->link(
								$this->Html->image('/admin/suprim_h20.png', array(
									"alt" => "Supprimer",
									"title" => "Supprimer"
								)),
								'',
								array(
									'onclick' => "if(confirm('Etes-vous sür de vouloir supprimer cette page ?')) show_iframe('admin/rubriques/suprim/".$c["Rubrique"]["id"]."'); return false;",
									'escape'=>false
								)
							);
							
						}
						echo "</li>";
						echo "<li class='tab_li_img'>";
							echo $this->Html->link(
								$this->Html->image('/admin/param.png', array(
									"alt" => "Modifier",
									"title" => "Modifier paramètre"
								)),
								'',
								array(
									'onclick' => "show_iframe('admin/rubriques/edit/".$c["Rubrique"]["id"]."'); return false;",
									'escape'=>false
								)
							);
						echo "</li>";
						if ($c["Rubrique"]["contenutype_id"]!=0) {
							echo "<li class='tab_li_img'>";
								echo $this->Html->link(
									$this->Html->image('/admin/voir_h20.png', array(
										"alt" => "Voir",
										"title" => "Aller sur cette rubrique"
									)),
									array(
										'controller'=>'rubriques', 
										'action'=>'view', 
										$c["Rubrique"]["id"],
										'admin'=>false
									),
									array('escape'=>false)
								);
							echo "</li>";
						}
						
					echo "</ul>";
					
				}
			}
		}
		 ?>
	</div>