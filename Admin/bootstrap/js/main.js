jQuery(document).ready(function($) {
  "use strict";

  $("#UpdateProdi").click(function() {
    var DataEditProdi = { EditNamaProdi: $("#EditNamaProdi").val(),
                          EditIdProdi: $("#EditIdProdi").val()
                        };
  	$.ajax({
      type	: 'POST',
  		url		: 'http://localhost/SPK_SNMPTN/Admin/UpdateProdi',
  		data	: DataEditProdi,
  		success	: function(pesan){
  			if(pesan=='ok'){
  				window.location = 'http://localhost/SPK_SNMPTN/Admin/Prodi';
  			}
  		}
  	});
    return false;
  });

  $("#TambahProdi").click(function() {
    var DataProdiBaru= { NamaProdiBaru: $("#NamaProdiBaru").val()};
  	$.ajax({
      type	: 'POST',
  		url		: 'http://localhost/SPK_SNMPTN/Admin/TambahProdi',
  		data	: DataProdiBaru,
      success	: function(pesan){
  			if(pesan=='ok'){
  				window.location = 'http://localhost/SPK_SNMPTN/Admin/Prodi';
  			}
  		}
    });
    return false;
  });

  $(document).on("click",".HapusProdi",function(){
    var HapusProdi = { HapusIdProdi: $(this).attr('HapusIdProdi')};
    var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
    if (Konfirmasi == true) {
      $.ajax({
        type	: 'POST',
    		url		: 'http://localhost/SPK_SNMPTN/Admin/HapusProdi',
    		data	: HapusProdi,
        success	: function(pesan){
    			if(pesan=='ok'){
    				window.location = 'http://localhost/SPK_SNMPTN/Admin/Prodi';
    			}
    		}
      });
    }
    return false;
  });

  $("#TambahKriteria").click(function() {
    var DataKriteriaBaru= { NamaKriteriaBaru: $("#NamaKriteriaBaru").val()};
    $.ajax({
      type	: 'POST',
      url		: 'http://localhost/SPK_SNMPTN/Admin/TambahKriteria',
      data	: DataKriteriaBaru,
      success	: function(pesan){
        if(pesan=='ok'){
          window.location = 'http://localhost/SPK_SNMPTN/Admin/Kriteria';
        }
      }
    });
    return false;
  });

  $("#UpdateKriteria").click(function() {
    var DataEditKriteria = { EditNamaKriteria: $("#EditNamaKriteria").val(),
                          EditIdKriteria: $("#EditIdKriteria").val(),
                          NamaKriteriaLama: $("#NamaKriteriaLama").val()};
    $.ajax({
      type	: 'POST',
      url		: 'http://localhost/SPK_SNMPTN/Admin/UpdateKriteria',
      data	: DataEditKriteria,
      success	: function(pesan){
        if(pesan=='ok'){
          window.location = 'http://localhost/SPK_SNMPTN/Admin/Kriteria';
        }
      }
    });
    return false;
  });

  $(document).on("click",".HapusKriteria",function(){
    var Data = $(this).attr('HapusIdKriteria');
    var Pisah = Data.split("|");
    var HapusKriteria = { HapusIdKriteria: Pisah[0],HapusNamaKriteria: Pisah[1]};
    var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
    if (Konfirmasi == true) {
      $.ajax({
        type	: 'POST',
        url		: 'http://localhost/SPK_SNMPTN/Admin/HapusKriteria',
        data	: HapusKriteria,
        success	: function(pesan){
          if(pesan=='ok'){
            window.location = 'http://localhost/SPK_SNMPTN/Admin/Kriteria';
          }
        }
      });
    }
    return false;
  });

  $(document).on("click",".TambahIdKriteriaSub",function(){
    var IdProdi = $(this).attr('IdKriteriaSub');
    document.getElementById('SimpanIdKriteriaSub').value = IdProdi;
  });

  $("#TambahSubKriteria").click(function() {
    var Data = $('#SimpanIdKriteriaSub').val();
    var Pisah = Data.split("|");
    var DataSubKriteriaBaru = {
      NamaSubKriteriaBaru: $("#NamaSubKriteriaBaru").val(),
      IdKriteriaSub: Pisah[0],
      NamaKriteriaSub: Pisah[1]
    };
    $.ajax({
      type	: 'POST',
      url		: 'http://localhost/SPK_SNMPTN/Admin/TambahSubKriteria',
      data	: DataSubKriteriaBaru,
      success	: function(pesan){
        if(pesan=='ok'){
          alert("Sukses");
          window.location = 'http://localhost/SPK_SNMPTN/Admin/Kriteria';
        }
      }
    });
    return false;
  });

  $("#UpdateSubKriteria").click(function() {
    var DataEditSubKriteria = {
      EditNamaSubKriteria: $("#EditNamaSubKriteria").val(),
      EditIdSubKriteria: $("#EditIdSubKriteria").val(),
      NamaSubKriteriaLama: $("#NamaSubKriteriaLama").val()
    };
    $.ajax({
      type	: 'POST',
      url		: 'http://localhost/SPK_SNMPTN/Admin/UpdateSubKriteria',
      data	: DataEditSubKriteria,
      success	: function(pesan){
        if(pesan=='ok'){
          window.location = 'http://localhost/SPK_SNMPTN/Admin/SubKriteria';
        }
      }
    });
    return false;
  });

  $(document).on("click",".HapusSubKriteria",function(){
    var Data = $(this).attr('HapusIdSubKriteria');
    var Pisah = Data.split("|");
    var HapusSubKriteria = { HapusIdSubKriteria: Pisah[0],
                             NamaSubKriteria: Pisah[1],
                             IdKriteria: Pisah[2],
                             NamaKriteria: Pisah[3]};
    var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
    if (Konfirmasi == true) {
      $.ajax({
        type	: 'POST',
        url		: 'http://localhost/SPK_SNMPTN/Admin/HapusSubKriteria',
        data	: HapusSubKriteria,
        success	: function(pesan){
          if(pesan=='ok'){
            window.location = 'http://localhost/SPK_SNMPTN/Admin/SubKriteria';
          }
        }
      });
    }
    return false;
  });

  $(document).on("click",".HapusSiswa",function(){
    var HapusSiswa = { HapusSiswa: $(this).attr('HapusSiswa')};
    var Konfirmasi = confirm("Yakin Ingin Menghapus Data?");
    if (Konfirmasi == true) {
      $.ajax({
        type	: 'POST',
        url		: 'http://localhost/SPK_SNMPTN/Admin/HapusSiswa',
        data	: HapusSiswa,
        success	: function(pesan){
          if(pesan=='ok'){
            window.location = 'http://localhost/SPK_SNMPTN/Admin/Siswa';
          }
        }
      });
    }
    return false;
  });

  $(document).on("click",".BobotKriteria",function(){
    var NamaProdi = $(this).attr('BobotKriteria');
    document.getElementById('NamaProdiKriteria').value = NamaProdi;
  });

});
