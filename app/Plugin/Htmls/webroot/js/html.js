$(document).ready(function() {
	actucontent();
	$('.htmlcontent').keyup(function() {
		actucontent();
	});
	$('#csscontent').keyup(function() {
		actucontent();
	});
	$('#jscontent').keyup(function() {
		actucontent();
	});
	$('.htmlcontent').blur(function() {
		actucontent();
	});
	$('#csscontent').blur(function() {
		actucontent();
	});
	$('#jscontent').blur(function() {
		actucontent();
	});
	
	$( "#zoneparam" ).droppable({
		hoverClass: "zoneselect2",
		drop: function( event, ui ) {
			var img = $(ui.draggable).attr("data-value");
			var htmlcont = "<img src='"+__prefix+"/img/content/"+img+"' alt='"+img+"' />";
			$( "#htmlcontent" ).val($( "#htmlcontent" ).val()+htmlcont);
			actucontent();
		}
	});
	$( ".htmlcontent" ).droppable({
		hoverClass: "zoneselect2",
		drop: function( event, ui ) {
			var img = $(ui.draggable).attr("data-value");
			var htmlcont = "<img src='"+__prefix+"/img/content/"+img+"' alt='"+img+"' />";
			$(this).val($(this).val()+htmlcont);
			actucontent();
		}
	});
	
	$( "#csscontent" ).droppable({
		hoverClass: "zoneselect2",
		drop: function( event, ui ) {
			var img = $(ui.draggable).attr("data-value");
			var htmlcont = "background-image:url('"+__prefix+"/img/content/"+img+"');";
			$(this).val($(this).val()+htmlcont);
			actucontent();
		}
	});
	
});
function actucontent(){
	var cont = "";
	cont += "<style type='text/css'>"+$('#csscontent').val()+"</style>";
	cont += "<script language='javascript'>"+$('#jscontent').val()+"</script>";
	var i=1;
	$('.htmlcontent').each(function() {
		var lang = $(this).attr("data-lang");
		var cont2 = $('#htmlcontent'+lang).val();
		
		$('#allcontent'+lang).val(cont+cont2);
		$('#zoneparam'+lang).html(cont+cont2);
		i++;
	});
	
}