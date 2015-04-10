(function($){   
  
	$.cometchatspy = function(){

		var heartbeatTimer;
		var timeStamp = '0';		

		function chatHeartbeat(){	
			
			$.ajax({
				url: "index.php?module=monitor&action=data",
				data: {timestamp: timeStamp, token: token},
				type: 'post',
				cache: false,
				dataFilter: function(data) {
					if (typeof (JSON) !== 'undefined' && typeof (JSON.parse) === 'function')
					  return JSON.parse(data);
					else
					  return eval('(' + data + ')');
				},
				success: function(data) {
					if (data) {
						var htmlappend = '';

						$.each(data, function(type,item){
							if (type == 'timestamp') {
								timeStamp = item;
							}

							if (type == 'online') {
								$('#online').html(item);
							}

							if (type == 'messages') {
								$.each(item, function(i,incoming) {
									htmlappend = '<div class="chat"><div class="chatrequest2">'+incoming.fromu+' -> '+incoming.tou+'</div><div class="chatmessage2" >'+incoming.message+'</div><div style="clear:both"></div></div>' + htmlappend;

								});
							}
						});

						if (htmlappend != '') {
							$("#data").prepend(htmlappend);
							$('div.message').fadeIn(2000);
							$('div.message:gt(19)').remove(); 
						}
					}
					
				clearTimeout(heartbeatTimer);
				heartbeatTimer = setTimeout( function() { chatHeartbeat(); },3000);
				
			}});

		}

		chatHeartbeat();

	} 
  
})(jQuery);


(function($){   
  
	$.fancyalert = function(message){
		if ($("#alert").length > 0) {
			removeElement("alert");
		}

		var html = '<div id="alert">'+message+'</div>';
		$('body').append(html);
		$alert = $('#alert');
			if($alert.length) {
				var alerttimer = window.setTimeout(function () {
					$alert.trigger('click');
				}, 5000);
				$alert.css('border-bottom','4px solid #76B6D2');
				$alert.animate({height: $alert.css('line-height') || '50px'}, 200)
				.click(function () {
					window.clearTimeout(alerttimer);
					$alert.animate({height: '0'}, 200);
					$alert.css('border-bottom','0px solid #333333');
				});
			}
	};   
  
})(jQuery);

/* Modules */

function modules_updateorder(del,ren,showhide,lightbox) {
	order = [];
	$('#modules_livemodules').children('li').each(function(idx, elm) {
		order.push("\$trayicon[] = array('"+elm.id+"','"+$(elm).attr('d1')+"','"+$(elm).attr('d2')+"','"+$(elm).attr('d3')+"','"+$(elm).attr('d4')+"','"+$(elm).attr('d5')+"','"+$(elm).attr('d6')+"','"+$(elm).attr('d7')+"','"+$(elm).attr('d8')+"');")		 
	});  

	$.post('?module=modules&action=updateorder', {'order[]': order, token: token}, function(data) {
		if (lightbox) {
			$.fancyalert('Module has been set to appear as a '+showhide+'');
		} else if (showhide) {
			$.fancyalert('Module text will now be '+showhide+' in the bar');
		} else if (ren) {
			$.fancyalert('Module successfully renamed.');
		} else if (del) {
			$.fancyalert('Module successfully deactivated.');
		} else {
			$.fancyalert('Modules order successfully updated.');
		}
	});

}

function modules_removemodule(id) {
	var answer = confirm ('Are you sure you want to deactivate this module?');
	if (answer) {
		removeElement(id);
		modules_updateorder(true);
	}
}

function modules_renamemodule(id) {
	if (document.getElementById(id+'_title').innerHTML.indexOf('<a href="?module=modules">cancel</a>') == -1) {
		document.getElementById(id+'_title').innerHTML = '<input type="textbox" id="'+id+'_newtitle" class="inputboxsmall" style="margin-bottom:3px" value="'+document.getElementById(id+'_title').innerHTML+'"/><br/><input type="button" onclick="javascript:modules_renamemoduleprocess(\''+id+'\');" value="Rename" class="buttonsmall">&nbsp;&nbsp;or <a href="?module=modules">cancel</a>';
	}
}

function modules_renamemoduleprocess(id) {
	var newtitle = document.getElementById(id+'_newtitle').value+'';
	newtitle = newtitle.replace(/"/g,'');

	document.getElementById(id).setAttribute('d1',newtitle.replace("'","\\\\\\\'"));
	document.getElementById(id+'_title').innerHTML = newtitle;
	modules_updateorder(false,true);
}

function modules_showtext(self,id) {
	var current = $('#'+id).attr('d8');

	if (current == '' || current == 0) {
		newvalue = 1;
		$(self).find("img").css('opacity','0.5');
		$(self).find("img").attr('title','Hide the module title in the chatbar');
	} else {
		newvalue = '';
		$(self).find("img").css('opacity','1');
		$(self).find("img").attr('title','Show the module title in the chatbar');
	}

	document.getElementById(id).setAttribute('d8',newvalue);
	if (newvalue == 1) { text = 'shown'; } else { text = 'hidden'; }
	modules_updateorder(false,false,text);
}

function modules_showpopup(self,id) {
	var current = $('#'+id).attr('d3');

	if (current == '_lightbox') {
		newvalue = '_popup';
		$(self).find("img").css('opacity','1');
		$(self).find("img").attr('title','Open module in a lightbox');
	} else {
		newvalue = '_lightbox';
		$(self).find("img").css('opacity','0.5');
		$(self).find("img").attr('title','Open module as a popup');
	}

	document.getElementById(id).setAttribute('d3',newvalue);
	if (newvalue == '_lightbox') { text = 'lightbox'; } else { text = 'popup'; }
	modules_updateorder(false,false,text,true);
}

function removeElement(id) {
  var element = document.getElementById(id);
  element.parentNode.removeChild(element);
}


/* Plugins */

function plugins_updateorder(del) {
	order = '';
	$('#modules_liveplugins').children('li').each(function(idx, elm) {
		order += "'"+$(elm).attr('d1')+"',"; 
	});  

	$.post('?module=plugins&action=updateorder', {'order': order, token: token}, function(data) {
		if (del) {
			$.fancyalert('Plugin successfully deactivated.');
		} else {
			$.fancyalert('Plugins order successfully updated.');
		}
	});

}

function plugins_removeplugin(id) {
	var answer = confirm ('Are you sure you want to deactivate this plugin?');
	if (answer) {
		removeElement(id);
		plugins_updateorder(true);
	}
}

function plugins_updatechatroomorder(del) {
	order = '';
	$('#modules_liveplugins').children('li').each(function(idx, elm) {
		order += "'"+$(elm).attr('d1')+"',"; 
	});  

	$.post('?module=plugins&action=updatechatroomorder', {'order': order, token: token}, function(data) {
		if (del) {
			$.fancyalert('Plugin successfully deactivated.');
		} else {
			$.fancyalert('Plugins order successfully updated.');
		}
	});

}

function plugins_removechatroomplugin(id) {
	var answer = confirm ('Are you sure you want to deactivate this plugin?');
	if (answer) {
		removeElement(id);
		plugins_updatechatroomorder(true);
	}
}

function plugins_renameplugin(id) {
	$.fancyalert('Please edit the plugin language to modify the name');
}

function extensions_removeextension(id) {
	var answer = confirm ('Are you sure you want to deactivate this extension?');
	if (answer) {
		removeElement(id);
		extensions_updateorder(true);
	}
}

function extensions_updateorder(del) {
	order = '';
	$('#modules_liveextensions').children('li').each(function(idx, elm) {
		order += "'"+$(elm).attr('d1')+"',"; 
	});  

	$.post('?module=extensions&action=updateorder', {'order': order, token: token}, function(data) {
		$.fancyalert('Extension successfully deactivated.');
	});

}

function extensions_configextension(id) {
	window.open('?module=dashboard&action=loadexternal&type=extension&name='+id,'external','width=400,height=300,resizable=1,scrollbars=1');
}

function themes_makedefault(id) {
	$.post('?module=themes&action=makedefault', {'theme': id, token: token}, function(data) {
		location.href = '?module=themes';
	});
}

function themes_edittheme(id) {
	location.href = '?module=themes&action=edittheme&data='+id;
}

function themes_exporttheme(id) {
	location.href = '?module=themes&action=exporttheme&data='+id+'&token='+token;
}

function themes_removetheme(id) {
	var answer = confirm ('This action cannot be undone. Are you sure you want to perform this action?');
	if (answer) {
		location.href = '?module=themes&action=removethemeprocess&data='+id+'&token='+token;
	}
}

function logs_gotouser(id) {
	location.href = '?module=logs&action=viewuser&data='+id+'&token='+token;
}

function logs_gotochatroom(id) {
	location.href = '?module=logs&action=viewuserchatroomconversation&data='+id+'&token='+token;
}

function logs_gotouserb(id,id2) {
	location.href = '?module=logs&action=viewuserconversation&data='+id+'&data2='+id2+'&token='+token;
}

function modules_configmodule(id) {
	window.open('?module=dashboard&action=loadexternal&type=module&name='+id,'external','width=400,height=300,resizable=1,scrollbars=1');
}

function plugins_configplugin(id) {
	window.open('?module=dashboard&action=loadexternal&type=plugin&name='+id,'external','width=400,height=300,resizable=1,scrollbars=1');
}

function themes_updatecolors(theme) {
	var colors = {};
	$('.colors').each(function() {
		colors[$(this).attr('oldcolor')] = $(this).attr('newcolor');
	})

	$.post('?module=themes&action=updatecolorsprocess', {'theme': theme, 'colors': colors, token: token}, function(data) {
		window.location.reload();
	});
	return false;
}

function themes_updatevariables(theme) {
	var colors = {};
	$('.themevariables').each(function() {
		colors[$(this).attr('name')] = $(this).val().replace(/\'/g,'"');
	})

	$.post('?module=themes&action=updatevariablesprocess', {'theme': theme, 'colors': colors, token: token}, function(data) {
		window.location.reload();
	});
	return false;
}

function language_updatelanguage(md5,id,file,lang) {
	var language = {};
	var rtl = '';

	if (file == '') {
		rtl = $('form input[type=radio]:checked').val();
	}

	$('#'+md5+' textarea').each(function(index,value) {
		language[$(value).attr('name')] = $(value).attr('value');	
	})
	$.post('?module=language&action=editlanguageprocess', {'id': id, 'lang': lang, 'file': file, 'language': language, token: token, rtl: rtl}, function(data) {
		$.fancyalert('Language has been successfully modified.');
	});
	return false;
}

function language_makedefault(id) {
	$.post('?module=language&action=makedefault', {'lang': id, token: token}, function(data) {
		location.href = '?module=language';
	});
}


function language_restorelanguage(md5,id,file,lang) {
	var language = {};
	$('#'+md5+' textarea').each(function(index,value) {
		language[index] = $(value).attr('value');	
	})
	$.post('?module=language&action=restorelanguageprocess', {'id': id, 'lang': lang, 'file': file, 'language': language, token: token}, function(data) {
		window.location.reload();
	});
	return false;
}

function language_removelanguage(id) {
	var answer = confirm ('This action cannot be undone. Are you sure you want to perform this action?');
	if (answer) {
		location.href = '?module=language&action=removelanguageprocess&data='+id+'&token='+token;
	}
}

function language_sharelanguage(id) {
	var answer = prompt ('Please enter the full name for your language');
	if (answer) {
		var name = prompt ('Please enter your name (for credit line) (leave blank for anonymous)');
		$.get('?module=language&action=sharelanguage', {'data': id, 'lang': answer, 'name': name, token: token}, function(data) {
			$.fancyalert('Thank you for sharing!');
		});
	}
}

function embed_link(url,width,height) {
	var mod = url.split('/modules/');  
	var module = mod[1].split('/');
	embedlink = window.open('','embedlink','width=400,height=100,resizable=0,scrollbars=0');
	embedlink.document.write("<title>Embed Link</title><style>textarea { border:1px solid #ccc; color: #333; font-family:verdana; font-size:12px; }</style>");
	embedlink.document.write('<textarea style="width:380px;height:80px"><iframe src="'+url+'" width="'+width+'" height="'+height+'" frameborder="1" class="cometchat_embed_'+module[0]+'"></iframe></textarea>');
	embedlink.document.close();
	embedlink.focus();
}

function rgbtohsl(r, g, b){
    r /= 255, g /= 255, b /= 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if(max == min){
        h = s = 0;
    }else{
        var d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch(max){
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h /= 6;
    }

    return [h, s, l];
}

function hsltorgb(h, s, l){
    var r, g, b;

    if(s == 0){
        r = g = b = l;
    }else{
        function hue2rgb(p, q, t){
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        var p = 2 * l - q;
        r = hue2rgb(p, q, h + 1/3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1/3);
    }

    return [r * 255, g * 255, b * 255];
}

function rgbtohex(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
}


function hextorgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}



function shift(change) {
	$('.colors').each(function() {
		var hex = $(this).attr('oldcolor');
		var rgb = hextorgb(hex);
		var hsl = rgbtohsl(rgb.r,rgb.g,rgb.b);
		hsl[0] += parseFloat(change);

		while (hsl[0] > 1) {
			hsl[0] -= 1;
		}


		rgb = hsltorgb(hsl[0],hsl[1],hsl[2]);

		hex = rgbtohex(parseInt(rgb[0]),parseInt(rgb[1]),parseInt(rgb[2]));

		$(this).attr('newcolor',hex);
		$(this).css('background',hex);

	});
}