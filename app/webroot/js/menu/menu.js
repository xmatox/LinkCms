(function($){

	var o = {
		idgroupe : '',
		idgraph : '',
		message : 'Déposez vos fichiers ici',
		script : 'menu.php',
		dosRacine : __prefix+"/",
		complete : function(json){
			return false;
		}
	}
	$.fn.menu = function(oo){
		var replace = false;
		if(oo) $.extend(o,oo);
		creamenu();
		actuvisu();
		$('#zpm_save').css("cursor","pointer");
		$('#zpm_save').click(function() {
			console.log("5");
			saveform();
		});
		$('#supprimgm').css("cursor","pointer");
		$('#supprimgm').click(function() {
			$("#dropfile_content > div > img").remove();
			$('#zpm_fondimg').val("");
		});
		//
		$('.etats').each(function(){
			$(this).css("cursor","pointer");
			$(this).click(function() {
				$('#zpm_save').attr('data-value',$(this).attr('data-value'));
				actuvisu();
				initetat();
				$(this).addClass('actif');
			});
		});
		function initetat(){
			$('.etats').each(function(){
				$(this).removeClass('actif');
				
			});
		}
		function creamenu(){
			
			$("#constmenu").prepend( $('<div class="constmenu2" id="constmenu2" ></div>') );
			$("#constmenu").prepend( $('<div class="constmenu1" id="constmenu1" ></div>') );
			recupmenu();
			
			/*this.each(function(){
			});*/
		}
		function recupmenu(){
			
			var formUrl = o.dosRacine+"menus/ajax_recup/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				data: { idgroupe: o.idgroupe },
				dataType: 'json',
				success: function(data) {
					var posi=0;
					if(data){
						for ( var cle in data ) {
							posi++;
							var datacle = data[cle]["Menu"];
							var dataid = datacle.id;
							var dataordre = datacle.ordre;
							var datanom = datacle.nom;
							var datarubrique_id = datacle.rubrique_id;
							$("#constmenu2").append( $('<div class="menu_cont" id="'+dataid+'" data-ordre="'+dataordre+'"></div>') );
							creaform(dataid,datanom,datarubrique_id);
							/*$("#menu"+dataid).draggable({
								opacity: 0.50,
								revert: true,
								zIndex:2600
							});*/
							$("#constmenu2").sortable({
								axis: "x", // Le sortable ne s'applique que sur l'axe vertical
								// Evenement appelé lorsque l'élément est relaché
								stop: function(event, ui){
									// Pour chaque item de liste
									$(".menu_cont").each(function(){
										// On actualise sa position
										index = parseInt($(this).index()+1);
										setposition($(this).attr("id"),index);
									});
								}
							});
						}
					}
					posi++;
					$("#constmenu1").prepend( $('<div class="menu_cont_vide" data-ordre="'+posi+'">Ajouter une rubrique</div>') );
					$(".menu_cont_vide").css("cursor","pointer");
					$(".menu_cont_vide").click(function() {
						addmenu();
					});
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
		function addmenu(){
			
			var formUrl = o.dosRacine+"menus/ajax_add/";
			
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { ordre: $(".menu_cont_vide").attr("data-ordre"),idgroupe: o.idgroupe },
				success: function(data) {
					if(data){
					console.log(data);
						var dataid = data;
						var datanom = "";
						var datarubrique_id = "";
						var ordre = $(".menu_cont_vide").attr("data-ordre");
						$(".menu_cont_vide").attr("data-ordre",ordre+1);
						$("#constmenu2").append( $('<div class="menu_cont" id="'+dataid+'" data-ordre="'+ordre+'"></div>') );
						creaform(dataid,datanom,datarubrique_id);
						
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
		
		function creaform(id,nom,rub){
			var formUrl = o.dosRacine+"menus/ajax_rub/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				
				success: function(data) {
					if(data){
						
						var retour = "<div id='trash_"+id+"' class='trash'></div>";
						retour += "<div id='save_"+id+"' class='save'></div>";
						//retour += "<div class='menuform'>Nom : <input type='text' class='menuinput' id='nom_"+id+"' /><br/>";
						retour += "<div class='menuform'>";
						retour += "Rubrique : <select id='rub_"+id+"' class='menuinput'>";
						
						for ( var cle in data ) {
							var datacle = data[cle]["Rubrique"];
							var dataid = datacle.id;
							var datanom = datacle.nom;
							retour += '<option value="'+dataid+'">'+datanom+'</option>';
						}
						retour += '</select></div>';
						$("#"+id).append( retour );
						//$("#nom_"+id).val(nom);
						$("#rub_"+id).val(rub);
						//
						$("#save_"+id).css("cursor","pointer");
						$("#save_"+id).click(function() {
							savemenu(id);
						});
						$("#trash_"+id).css("cursor","pointer");
						$("#trash_"+id).click(function() {
							if(confirm("Etes vous sur de vouloir supprimer cette rubrique ?")){
								deleteform(id);
							}
						});
						
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
		function savemenu(id){
			var formUrl = o.dosRacine+"menus/ajax_saveform/";
			//var dnom = $("#nom_"+id).val();
			var drub = $("#rub_"+id).val();
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { rub: drub, id: id },
				beforeSend: function(jqXHR, settings) {
					$("#"+id).css("opacity","0.4");
				},
				success: function(data) {
					if(data){
						$("#"+id).css("opacity","1");
						actuvisu();
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
		function deleteform(id){
			var formUrl = o.dosRacine+"menus/ajax_deleteform/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { id: id },
				success: function(data) {
					if(data){
						$('#'+id).remove();
						actuvisu();
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
		
		function setposition(id,pos){
			var formUrl = o.dosRacine+"menus/ajax_setposition/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { position: pos, id: id },
				success: function(data) {
					if(data){
						actuvisu();
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
				
		function actuvisu(){
			var formUrl = o.dosRacine+"menugroupes/ajax_actuvisu/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { id: o.idgraph,idgroupe: o.idgroupe },
				success: function(data) {
					if(data){
					
						var datacle = data["css"]["Graphelement"];
						var datacleroll = data["cssroll"]["Graphelement"];
						var datamenu = data["menu"];
						
						$("#visumenu").html(datamenu);
						initmenu();
						if(datacle.width) $(".elb_menu").css("width",datacle.width);
						if(datacle.float) $(".elb_menu").css("float",datacle.float);
						
						setcss(datacle,".elb_menu a");
						$(".elb_menu>ul>li").css("width","100%");
						
						$(".elb_menu a").hover(
							function () {
								setcss(datacleroll,this);
							},
							function () {
								setcss(datacle,this);
							}
						);
						
						
						//if(datacle.fondimg) getImgSize(".elb_menu",o.dosRacine+"/img/graph/"+datacle.fondimg);
						//
						
						
						if($('#zpm_save').attr('data-value')=='roll'){
							var dc = datacleroll;
						}else{
							var dc = datacle;
						}
						
						if(dc.width) $("#zpm_width").val(dc.width); else $("#zpm_width").val("");
						if(dc.height) $("#zpm_height").val(dc.height); else $("#zpm_height").val("");
						if(dc.border){ var aborder=dc.border.split(' '); $("#zpm_border1").val(aborder[0]); $("#zpm_border2").val(aborder[1]); }else{ $("#zpm_border1").val("0px"); $("#zpm_border2").val("#000000");  }
						if(dc.borderradius){ var aborderradius=dc.borderradius.split('px '); $("#zpm_borderradius1").val(aborderradius[0]); $("#zpm_borderradius2").val(aborderradius[1]); $("#zpm_borderradius3").val(aborderradius[2]); $("#zpm_borderradius4").val(aborderradius[3]); }else{ $("#zpm_borderradius1").val(0); $("#zpm_borderradius2").val(0); $("#zpm_borderradius3").val(0); $("#zpm_borderradius4").val(0); }
						if(dc.margin){ var amargin=dc.margin.split('px '); $("#zpm_margin1").val(amargin[0]); $("#zpm_margin2").val(amargin[1]); $("#zpm_margin3").val(amargin[2]); $("#zpm_margin4").val(amargin[3]); }else{ $("#zpm_margin1").val(0); $("#zpm_margin2").val(0); $("#zpm_margin3").val(0); $("#zpm_margin4").val(0); }
						if(dc.padding){ var apadding=dc.padding.split('px '); $("#zpm_padding1").val(apadding[0]); $("#zpm_padding2").val(apadding[1]); $("#zpm_padding3").val(apadding[2]); $("#zpm_padding4").val(apadding[3]); }else{ $("#zpm_padding1").val(0); $("#zpm_padding2").val(0); $("#zpm_padding3").val(0); $("#zpm_padding4").val(0); }
						if(dc.float) $("#zpm_float").val(dc.float); else $("#zpm_float").val("");
						if(dc.fondcolor) $("#zpm_fondcolor").val(dc.fondcolor); else $("#zpm_fondcolor").val("");
						if(dc.textfont) $("#zpm_textfont").val(dc.textfont); else $("#zpm_textfont").val("");
						if(dc.textsize) $("#zpm_textsize").val(dc.textsize); else $("#zpm_textsize").val("");
						if(dc.textcolor) $("#zpm_textcolor").val(dc.textcolor); else $("#zpm_textcolor").val("");
						if(dc.textalign) $("#zpm_textalign").val(dc.textalign); else $("#zpm_textalign").val("");
						if(dc.textgras) $("#zpm_textgras").val(dc.textgras); else $("#zpm_textgras").val("");
						if(dc.fondimg) $("#zpm_fondimg").val(dc.fondimg); else $("#zpm_fondimg").val("");
						if(dc.fondimgpos) $("#zpm_fondimgpos").val(dc.fondimgpos); else $("#zpm_fondimgpos").val("");
						if(dc.fondimgrepeat) $("#zpm_fondimgrepeat").val(dc.fondimgrepeat); else $("#zpm_fondimgrepeat").val("");
						
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//console.log(error);
				}
			});
		}
		function setcss(datacle,div){
			if(datacle.width) $(div).css("width",datacle.width);
			if(datacle.height) $(div).css("height",datacle.height);
			if(datacle.border) $(div).css("border",datacle.border);
			if(datacle.borderradius) $(div).css("-moz-border-radius",datacle.borderradius);
			if(datacle.borderradius) $(div).css("-webkit-border-radius",datacle.borderradius);
			if(datacle.margin) $(div).css("margin",datacle.margin);
			if(datacle.padding) $(div).css("padding",datacle.padding);
			if(datacle.fondcolor) $(div).css("background-color",datacle.fondcolor);
			if(datacle.textfont) $(div).css("font-family",datacle.textfont);
			if(datacle.textsize) $(div).css("font-size",datacle.textsize);
			if(datacle.textcolor) $(div).css("color",datacle.textcolor);
			if(datacle.textalign) $(div).css("text-align",datacle.textalign);
			if(datacle.textgras) $(div).css("font-weight",datacle.textgras);
			$(div).css("background-image","url('"+o.dosRacine+"/img/graph/"+datacle.fondimg+"')");
			if(datacle.fondimgpos) $(div).css("background-position",datacle.fondimgpos);
			if(datacle.fondimgrepeat) $(div).css("background-repeat",datacle.fondimgrepeat);
		}
		function saveform(){
			console.log("ok");
			var id = o.idgraph;
			var width = $("#zpm_width").val();
			var height = $("#zpm_height").val();
			var border = $("#zpm_border1").val()+" "+$("#zpm_border2").val()+" solid";
			var margin = $("#zpm_margin1").val()+"px "+$("#zpm_margin2").val()+"px "+$("#zpm_margin3").val()+"px "+$("#zpm_margin4").val()+"px ";
			var borderradius = $("#zpm_borderradius1").val()+"px "+$("#zpm_borderradius2").val()+"px "+$("#zpm_borderradius3").val()+"px "+$("#zpm_borderradius4").val()+"px ";
			var padding = $("#zpm_padding1").val()+"px "+$("#zpm_padding2").val()+"px "+$("#zpm_padding3").val()+"px "+$("#zpm_padding4").val()+"px ";
			var float = $("#zpm_float").val();
			var fondcolor = $("#zpm_fondcolor").val();
			var textfont = $("#zpm_textfont").val();
			var textsize = $("#zpm_textsize").val();
			var textcolor = $("#zpm_textcolor").val();
			var textalign = $("#zpm_textalign").val();
			var textgras = $("#zpm_textgras").val();
			var fondimg = $("#zpm_fondimg").val();
			var fondimgpos = $("#zpm_fondimgpos").val();
			var fondimgrepeat = $("#zpm_fondimgrepeat").val();
			var etats = $('#zpm_save').attr('data-value');
			
			var formUrl = o.dosRacine+"menugroupes/ajax_saveform/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { id: id,width: width,height: height,border: border,margin: margin,padding: padding,float: float,fondcolor: fondcolor,borderradius: borderradius,textsize: textsize,textcolor: textcolor,textalign: textalign,textgras: textgras,textfont: textfont,fondimg: fondimg,fondimgpos: fondimgpos,fondimgrepeat: fondimgrepeat,etats: etats },
				beforeSend: function(jqXHR, settings) {
					$("#zpm_save").css("opacity","0.4");
				},
				success: function(data) {
				if(data){
					$("#zpm_save").css("opacity","1");
					actuvisu();
				}
				
				
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
		}
		function getImgSize(div,imgSrc){
		   var i=new Image;
			i.src=imgSrc;
			i.onload=function(){
				console.log("'"+i.width/2+"px "+i.height/2+"px'");
				$(div).css("background-size",''+i.width/2+'px '+i.height/2+'px');
			}
			
		}
	}
})(jQuery);