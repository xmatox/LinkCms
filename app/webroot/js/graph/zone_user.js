$(document).ready(function() {
	$('#ajoutelement').css("cursor","pointer");
	$('#ajoutelement').click(function() {
		saveform_el($('#zp_elements').attr("data-id"));
	});
});

function recupform_el(zone){
	set_loader(true);
	var formUrl = __prefix+"/zoneelements/ajax_recupzone/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone },
		success: function(data) {
			set_loader(false);
			if(data){
				$("#"+zone+">.el_block").remove();
				$("#"+zone+"").prepend(data);
				init_sortable();
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}
function saveform_el(zone){
	set_loader(true);
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
			set_loader(false);
			if(data){
				recupform_el(zone);
			}
			
		
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}
/*
function actuvisu_el(){
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

					if(datacle.fondcolor) $("#"+datacle.nom).css("background-color",datacle.fondcolor);
					if(datacle.fondimg) $("#"+datacle.nom).css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimgfolder+datacle.fondimg+"')");
					if(datacle.fondimgpos) $("#"+datacle.nom).css("background-position",datacle.fondimgpos);
					if(datacle.fondimgrepeat) $("#"+datacle.nom).css("background-repeat",datacle.fondimgrepeat);
					if(datacle.fondimg) getImgSize("#"+datacle.nom,__prefix+"/img/graph/"+datacle.fondimgfolder+datacle.fondimg);

					if(datacle.nom=="fond"){
						
					}else if(datacle.nom=="tete"){
						if(datacle.width) $("#zcontenu").css("width",datacle.width/2);
						if(datacle.height) $("#tete").css("height",datacle.height/2);
					}else if(datacle.nom=="pied"){
						if(datacle.height) $("#pied").css("height",datacle.height/2);
					}else if(datacle.nom=="gauche"){
						if(!datacle.active) $("#gauche").css("width",0);
						else if(datacle.width) $("#gauche").css("width",datacle.width/2);
					}else if(datacle.nom=="droite"){
						if(!datacle.active) $("#droite").css("width",0);
						else if(datacle.width) $("#droite").css("width",datacle.width/2);
					}else if(datacle.nom=="centre"){
						var Wcentre = $("#zcontenu").width()-$("#gauche").width()-$("#droite").width();
						$("#centre").css("width",Wcentre);
					}
					
				}
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}
*/
function deleteform_el(id){
	set_loader(true);
	var formUrl = __prefix+"/zoneelements/ajax_deleteform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { id: id },
		success: function(data) {
			set_loader(false);
			if(data){
				$('#ze_'+id).remove();
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}

function setposition_el(id,pos){
	set_loader(true);
	var formUrl = __prefix+"/zoneelements/ajax_setposition/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { position: pos, id: id },
		success: function(data) {
			set_loader(false);
			if(data){
				
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}