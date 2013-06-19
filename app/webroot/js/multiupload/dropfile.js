(function($){

	var o = {
		message : 'Déposez vos fichiers ici',
		script : 'upload.php',
		clone : true,
		trash : true,
		select : false,
		inputmaj : "none",
		rename : false,
		selectmessage : 'Glisser votre photo principale ici',
		foldermin : "0",
		foldermin2 : '0',
		foldermin3 : '0',
		widthmin : '0',
		heightmin : '0',
		widthmin2 : '0',
		heightmin2 : '0',
		widthmin3 : '0',
		heightmin3 : '0',
		complete : function(json){
			return false;
		}
	}
	$.fn.dropfile = function(oo){
		var replace = false;
		if(oo) $.extend(o,oo);
		if(o.trash){
			if($(".dropfile").length>1){
				if($("#trash").length==0){
					$("#dropfile_content").prepend( $('<div id="trash"></div>') );
				}
			}
		}
		if(o.select){
			if($(".dropfile").length>1){
				if($("#select").length==0){
					$("#dropfile_content").prepend( $('<div id="select"></div>') );
					$('<span>').addClass('instructions').append(o.selectmessage).appendTo($("#select"));
					if($("#input_location").val()){
						$("#select").append($("#input_location").val());
					}
				}
			}
		}
		
		this.each(function(){
			$('<span>').addClass('instructions').append(o.message).appendTo(this);
			$('<span>').addClass('progress').appendTo(this);
			$(this).bind({
				dragenter : function(e){
					e.preventDefault();
				},
				dragover : function(e){
					e.preventDefault();
					$(this).addClass('hover');
				},
				dragleave : function(e){
					e.preventDefault();
					$(this).removeClass('hover');
					//console.log('ok');
				}
			});
			this.addEventListener('drop',function(e){
				e.preventDefault();
				var files = e.dataTransfer.files;
				if($(this).data('value')){
					replace=true;
				}
				upload(files,$(this),0);
			},false);
			//
			if(o.trash || o.select){
				if($(this).data('value')){
					$(this).draggable({
						opacity: 0.50,
						revert: true,
						zIndex:2600
					});
				}
				if(o.trash){
					$("#trash").droppable({
						over: function(event, ui){
							$(this).addClass('hover');
							if(ui.draggable,ui.draggable.context.children[0].alt){
								$(this).html("<p align='center'>Supprimer<br/>"+ui.draggable.context.children[0].alt+" ?</p>");
							}else{
								$(this).html("<p align='center'>Supprimer<br/>"+ui.draggable.context.children[2].alt+" ?</p>");
							}
							//console.log(ui.draggable.context.children[0].alt);
						},
						out: function(event, ui){
							$(this).removeClass('hover');
							$(this).text("");
						},
						drop: function(event, ui){
							var imgname;
							if(ui.draggable.context.children[0].alt){
							imgname = ui.draggable.context.children[0].alt;
							}else{
							imgname = ui.draggable.context.children[2].alt;
							}
							//$(ui.draggable.context.id).hide(); 
							//setTimeout(function() { ui.draggable.remove(); }, 1);
							//ui.draggable.context.children[0].
							if(confirm("Etes vous sur de vouloir supprimer "+imgname)){
								delet(ui.draggable,imgname);
							}
							
						}
					});
				}
				if(o.select){
					$("#select").droppable({
						over: function(event, ui){
							$(this).addClass('hover');
							if(ui.draggable,ui.draggable.context.children[0].alt){
							//
							}
						},
						out: function(event, ui){
							$(this).removeClass('hover');
						},
						drop: function(event, ui){
							var imgname;
							if(ui.draggable.context.children[0].alt){
							imgname = ui.draggable.context.children[0].alt;
							}else{
							imgname = ui.draggable.context.children[2].alt;
							}
							//
							if(confirm("Voulez vous choisir "+imgname+" comme image principale")){
								select(ui.draggable,imgname);
							}
							
						}
					});
				}
				
			}
		});
		function delet(div,img){
			
			var xhr2 = new XMLHttpRequest();
			// Evenements
			xhr2.addEventListener("load",function(e){
				var json = jQuery.parseJSON(e.target.responseText);
				
				if(json.error){
					alert(json.error);
					return false;
				}
				if(o.select){
				console.log(div.find("img").attr("alt"));
				console.log($("#select").find("img").attr("alt"));
					if(div.find("img").attr("alt")==$("#select").find("img").attr("alt")){
						$("#select").find("img").remove();
					}
					//console.log(div.find("img"));
				}
				$("#trash").removeClass('hover');
				
				setTimeout(function() { div.remove(); }, 1);
				
				$("#trash").html("<p align='center'>"+img+"<br/> a bien été supprimé</p>");
				if($(".dropfile").length==2){
					if(o.trash){
						$("#trash").remove();
					}
					if(o.select){
						$("#select").remove();
					}
				}
			},false);
			
			xhr2.open("post",o.script,true);
			xhr2.setRequestHeader('content-type', 'multipart/form-data');
			xhr2.setRequestHeader('x-file-name', img);
			xhr2.setRequestHeader('x-file-delete', "ok");
			xhr2.setRequestHeader('x-file-folder', o.folder);
			xhr2.setRequestHeader('x-file-foldermin', o.foldermin);
			xhr2.setRequestHeader('x-file-foldermin2', o.foldermin2);
			xhr2.setRequestHeader('x-file-foldermin3', o.foldermin3);
			xhr2.send();
		}
		function select(div,img){
			
			var xhr3 = new XMLHttpRequest();
			// Evenements
			xhr3.addEventListener("load",function(e){
				var json = jQuery.parseJSON(e.target.responseText);
				
				if(json.error){
					alert(json.error);
					return false;
				}
				$("#select").removeClass('hover');
				$("#select").append(json.content);
				$("#input_name").val(json.name);
				$("#input_location").val(json.content);
				//$("#formPhoto").submit();
				var formData = $('#formPhoto').serialize();
				var formUrl = $('#formPhoto').attr('action');
				$.ajax({
					type: 'POST',
					url: formUrl,
					data: formData,
					dataType: 'json',
					success: function(data) {
					//
					},
					error: function(xhr, textStatus, error){
						//alert(textStatus);
					}
				});
 
				
			},false);
			
			xhr3.open("post",o.script,true);
			xhr3.setRequestHeader('content-type', 'multipart/form-data');
			xhr3.setRequestHeader('x-file-name', img);
			xhr3.setRequestHeader('x-file-select', "ok");
			xhr3.setRequestHeader('x-file-foldermin', o.foldermin);
			xhr3.send();
		}
		
		function upload(files,area,index){
			var file = files[index];
			if(index > 0 && o.clone){
				area = area.clone().html('').insertAfter(area).dropfile(o);
				area.data('value',null);
			}
			var xhr = new XMLHttpRequest();
			var progress = area.find('.progress');
			// Evenements
			xhr.addEventListener("load",function(e){
				var json = jQuery.parseJSON(e.target.responseText);
				area.removeClass('hover');
				progress.css({height:0});
				if(index < files.length-1){
					upload(files,area,index+1);
				}
				if(json.error){
					alert(json.error);
					return false;
				}
				if(o.complete(json)){
					return true;
				}
				if(o.clone && !replace && index == files.length-1){
					area.clone().html('').insertAfter(area).dropfile(o);
				}
				if(replace){
					area.find("img").remove();
				}
				if(oo.inputmaj!="none"){
					oo.inputmaj.val(json.name);
				}
				area.append(json.content);
				area.data('value',json.name);
				if(o.trash || o.select){
					area.draggable({
						opacity: 0.50,
						revert: true
					});
				}
				
			},false);
			xhr.upload.addEventListener("progress",function(e){
				if(e.lengthComputable){
					var perc = Math.round((e.loaded/e.total) * 100)+ '%';
					if(perc=="100%"){
						progress.css({height:perc}).html("<br/><br/><p align='center'>CREATION DES VIGNETTES</p>");
					}else{
						progress.css({height:perc}).html(perc);
					}
				}
			},false);
			xhr.open("post",o.script,true);
			xhr.setRequestHeader('content-type', 'multipart/form-data');
			xhr.setRequestHeader('x-file-type', file.type);
			xhr.setRequestHeader('x-file-size', file.size);
			xhr.setRequestHeader('x-file-name', file.name);
			xhr.setRequestHeader('x-file-foldermin', o.foldermin);
			xhr.setRequestHeader('x-file-widthmin', o.widthmin);
			xhr.setRequestHeader('x-file-heightmin', o.heightmin);
			xhr.setRequestHeader('x-file-foldermin2', o.foldermin2);
			xhr.setRequestHeader('x-file-widthmin2', o.widthmin2);
			xhr.setRequestHeader('x-file-heightmin2', o.heightmin2);
			xhr.setRequestHeader('x-file-foldermin3', o.foldermin3);
			xhr.setRequestHeader('x-file-widthmin3', o.widthmin3);
			xhr.setRequestHeader('x-file-heightmin3', o.heightmin3);
			if(o.rename){
				xhr.setRequestHeader('x-file-rename', o.rename);
			}
			for(var i in area.data()){
				if(typeof area.data(i) !== 'object'){
					xhr.setRequestHeader('x-param-'+i, area.data(i));
				}
			}
			xhr.send(file);
		}
		return this;
	}
})(jQuery);