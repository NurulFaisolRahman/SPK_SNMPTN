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
    if (checkform(this)) {
      var dt = new Date();
      var datalogin = { Username: $("#Username").val(),
                        Password: $("#Password").val(),
                        TanggalLahir: $("#TanggalLahir").val(),
                        JenisKelamin: $("#JenisKelamin").val(),
                        IdProdi: $("#IdProdi").val(),
                        Tahun: dt.getFullYear()
                      };
      $.ajax({
        type  : 'POST',
        url   : 'http://localhost/SPK_SNMPTN/Daftar/CekDaftar',
        data  : datalogin,
        success : function(pesan){
          if(pesan=='ok'){
            window.location = 'http://localhost/SPK_SNMPTN/Siswa';
          }
        }
      });
      return false;
    }
  });

  GantiCaptcha();

  function GantiCaptcha(){
    var Captcha = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < 6; i++ ) {
       Captcha += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    document.getElementById("txtCaptcha").value = Captcha;
    document.getElementById("CaptchaDiv").innerHTML = Captcha;
  }

  function checkform(theform){
    var why = "";
    if($("#CaptchaInput").val() == ""){
      why += "- Mohon Input Captcha.\n";
    }
    if($("#CaptchaInput").val() != ""){
      if(ValidCaptcha($("#CaptchaInput").val()) == false){
        why += "- Input Captcha Tidak Sesuai.\n";
      }
    }
    if(why != ""){
      alert(why);
      GantiCaptcha();
      return false;
    }
    else {
      return true;
    }
  }

  // Validate input against the generated number
  function ValidCaptcha(){
    var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
    var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
    if (str1 == str2){
      return true;
    }else{
      return false;
    }
  }

  // Remove the spaces from the entered and generated code
  function removeSpaces(string){
    return string.split(' ').join('');
  }

});
