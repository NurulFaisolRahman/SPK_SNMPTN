jQuery(document).ready(function($) {
  "use strict";
  $("#TombolLogin").click(function() {
    var datalogin = { Username: $("#Username").val(),
                      Password: $("#Password").val()
                    };
  	$.ajax({
      type	: 'POST',
  		url		: 'http://localhost/SPK_SNMPTN/Admin/CekLogin',
  		data	: datalogin,
  		success	: function(pesan){
  			if(pesan=='ok'){
  				window.location = 'http://localhost/SPK_SNMPTN/Admin/Prodi';
  			}
  			else{
  				alert(pesan);
  				$('#LoginForm').find("input").val("");
  			}
  		}
  	});
    return false;
  });
});
