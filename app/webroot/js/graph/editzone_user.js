$(document).ready(function() {
	$('#zp_save_elstyle').css("cursor","pointer");
	$('#zp_save_elstyle').click(function() {
		saveform_fe();
		
	});
	$('#supprimg_e').click(function() {
		$("#dropfile_content_e > div > img").remove();
		$('#zpe_fondimg').val("");
	});
});
function initselectit_fe(){
	$('.el_block').each(function(index) {
		if ($(this).hasClass('zoneselect2')) {
			$(this).removeClass('zoneselect2');
		}
	});
}
function actuvisu_fe(zone){
	if(zone.substr(0,2)=="re"){
		var formUrl = __prefix+"/rubriqueelements/ajax_actueditzone/";
		element_id = zone.replace("re_","");
	}else{
		var formUrl = __prefix+"/zoneelements/ajax_actueditzone/";
		element_id = zone.replace("ze_","");
	}
	
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone,id: element_id },
		success: function(data) {
			if(data){
				$("#zp_name_elstyle").html("<b>ELEMENT : "+data["nom"]+"</b>");
				$("#zp_elstyle").attr("data-id",zone);
					var datacle = data["css"]["Graphelement"];
					if(datacle.width) $("#"+zone).css("width",datacle.width);
						if(datacle.width) $("#zpe_width").val(datacle.width); else $("#zpe_width").val("");
						if(datacle.height) $("#"+zone).css("height",datacle.height);
						if(datacle.height) $("#zpe_height").val(datacle.height); else $("#zpe_height").val("");
						if(datacle.border) $("#"+zone).css("border",datacle.border);
						if(datacle.border){ var aborder=datacle.border.split(' '); $("#zpe_border1").val(aborder[0]); $("#zpe_border2").val(aborder[1]); }else{ $("#zpe_border1").val("0px"); $("#zpe_border2").val("#000000");  }
						if(datacle.borderradius) $("#"+zone).css("-moz-border-radius",datacle.borderradius);
						if(datacle.borderradius) $("#"+zone).css("-webkit-border-radius",datacle.borderradius);
						if(datacle.borderradius){ var aborderradius=datacle.borderradius.split('px '); $("#zpe_borderradius1").val(aborderradius[0]); $("#zpe_borderradius2").val(aborderradius[1]); $("#zpe_borderradius3").val(aborderradius[2]); $("#zpe_borderradius4").val(aborderradius[3]); }else{ $("#zpe_borderradius1").val(0); $("#zpe_borderradius2").val(0); $("#zpe_borderradius3").val(0); $("#zpe_borderradius4").val(0); }
						if(datacle.margin) $("#"+zone).css("margin",datacle.margin);
						if(datacle.margin){ var amargin=datacle.margin.split('px '); $("#zpe_margin1").val(amargin[0]); $("#zpe_margin2").val(amargin[1]); $("#zpe_margin3").val(amargin[2]); $("#zpe_margin4").val(amargin[3]); }else{ $("#zpe_margin1").val(0); $("#zpe_margin2").val(0); $("#zpe_margin3").val(0); $("#zpe_margin4").val(0); }
						if(datacle.padding) $("#"+zone).css("padding",datacle.padding);
						if(datacle.padding){ var apadding=datacle.padding.split('px '); $("#zpe_padding1").val(apadding[0]); $("#zpe_padding2").val(apadding[1]); $("#zpe_padding3").val(apadding[2]); $("#zpe_padding4").val(apadding[3]); }else{ $("#zpe_padding1").val(0); $("#zpe_padding2").val(0); $("#zpe_padding3").val(0); $("#zpe_padding4").val(0); }
						if(datacle.float) $("#"+zone).css("float",datacle.float); else $("#"+zone).css("float","none");
						if(datacle.float) $("#zpe_float").val(datacle.float); else $("#zpe_float").val("");
						$("#"+zone).css("background-color",datacle.fondcolor);
						if(datacle.fondcolor) $("#zpe_fondcolor").val(datacle.fondcolor); else $("#zpe_fondcolor").val("");
						if(datacle.textsize) $("#"+zone).css("font-size",datacle.textsize);
						if(datacle.textsize) $("#zpe_textsize").val(datacle.textsize); else $("#zpe_textsize").val("");
						 $("#"+zone).css("color",datacle.textcolor);
						if(datacle.textcolor) $("#zpe_textcolor").val(datacle.textcolor); else $("#zpe_textcolor").val("");
						if(datacle.textalign) $("#"+zone).css("text-align",datacle.textalign);
						if(datacle.textalign) $("#zpe_textalign").val(datacle.textalign); else $("#zpe_textalign").val("");
						if(datacle.textgras) $("#"+zone).css("font-weight",datacle.textgras);
						if(datacle.textgras) $("#zpe_textgras").val(datacle.textgras); else $("#zpe_textgras").val("");
						if(datacle.fondimg) $("#"+zone).css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimgfolder+datacle.fondimg+"')");
						else $("#"+zone).css("background-image","none");
						if(datacle.fondimg) $("#zpe_fondimg").val(datacle.fondimg); else $("#zpe_fondimg").val("");
						if(datacle.fondimgpos) $("#"+zone).css("background-position",datacle.fondimgpos);
						if(datacle.fondimgpos) $("#zpe_fondimgpos").val(datacle.fondimgpos); else $("#zpe_fondimgpos").val("");
						if(datacle.fondimgrepeat) $("#"+zone).css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimgrepeat) $("#zpe_fondimgrepeat").val(datacle.fondimgrepeat); else $("#zpe_fondimgrepeat").val("");
						//if(datacle.fondimg) getImgSize("#"+zone,__prefix+"/img/graph/"+datacle.fondimg);
						if(datacle.fondimg){
							/*$("#dropfile_content_e > div").css("background-image","url("+__prefix+"/img/graph/"+datacle.fondimg+")");
							$("#dropfile_content_e > div").css("background-size","150px 300px");*/
							$("#dropfile_content_e > div").append("<img src='"+__prefix+"/img/graph/"+datacle.fondimgfolder+datacle.fondimg+"' width='100%' alt='"+datacle.fondimg+"'>");
						}else
							$("#dropfile_content_e > div > img").remove();
						$('#dropfile_e').dropfile({foldermin : datacle.fondimgfolder});
			}
			
			
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}

function saveform_fe(){
	var zone = $("#zp_elstyle").attr("data-id");
	var width = $("#zpe_width").val();
	var height = $("#zpe_height").val();
	var border = $("#zpe_border1").val()+" "+$("#zpe_border2").val()+" solid";
	if(!$("#zpe_margin1").val()) $("#zpe_margin1").val(0);
	if(!$("#zpe_margin2").val()) $("#zpe_margin2").val(0);
	if(!$("#zpe_margin3").val()) $("#zpe_margin3").val(0);
	if(!$("#zpe_margin4").val()) $("#zpe_margin4").val(0);
	if(!$("#zpe_padding1").val()) $("#zpe_padding1").val(0);
	if(!$("#zpe_padding2").val()) $("#zpe_padding2").val(0);
	if(!$("#zpe_padding3").val()) $("#zpe_padding3").val(0);
	if(!$("#zpe_padding4").val()) $("#zpe_padding4").val(0);
	if(!$("#zpe_borderradius1").val()) $("#zpe_borderradius1").val(0);
	if(!$("#zpe_borderradius2").val()) $("#zpe_borderradius2").val(0);
	if(!$("#zpe_borderradius3").val()) $("#zpe_borderradius3").val(0);
	if(!$("#zpe_borderradius4").val()) $("#zpe_borderradius4").val(0);
	var margin = $("#zpe_margin1").val()+"px "+$("#zpe_margin2").val()+"px "+$("#zpe_margin3").val()+"px "+$("#zpe_margin4").val()+"px ";
	var borderradius = $("#zpe_borderradius1").val()+"px "+$("#zpe_borderradius2").val()+"px "+$("#zpe_borderradius3").val()+"px "+$("#zpe_borderradius4").val()+"px ";
	var padding = $("#zpe_padding1").val()+"px "+$("#zpe_padding2").val()+"px "+$("#zpe_padding3").val()+"px "+$("#zpe_padding4").val()+"px ";
	var float = $("#zpe_float").val();
	var fondcolor = $("#zpe_fondcolor").val();
	var textsize = $("#zpe_textsize").val();
	var textcolor = $("#zpe_textcolor").val();
	var textalign = $("#zpe_textalign").val();
	var textgras = $("#zpe_textgras").val();
	var fondimg = $("#zpe_fondimg").val();
	var fondimgpos = $("#zpe_fondimgpos").val();
	var fondimgrepeat = $("#zpe_fondimgrepeat").val();
	
	var formUrl = __prefix+"/graphelements/ajax_saveeditzone/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone,width: width,height: height,border: border,margin: margin,padding: padding,float: float,fondcolor: fondcolor,borderradius: borderradius,textsize: textsize,textcolor: textcolor,textalign: textalign,textgras: textgras,fondimg: fondimg,fondimgpos: fondimgpos,fondimgrepeat: fondimgrepeat },
		beforeSend: function(jqXHR, settings) {
			$("#zpe_save").css("opacity","0.4");
		},
		success: function(data) {
		if(data){
			$("#zpe_save").css("opacity","1");
			actuvisu_fe(zone)
		}
		
		
		},
		error: function(xhr, textStatus, error){
			//
		}
	});
}
function edit_cont(zone){
	set_loader(true);
	if(zone.substr(0,2)=="re"){
		var formUrl = __prefix+"/rubriqueelements/ajax_editcont/";
		element_id = zone.replace("re_","");
		var typee = "rubrique";
	}else{
		var formUrl = __prefix+"/zoneelements/ajax_editcont/";
		element_id = zone.replace("ze_","");
		var typee = "zone";
	}
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone,id: element_id,typee: typee },
		success: function(data) {
			set_loader(false);
			if(data){
				var type = data[0];
				if(type=="rubrique"){
					var tabl = data["Contenutype"]["table"].toLowerCase();
					var cont_id = data["Rubriqueelement"]["contenupage_id"].toLowerCase();
				}else{
					var tabl = data["Elementtype"]["table"].toLowerCase();
					var cont_id = data["Zoneelement"]["contenupage_id"].toLowerCase();
				}
				var ulredit = "admin/"+tabl+"/"+tabl+"/edit/"+cont_id
				console.log(ulredit)
				show_iframe(ulredit);
				/*$("body").append("<div id='popup_edit'><div id='popup_edit_cont'><iframe name='frame_edit' src='"+__prefix+"/admin/"+tabl+"/"+tabl+"/edit/"+cont_id+"' scrolling='auto' height='500' width='800' frameborder='no'></iframe></div></div>");
				$("#popup_edit").click(function() {
					$(this).remove();
					recupform_rub($('.el_blocks').attr('id'));
				});*/
			}
		}
	});
	
}