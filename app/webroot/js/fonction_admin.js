$(document).ready(function() {
	initlang();
	initposition();
	$('#supprimg_bnt').css("cursor","pointer");
	$('#supprimg_bnt_actif').css("cursor","pointer");
	$('#supprimg_bnt').click(function() {
		$("#dropfile_content_bnt > div > img").remove();
		$('#img_btn').val("");
	});
	$('#supprimg_bnt_actif').click(function() {
		$("#dropfile_content_bnt_actif > div > img").remove();
		$('#img_btn_actif').val("");
	});
});
function initlang(){
	var nbLang = $('.lang').length;
	if(nbLang > 0) {
		$('.lang').each(function(){
			$(this).css("cursor","pointer");
			$(this).click(function(){
				hideLang();
				var tlang = $(this).find('img').attr("alt");
				$('#input_'+tlang).show();
				$(this).addClass('selected');
			});
		});
	}
}
function hideLang(){
	$('.lang').each(function(){
		var tlang = $(this).find('img').attr("alt");
		$('#input_'+tlang).hide();
		$(this).removeClass('selected');
	});
}
function copytext(input1,input2,fck){
	if(!fck){
		$('#'+input1).val($('#'+input1).val()+$('#'+input2).val());
	}else{
		CKEDITOR.instances[input1].setData(CKEDITOR.instances[input1].getData()+CKEDITOR.instances[input2].getData());
		return false;
	}
}
function initposition(){
	var nbpos = $('#position').length;
	if(nbpos > 0) {
		$("#position").sortable({
			axis: "y", // Le sortable ne s'applique que sur l'axe vertical
			// Evenement appelé lorsque l'élément est relaché
			stop: function(event, ui){
				// Pour chaque item de liste
				$("#position>ul").each(function(){
					// On actualise sa position
					index = parseInt($(this).index()+1);
					setposition($(this).attr("id"),index,$('#position').attr("data-value"));
				});
			}
		});
	}
}
function setposition(id,pos,url){
	var formUrl = __prefix+url;
	$.ajax({
		type: 'POST',
		url: formUrl,
		async: true,
		dataType: 'json',
		data: { position: pos, id: id },
		success: function(data) {
			if(data){
				//
			}
		},
		error: function(xhr, textStatus, error){
			//console.log(error);
		}
	});
}
function changetype(data){
	if(data=="infomulti"){
		$(".ftextearea").each(function(){
			CKEDITOR.replace($(this).attr("id"));
		});
	}else{
		$(".ftextearea").each(function(){
			var editorID = $(this).attr("id");
            var instance = CKEDITOR.instances[editorID];
            if (instance) { instance.destroy(true); }
            //CKEDITOR.replace(editorID);
		});
	}
}