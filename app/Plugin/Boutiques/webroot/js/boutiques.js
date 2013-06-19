function addcaddie(id,idprod,url){
	var formUrl = __prefix+"/boutiques/boutiques/ajax_addcaddie/";
			
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { idprod: idprod,id: id },
				success: function(data) {
					if(data){
					
						window.location.href=url;
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
}
function delcaddie(id,idprod){
	var formUrl = __prefix+"/boutiques/boutiques/ajax_delcaddie/";
			
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { idprod: idprod,id: id },
				success: function(data) {
					if(data){
					
						window.location.href="../cart/view";
					}
					
					
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
					//console.log(error);
					//setCountdown();
				}
			});
}
function moinscaddie(id,idprod){
	var formUrl = __prefix+"/boutiques/boutiques/ajax_moinscaddie/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { idprod: idprod,id: id },
				success: function(data) {
					if(data){
						window.location.href="../cart/view";
					}
				},
				error: function(xhr, textStatus, error){
					//
				}
			});
}
function pluscaddie(id,idprod){
	var formUrl = __prefix+"/boutiques/boutiques/ajax_pluscaddie/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { idprod: idprod,id: id },
				success: function(data) {
					if(data){
						window.location.href="../cart/view";
					}
				},
				error: function(xhr, textStatus, error){
					//
				}
			});
}
function getcaddie(id){
	var formUrl = __prefix+"/boutiques/boutiques/ajax_getcaddie/";
			$.ajax({
				type: 'POST',
				url: formUrl,
				async: true,
				dataType: 'json',
				data: { id: id },
				success: function(data) {
					if(data && data!="no"){
						var total=0;
						var i=0;
						var paypal = '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">';
						paypal +='<input type="hidden" name="cmd" value="_cart" />';
						paypal +='<input type="hidden" name="upload" value="1" />';
						paypal +='<input type="hidden" name="item_name" value="Shopping Cart" />';
						
						
						
						for ( var cle in data ) {
							if(data[cle]["paypal"]){
								paypal +='<input type="hidden" name="business" value="'+data[cle]["paypal"]+'">';
							}else{
								i++;
								var tot = data[cle]["prix"]*data[cle]["nb"];
								total += tot;
								tot = tot.toFixed(2);
								var content = '<ul><li class="c_item">'+data[cle]["nom"]+'</li><li class="c_prix">'+data[cle]["prix"]+' €</li><li class="c_qty">'+data[cle]["nb"];
								
								if (data[cle]["nb"]>1) {
									content += '<a href="#" onclick="moinscaddie(\''+data[cle]["idbout"]+'\',\''+data[cle]["id"]+'\');return false;"><img src="'+__prefix+'/img/moins.png" alt="moins" /></a>';
								}
								content += '<a href="#" onclick="pluscaddie(\''+data[cle]["idbout"]+'\',\''+data[cle]["id"]+'\');return false;"><img src="'+__prefix+'/img/plus.png" alt="plus" /></a>';
								content += '</li><li class="c_tot">'+tot+' €</li><li class="c_sup"><a href="#" onclick="delcaddie(\''+data[cle]["idbout"]+'\',\''+data[cle]["id"]+'\');return false;"><img src="'+__prefix+'/img/trash.png" alt="delete" /></a></li></ul>';
								$('#caddiecontent').append(content);
								paypal +='<input type="hidden" name="item_name_'+i+'" value="'+data[cle]["nom"]+'" />';
								paypal +='<input type="hidden" name="amount_'+i+'" value="'+data[cle]["prix"]+'" />';
								paypal +='<input type="hidden" name="quantity_'+i+'" value="'+data[cle]["nb"]+'" />';
								
							}
						}
						total = total.toFixed(2);
						$('#caddietotal').append("<b>TOTAL : "+total+" €</b>");
						$('#caddieship').append("<i><?php echo __d('boutiques', '+ applicable shipping'); ?></i>");
						paypal +='<input type="hidden" name="amount" value="'+total+'" />';
						paypal +='<input type="hidden" name="currency_code" value="EUR" />';
						paypal +='<input type="submit" id="caddiecheckout" value="<?php echo __d('boutiques', 'CHECKOUT'); ?>" />';
						paypal +='</form>';
						$('#caddiecheck').html(paypal);

					}
					if(i==0){
						$('#caddietotal').html("<b><?php echo __d('boutiques', 'The cart is empty'); ?></b>");
						$('#caddieship').html("");
						$('#caddiecheck').html("<div class='bkp_caddie' style='margin-right:10px;'><a href='"+__prefix+"/p/"+__idrub+"' style='color:#fff;'><?php echo __d('boutiques', 'Return to the shop'); ?></a></div>");
					}
				},
				error: function(xhr, textStatus, error){
					//alert(textStatus);
				}
			});
}
function getcaddieshort(id,idelement){
	var formUrl = __prefix+"/boutiques/boutiques/ajax_getcaddie/";
			$.ajax({
				type: 'POST',
				url: formUrl,
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
