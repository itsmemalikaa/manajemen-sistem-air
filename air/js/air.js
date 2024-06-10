$(document).ready(function () {
    uri = window.location.href;
    // console.log("uri: "+uri);
    e = uri.split("=");
    // console.log("URI: "+uri+" hasil: "+e[1]);
    if (e[1] == "user" || e[1] == "user_edit&nik") {
      if (e[1] == "user") {
        $(
          "#chart,#summary,#user_add,#tarif_add,#tarif_list,#catat_meter_add,#catat_meter_list"
        ).hide();
      } else {
        //tombol Edit/Ubah diklik
        $(
          "#summary,#chart,#user_list,#tarif_add,#tarif_list,#catat_meter_add,#catat_meter_list"
        ).hide();
        $("#user_add").show();
        $(
          "#user_form input[name='nik'],#user_form input[name='Username'],#user_form input[name='pswd']"
        ).attr("disabled", true); //elemen input dengan atribut namenya nik dan username dibuat tdk bisa diinput saat edit data
        $("#user_form button").val("user_edit"); //mereset value elemen button menjadi user_edit agar tombol bisa untuk edit data
        $("#user_form").append("<input type=hidden name=nik value=" + e[2] + ">"); //menambahkan elemen input dengan tipe hidden
      }
  
      if ($("#alert-user").hasClass("alert-danger")) {
        //jika saat entri data ada error
        $("#user_list").hide();
        $("#user_add").show();
      } else if ($("#alert-user").hasClass("alert-success")) {
        $("#user_list").show();
        $("#user_add").hide();
      }
      $(".datatable-dropdown").append(
        '<button type= button class="btn float-start me-2 btn-outline-success"><i class="fa-solid fa-user-plus fa-beat"></i> Data </button>'
      );
      $(".datatable-dropdown button").click(function () {
        $("#user_list").hide();
        $("#user_add").show();
        $("#user_form input,#user_form textarea,#user_form select").val(""); //mereset isi elemen input, textarea & select
        $("#user_form button").val("user_add"); //mereset value elemen button menjadi user_add agar tombol bisa untuk nambah data
        $(
          "#user_form input[name='nik'],#user_form input[name='username'],#user_form input[name='pswd']"
        ).attr("disabled", false); //elemen input dengan atribut namenya nik dan username dibuat tdk bisa diinput saat edit data
      });
  
      $("button[data-bs-toggle='modal']").click(function () {
        nik = $(this).attr("data-nik");
        $("#myModal .modal-body").text("Yakin hapus data nik " + nik + "?");
        $(".modal-footer form").append(
          "<input type=hidden name=nik value=" + nik + ">"
        );
      });
    } else if (e[1] == "tarif" || e[1] == "tarif_edit&id_tarif") {
      $(
        "#chart,#summary,#user_add,#user_list,#catat_meter_add,#catat_meter_list"
      ).hide();
      if (e[1] == "tarif") {
        $("#tarif_add").hide();
        $("#tarif_list").show();
      } else {
        //tombol Edit/Ubah diklik
        $("#tarif_add").show();
        $("#tarif_list").hide();
        $("#tarif_form input[name='id_tarif']").attr("disabled", true); //elemen input dengan atribut namenya id tairif dibuat tdk bisa diinput saat edit data
        $("#tarif_form button").val("tarif_edit"); //mereset value elemen button menjadi tarif_edit agar tombol bisa untuk edit data
        $("#tarif_form").append(
          "<input type=hidden name=id_tarif value=" + e[2] + ">"
        ); //menambahkan elemen input dengan tipe hidden
      }
  
      if ($("#alert-tarif").hasClass("alert-danger")) {
        //jika saat entri data ada error
        $("#tarif_list").hide();
        $("#tarif_add").show();
      } else if ($("#alert-tarif").hasClass("alert-success")) {
        $("#tarif_list").show();
        $("#tarif_add").hide();
      }
  
      const datatablesSimple = document.getElementById("tarif_table");
      if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
      }
      $(".datatable-dropdown").append(
        '<button type= button class="btn float-start me-2 btn-outline-success"><i class="fa-solid fa-sack-dollar fa-beat"></i> Tambah Tarif </button>'
      );
      $(".datatable-dropdown button").click(function () {
        //saat tombol tambah tarif di klik
        $("#tarif_list").hide();
        $("#tarif_add").show();
        // $("#tarif_form input").val(""); //mereset isi elemen input, textarea & select
        $("#tarif_form button").val("tarif_add"); //mereset value elemen button menjadi user_add agar tombol bisa untuk nambah data
        $("#tarif_form input[name='id_tarif']").attr("disabled", false); //elemen input dengan atribut namenya nik dan username dibuat tdk bisa diinput saat edit data
      });
  
      $("button[data-bs-toggle='modal']").click(function () {
        id_tarif = $(this).attr("data-id_tarif");
        $("#myModal .modal-body").text(
          "Yakin hapus data ID Tarif " + id_tarif + "?"
        );
        $(".modal-footer form").append(
          "<input type=hidden name=id_tarif value=" + id_tarif + ">"
        );
        $(".modal-footer button").val("tarif_hapus");
      });
    } else if (e[1] == "catat_meter" || e[1] == "catat_meter_edit&id_meter") {
      $("#chart,#summary,#user_add,#user_list,#tarif_add,#tarif_list").hide();
      if (e[1] == "catat_meter") {
        $("#catat_meter_add").hide();
        $("#catat_meter_list").show();
      } else {
        //tombol Edit/Ubah diklik
        $("#catat_meter_add").show();
        $("#catat_meter_list").hide();
        // $("#catat_meter_form input[name='id_meter']").attr("disabled", true); //elemen input dengan atribut namenya id tairif dibuat tdk bisa diinput saat edit data
        $("#catat_meter_form button").val("catat_meter_edit"); //mereset value elemen button menjadi tarif_edit agar tombol bisa untuk edit data
        $("#catat_meter_form").append(
          "<input type=hidden name=id_meter value=" + e[2] + ">"
        ); //menambahkan elemen input dengan tipe hidden
      }
  
      if ($("#alert-catat_meter").hasClass("alert-danger")) {
        //jika saat entri data ada error
        $("#catat_meter_list").hide();
        $("#catat_meter_add").show();
      } else if ($("#alert-catat_meter").hasClass("alert-success")) {
        $("#catat_meter_list").show();
        $("#catat_meter_add").hide();
      }
  
      const datatablesSimple = document.getElementById("catat_meter_table");
      if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
      }
      $(".datatable-dropdown").append(
        '<button type= button class="btn float-start me-2 btn-outline-success"><i class="fa-solid fa-truck-droplet fa-beat"></i> Tambah Meter </button>'
      );
      $(".datatable-dropdown button").click(function () {
        //saat tombol tambah tarif di klik
        $("#catat_meter_list").hide();
        $("#catat_meter_add").show();
        // $("#tarif_form input").val(""); //mereset isi elemen input, textarea & select
        $("#catat_meter_form button").val("catat_meter_add"); //mereset value elemen button menjadi user_add agar tombol bisa untuk nambah data
        // $("#catat_meter_form input[name='id_meter']").attr("disabled", false); //elemen input dengan atribut namenya nik dan username dibuat tdk bisa diinput saat edit data
      });
  
      $("button[data-bs-toggle='modal']").click(function () {
        id_meter = $(this).attr("data-id_meter");
        $("#myModal .modal-body").text("Yakin hapus data Meter " + id_meter + "?");
        $(".modal-footer form").append(
          "<input type=hidden name=id_meter value=" + id_meter + ">"
        );
        $(".modal-footer button").val("catat_meter_hapus");
      });
    } else {
      $(
        "#user_add,#user_list,#tarif_add,#tarif_list,#catat_meter_add,#catat_meter_list"
      ).hide();
  
      $.ajax({
        type: "post",
        url: "../assets/ajax.php",
        data: { p: "summary" },
        dataType: "json",
        success: function (d) {
          // console.log("kalo sukses");
          vol_pemakaian = d[0].total_vol;
          jml_pelanggan = d[1].plg_jml;
          jml_pelanggan_catat = d[2].plg_catat;
          jml_pelanggan_blmcatat = jml_pelanggan - jml_pelanggan_catat;
          $("#summary .bg-primary h1").text(vol_pemakaian);
          $("#summary .bg-warning h1").text(jml_pelanggan);
          $("#summary .bg-success h1").text(jml_pelanggan_catat);
          $("#summary .bg-danger h1").text(jml_pelanggan_blmcatat);
        },
      });
    }
  });
  