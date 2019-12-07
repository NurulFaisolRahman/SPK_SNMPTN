jQuery(document).ready(function($) {
  "use strict";
  $("#TombolLogin").click(function() {
    var datalogin = { Username: $("#Username").val(),
                      Password: $("#Password").val()
                    };
  	$.ajax({
      type	: 'POST',
  		url		: 'http://localhost/SPK_SNMPTN/Login/CekLogin',
  		data	: datalogin,
  		success	: function(pesan){
  			if(pesan=='Admin'){
  				window.location = 'http://localhost/SPK_SNMPTN/Admin/Siswa';
  			}
        else if (pesan=='Siswa') {
          window.location = 'http://localhost/SPK_SNMPTN/Siswa';
        }
  			else{
  				alert(pesan);
  				$('#LoginForm').find("input").val("");
  			}
  		}
  	});
    return false;
  });

  $("#TombolDaftar").click(function() {
    var dt = new Date();
    var datalogin = { Username: $("#Username").val(),
                      Password: $("#Password").val(),
                      IdProdi: $("#IdProdi").val(),
                      Tahun: dt.getFullYear()
                    };
  	$.ajax({
      type	: 'POST',
  		url		: 'http://localhost/SPK_SNMPTN/Daftar/CekDaftar',
  		data	: datalogin,
  		success	: function(pesan){
  			if(pesan=='ok'){
  				window.location = 'http://localhost/SPK_SNMPTN/Siswa';
  			}
  			// else{
  			// 	alert(pesan);
  			// 	$('#LoginForm').find("input").val("");
  			// }
  		}
  	});
    return false;
  });
});
