$(document).ready(function() {
	var zone = $('#zoneparam').attr("data-value");
	actuvisu(zone);
	$('label').css("display","inline");
	$('label').css("float","none");
	$('#zonevisu2 h1').addClass("h1intit");
	$('#zp_save').css("cursor","pointer");
	$('#zp_save').click(function() {
		saveform(zone);
	});
	$('.el_block a').each(function(index) {
		$(this).removeAttr("href");
	});
	var i=0;
	$('#zonevisu2 .el_block .el_block').each(function() {
		i++;
		if(i==1){
			$(this).addClass('zoneselect2');
		}
		$(this).click(function() {
			if (!$(this).hasClass('zoneselect2')) {
				
				initselectit();
				
				$(this).addClass('zoneselect2');
				zone = $(this).attr("id");
				$('#zoneparam').attr("data-value",zone)
				actuvisu(zone);
			}
			
			
			
		});
	});
	
});
function initselectit(){
	$('.el_block').each(function(index) {
		$(this).removeClass('zoneselect2');
	});
}
function actuvisu(zone){
	var formUrl = __prefix+"/graphelements/ajax_actueditzone/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone },
		success: function(data) {
			if(data){
				for ( var cle in data ) {
					var datacle = data[cle]["Graphelement"];
					if(datacle.width) $("#"+zone).css("width",datacle.width);
						if(datacle.width) $("#zp_width").val(datacle.width); else $("#zp_width").val("");
						if(datacle.height) $("#"+zone).css("height",datacle.height);
						if(datacle.height) $("#zp_height").val(datacle.height); else $("#zp_height").val("");
						if(datacle.border) $("#"+zone).css("border",datacle.border);
						if(datacle.border){ var aborder=datacle.border.split(' '); $("#zp_border1").val(aborder[0]); $("#zp_border2").val(aborder[1]); }else{ $("#zp_border1").val("0px"); $("#zp_border2").val("#000000");  }
						if(datacle.borderradius) $("#"+zone).css("-moz-border-radius",datacle.borderradius);
						if(datacle.borderradius) $("#"+zone).css("-webkit-border-radius",datacle.borderradius);
						if(datacle.borderradius){ var aborderradius=datacle.borderradius.split('px '); $("#zp_borderradius1").val(aborderradius[0]); $("#zp_borderradius2").val(aborderradius[1]); $("#zp_borderradius3").val(aborderradius[2]); $("#zp_borderradius4").val(aborderradius[3]); }else{ $("#zp_borderradius1").val(0); $("#zp_borderradius2").val(0); $("#zp_borderradius3").val(0); $("#zp_borderradius4").val(0); }
						if(datacle.margin) $("#"+zone).css("margin",datacle.margin);
						if(datacle.margin){ var amargin=datacle.margin.split('px '); $("#zp_margin1").val(amargin[0]); $("#zp_margin2").val(amargin[1]); $("#zp_margin3").val(amargin[2]); $("#zp_margin4").val(amargin[3]); }else{ $("#zp_margin1").val(0); $("#zp_margin2").val(0); $("#zp_margin3").val(0); $("#zp_margin4").val(0); }
						if(datacle.padding) $("#"+zone).css("padding",datacle.padding);
						if(datacle.padding){ var apadding=datacle.padding.split('px '); $("#zp_padding1").val(apadding[0]); $("#zp_padding2").val(apadding[1]); $("#zp_padding3").val(apadding[2]); $("#zp_padding4").val(apadding[3]); }else{ $("#zp_padding1").val(0); $("#zp_padding2").val(0); $("#zp_padding3").val(0); $("#zp_padding4").val(0); }
						if(datacle.float) $("#"+zone).css("float",datacle.float); else $("#"+zone).css("float","none");
						if(datacle.float) $("#zp_float").val(datacle.float); else $("#zp_float").val("");
						$("#"+zone).css("background-color",datacle.fondcolor);
						if(datacle.fondcolor) $("#zp_fondcolor").val(datacle.fondcolor); else $("#zp_fondcolor").val("");
						if(datacle.textsize) $("#"+zone).css("font-size",datacle.textsize);
						if(datacle.textsize) $("#zp_textsize").val(datacle.textsize); else $("#zp_textsize").val("");
						if(datacle.textcolor) $("#"+zone).css("color",datacle.textcolor);
						if(datacle.textcolor) $("#zp_textcolor").val(datacle.textcolor); else $("#zp_textcolor").val("");
						if(datacle.textalign) $("#"+zone).css("text-align",datacle.textalign);
						if(datacle.textalign) $("#zp_textalign").val(datacle.textalign); else $("#zp_textalign").val("");
						if(datacle.textgras) $("#"+zone).css("font-weight",datacle.textgras);
						if(datacle.textgras) $("#zp_textgras").val(datacle.textgras); else $("#zp_textgras").val("");
						if(datacle.fondimg) $("#"+zone).css("background-image","url('"+__prefix+"/img/graph/"+datacle.fondimg+"')");
						if(datacle.fondimg) $("#zp_fondimg").val(datacle.fondimg); else $("#zp_fondimg").val("");
						if(datacle.fondimgpos) $("#"+zone).css("background-position",datacle.fondimgpos);
						if(datacle.fondimgpos) $("#zp_fondimgpos").val(datacle.fondimgpos); else $("#zp_fondimgpos").val("");
						if(datacle.fondimgrepeat) $("#"+zone).css("background-repeat",datacle.fondimgrepeat);
						if(datacle.fondimgrepeat) $("#zp_fondimgrepeat").val(datacle.fondimgrepeat); else $("#zp_fondimgrepeat").val("");
						//if(datacle.fondimg) getImgSize("#"+zone,__prefix+"/img/graph/"+datacle.fondimg);
					
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
function saveform(){
	var zone = $('#zoneparam').attr("data-value");
	var width = $("#zp_width").val();
	var height = $("#zp_height").val();
	var border = $("#zp_border1").val()+" "+$("#zp_border2").val()+" solid";
	if(!$("#zp_margin1").val()) $("#zp_margin1").val(0);
	if(!$("#zp_margin2").val()) $("#zp_margin2").val(0);
	if(!$("#zp_margin3").val()) $("#zp_margin3").val(0);
	if(!$("#zp_margin4").val()) $("#zp_margin4").val(0);
	if(!$("#zp_padding1").val()) $("#zp_padding1").val(0);
	if(!$("#zp_padding2").val()) $("#zp_padding2").val(0);
	if(!$("#zp_padding3").val()) $("#zp_padding3").val(0);
	if(!$("#zp_padding4").val()) $("#zp_padding4").val(0);
	if(!$("#zp_borderradius1").val()) $("#zp_borderradius1").val(0);
	if(!$("#zp_borderradius2").val()) $("#zp_borderradius2").val(0);
	if(!$("#zp_borderradius3").val()) $("#zp_borderradius3").val(0);
	if(!$("#zp_borderradius4").val()) $("#zp_borderradius4").val(0);
	var margin = $("#zp_margin1").val()+"px "+$("#zp_margin2").val()+"px "+$("#zp_margin3").val()+"px "+$("#zp_margin4").val()+"px ";
	var borderradius = $("#zp_borderradius1").val()+"px "+$("#zp_borderradius2").val()+"px "+$("#zp_borderradius3").val()+"px "+$("#zp_borderradius4").val()+"px ";
	var padding = $("#zp_padding1").val()+"px "+$("#zp_padding2").val()+"px "+$("#zp_padding3").val()+"px "+$("#zp_padding4").val()+"px ";
	var float = $("#zp_float").val();
	var fondcolor = $("#zp_fondcolor").val();
	var textsize = $("#zp_textsize").val();
	var textcolor = $("#zp_textcolor").val();
	var textalign = $("#zp_textalign").val();
	var textgras = $("#zp_textgras").val();
	var fondimg = $("#zp_fondimg").val();
	var fondimgpos = $("#zp_fondimgpos").val();
	var fondimgrepeat = $("#zp_fondimgrepeat").val();
	
	var formUrl = __prefix+"/graphelements/ajax_saveeditzone/";
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { zone: zone,width: width,height: height,border: border,margin: margin,padding: padding,float: float,fondcolor: fondcolor,borderradius: borderradius,textsize: textsize,textcolor: textcolor,textalign: textalign,textgras: textgras,fondimg: fondimg,fondimgpos: fondimgpos,fondimgrepeat: fondimgrepeat },
		beforeSend: function(jqXHR, settings) {
			$("#zp_save").css("opacity","0.4");
		},
		success: function(data) {
		if(data){
			$("#zp_save").css("opacity","1");
			actuvisu(zone)
		}
		
		
		},
		error: function(xhr, textStatus, error){
			//alert(textStatus);
			//console.log(error);
			//setCountdown();
		}
	});
}