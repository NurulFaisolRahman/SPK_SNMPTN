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
                          EditIdKriteria: $("#EditIdKriteria").val()
                        };
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
    var HapusKriteria = { HapusIdKriteria: $(this).attr('HapusIdKriteria')};
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
    return false;
  });

  $("#TambahSubKriteria").click(function() {
    var DataSubKriteriaBaru = {
      NamaSubKriteriaBaru: $("#NamaSubKriteriaBaru").val(),
      IdKriteriaBaru: $('#PilihanKriteria').find(":selected").val()
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
      IdKriteriaBaru: $('#PilihanEditKriteria').find(":selected").val()
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
    var HapusSubKriteria = { HapusIdSubKriteria: $(this).attr('HapusIdSubKriteria')};
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
    return false;
  });

  $("#TambahDataSiswa").click(function() {
    var DataSiswaBaru = {
      NomorPendaftaranBaru: $("#NomorPendaftaranBaru").val(),
      NPSNSekolahBaru: $("#NPSNSekolahBaru").val(),
      PilihanMinat: $('#PilihanMinat').find(":selected").val()
    };
    $.ajax({
      type	: 'POST',
      url		: 'http://localhost/SPK_SNMPTN/Admin/TambahSiswa',
      data	: DataSiswaBaru,
      success	: function(pesan){
        if(pesan=='ok'){
          window.location = 'http://localhost/SPK_SNMPTN/Admin/Siswa';
        }
      }
    });
    return false;
  });

  $("#UpdateSiswa").click(function() {
    var DataEditSiswa = {
      NomorPendaftaranLama: $("#NomorPendaftaranLama").val(),
      EditNomorPendaftaran: $("#EditNomorPendaftaran").val(),
      EditNPSNSekolah: $("#EditNPSNSekolah").val(),
      PilihanEditMinat: $('#PilihanEditMinat').find(":selected").val()
    };
    $.ajax({
      type	: 'POST',
      url		: 'http://localhost/SPK_SNMPTN/Admin/UpdateSiswa',
      data	: DataEditSiswa,
      success	: function(pesan){
        if(pesan=='ok'){
          window.location = 'http://localhost/SPK_SNMPTN/Admin/Siswa';
        }
      }
    });
    return false;
  });

  $(document).on("click",".HapusSiswa",function(){
    var HapusSiswa = { HapusSiswa: $(this).attr('HapusSiswa')};
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
    return false;
  });

  $(document).on("click",".BobotKriteria",function(){
    var NamaProdi = $(this).attr('BobotKriteria');
    document.getElementById('NamaProdiKriteria').value = NamaProdi;
  });

  $("#SimpanBobotKriteria").click(function() {
    alert($('#NamaProdiKriteria').val());
  });

});
