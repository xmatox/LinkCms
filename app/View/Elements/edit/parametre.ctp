<div id="zp_openclose_parametre" class="zp_close"></div>
	<div id="zp_name_parametre" class="zp_name">PARAMETRE</div>
	<div id="zp_cont_parametre" class="zp_cont">
		<ul class='tab1'>
			<li class='tab_li_titre'>
				<?php 
				echo $this->Html->link(
					"Paramètre",
					'',
					array(
						'onclick' => "show_iframe('admin/parametres/edit/'); return false;",
						'escape'=>false
					)
				); 
				?>
			</li>
		</ul>
		<ul class='tab2'>
			<li class='tab_li_titre'>
				<?php 
				echo $this->Html->link(
					"Langues",
					'',
					array(
						'onclick' => "show_iframe('admin/Languages/list/'); return false;",
						'escape'=>false
					)
				); 
				?>
			</li>
		</ul>
		<ul class='tab1'>
			<li class='tab_li_titre'>
				<?php 
				echo $this->Html->link(
					"CSS",
					'',
					array(
						'onclick' => "show_iframe('admin/styles/edit/'); return false;",
						'escape'=>false
					)
				); 
				?>
			</li>
		</ul>
		<ul class='tab2'>
			<li class='tab_li_titre'>
				<?php 
				echo $this->Html->link(
					"Utilisateurs",
					'',
					array(
						'onclick' => "show_iframe('admin/Users/list/'); return false;",
						'escape'=>false
					)
				); 
				?>
			</li>
		</ul>
	</div>