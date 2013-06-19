<div id="zp_openclose_plugin" class="zp_close"></div>
	<div id="zp_name_plugin" class="zp_name">PLUGINS</div>
	<div id="zp_cont_plugin" class="zp_cont">
		<?php 
		if(empty($typecat)){
			echo "<div class='error'>Il n'y a pas de plugin.</div>";
		}else{
			
			$nColor = 0;
			foreach($typecat as $c){
				$nColor++;
				if($nColor%2==0){
					echo "<ul class='tab1'>";
				}else{
					echo "<ul class='tab2'>";
				}
					echo "<li class='tab_li_titre'>";
						echo $this->Html->link(
							$c['Contenutype']['nom'],
							'',
							array(
								'onclick' => "show_iframe('admin/".strtolower($c['Contenutype']['table'])."/".strtolower($c['Contenutype']['table'])."/list/'); return false;",
								'escape'=>false
							)
						);
					echo "</li>";
					
					echo "<li class='tab_li_img'>";
						
						echo $this->Html->link(
							$this->Html->image('/admin/suprim_h20.png', array(
								"alt" => "Supprimer"
							)),
							'',
							array(
								'onclick' => "show_iframe('admin/".strtolower($c['Contenutype']['table'])."/".strtolower($c['Contenutype']['table'])."/delete/'); return false;",
								'escape'=>false
							)
						);
					echo "</li>";
					
					
					
				echo "</ul>";
			}

		}
		$notexist = array();
		foreach($listeplugin[0] as $lp){
			foreach($typecat as $c){
				$exist = false;
				if ($c['Contenutype']['table']==$lp) {
					$exist = true;
					break;
				}
			}
			if(!$exist) array_push($notexist,$lp);
		}
		foreach($notexist as $lp){

					echo "<ul class='tab1' style='background-color:#C9C9C9'>";
				
					echo "<li class='tab_li_titre'>";
						echo $this->Html->link(
							$lp,
							'',
							array(
								'onclick' => "show_iframe('admin/".strtolower($lp)."/".strtolower($lp)."/install/'); return false;",
								'escape'=>false
							)
						);
					echo "</li>";
					
					echo "<li class='tab_li_img'>";
						
						echo $this->Html->link(
							$this->Html->image('/admin/add.png', array(
								"alt" => "Installer"
							)),
							'',
							array(
								'onclick' => "show_iframe('admin/".strtolower($lp)."/".strtolower($lp)."/install/'); return false;",
								'escape'=>false
							)
						);
					echo "</li>";
					
					
				echo "</ul>";
				
		}
		 ?>
	</div>