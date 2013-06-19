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

				});
			}
			},
		function () {
			if(selecte!=$(this).attr("id")){
				$('#bout_'+$(this).attr("id")).remove();
			}
		}
	);
	$(".editable_centre").hover(
		function () {
			if($('#bout_'+$(this).find(".el_blocks").attr("id")).length<1){
				$(this).append("<div id='bout_"+$(this).find(".el_blocks").attr("id")+"' data-id='"+$(this).find(".el_blocks").attr("id")+"' class='edithis ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
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
				});
			}
		},
		function () {
			if(selecte!=$(this).find(".el_blocks").attr("id")){
				$('#bout_'+$(this).find(".el_blocks").attr("id")).remove();
			}
		}
	);
	// $(".editable .el_block").draggable({ containment: "parent" });

	//iframe
	$(".showiframe").css("cursor","pointer")
	$(".showiframe").click(function() {
		show_iframe($(this).attr("data-value"));
	});
	
	
});
function init_sortable(){
   $(".editable .el_block").hover(
     function () {
      
        if ($('#bout_'+$(this).parent().attr('id')).hasClass('edithis_ok') || $('#bout_'+$(this).parent().parent().attr('id')).hasClass('edithis_ok')) {
           $(this).append("<div id='resizethis' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-arrow-4-diag'></a></div>");
          $(this).addClass('contourselect');
          $(this).append("<div id='paramthisC' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
          $(this).append("<div id='delethisC' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-trash'></a></div>");
          $(this).append("<div id='edithisC' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-pencil'></a></div>");
          var position = $(this).position();
          leftVal = position.left;
          martop = new Number($(this).css("margin-top").replace("px",""));
          topVal = position.top+martop;
          $('#resizethis').css({left:leftVal,top:topVal}).fadeIn(1500);
          $('#paramthisC').css({left:leftVal+90,top:topVal}).fadeIn(1500);
          $('#delethisC').css({left:leftVal+60,top:topVal}).fadeIn(1500);
          $('#edithisC').css({left:leftVal+30,top:topVal}).fadeIn(1500);
          $("#paramthisC").click(
            function () {
              paramC(this);
            }
          );
          $("#delethisC").click(
            function () {
              deleteC(this);
            }
          );
          $("#edithisC").click(
            function () {
              edithisC(this);
            }
          );
        }
       
      },
      function () {
        $('#resizethis').remove();
        $('#paramthisC').remove();
        $('#delethisC').remove();
        $('#edithisC').remove();
       $(this).removeClass('contourselect');
      }
    );
	//
	$(".editable_centre .el_block").hover(
     function () {
      
        if ($('#bout_'+$(this).parent().attr('id')).hasClass('edithis_ok') || $('#bout_'+$(this).parent().parent().attr('id')).hasClass('edithis_ok')) {
           $(this).append("<div id='resizethis' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-arrow-4-diag'></a></div>");
          $(this).addClass('contourselect');
          $(this).append("<div id='paramthisR' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-gear'></a></div>");
          $(this).append("<div id='delethisR' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-trash'></a></div>");
          $(this).append("<div id='edithisR' class='ui-state-default ui-corner-all'><a href='#' class='ui-icon ui-icon-pencil'></a></div>");
          var position = $(this).position();
          leftVal = position.left;
          martop = new Number($(this).css("margin-top").replace("px",""));
          topVal = position.top+martop;
          $('#resizethis').css({left:leftVal,top:topVal}).fadeIn(1500);
          $('#paramthisR').css({left:leftVal+90,top:topVal}).fadeIn(1500);
          $('#delethisR').css({left:leftVal+60,top:topVal}).fadeIn(1500);
          $('#edithisR').css({left:leftVal+30,top:topVal}).fadeIn(1500);
          $("#paramthisR").click(
            function () {
              paramR(this);
            }
          );
          $("#delethisR").click(
            function () {
              deleteR(this);
            }
          );
          $("#edithisR").click(
            function () {
              edithisC(this);
            }
          );
        }
       
      },
      function () {
        $('#resizethis').remove();
        $('#paramthisR').remove();
        $('#delethisR').remove();
        $('#edithisR').remove();
       $(this).removeClass('contourselect');
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
	$("body").append("<div id='popup_edit'><div id='popup_edit_cont_all'><div id='popup_edit_move'>DEPLACER</div><div id='popup_edit_close'>FERMER</div><div id='popup_edit_cont'></div></div></div>");
	$("#popup_edit").fadeIn("slow");
	$('#popup_edit_cont').load(__prefix+"/"+url, function() {
		set_loader(false);
		$("#popup_edit_cont_all").slideDown("slow");
		$("body").css("overflow","hidden");
		$('#popup_edit_cont_all').draggable({ handle: "#popup_edit_move" });
		$('.popup_edit_move').css("cursor","move");
		$( "#popup_edit_cont_all" ).resizable({
			helper: "ui-resizable-helper",
			stop: function( event, ui ) {
				$("#popup_edit_cont").css("height",ui.size.height-20);
				
			}
		});
	});
	$("#popup_edit_close").click(function() {
		//$(this).remove();
		//location.reload();
		$("#popup_edit_cont_all").slideUp("slow");
		
		set_loader(true);
		$('body').load(location.href, function() {
			set_loader(false);
			$("#popup_edit").fadeOut("slow");
			$("body").css("overflow","auto");
		});
	});
			
}