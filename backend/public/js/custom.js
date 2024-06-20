// // Custom JS

// $(document).ready(function () {
//     $(".tbData").DataTable({
//         paging: true,
//         lengthChange: true,
//         searching: true,
//         ordering: true,
//         info: true,
//         autoWidth: false,
//         responsive: true,
//     });

//     // Klik Gambar Menu
//     $("#foto_menu").click(function () {
//         $("#file_foto").click();
//     });

//     // Ketika file input change
//     $("#file_foto").change(function () {
//         setImage(this, "#foto_menu");
//     });

//     // Klik Foto User
//     $("#foto").click(function () {
//         $("#file_foto").click();
//     });

//     // Ketika file input change
//     $("#file_foto").change(function () {
//         setImage(this, "#foto");
//     });

//     // Cari Menu
//     if ($("#search").length > 0) {
//         $("#search").keyup(function () {
//             var rex = new RegExp($(this).val(), "i");
//             $(".menu-item").hide();
//             $(".menu-item")
//                 .filter(function () {
//                     return rex.test($(this).text());
//                 })
//                 .fadeIn();
//         });
//     }
// });

// // Read Image
// function setImage(input, target) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();

//         // Mengganti src dari object img#avatar
//         reader.onload = function (e) {
//             $(target).attr("src", e.target.result);
//         };

//         reader.readAsDataURL(input.files[0]);
//     }
// }

// // Heandle From Table
// function setFormTable(mode, data = null) {
//     $("#frm_Table")[0].reset();
//     if (mode == "Edit") {
//         rsTable = JSON.parse(data);

//         $("#id_table").val(rsTable.id);
//         $("#no_table").val(rsTable.no_table);
//         $("#capacity_table").val(rsTable.capacity_table);
//         $("#status_table").val(rsTable.status_table);
//     }
//     $("#mode").html(mode);
//     $("#modal-meja").modal("show");

//     console.log(rsTable.id);
// }

// // Transaksi
// let kd_cus = 0;
// let nm_cus = "General";
// let id_meja = 0;
// let jns_layanan = "Dine In"; // Take Away
// let items = [];
// let diskon = 0;
// let total = 0;
// let gtotal = 0;
// let tarif_layanan = 0;
// let tax = 0;

// function addMenu(menu) {
//     // Menu Yang Di Pilih
//     let rsMenu = JSON.parse(menu);

//     // Cek Menu Didalam Variabel Items
//     cekMenu = items.filter((menu) => menu.id_menu == rsMenu.id);

//     if (cekMenu.length == 0) {
//         // Jika Belum ada maka data di tambahkan ke variabel items
//         dtMenu = {
//             id_menu: rsMenu.id,
//             kd_menu: rsMenu.kd_menu,
//             nm_menu: rsMenu.nm_menu,
//             harga_menu: rsMenu.harga_menu,
//             jumlah_menu: 1,
//         };
//         items.push(dtMenu); // Menambahkan data Ke variabel menu
//     } else {
//         // Jika sudah maka Update Jumlah
//         idxItem = items.findIndex((menu) => menu.id_menu == rsMenu.id);
//         items[idxItem].jumlah_menu += 1;
//     }

//     listMenu();

//     console.log(items);
// }

// function updateJumlah(e) {
//     idxMenu = $(e).parent().parent().attr("idx");
//     // Tombol Minus
//     if ($(e).hasClass("input-group-prepend")) {
//         if (items[idxMenu].jumlah_menu > 1) {
//             items[idxMenu].jumlah_menu -= 1;
//         }
//     }

//     // Tombol Plus
//     if ($(e).hasClass("input-group-append")) {
//         items[idxMenu].jumlah_menu += 1;
//     }

//     // Ketika Input di Update nilai Jumlahnya
//     if ($(e).hasClass("jumlah")) {
//         n = parseInt($(e).val());
//         items[idxMenu].jumlah_menu = n <= 0 ? 1 : n;
//     }

//     listMenu();
// }

// function listMenu() {
//     $(".order-list").html(""); // Menghapus HTML pada div dengan .oreder list
//     items.map((rsMenu, index) => {
//         content = $("#template").clone();
//         content.removeClass("d-none");
//         content.attr("idx", index);
//         content.attr("id", rsMenu.id_menu);
//         content.find(".nm_menu").html(rsMenu.nm_menu);
//         content.find(".qty_menu").find("input").val(rsMenu.jumlah_menu);
//         content
//             .find(".price_menu")
//             .html(
//                 (rsMenu.harga_menu * rsMenu.jumlah_menu).toLocaleString("id-ID")
//             );

//         $(".order-list").append(content);
//     });

//     updateTotal();
// }

// function delMenu(e) {
//     idxMenu = $(e).parent().attr("idx");

//     items.splice(idxMenu, 1);

//     listMenu();
// }

// function updateTotal() {
//     total = 0;
//     // Menghitung total pesanan
//     items.map((rsMenu) => {
//         total += rsMenu.harga_menu * rsMenu.jumlah_menu;
//     });

//     total_diskon = total - Math.round(diskon * total);
//     tarif_layanan = total_diskon * (5 / 100);
//     tax = (total_diskon + tarif_layanan) * (10 / 100);
//     gtotal = total_diskon + tax;

//     $("#total").html("Rp " + total.toLocaleString("id-ID"));
//     $("#diskon").html(
//         "Rp " + Math.round(diskon * total).toLocaleString("id-ID")
//     );
//     $("#tax").html("Rp " + Math.round(tax).toLocaleString("id-ID"));
//     $("#gtotal").html("Rp " + Math.round(gtotal).toLocaleString("id-ID"));
// }

// function setCustomer(customer) {
//     rsCustomer = JSON.parse(customer);

//     // Set Nama Customer
//     $("#nm_customer").html(rsCustomer.nm_cus);

//     kd_cus = rsCustomer.kd_cus;
//     nm_cus = rsCustomer.nm_cus;

//     if (kd_cus == 0) {
//         diskon = 0;
//     } else {
//         diskon = 0.05;
//     }
//     if (items.length > 0) {
//         updateTotal();
//     }

//     // Set Nama Customer
//     if (kd_cus == 0) {
//         $("#tnm_customer").val("");
//         $("#tnm_customer").fadeIn("");
//     } else {
//         $("#tnm_customer").fadeOut("");
//     }

//     // Close Modal
//     $("#modal-customer").modal("hide");
// }

// // User
// function setCashier(user) {
//     rsUser = JSON.parse(user);

//     // Set Nama Customer
//     $("#nm_user").html(rsUser.name);

//     name_user = rsUser.name;

//     // if (kd_cus == 0) {
//     //     diskon = 0;
//     // } else {
//     //     diskon = 0.05;
//     // }
//     // if (items.length > 0) {
//     //     updateTotal();
//     // }

//     // Set Nama Customer
//     if (kd_cus == 0) {
//         $("#tnm_customer").val("");
//         $("#tnm_customer").fadeIn("");
//     } else {
//         $("#tnm_customer").fadeOut("");
//     }
//     // Close Modal
//     $("#modal-user").modal("hide");
// }

// function setCategory(id) {
//     if (id == "all") {
//         $(".menu-item").fadeIn();
//     } else {
//         $(".menu-item").hide();
//         $(id).fadeIn();
//     }
// }

// function setNamaCustomer(e) {
//     nm_cus = $(e).val();
//     console.log(nm_cus);
// }

// // Teko Fadil
// // Set who will buy and adjusted the diskon
// // function setPerson(value) {
// //     const inputCus = $("#tnm_customer");
// //     const guestBtn = $("#guest");
// //     const memberBtn = $("#member");

// //     if (value == "guest") {
// //         $(inputCus).addClass("d-block");
// //         $(inputCus).removeClass("d-none");
// //         $(guestBtn).addClass("d-none");

// //         $(inputCus).css("border", "1px solid #37ff51");
// //         $(memberBtn).children().css("border", "1px solid #ced4da");

// //         kd_cus = 0;
// //         nm_cus = inputCus.val();
// //         diskon = 0;
// //         $("#member-text").html("Member");
// //     } else if (value == "reset") {
// //         $(inputCus).addClass("d-none");
// //         $(inputCus).removeClass("d-block");
// //         $(guestBtn).removeClass("d-none");

// //         $(inputCus).css("border", "1px solid #ced4da");
// //         $(memberBtn).children().css("border", "1px solid #ced4da");
// //     } else {
// //         $(inputCus).addClass("d-none");
// //         $(inputCus).removeClass("d-block");
// //         $(guestBtn).removeClass("d-none");

// //         $(inputCus).css("border", "1px solid #ced4da");
// //         $(memberBtn).children().css("border", "1px solid #37ff51");
// //     }

// //     updateTotal();
// // }

// // Teko Fadil
// // Modal Customer
// // function setCus(customer) {
// //     let rsCustomer = JSON.parse(customer);

// //     // Set Nama Customer
// //     $("#member-text").html(rsCustomer.nm_cus);

// //     kd_cus = rsCustomer.kd_cus;
// //     nm_cus = rsCustomer.nm_cus;

// //     // check to Fill the diskon
// //     kd_cus != 0 ? (diskon = 0.05) : (diskon = 0);

// //     if (items.length > 0) {
// //         updateTotal();
// //     }

// //     // Close Modal
// //     $("#modal-customer").modal("hide");
// // }

// // Teko Fadil
// // Modal Table
// // let sw = document.getElementById("switch");

// // // Dine In insert data
// // function setService(layanan) {
// //     let rsMeja = JSON.parse(layanan);

// //     jns_layanan = "Dine In";
// //     id_meja = rsMeja.id;
// //     $("#modal-meja").modal("hide");
// //     $("#table").html(`Meja#${rsMeja.no_table}`);
// // }

// // Teko Fadil
// // change the type of service
// // sw.addEventListener("change", () => {
// //     if (sw.checked) {
// //         // if dine in
// //         $("#modal-meja").on("hidden.bs.modal", () => {
// //             if (id_meja == 0) {
// //                 sw.checked = false;
// //             } else {
// //                 sw.checked = true;
// //             }
// //         });

// //         $("#modal-meja").modal("show");
// //     } else {
// //         // If take away
// //         jns_layanan = "Take Away";
// //         id_meja = 0;
// //         $("#table").html("");
// //     }
// // });

// // function setNamaCustomer(e) {
// //     nm_cus = $(e).val();
// //     console.log(nm_cus);
// // }

// function setLayanan(layanan) {
//     if (layanan == "Take Away") {
//         $("#layanan").html(layanan);
//         jns_layanan = "Take Away";
//     } else {
//         rsMeja = JSON.parse(layanan);
//         $("#layanan").html("Meja " + rsMeja.no_table);
//         jns_layanan = "Dine In";
//         id_meja = rsMeja.id;
//     }

//     // Close Modal
//     $("#modal-meja").modal("hide");
// }

// function saveTrans() {
//     // Validasi
//     if (items.length == 0) {
//         swal("Maaf Menu Masih kosong !", "You clicked the button!", "error");
//         return false;
//     }

//     if (jns_layanan == "Dine In" && id_meja == 0) {
//         swal("Maaf Meja belum di pilih !", "You clicked the button!", "error");
//         return false;
//     }

//     // Data simpan
//     data_store = {
//         kd_cus: kd_cus,
//         nm_cus: nm_cus,
//         id_meja: id_meja,
//         layanan: jns_layanan,
//         gtotal: gtotal,
//         diskon: diskon,
//         blayanan: tarif_layanan,
//         tax: tax,
//         _token: $("#detail").attr("csrf"),
//         detail: items,
//     };

//     $.ajax({
//         beforeSend: function () {
//             $("#loader").css("display", "flex").fadeIn();
//         },
//         type: "POST",
//         dataType: "json",
//         url: $("#detail").attr("url"),
//         data: data_store,
//         success: function (data) {
//             console.log(data);
//             if (data.status == 200) {
//                 resetTrans();
//                 $("#loader").fadeOut(function () {
//                     toastr.success(data.text);
//                 });
//             }
//         },
//         error: function (data) {
//             console.log(data);
//         },
//     });
// }

// // Teko Fadil
// // function resetTrans() {
// //     let sw = document.getElementById("switch");

// //     kd_cus = 0;
// //     nm_cus = "";
// //     id_meja = 0;
// //     jns_layanan = "Take Away";
// //     items = [];
// //     diskon = 0;
// //     gtotal = 0;
// //     tarif_layanan = 0;
// //     tax = 0;

// //     sw.checked = false;
// //     $("#tnm_customer").val("");
// //     $("#member-text").html("Member");
// //     $("#table").html("");
// //     // $("#nm_customer").html(nm_cus);
// //     // $("#layanan").html(jns_layanan);
// //     $(".order-list").html("");
// //     setPerson("reset");
// //     $("#total").html(0);
// //     $("#diskon").html(0);
// //     $("#tax").html(0);
// //     $("#gtotal").html(0);
// // }

// function resetTrans() {
//     var kd_cus = 0;
//     var nm_cus = "General Customer";
//     var id_meja = 0;
//     var jns_layanan = "Dine In";
//     var items = [];
//     var diskon = 0;
//     var total = 0;
//     var gtotal = 0;
//     var tarif_layanan = 0;
//     var tax = 0;

//     $("#tnm_customer").val("");
//     $("#nm_customer").html(nm_cus);
//     $("#layanan").html(jns_layanan);
//     $(".order-list").html("");
//     $("#total").html(0);
//     $("#diskon").html(0);
//     $("#tax").html(0);
//     $("#gtotal").html(0);
// }

$("#foto_icon").click(function () {
    $("#file_icon").click();
});
$("#file_icon").change(function () {
    setImage(this, "#foto_icon");
});
// $("#icon").click(function () {
//     $("#file_icon").click();
// })
// $("#file_icon").change(function () {
//     setImage(this, "#icon");
// })
function setImage(input, target) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(target).attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
