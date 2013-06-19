$(document).ready(function() {
	$('#ajoutrub').css("cursor","pointer");
	$('#ajoutrub').click(function() {
		saveform_rub($('#zp_contenus').attr("data-id"));
	});
});

function recupform_rub(zone){
	set_loader(true);
	var formUrl = __prefix+"/rubriqueelements/ajax_recupzone/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone },
		success: function(data) {
			set_loader(false);
			if(data){
				$("#centre>.el_blocks").remove();
				$("#centre").prepend(data);
				init_sortable();
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}
function saveform_rub(zone){
	set_loader(true);
	var contenutype = $("#contenutype").val();
	var contenupage = $("#contenupagec").val();
	
	var formUrl = __prefix+"/rubriqueelements/ajax_saveform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { contenutype: contenutype,contenupage: contenupage,zone: zone },
		success: function(data) {
			set_loader(false);
			if(data){
				recupform_rub(zone);
			}
			
		
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}
function deleteform_rub(id){
	var formUrl = __prefix+"/rubriqueelements/ajax_deleteform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { id: id },
		success: function(data) {
			if(data){
				$('#re_'+id).remove();
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}

function setposition_rub(id,pos){
	var formUrl = __prefix+"/rubriqueelements/ajax_setposition/";
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
			//
		}
	});
}
