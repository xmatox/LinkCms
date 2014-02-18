$(document).ready(function() {
	//
	$( document ).tooltip({ position: { my: "right center", at: "left center" } });
	//
	$( "#zp_width_g" ).attr("disabled","disabled");
	$( "#zp_width_g" ).val($( "#contenu" ).width());
	$( ".resizable_contenu" ).resizable({
		helper: "ui-resizable-helper",
		handles:'e',
		stop: function( event, ui ) {
			setsize("contenu","",ui.size.width);
			$(this).css("max-width",ui.size.width);
			$(this).css("width","auto");
			$( "#zp_width_g" ).val(ui.size.width);
		}
	});
	$( ".resizable_tete" ).resizable({
		helper: "ui-resizable-helper",
		handles:'s',
		stop: function( event, ui ) {
			setsize("tete",ui.size.height,"");
		}
	});
	$( ".resizable_gauche" ).resizable({
		helper: "ui-resizable-helper",
		handles:'e',
		stop: function( event, ui ) {
			setsize("gauche","",ui.size.width);
		}
	});
	$( ".resizable_droite" ).resizable({
		helper: "ui-resizable-helper",
		handles:'w',
		stop: function( event, ui ) {
			setsize("droite","",ui.size.width);
		}
	});
	$( ".resizable_pied" ).resizable({
		helper: "ui-resizable-helper",
		handles:'n, e',
		stop: function( event, ui ) {
			setsize("pied",ui.size.height,ui.size.width);
			$(this).css("max-width",ui.size.width);
			$(this).css("width","auto");
		}
	});
	
	//
	init_sortable();
	//
	var selecte;
	$(".editable").hover(
		function () {
			if($('#bout_'+$(this).attr("id")).length<1){
				$(this).append("<div id='bout_"+$(this).attr("id")+"' data-id='"+$(this).attr("id")+"' class='edithis ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
				$(this).append("<div id='bout_plus_"+$(this).attr("id")+"' data-id='"+$(this).attr("id")+"' class='edithis ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-plusthick'></a></div>");
				$('#bout_plus_'+$(this).attr("id")).css({right:40});
				//
				$('#bout_'+$(this).attr("id")).click(function() {
					$('.edithis').not('#bout_'+$(this).attr("data-id")).remove();
					initselectit();
					recupform($(this).attr("data-id"));
					selecte=$(this).attr("data-id");
					$(this).addClass("edithis_ok");
					$('#zp_elements').css("display","block");
					$('#zp_elements').attr("data-id",selecte);
					$('#zp_contenus').css("display","none");
					return false;
				});

				$('#bout_plus_'+$(this).attr("id")).click(function() {
					if($('#elementtypeInside').length<1){
						$("#elementtype").clone().prependTo($(this)).attr("id","elementtypeInside");
						$("#elementtypeInside").attr("onchange","addElement('"+$(this).attr("data-id")+"')");
					}
					return false;
				});
			}else{
				$('#bout_'+$(this).attr("id")).click(function() {
					$('.edithis').remove();
					initselectit();
					$('#bout_'+selecte).removeClass("edithis_ok");
					recupform("fond");
					selecte="fond";
					$('#zp_elements').css("display","none");
					$('#zp_elements').attr("data-id",selecte);
					return false;

				});
			}
			},
		function () {
			if(selecte!=$(this).attr("id")){
				$('#bout_'+$(this).attr("id")).remove();
				$('#bout_plus_'+$(this).attr("id")).remove();
			}
		}
	);
	$(".editable_centre").hover(
		function () {
			if($('#bout_'+$(this).find(".el_blocks").attr("id")).length<1){
				$(this).append("<div id='bout_"+$(this).find(".el_blocks").attr("id")+"' data-id='"+$(this).find(".el_blocks").attr("id")+"' class='edithis ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
				$(this).append("<div id='bout_plus_"+$(this).find(".el_blocks").attr("id")+"' data-id='"+$(this).find(".el_blocks").attr("id")+"' class='edithis ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-plusthick'></a></div>");
				$('#bout_plus_'+$(this).find(".el_blocks").attr("id")).css({right:40});
				//
				$('#bout_'+$(this).find(".el_blocks").attr("id")).click(function() {
					$('.edithis').not('#bout_'+$(this).attr("data-id")).remove();
					
					selecte=$(this).attr("data-id");
					$(this).addClass("edithis_ok");
					$('#zp_contenus').css("display","block");
					$('#zp_contenus').attr("data-id",selecte);
					recupform("centre");
					$('#zp_elements').css("display","none");
					$('#zp_elements').attr("data-id","centre");
					$('#zp_elstyle').css("display","none");
					return false;
				});
				$('#bout_plus_'+$(this).find(".el_blocks").attr("id")).click(function() {
					if($('#contenutypeInside').length<1){
						$("#contenutype").clone().prependTo($(this)).attr("id","contenutypeInside");
						$("#contenutypeInside").attr("onchange","addContent('"+$(this).attr("data-id")+"')");
					}
					return false;
				});
			}else{
				$('#bout_'+$(this).find(".el_blocks").attr("id")).click(function() {
					$('.edithis').remove();
					$('#bout_'+selecte).removeClass("edithis_ok");
					
					selecte="fond";
					$('#zp_contenus').css("display","none");
					$('#zp_contenus').attr("data-id",selecte);
					recupform("fond");
					$('#zp_elements').css("display","none");
					$('#zp_elements').attr("data-id",selecte);
					$('#zp_elstyle').css("display","none");
					return false;
				});
			}
		},
		function () {
			if(selecte!=$(this).find(".el_blocks").attr("id")){
				$('#bout_'+$(this).find(".el_blocks").attr("id")).remove();
				$('#bout_plus_'+$(this).find(".el_blocks").attr("id")).remove();
			}
		}
	);
	// $(".editable .el_block").draggable({ containment: "parent" });

	//iframe
	$(".showiframe").css("cursor","pointer");
	$(".showiframe").click(function() {
		show_iframe($(this).attr("data-value"));
	});
	// edit writter
	$(".edit_block").css("cursor","pointer");
	$(".edit_block").click(function() {
		var element_id = $(this).attr("id").replace("ed_bl_","re_");
  		edit_cont(element_id);
	});
	$(".editadmin>a").click(function() {
		$(".editadmincont").slideToggle();
	});
});
function addRemoveCadre(div, plus){
		
          martop = new Number($(div).css("margin-top").replace("px",""));
          marleft = new Number($(div).css("margin-left").replace("px",""));
          marright = new Number($(div).css("margin-right").replace("px",""));
          marbottom = new Number($(div).css("margin-bottom").replace("px",""));
          if(plus){
          	$(div).addClass('contourselect');
			$(div).css("margin-top",martop-2);
			$(div).css("margin-left",marleft-2);
			$(div).css("margin-right",marright-2);
			$(div).css("margin-bottom",marbottom-2);
          }else{
          	$(div).removeClass('contourselect');
          	$(div).css("margin-top",martop+2);
			$(div).css("margin-left",marleft+2);
			$(div).css("margin-right",marright+2);
			$(div).css("margin-bottom",marbottom+2);
          }
          
}
function init_sortable(){
   $(".editable .el_block").hover(
     function () {
      
        if ($('#bout_'+$(this).parent().attr('id')).hasClass('edithis_ok') || $('#bout_'+$(this).parent().parent().attr('id')).hasClass('edithis_ok')) {
          addRemoveCadre(this,true);
          $(this).append("<div id='resizethis' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-arrow-4-diag'></a></div>");
          $(this).append("<div id='paramthisC' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
          $(this).append("<div id='delethisC' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-trash'></a></div>");
          $(this).append("<div id='edithisC' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-pencil'></a></div>");
          var position = $(this).position();
          martop = new Number($(this).css("margin-top").replace("px",""));
          marleft = new Number($(this).css("margin-left").replace("px",""));
          leftVal = position.left+marleft;
          topVal = position.top+martop;
          $('#resizethis').css({left:leftVal,top:topVal}).fadeIn(1500);
          $('#paramthisC').css({left:leftVal+90,top:topVal}).fadeIn(1500);
          $('#delethisC').css({left:leftVal+60,top:topVal}).fadeIn(1500);
          $('#edithisC').css({left:leftVal+30,top:topVal}).fadeIn(1500);
          $("#paramthisC").click(
            function () {
              paramC(this);
              return false;
            }
          );
          $("#delethisC").click(
            function () {
              deleteC(this);
              return false;
            }
          );
          $("#edithisC").click(
            function () {
              edithisC(this);
              return false;
            }
          );
        }
       
      },
      function () {
        $('#resizethis').remove();
        $('#paramthisC').remove();
        $('#delethisC').remove();
        $('#edithisC').remove();
        if($(this).hasClass('contourselect')){
			addRemoveCadre(this,false);
		}
      }
    );
	//
	$(".editable_centre .el_block").hover(
     function () {
      
        if ($('#bout_'+$(this).parent().attr('id')).hasClass('edithis_ok') || $('#bout_'+$(this).parent().parent().attr('id')).hasClass('edithis_ok')) {
          addRemoveCadre(this,true);
          $(this).append("<div id='resizethis' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-arrow-4-diag'></a></div>");
          $(this).append("<div id='paramthisR' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
          $(this).append("<div id='delethisR' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-trash'></a></div>");
          $(this).append("<div id='edithisR' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-pencil'></a></div>");
          var position = $(this).position();
          martop = new Number($(this).css("margin-top").replace("px",""));
          marleft = new Number($(this).css("margin-left").replace("px",""));
          leftVal = position.left+marleft;
          topVal = position.top+martop;
          $('#resizethis').css({left:leftVal,top:topVal}).fadeIn(1500);
          $('#paramthisR').css({left:leftVal+90,top:topVal}).fadeIn(1500);
          $('#delethisR').css({left:leftVal+60,top:topVal}).fadeIn(1500);
          $('#edithisR').css({left:leftVal+30,top:topVal}).fadeIn(1500);
          $("#paramthisR").click(
            function () {
              paramR(this);
              return false;
            }
          );
          $("#delethisR").click(
            function () {
              deleteR(this);
              return false;
            }
          );
          $("#edithisR").click(
            function () {
              edithisC(this);
              return false;
            }
          );
        }
       
      },
      function () {
        $('#resizethis').remove();
        $('#paramthisR').remove();
        $('#delethisR').remove();
        $('#edithisR').remove();
        if($(this).hasClass('contourselect')){
			addRemoveCadre(this,false);
		}
      }
    );
	$(".el_block").parent().sortable({ 
		handle: "#resizethis",
		stop: function(event, ui){
			// 
			if ($(ui.item).parent().hasClass('el_blocks')) {
				$(ui.item).parent().find(".el_block").each(function(){
					zone_id = $(this).attr("id").replace("re_","");

					// On actualise sa position
					index = parseInt($(this).index()+1);
					setposition_rub(zone_id,index);
				});
			}else{
				$(ui.item).parent().find(".el_block").each(function(){
					zone_id = $(this).attr("id").replace("ze_","");

					// On actualise sa position
					index = parseInt($(this).index()+1);
					setposition_el(zone_id,index);
				});
			}
			
		}
	});
}

function paramC(id){
  var element_id = $(id).parent().attr("id");
  actuvisu_fe(element_id);
  $('#zp_elstyle').css("display","block");
}
function deleteC(id){
  var element_id = $(id).parent().attr("id");
  element_id = element_id.replace("ze_","");
  if(confirm("Confirmer la suppression de l'élément ?")){
    deleteform_el(element_id);
    if($("#zp_elstyle").attr("data-id")==$(id).parent().attr("id"))
      $('#zp_elstyle').css("display","none");
  }
}
function edithisC(id){
  var element_id = $(id).parent().attr("id");
  edit_cont(element_id);
}
function paramR(id){
  var element_id = $(id).parent().attr("id");
  actuvisu_fe(element_id);
  $('#zp_elstyle').css("display","block");
}
function deleteR(id){
  var element_id = $(id).parent().attr("id");
  element_id = element_id.replace("re_","");
  if(confirm("Confirmer la suppression de l'élément ?")){
    deleteform_rub(element_id);
    if($("#zp_elstyle").attr("data-id")==$(id).parent().attr("id"))
      $('#zp_elstyle').css("display","none");
  }
}
function addContent(zone){
	$("#contenutype").val($("#contenutypeInside").val());
	$("#contenupagec").val("new");
	saveform_rub(zone);
}
function addElement(zone){
	$("#elementtype").val($("#elementtypeInside").val());
	$("#contenupage").val("new");
	saveform_el(zone);
}
function setsize(zone,height,width){
	set_loader(true);
  var formUrl = __prefix+"/graphelements/ajax_editsize";
  $.ajax({
    type: 'POST',
    url: formUrl,
    async: true,
    dataType: 'json',
    data: { zone: zone, height: height, width: width },
    success: function(data) {
      if(data){
        set_loader(false);
      }
    },
    error: function(xhr, textStatus, error){
      //console.log(error);
    }
  });
}
function set_loader(show){
	if(show)
		$('body').append("<div id='loader_ajax'><div id='la_cont'><img src='"+__prefix+"/css/images/ajax-loader.gif' alt='Loader' /><br/>CHARGEMENT</div></div>");
	else
		$("#loader_ajax").remove();
}
function show_iframe(url){
	//$("body").append("<div id='popup_edit'><div id='popup_edit_cont'><iframe name='frame_edit' src='"+__prefix+"/"+url+"' scrolling='auto' height='500' width='800' frameborder='no'></iframe></div></div>");
	set_loader(true);
	/*$("body").append("<div id='popup_edit'><div id='popup_edit_cont_all'><div id='popup_edit_head'><div id='popup_edit_close'>FERMER</div></div><div id='popup_edit_cont'></div></div></div>");*/
	$("body").append("<div id='popup_edit'><div id='popup_edit_cont_all'><div id='popup_edit_close'  class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-close'></a></div><div id='popup_edit_cont'></div></div></div>");
	$("#popup_edit").fadeIn("slow");
	$('#popup_edit_cont').load(__prefix+"/"+url, function(response, status, xhr) {
		if (status == "error") {
			alert("Une erreur est survenue au chargement de la page, vous pouvez recommencer une fois la page recharger.");
			location.reload();
		}
		set_loader(false);
		$("#popup_edit_cont_all").slideDown("slow");
		$("body").css("overflow","hidden");
		$( "#popup_edit_cont_all" ).resizable({
			helper: "ui-resizable-helper",
			handles:'e'
		});
	});
	$("#popup_edit_close").click(function() {
		//$(this).remove();
		//location.reload();
		hide_iframe();
	});
			
}
function hide_iframe(){
	$("#popup_edit_cont_all").slideUp("slow");
		
	set_loader(true);
	$('body').load(location.href, function(response, status, xhr) {
		if (status == "error") {
			location.reload();
		}
		set_loader(false);
		$("#popup_edit").fadeOut("slow");
		$("body").css("overflow","auto");
	});
}
function isSimilarToPrefix(url){
	if(url.substr(-1)=="/") url = url.substr(0,url.length-1);
	var pathNameUrl = url.split("/");
	var pathNamePrefix = __prefix.split("/");
	pathNameUrl = pathNameUrl[pathNameUrl.length-1];
	pathNamePrefix = pathNamePrefix[pathNamePrefix.length-1];
	if(pathNameUrl==pathNamePrefix) return true;
	else return false;
}