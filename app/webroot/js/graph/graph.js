$(document).ready(function() {
	var zone;
	var divencours;
	actuvisu();
	recupform("fond");
	$('.selectit').each(function(index) {
		$(this).click(function() {
			if ($(this).hasClass('zoneselect')) {
				initselectit();
				divencours = $("#zbody");
				$("#zbody").addClass('zoneselect');
				zone = "fond";
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
	$('#zp_save').css("cursor","pointer");
	$('#zp_save').click(function() {
		saveform();
	});
	//
	$('#zoneparam').draggable();
});
function initselectit(){
	$('.selectit').each(function(index) {
		$(this).removeClass('zoneselect');
	});
	$("#zbody").removeClass('zoneselect');
}
function recupform(zone){
	var formUrl = __prefix+"/graphelements/ajax_recupform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone },
		success: function(data) {
			if(data){
				$("#zp_name").html("<b>"+data["Graphelement"].nom+"</b>");
				$("#zp_name").attr("data-value",data["Graphelement"].id);
				$("#zp_width").val(data["Graphelement"].width);
				$("#zp_height").val(data["Graphelement"].height);
				$("#zp_fondcolor").val(data["Graphelement"].fondcolor);
				$("#zp_fondimg").val(data["Graphelement"].fondimg);
				$("#zp_fondimgpos").val(data["Graphelement"].fondimgpos);
				$("#zp_fondimgrepeat").val(data["Graphelement"].fondimgrepeat);
				$("#dropfile_content > div").css("background-image","url("+__prefix+"/img/graph/"+data['Graphelement'].fondimg+")");
				$("#dropfile_content > div").css("background-size","150px 300px");
				if(data["Graphelement"].margin){ var amargin=data["Graphelement"].margin.split('px '); $("#zp_margin1").val(amargin[0]); $("#zp_margin2").val(amargin[1]); $("#zp_margin3").val(amargin[2]); $("#zp_margin4").val(amargin[3]); }else{ $("#zp_margin1").val(0); $("#zp_margin2").val(0); $("#zp_margin3").val(0); $("#zp_margin4").val(0); }
				if(data["Graphelement"].padding){ var apadding=data["Graphelement"].padding.split('px '); $("#zp_padding1").val(apadding[0]); $("#zp_padding2").val(apadding[1]); $("#zp_padding3").val(apadding[2]); $("#zp_padding4").val(apadding[3]); }else{ $("#zp_padding1").val(0); $("#zp_padding2").val(0); $("#zp_padding3").val(0); $("#zp_padding4").val(0); }
				//
				showform();
				if(data["Graphelement"].nom=="fond"){
					$("#zp_width").attr("disabled",true);
					$("#zp_height").attr("disabled",true);
					$("#zp_margin1").attr("disabled",true); $("#zp_margin2").attr("disabled",true); $("#zp_margin3").attr("disabled",true); $("#zp_margin4").attr("disabled",true); 
					$("#zp_padding1").attr("disabled",true); $("#zp_padding2").attr("disabled",true); $("#zp_padding3").attr("disabled",true); $("#zp_padding4").attr("disabled",true); 
				}else if(data["Graphelement"].nom=="droite"){
					$("#zp_height").attr("disabled",true);
				}else if(data["Graphelement"].nom=="pied"){
					$("#zp_margin1").attr("disabled",true); $("#zp_margin2").attr("disabled",true); $("#zp_margin3").attr("disabled",true); $("#zp_margin4").attr("disabled",true); 
				}else if(data["Graphelement"].nom=="gauche"){
					$("#zp_height").attr("disabled",true);
				}else if(data["Graphelement"].nom=="centre"){
					$("#zp_width").attr("disabled",true);
					$("#zp_height").attr("disabled",true);
				}
				var dcdivW = data["Graphelement"].width;
				if(!dcdivW) dcdivW = 150;
				if(dcdivW>300) dcdivW2 = 300;
				else dcdivW2 = dcdivW;
				var dcdivH = data["Graphelement"].height;
				if(!data["Graphelement"].height) dcdivH = 150;
				dcdivH2 = dcdivH*300/dcdivW;
				if(dcdivH2>150){
					dcdivW2 = dcdivH2*150/dcdivW2;
					dcdivH2 = 150;
				}
				$("#dropfile_content div").css("width",dcdivW2);
				$("#dropfile_content div").css("height",dcdivH2);
				$("#dropfile_content").css("width",dcdivW2);
				$("#dropfile_content").css("height",dcdivH2);
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
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0]/2)+"px "+(amargin[1]/2)+"px "+(amargin[2]/2)+"px "+(amargin[3]/2)+"px "};
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0]/2)+"px "+(apadding[1]/2)+"px "+(apadding[2]/2)+"px "+(apadding[3]/2)+"px ";
						if(datacle.margin)$("#tete").css("margin",margin2)};
						$("#tete").css("padding",padding2);
					}else if(datacle.nom=="pied"){
						if(datacle.height) $("#pied").css("height",datacle.height/2);
						if(datacle.width) $("#pied").css("width",datacle.width/2);
						else $("#pied").css("width","100%");
						$("#pied").css("margin","auto");
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0]/2)+"px "+(amargin[1]/2)+"px "+(amargin[2]/2)+"px "+(amargin[3]/2)+"px "};
						if(datacle.margin) $("#pied").css("padding",margin2);
						
							if(datacle.fondcolor) $("#pied").css("background-color",datacle.fondcolor);
							if(datacle.fondimg) $("#pied").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
							if(datacle.fondimgpos) $("#pied").css("background-position",datacle.fondimgpos);
							if(datacle.fondimgrepeat) $("#pied").css("background-repeat",datacle.fondimgrepeat);
							if(datacle.fondimg) getImgSize("#pied",__prefix+"/img/graph/"+datacle.fondimg);
						
						$("#piedcont").css("width",$("#tete").width());
						if(datacle.height) $("#piedcont").css("height",datacle.height/2);
						$("#piedcont").css("margin","auto");
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0]/2)+"px "+(apadding[1]/2)+"px "+(apadding[2]/2)+"px "+(apadding[3]/2)+"px ";}
						if(datacle.padding) $("#piedcont").css("padding",padding2);
						
						
					}else if(datacle.nom=="gauche"){
						if(!datacle.active) $("#gauche").css("width",0);
						else if(datacle.width) $("#gauche").css("width",datacle.width/2);
						if(datacle.fondcolor) $("#gauche").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#gauche").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#gauche").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#gauche").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#gauche",__prefix+"/img/graph/"+datacle.fondimg);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0]/2)+"px "+(amargin[1]/2)+"px "+(amargin[2]/2)+"px "+(amargin[3]/2)+"px "};
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0]/2)+"px "+(apadding[1]/2)+"px "+(apadding[2]/2)+"px "+(apadding[3]/2)+"px ";}
						if(datacle.margin) $("#gauche").css("margin",margin2);
						if(datacle.padding) $("#gauche").css("padding",padding2);
					}else if(datacle.nom=="droite"){
						if(!datacle.active) $("#droite").css("width",0);
						else if(datacle.width) $("#droite").css("width",datacle.width/2);
						if(datacle.fondcolor) $("#droite").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#droite").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#droite").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#droite").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#droite",__prefix+"/img/graph/"+datacle.fondimg);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0]/2)+"px "+(amargin[1]/2)+"px "+(amargin[2]/2)+"px "+(amargin[3]/2)+"px "};
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0]/2)+"px "+(apadding[1]/2)+"px "+(apadding[2]/2)+"px "+(apadding[3]/2)+"px ";}
						if(datacle.margin) $("#droite").css("margin",margin2);
						if(datacle.padding) $("#droite").css("padding",padding2);
					}else if(datacle.nom=="centre"){
						if(datacle.fondcolor) $("#centre").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#centre").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimgpos) $("#centre").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#centre").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0]/2)+"px "+(amargin[1]/2)+"px "+(amargin[2]/2)+"px "+(amargin[3]/2)+"px "; var marginW = amargin[1]/2+amargin[3]/2;}else{ var marginW=0; }
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0]/2)+"px "+(apadding[1]/2)+"px "+(apadding[2]/2)+"px "+(apadding[3]/2)+"px "; var paddingW = apadding[1]/2+apadding[3]/2;}else{ var paddingW=0; }
						if(datacle.margin) $("#centre").css("margin",margin2);
						if(datacle.padding) $("#centre").css("padding",padding2);
						if(datacle.fondimg) getImgSize("#centre",__prefix+"/img/graph/"+datacle.fondimg);
						var Wcentre = $("#zcontenu").width()-$("#gauche").width()-$("#droite").width()-paddingW-marginW;
						$("#centre").css("width",Wcentre);
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
function showform(){
	$("#zp_width").removeAttr('disabled');
	$("#zp_height").removeAttr('disabled');
	$("#zp_fondcolor").removeAttr('disabled');
	$("#zp_fondimg").removeAttr('disabled');
	$("#zp_fondimgpos").removeAttr('disabled');
	$("#zp_margin1").removeAttr('disabled'); $("#zp_margin2").removeAttr('disabled'); $("#zp_margin3").removeAttr('disabled'); $("#zp_margin4").removeAttr('disabled'); 
	$("#zp_padding1").removeAttr('disabled'); $("#zp_padding2").removeAttr('disabled'); $("#zp_padding3").removeAttr('disabled'); $("#zp_padding4").removeAttr('disabled'); 
}
function saveform(){
	var id = $("#zp_name").attr("data-value");
	var width = $("#zp_width").val();
	var height = $("#zp_height").val();
	if(!$("#zp_margin1").val()) $("#zp_margin1").val(0);
	if(!$("#zp_margin2").val()) $("#zp_margin2").val(0);
	if(!$("#zp_margin3").val()) $("#zp_margin3").val(0);
	if(!$("#zp_margin4").val()) $("#zp_margin4").val(0);
	if(!$("#zp_padding1").val()) $("#zp_padding1").val(0);
	if(!$("#zp_padding2").val()) $("#zp_padding2").val(0);
	if(!$("#zp_padding3").val()) $("#zp_padding3").val(0);
	if(!$("#zp_padding4").val()) $("#zp_padding4").val(0);
	var margin = $("#zp_margin1").val()+"px "+$("#zp_margin2").val()+"px "+$("#zp_margin3").val()+"px "+$("#zp_margin4").val()+"px ";
	var padding = $("#zp_padding1").val()+"px "+$("#zp_padding2").val()+"px "+$("#zp_padding3").val()+"px "+$("#zp_padding4").val()+"px ";
	var fondcolor = $("#zp_fondcolor").val();
	var fondimg = $("#zp_fondimg").val();
	var fondimgpos = $("#zp_fondimgpos").val();
	var fondimgrepeat = $("#zp_fondimgrepeat").val();
	var Wcentre="";
	/*if(id==5){
		Wcentre = $("#zcontenu").width()*2-$("#gauche").width()*2-width-$("#centre").css('marginLeft').replace("px","")*2-$("#centre").css('marginRight').replace("px","")*2-$("#centre").css('padding-left').replace("px","")*2-$("#centre").css('padding-right').replace("px","")*2;
	}else if(id == 6){
		Wcentre = $("#zcontenu").width()*2-width-$("#droite").width()*2-$("#centre").css('marginLeft').replace("px","")*2-$("#centre").css('marginRight').replace("px","")*2-$("#centre").css('padding-left').replace("px","")*2-$("#centre").css('padding-right').replace("px","")*2;
	}else if(id == 7){
		Wcentre = $("#zcontenu").width()*2-$("#gauche").width()*2-$("#droite").width()*2-$("#zp_margin2").val()-$("#zp_margin4").val()-$("#zp_padding2").val()-$("#zp_padding4").val();
		//width = $("#zp_width").val()-$("#zp_margin2").val()-$("#zp_margin4").val()-$("#zp_padding2").val()-$("#zp_padding4").val();
	}else if(id == 3){
		Wcentre = width-$("#gauche").width()*2-$("#droite").width()*2-$("#centre").css('marginLeft').replace("px","")*2-$("#centre").css('marginRight').replace("px","")*2-$("#centre").css('padding-left').replace("px","")*2-$("#centre").css('padding-right').replace("px","")*2;
	}*/
	if(id==5){
		Wcentre = $("#zcontenu").width()*2-$("#gauche").width()*2-width;
	}else if(id == 6){
		Wcentre = $("#zcontenu").width()*2-width-$("#droite").width()*2;
	}else if(id == 7){
		Wcentre = $("#zcontenu").width()*2-$("#gauche").width()*2-$("#droite").width()*2;
		//width = $("#zp_width").val()-$("#zp_margin2").val()-$("#zp_margin4").val()-$("#zp_padding2").val()-$("#zp_padding4").val();
	}else if(id == 3){
		Wcentre = width-$("#gauche").width()*2-$("#droite").width()*2;
	}
	var formUrl = __prefix+"/graphelements/ajax_saveform/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { id: id,width: width,height: height,fondcolor: fondcolor,fondimg: fondimg,fondimgpos: fondimgpos,margin: margin,Wcentre: Wcentre,fondimgrepeat: fondimgrepeat,padding: padding },
		beforeSend: function(jqXHR, settings) {
			$("#zp_save").css("opacity","0.4");
		},
		success: function(data) {
		if(data){
			$("#zp_save").css("opacity","1");
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