function getcaddieshort(id,idelement){
	var formcaddies = __prefix+"/boutiques/boutiques/ajax_getcaddie/";
	$.ajax({
		type: 'POST',
		url: formcaddies,
		async: true,
		dataType: 'json',
		data: { id: id },
		success: function(data) {
			if(data && data!="no"){
				var total=0;
				var i=0;
				for ( var cle in data ) {
					if(data[cle]["idrub"]){
						var idrub = data[cle]["idrub"]
					}else{
						var tot = data[cle]["prix"]*data[cle]["nb"];
						total += tot;
						i++;
					}
				}
				total = total.toFixed(2);
					if(i>1)
						$('#cs_content_'+idelement).append("<div class='cs_shortcaddie'>"+i+" <?php echo __d('boutiques', 'Items'); ?></div>");
					else
						$('#cs_content_'+idelement).append("<div class='cs_shortcaddie'>"+i+" <?php echo __d('boutiques', 'Item'); ?></div>");
					$('#cs_content_'+idelement).append("<div class='cs_shortcaddie'>"+total+" €</div>");
					$('#cs_content_'+idelement).append("<div class='bkp_shortcaddie'><a href='"+__prefix+"/p/"+idrub+"/cart/view'><?php echo __d('boutiques', 'Go to Cart'); ?></a></div>");
			}
		},
		error: function(xhr, textStatus, error){
			//alert(textStatus);
		}
	});
}