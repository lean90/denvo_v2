<?php
	
		include dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php";

		if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
			include dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php";
		} 

		foreach ($clearconversation_language as $i => $l) {
			$clearconversation_language[$i] = str_replace("'", "\'", $l);
		}
?>

(function($){   
  
	$.ccclearconversation = (function () {

		var title = '<?php echo $clearconversation_language[0];?>';

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id) {
				if ($("#currentroom_convotext").html() != '') {
					$("#currentroom_convotext").html('');
				}
			}

        };
    })();
 
})(jqcc);