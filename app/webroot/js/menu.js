$(document).ready(function() {
	initmenu();
});
function initmenu(){
	var timedrop = 100;
	var idMenu = 'ul.el_block';
	var classHover = 'actif';
	
	if((idMenu)) {
		
		$("li.hori").hover(function () {
			$(this).children('ul').slideDown(timedrop);
			//$(this).children('ul').show("slide", { direction: "down" }, 0);
		},function () {
			//$(this).removeClass( classHover );
			$(this).children('ul').slideUp(timedrop);
			//$(this).children('ul').hide("slide", { direction: "down" }, 0);
		});
		$("li.vert").hover(function () {
			$(this).children('ul').css("top",0);
			$(this).children('ul').css("left",$(this).css("width"));
			//$(this).children('ul').show("slide", { direction: "left" }, 0);
			$(this).children('ul').animate({width:'toggle'},timedrop);
		},function () {
			$(this).children('ul').animate({width:'toggle'},timedrop);
		});
		
	}
	
	/*
	// ctrl + shift pour avoir le focus sur le premier item du menu
	$(document).keyup(function (e) {
		if(e.which == 17) isCtrl=false;
	}).keydown(function (e) {
		if(e.which == 17) isCtrl=true;
		if(e.which == 16 && isCtrl == true) {
			var Item = $(" > li:first-child a", idMenu);
			var titleItem = $(Item).attr('title');
				$(Item).addClass( classHover ).focus();
	 	}
	});
	
	
	
	*/
}
