(function($){

	var o = {
		script : 'delet.php'
	}
	$.fn.trash = function(oo){
		var replace = false;
		if(oo) $.extend(o,oo);
		this.each(function(){
			
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
				console.log(e);
				//delet(files);
			},false);
		});
		function delet(files){
			var file = files[0];
			
			if (files.length == 0) {
                    alert("Please browse for one or more files.");
                } else {
                    for (var i = 0; i < files.length; i++) {
                        alert("<br /><b>" + (i+1) + ". file</b><br />");
					}
				}
			
			/*
			var xhr = new XMLHttpRequest();
			//var progress = area.find('.progress');
			// Evenements
			xhr.addEventListener("load",function(e){
				var json = jQuery.parseJSON(e.target.responseText);
				area.removeClass('hover');
				
				if(json.error){
					alert(json.error);
					return false;
				}
			},false);
			
			xhr.open("post",o.script,true);
			xhr.setRequestHeader('content-type', 'multipart/form-data');
			xhr.setRequestHeader('x-file-type', file.type);
			xhr.setRequestHeader('x-file-size', file.fileSize);
			xhr.setRequestHeader('x-file-name', file.fileName);
			
			for(var i in area.data()){
				if(typeof area.data(i) !== 'object'){
					xhr.setRequestHeader('x-param-'+i, area.data(i));
				}
			}
			xhr.send(file);*/
		}
		return this;
	}
})(jQuery);