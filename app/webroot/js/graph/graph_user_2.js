$(document).ready(function() {
	
	actuvisu();
	recupform("fond");
	
	$('#zp_save').css("cursor","pointer");
	$('#zp_save').click(function() {
		saveform();
	});
	$('#zp_openclose').css("cursor","pointer");
	$('#zp_openclose').click(function() {
		if ($(this).hasClass('zp_open')) {
			$(this).addClass('zp_close');
			$(this).removeClass('zp_open');
			
		}else{
			$(this).addClass('zp_open');
			$(this).removeClass('zp_close');

			
		}
		$('#zp_cont').slideToggle("slow");
	});
	//
	$('#zp_openclose_general').css("cursor","pointer");
	$('#zp_openclose_general').click(function() {
		if ($(this).hasClass('zp_open')) {
			$(this).addClass('zp_close');
			$(this).removeClass('zp_open');
			
		}else{
			$(this).addClass('zp_open');
			$(this).removeClass('zp_close');

			
		}
		$('#zp_cont_general').slideToggle("slow");
	});
	//
	$('#zp_openclose_element').css("cursor","pointer");
	$('#zp_openclose_element').click(function() {
		if ($(this).hasClass('zp_open')) {
			$(this).addClass('zp_close');
			$(this).removeClass('zp_open');
			
		}else{
			$(this).addClass('zp_open');
			$(this).removeClass('zp_close');

			
		}
		$('#zp_cont_element').slideToggle("slow");
	});
	//
	$('#zp_openclose_elstyle').css("cursor","pointer");
	$('#zp_openclose_elstyle').click(function() {
		if ($(this).hasClass('zp_open')) {
			$(this).addClass('zp_close');
			$(this).removeClass('zp_open');
			
		}else{
			$(this).addClass('zp_open');
			$(this).removeClass('zp_close');

			
		}
		$('#zp_cont_elstyle').slideToggle("slow");
	});
	//
	$('#zoneparam').draggable({ handle: ".zp_name" });
	$('.zp_name').css("cursor","move");
});
function initselectit(){
	$('.edithis').each(function(index) {
		$(this).removeClass('zoneselect');
	});
	$("#body").removeClass('zoneselect');
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
				$("#zp_name").html("<b>MISE EN PAGE : "+data["Graphelement"].nom+"</b>");
				$("#zp_name").attr("data-value",data["Graphelement"].id);
				$("#zp_width").val(data["Graphelement"].width);
				$("#zp_height").val(data["Graphelement"].height);
				$("#zp_fondcolor").val(data["Graphelement"].fondcolor);
				$("#zp_fondimg").val(data["Graphelement"].fondimg);
				$("#zp_fondimgpos").val(data["Graphelement"].fondimgpos);
				$("#zp_fondimgrepeat").val(data["Graphelement"].fondimgrepeat);
				/*$("#dropfile_content > div").css("background-image","url("+__prefix+"/img/graph/"+data['Graphelement'].fondimg+")");
				$("#dropfile_content > div").css("background-size","150px 300px");*/
				if(data['Graphelement'].fondimg)
					$("#dropfile_content > div").append("<img src='"+__prefix+"/img/graph/"+data['Graphelement'].fondimg+"' width='100%' alt='"+__prefix+"/img/graph/"+data['Graphelement'].fondimg+"'>");
				else
					$("#dropfile_content > div > img").remove();
				if(data["Graphelement"].margin){ var amargin=data["Graphelement"].margin.split(' '); $("#zp_margin1").val(amargin[0]); $("#zp_margin2").val(amargin[1]); $("#zp_margin3").val(amargin[2]); $("#zp_margin4").val(amargin[3]); }else{ $("#zp_margin1").val(0); $("#zp_margin2").val(0); $("#zp_margin3").val(0); $("#zp_margin4").val(0); }
				if(data["Graphelement"].padding){ var apadding=data["Graphelement"].padding.split(' '); $("#zp_padding1").val(apadding[0]); $("#zp_padding2").val(apadding[1]); $("#zp_padding3").val(apadding[2]); $("#zp_padding4").val(apadding[3]); }else{ $("#zp_padding1").val(0); $("#zp_padding2").val(0); $("#zp_padding3").val(0); $("#zp_padding4").val(0); }
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

					if(datacle.fondcolor) $("#"+datacle.nom).css("background-color",datacle.fondcolor);
					if(datacle.fondimg) $("#"+datacle.nom).css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
					else $("#"+datacle.nom).css("background-image","none");
					if(datacle.fondimgpos) $("#"+datacle.nom).css("background-position",datacle.fondimgpos);
					if(datacle.fondimgrepeat) $("#"+datacle.nom).css("background-repeat",datacle.fondimgrepeat);
					if(datacle.fondimg) getImgSize("#"+datacle.nom,__prefix+"/img/graph/"+datacle.fondimg);

					if(datacle.nom!="fond" && datacle.nom!="pied"){
						if(datacle.margin){var amargin=datacle.margin.split(' '); var margin2 = (amargin[0])+"px "+(amargin[1])+"px "+(amargin[2])+"px "+(amargin[3])+"px "};
						if(datacle.padding){var apadding=datacle.padding.split(' '); var padding2 = (apadding[0])+"px "+(apadding[1])+"px "+(apadding[2])+"px "+(apadding[3])+"px ";
						if(datacle.margin) $("#"+datacle.nom).css("margin",margin2)};
						if(datacle.padding) $("#"+datacle.nom).css("padding",padding2);
					}




					if(datacle.nom=="fond"){
						/*if(datacle.fondcolor) $("#body").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#body").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						else $("#body").css("background-image","none");
						if(datacle.fondimgpos) $("#body").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#body").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#body",__prefix+"/img/graph/"+datacle.fondimg);*/
					}else if(datacle.nom=="tete"){
						if(datacle.width) $("#contenu").css("width",datacle.width);
						if(datacle.height) $("#tete").css("height",datacle.height);
						/*if(datacle.fondcolor) $("#tete").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#tete").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						else $("#tete").css("background-image","none");
						if(datacle.fondimgpos) $("#tete").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#tete").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#tete",__prefix+"/img/graph/"+datacle.fondimg);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0])+"px "+(amargin[1])+"px "+(amargin[2])+"px "+(amargin[3])+"px "};
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0])+"px "+(apadding[1])+"px "+(apadding[2])+"px "+(apadding[3])+"px ";
						if(datacle.margin)$("#tete").css("margin",margin2)};
						$("#tete").css("padding",padding2);*/
					}else if(datacle.nom=="pied"){
						if(datacle.height) $("#pied").css("height",datacle.height);
						if(datacle.width) $("#pied").css("width",datacle.width);
						else $("#pied").css("width","100%");
						$("#pied").css("margin","auto");
						if(datacle.margin){var amargin=datacle.margin.split(' '); var margin2 = (amargin[0])+"px "+(amargin[1])+"px "+(amargin[2])+"px "+(amargin[3])+"px "};
						if(datacle.margin) $("#pied").css("padding",margin2);
						
						/*if(datacle.fondcolor) $("#pied").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#pied").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						else $("#pied").css("background-image","none");
						if(datacle.fondimgpos) $("#pied").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#pied").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#pied",__prefix+"/img/graph/"+datacle.fondimg);*/
						
						$("#piedcont").css("width",$("#tete").width());
						if(datacle.height) $("#piedcont").css("height",datacle.height);
						$("#piedcont").css("margin","auto");
						if(datacle.padding){var apadding=datacle.padding.split(' '); var padding2 = (apadding[0])+"px "+(apadding[1])+"px "+(apadding[2])+"px "+(apadding[3])+"px ";}
						if(datacle.padding) $("#piedcont").css("padding",padding2);
						
						
					}else if(datacle.nom=="gauche"){
						if(!datacle.active) $("#gauche").css("width",0);
						else if(datacle.width) $("#gauche").css("width",datacle.width);
						/*if(datacle.fondcolor) $("#gauche").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#gauche").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						else $("#gauche").css("background-image","none");
						if(datacle.fondimgpos) $("#gauche").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#gauche").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#gauche",__prefix+"/img/graph/"+datacle.fondimg);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0])+"px "+(amargin[1])+"px "+(amargin[2])+"px "+(amargin[3])+"px "};
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0])+"px "+(apadding[1])+"px "+(apadding[2])+"px "+(apadding[3])+"px ";}
						if(datacle.margin) $("#gauche").css("margin",margin2);
						if(datacle.padding) $("#gauche").css("padding",padding2);*/
					}else if(datacle.nom=="droite"){
						if(!datacle.active) $("#droite").css("width",0);
						else if(datacle.width) $("#droite").css("width",datacle.width);
						/*if(datacle.fondcolor) $("#droite").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#droite").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						else $("#droite").css("background-image","none");
						if(datacle.fondimgpos) $("#droite").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#droite").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimg) getImgSize("#droite",__prefix+"/img/graph/"+datacle.fondimg);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0])+"px "+(amargin[1])+"px "+(amargin[2])+"px "+(amargin[3])+"px "};
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0])+"px "+(apadding[1])+"px "+(apadding[2])+"px "+(apadding[3])+"px ";}
						if(datacle.margin) $("#droite").css("margin",margin2);
						if(datacle.padding) $("#droite").css("padding",padding2);*/
					}else if(datacle.nom=="centre"){
						/*if(datacle.fondcolor) $("#centre").css("background-color",datacle.fondcolor);
						if(datacle.fondimg) $("#centre").css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						else $("#centre").css("background-image","none");
						if(datacle.fondimgpos) $("#centre").css("background-position",datacle.fondimgpos);
						if(datacle.fondimgrepeat) $("#centre").css("background-repeat",datacle.fondimgrepeat);
						if(datacle.margin){var amargin=datacle.margin.split('px '); var margin2 = (amargin[0])+"px "+(amargin[1])+"px "+(amargin[2])+"px "+(amargin[3])+"px "; var marginW = amargin[1]+amargin[3];}else{ var marginW=0; }
						if(datacle.padding){var apadding=datacle.padding.split('px '); var padding2 = (apadding[0])+"px "+(apadding[1])+"px "+(apadding[2])+"px "+(apadding[3])+"px "; var paddingW = apadding[1]+apadding[3];}else{ var paddingW=0; }
						if(datacle.margin) $("#centre").css("margin",margin2);
						if(datacle.padding) $("#centre").css("padding",padding2);
						if(datacle.fondimg) getImgSize("#centre",__prefix+"/img/graph/"+datacle.fondimg);*/
						var Wcentre = $("#contenu").width()-$("#gauche").width()-$("#droite").width()-paddingW-marginW;
						$("#centre").css("max-width",Wcentre);
						
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

	if($("#zp_margin1").val().toLowerCase().indexOf("px") >= 0 || $("#zp_margin1").val().toLowerCase().indexOf("em") >= 0 || $("#zp_margin1").val().toLowerCase().indexOf("%") >= 0 || $("#zp_margin1").val().toLowerCase().indexOf("auto") >= 0) 
		var margin1 = $("#zp_margin1").val()+" ";
	else
		var margin1 = $("#zp_margin1").val()+"px ";
	if($("#zp_margin2").val().toLowerCase().indexOf("px") >= 0 || $("#zp_margin2").val().toLowerCase().indexOf("em") >= 0 || $("#zp_margin2").val().toLowerCase().indexOf("%") >= 0 || $("#zp_margin2").val().toLowerCase().indexOf("auto") >= 0) 
		var margin2 = $("#zp_margin2").val()+" ";
	else
		var margin2 = $("#zp_margin2").val()+"px ";
	if($("#zp_margin3").val().toLowerCase().indexOf("px") >= 0 || $("#zp_margin3").val().toLowerCase().indexOf("em") >= 0 || $("#zp_margin3").val().toLowerCase().indexOf("%") >= 0 || $("#zp_margin3").val().toLowerCase().indexOf("auto") >= 0) 
		var margin3 = $("#zp_margin3").val()+" ";
	else
		var margin3 = $("#zp_margin3").val()+"px ";
	if($("#zp_margin4").val().toLowerCase().indexOf("px") >= 0 || $("#zp_margin4").val().toLowerCase().indexOf("em") >= 0 || $("#zp_margin4").val().toLowerCase().indexOf("%") >= 0 || $("#zp_margin4").val().toLowerCase().indexOf("auto") >= 0) 
		var margin4 = $("#zp_margin4").val()+" ";
	else
		var margin4 = $("#zp_margin4").val()+"px ";
	var margin = margin1+margin2+margin3+margin4;
	if($("#zp_padding1").val().toLowerCase().indexOf("px") >= 0 || $("#zp_padding1").val().toLowerCase().indexOf("em") >= 0 || $("#zp_padding1").val().toLowerCase().indexOf("%") >= 0 || $("#zp_padding1").val().toLowerCase().indexOf("auto") >= 0) 
		var padding1 = $("#zp_padding1").val()+" ";
	else
		var padding1 = $("#zp_padding1").val()+"px ";
	if($("#zp_padding2").val().toLowerCase().indexOf("px") >= 0 || $("#zp_padding2").val().toLowerCase().indexOf("em") >= 0 || $("#zp_padding2").val().toLowerCase().indexOf("%") >= 0 || $("#zp_padding2").val().toLowerCase().indexOf("auto") >= 0) 
		var padding2 = $("#zp_padding2").val()+" ";
	else
		var padding2 = $("#zp_padding2").val()+"px ";
	if($("#zp_padding3").val().toLowerCase().indexOf("px") >= 0 || $("#zp_padding3").val().toLowerCase().indexOf("em") >= 0 || $("#zp_padding3").val().toLowerCase().indexOf("%") >= 0 || $("#zp_padding3").val().toLowerCase().indexOf("auto") >= 0) 
		var padding3 = $("#zp_padding3").val()+" ";
	else
		var padding3 = $("#zp_padding3").val()+"px ";
	if($("#zp_padding4").val().toLowerCase().indexOf("px") >= 0 || $("#zp_padding4").val().toLowerCase().indexOf("em") >= 0 || $("#zp_padding4").val().toLowerCase().indexOf("%") >= 0 || $("#zp_padding4").val().toLowerCase().indexOf("auto") >= 0) 
		var padding4 = $("#zp_padding4").val()+" ";
	else
		var padding4 = $("#zp_padding4").val()+"px ";
	var padding = padding1+padding2+padding3+padding4;
	
	//var margin = $("#zp_margin1").val()+"px "+$("#zp_margin2").val()+"px "+$("#zp_margin3").val()+"px "+$("#zp_margin4").val()+"px ";
	//var padding = $("#zp_padding1").val()+"px "+$("#zp_padding2").val()+"px "+$("#zp_padding3").val()+"px "+$("#zp_padding4").val()+"px ";
	var fondcolor = $("#zp_fondcolor").val();
	var fondimg = $("#zp_fondimg").val();
	var fondimgpos = $("#zp_fondimgpos").val();
	var fondimgrepeat = $("#zp_fondimgrepeat").val();
	var Wcentre="";
	/*if(id==5){
		Wcentre = $("#contenu").width()*2-$("#gauche").width()*2-width-$("#centre").css('marginLeft').replace("px","")*2-$("#centre").css('marginRight').replace("px","")*2-$("#centre").css('padding-left').replace("px","")*2-$("#centre").css('padding-right').replace("px","")*2;
	}else if(id == 6){
		Wcentre = $("#contenu").width()*2-width-$("#droite").width()*2-$("#centre").css('marginLeft').replace("px","")*2-$("#centre").css('marginRight').replace("px","")*2-$("#centre").css('padding-left').replace("px","")*2-$("#centre").css('padding-right').replace("px","")*2;
	}else if(id == 7){
		Wcentre = $("#contenu").width()*2-$("#gauche").width()*2-$("#droite").width()*2-$("#zp_margin2").val()-$("#zp_margin4").val()-$("#zp_padding2").val()-$("#zp_padding4").val();
		//width = $("#zp_width").val()-$("#zp_margin2").val()-$("#zp_margin4").val()-$("#zp_padding2").val()-$("#zp_padding4").val();
	}else if(id == 3){
		Wcentre = width-$("#gauche").width()*2-$("#droite").width()*2-$("#centre").css('marginLeft').replace("px","")*2-$("#centre").css('marginRight').replace("px","")*2-$("#centre").css('padding-left').replace("px","")*2-$("#centre").css('padding-right').replace("px","")*2;
	}*/

	if(!fondimg) $("#dropfile_content > div > img").remove();
	
	if(id==5){
		Wcentre = $("#contenu").width()*2-$("#gauche").width()*2-width;
	}else if(id == 6){
		Wcentre = $("#contenu").width()*2-width-$("#droite").width()*2;
	}else if(id == 7){
		Wcentre = $("#contenu").width()*2-$("#gauche").width()*2-$("#droite").width()*2;
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
		
		$(div).css("background-size",''+i.width+'px '+i.height+'px');
	}
	
}