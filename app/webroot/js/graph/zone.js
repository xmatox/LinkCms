$(document).ready(function() {
	var zone = "tete";
	var divencours;
	actuvisu();
	recupform(zone);
	$('.selectit').each(function(index) {
		$(this).click(function() {
			if ($(this).hasClass('zoneselect')) {
				/*initselectit();
				divencours = $("#zbody");
				$("#zbody").addClass('zoneselect');
				zone = "fond";*/
			}else{
				initselectit();
				divencours = $(this);
				$(this).addClass('zoneselect');
				zone = $(this).attr("id");
			}
			initselectit();
			divencours.addClass('zoneselect');
			recupform(zone);
			
		});
	});
	$('#ajoutelement').css("cursor","pointer");
	$('#ajoutelement').click(function() {
		saveform(zone);
	});
	$('#zp_css').css("cursor","pointer");
	$('#zp_css').click(function() {
		var graphid = $("#zp_name").attr('data-value');
		if(graphid){
			var link = __prefix+"/admin/graphelements/editzone/"+graphid;
			window.location.href=link;
		}else{
			alert('Cette zone est vide');
		}
	});
});
function initselectit(){
	$('.selectit').each(function(index) {
		$(this).removeClass('zoneselect');
	});
	$("#zbody").removeClass('zoneselect');
}
function recupform(zone){
	var formUrl = __prefix+"/zoneelements/ajax_recupform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone },
		success: function(data) {
			$("#zp_el").html("");
			if(data){
				
				$("#zp_name").html(zone);
				for ( var cle in data ) {
					//posi++;
					
					var datacle = data[cle];
					var dataid = datacle.id;
					var datatype = datacle.type;
					var dataordre = datacle.ordre;
					var datanom = datacle.nom;
					var dataelementtype_id = datacle.elementtype_id;
					var datagraphelement_id = datacle.graphelement_id;
					var datacontenupage_id = datacle.contenupage_id;
					$("#zp_name").attr('data-value',datagraphelement_id);
					$("#zp_el").append( $('<div class="zp_block" id="'+dataid+'" data-ordre="'+dataordre+'"><b>'+datatype+' : </b>'+datanom+'<div id="trash_'+dataid+'" class="trash"></div></div>') );
					
					$("#zp_el").sortable({
						axis: "y", // Le sortable ne s'applique que sur l'axe vertical
						// Evenement appelé lorsque l'élément est relaché
						stop: function(event, ui){
							// Pour chaque item de liste
							$(".zp_block").each(function(){
								// On actualise sa position
								index = parseInt($(this).index()+1);
								setposition($(this).attr("id"),index);
							});
						}
					});
				}
				$('.zp_block').each(function(index) {
					var lid = $(this).attr("id");
					$("#trash_"+lid).css("cursor","pointer");
					$("#trash_"+lid).click(function() {
						if(confirm("Etes vous sur de vouloir supprimer cet élément ?")){
							deleteform(lid);
						}
					});
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

function actuvisu(){
	var formUrl = __prefix+"/graphelements/ajax_actuvisu/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		success: function(data) {
			if(data){
				for ( var cle in data ) {
					var datacle = data[cle]["Graphelement"];
					if(datacle.nom=="fond"){
						if(datacle.fondcolor) $("#zbody").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#zbody").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#zbody").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#zbody").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#zbody",__prefix+"/img/graph/"+datacle.fondimg);
					}else if(datacle.nom=="tete"){
						if(datacle.width) $("#zcontenu").css("width",datacle.width/2);
						if(datacle.height) $("#tete").css("height",datacle.height/2);
						if(datacle.fondcolor) $("#tete").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#tete").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#tete").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#tete").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#tete",__prefix+"/img/graph/"+datacle.fondimg);
					}else if(datacle.nom=="pied"){
						if(datacle.height) $("#pied").css("height",datacle.height/2);
						if(datacle.fondcolor) $("#pied").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#pied").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#pied").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#pied").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#pied",__prefix+"/img/graph/"+datacle.fondimg);
					}else if(datacle.nom=="gauche"){
						if(!datacle.active) $("#gauche").css("width",0);
						else if(datacle.width) $("#gauche").css("width",datacle.width/2);
						if(datacle.fondcolor) $("#gauche").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#gauche").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#gauche").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#gauche").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#gauche",__prefix+"/img/graph/"+datacle.fondimg);
					}else if(datacle.nom=="droite"){
						if(!datacle.active) $("#droite").css("width",0);
						else if(datacle.width) $("#droite").css("width",datacle.width/2);
						if(datacle.fondcolor) $("#droite").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#droite").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#droite").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#droite").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#droite",__prefix+"/img/graph/"+datacle.fondimg);
					}else if(datacle.nom=="centre"){
						var Wcentre = $("#zcontenu").width()-$("#gauche").width()-$("#droite").width();
						$("#centre").css("width",Wcentre);
						if(datacle.fondcolor) $("#centre").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#centre").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#centre").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#centre").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#centre",__prefix+"/img/graph/"+datacle.fondimg);
					}
					
				}
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
function saveform(zone){
	
	var elementtype = $("#elementtype").val();
	var contenupage = $("#contenupage").val();
	
	var formUrl = __prefix+"/zoneelements/ajax_saveform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { elementtype: elementtype,contenupage: contenupage,zone: zone },
		success: function(data) {
			if(data){
				recupform(zone);
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
	var formUrl = __prefix+"/zoneelements/ajax_deleteform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { id: id },
		success: function(data) {
			if(data){
				$('#'+id).remove();
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
	var formUrl = __prefix+"/zoneelements/ajax_setposition/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { position: pos, id: id },
		success: function(data) {
			if(data){
				
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//alert(textStatus);
			//console.log(error);
			//setCountdown();
		}
	});
}