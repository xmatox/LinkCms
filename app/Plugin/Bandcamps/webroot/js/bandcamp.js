function recupcontent(bandid){
	var my_url = 'http://api.bandcamp.com/api/band/3/discography?key=vatnajokull&band_id='+bandid+'&debug';
	$.ajax({
	    'url': my_url,
	    'type': "GET",
	    'dataType': 'jsonp',
	    success: function(res) {
	    	if(res) {
				var rd = res.discography;
				console.log(rd);
				$("#bccontent").html("");
				var outp="";
				var i=1;
				for ( var cle in rd ) {
					if (i==1) {
						if (!rd[cle].album_id) var album_id = 'track='+rd[cle].track_id;
						else var album_id = 'album='+rd[cle].album_id;
						outp += '<div id="detailtitle" style="background-color:#eeeeee;opacity:0.4; filter:alpha(opacity=40);margin-right:10px;font-weight:bold;padding:5px;margin-bottom:10px;font-size:12px;color:#333;">'+rd[cle].artist+' - '+rd[cle].title+'</div>';
						outp += '<div style="width:700px;margin:auto;">';
						outp += '<div id="detailjack" style="width:350px;float:left;margin-right:10px;margin-bottom:20px;"><img src="'+rd[cle].large_art_url+'" alt="'+rd[cle].title+'" /></div>';
						outp += '<div id="detailtitre" style="width:300px;float:left;"><iframe width="300" height="355" style="position: relative; display: block; width: 300px; height: 355px;" src="http://bandcamp.com/EmbeddedPlayer/v=2/'+album_id+'/size=grande2/bgcol=FFFFFF/linkcol=4285BB/transparent=true/" allowtransparency="true" frameborder="0"><a href="'+rd[cle].url+'">'+rd[cle].title+'</a></iframe></div>';
						outp += '</div>';
						outp += '<div class="clear"></div>';
					}
					i++;
				}
				outp += '<div style="background-color:#eeeeee;opacity:0.4; filter:alpha(opacity=40);margin-right:10px;font-weight:bold;padding:5px;font-size:12px;color:#333;">Discographie</div>';
				outp += '<div class="clear"></div>';
				outp += '<div style="width:700px;margin:auto;">';
				for ( var cle in rd ) {
					var title = addslashes(rd[cle].title);
					var artist = addslashes(rd[cle].artist);
					if (!rd[cle].album_id) var album_id = 'track='+rd[cle].track_id;
					else var album_id = 'album='+rd[cle].album_id;
					outp += '<div style="float:left;margin:10px;width:150px;"><a href="#" onclick="affichedisco(\''+album_id+'\',\''+rd[cle].url+'\',\''+title+'\',\''+rd[cle].large_art_url+'\',\''+artist+'\');return false;"><img src="'+rd[cle].large_art_url+'" alt="'+rd[cle].title+'" style="width:150px" /></a></div>';
				}
				outp += '</div>';
				outp += '<div class="clear"></div>';
				$("#bccontent").html(outp);
		    }else{$("#bccontent").html("Pas d'album disponible");}
	    }
	});
}
function affichedisco(album_id,url,title,large_art_url,artist){
	$("#detailtitre").html('<iframe width="300" height="355" style="position: relative; display: block; width: 300px; height: 355px;" src="http://bandcamp.com/EmbeddedPlayer/v=2/'+album_id+'/size=grande2/bgcol=FFFFFF/linkcol=4285BB/transparent=true/" allowtransparency="true" frameborder="0"><a href="'+url+'">'+title+'</a></iframe>');
	$("#detailtitle").html(artist+' - '+title);
	$("#detailjack").html('<img src="'+large_art_url+'" alt="'+title+'" />');
}
function addslashes(str) {
	str=str.replace(/\\/g,'\\\\');
	str=str.replace(/\'/g,'\\\'');
	str=str.replace(/\"/g,'\\"');
	str=str.replace(/\0/g,'\\0');
	return str;
}