<?php
if($this->Session->read('Auth.User.id')){
	$forbidpage = array("catadmins", "users", "parametres");
	?>
	<div id="menuH">
		<ul>
			<?php 
			foreach($catM as $c){
				$catMs = $this->requestAction(array(
					"controller"=>"catadmins",
					"action"=>"getCat",
					"plugin"=>false
					),
					array("pass" => array($c["Catadmin"]["id"]))
				);
				//
				$rubencours = false;
				foreach($catMs as $cs){
					if(strtolower($this->params['controller'])==strtolower($cs["Catadmin"]["controller"])){
						$rubencours = true;
					}
				}
				if (!in_array(strtolower($c["Catadmin"]["controller"]), $forbidpage) || $this->Session->read('Auth.User.role')=="admin") {
					if($this->params['controller']==$c["Catadmin"]["controller"] || $rubencours == true){
						echo '<li class="ok">'.$c["Catadmin"]["nom"].'</li>'; 
					}else{
						echo '<li><a href="'.$this->Html->url(array('controller'=>$c["Catadmin"]["controller"],'action'=>$c["Catadmin"]["action"],'admin'=>true,'plugin'=>false)).'">'.$c["Catadmin"]["nom"].'</a></li>';
					}
					if(strtolower($this->params['controller'])==strtolower($c["Catadmin"]["controller"]) || $rubencours == true){
					?>
						<div class="menuS">
					<?php }else{ ?>
						<div class="menuS" style="display:none">
					<?php } ?>
						<ul>
						<?php
							
						
							$sscat = $this->requestAction(array(
								"controller"=>"catadmins",
								"action"=>"getCat",
								"plugin"=>false
								),
								array("pass" => array($c["Catadmin"]["id"]))
							);
							foreach($sscat as $ssc){
								if(strtolower($this->params['controller'])==strtolower($ssc["Catadmin"]["controller"]) && strtolower($this->params['action'])=="admin_".strtolower($ssc["Catadmin"]["action"])){
									echo '<li><p>'.$ssc["Catadmin"]["nom"].'</p></li>';
								}else{
									echo '<li><a href="'.$this->Html->url(array('controller'=>$ssc["Catadmin"]["controller"],'action'=>$ssc["Catadmin"]["action"],'admin'=>true)).'">'.$ssc["Catadmin"]["nom"].'</a></li>';
								}
							}
						
								
							
						?>
								
							
						</ul>
					</div>
					<?php
					echo '';
				}
			}
			?>
			
		</ul>
	</div>
	
<?php
}
?>
