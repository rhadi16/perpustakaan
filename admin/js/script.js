var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");
var toastLiveExample = document.getElementById('liveToast');

$(document).ready(function(){
  $('a[data-bs-toggle="tab"]').on('show.bs.tab', function (event) {
    localStorage.setItem('activeTab', $(event.target).attr('data-bs-target'));
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[data-bs-target="' + activeTab + '"]').tab('show');
  }
});

$(document).ready(function() {
  $('#example').DataTable();
  $('#example11').DataTable();
  $('#example2').DataTable();
  $('#example3').DataTable();
  $('#example4').DataTable();
  $('#example5').DataTable();
  $('#example-detail').DataTable();
});

let max = 2;
// tambah form isian untuk peminjaman buku
$(document).ready(function(){
  // Add new element
  $("#tambah-kolom").click(function(){
    console.log(max);
    // Finding total number of elements added
    var total_element = $(".element").length;
                
    // last <div> with element class id
    var lastid = $(".element:last").attr("id");
    var split_id = lastid.split("_");
    var nextindex = Number(split_id[1]) + 1;

    // Check total number elements
    if(total_element < max ){
        // Adding new div container after last occurance of element class
        $(".element:last").after(`<div class="element" id="div_`+ nextindex +`"></div>`);
                    
        // Adding element to <div>
        $("#div_" + nextindex).append(`
          <div id="txt_`+ nextindex +`">
            <button type="button" id="hapus-kolom_`+ nextindex +`" class="btn btn-danger remove">x</button>
            <input class="form-control mb-2" list="list_kode_buku`+ nextindex +`" id="kode_buku`+ nextindex +`" name="kode_buku[]" required placeholder="Judul Buku">
            <datalist id="list_kode_buku`+ nextindex +`">
              <?php
                $libook = mysqli_query($mysqli, "SELECT * FROM tb_buku");
                while ($dt_book = mysqli_fetch_array($libook)) {
              ?>
                <option value="<?php echo $dt_book['kode_buku'].' - '.$dt_book['judul'] ?>">
              <?php } ?>
            </datalist>
          </div>
        `);

        $.ajax({
          url: "js/ajax-list-buku.php",
          method: "GET",
          dataType: "html"
        }).done(function(msg) {
          $("#list_kode_buku"+nextindex).html(msg);
        }); 
    }
    max++;            
  });

  // Remove element
  $('#pinjam-buku').on('click','.remove',function(){
              
      var id = this.id;
      var split_id = id.split("_");
      var deleteindex = split_id[1];

      // Remove <div> with id
      $("#div_" + deleteindex).remove();
  });
});

const desc_in = $('.desc-in').data('flashdata');
if (desc_in == "suc-in-agt") {
    Swal.fire(
      'Berhasil Melakukan Input!',
      'Anggota Ditambahkan',
      'success'
    )
} else if (desc_in == "suc-ed-agt") {
    Swal.fire(
      'Berhasil Melakukan Perubahan!',
      'Data Anggota Diubah',
      'success'
    )
} else if (desc_in == "suc-del-agt") {
    Swal.fire(
      'Berhasil Menghapus!',
      'Data Anggota Telah Dihapus',
      'success'
    )
} else if (desc_in == "failed-log") {
    Swal.fire(
      'Gagal Melakukan Login!',
      'Email Atau Password Salah',
      'error'
    )
} else if (desc_in == "suc-in-rak") {
    Swal.fire(
      'Berhasil Menambahkan Rak!',
      'Rak Baru Ditambahkan',
      'success'
    )
} else if (desc_in == "suc-ed-rak") {
    Swal.fire(
      'Berhasil Mengubah Rak!',
      'Data Rak Diubah',
      'success'
    )
} else if (desc_in == "suc-del-rak") {
    Swal.fire(
      'Berhasil Menghapus!',
      'Data Rak Telah Dihapus',
      'success'
    )
} else if (desc_in == "suc-in-book") {
    Swal.fire(
      'Berhasil Menambahkan Buku!',
      'Buku Baru Ditambahkan',
      'success'
    )
} else if (desc_in == "suc-ed-book") {
    Swal.fire(
      'Berhasil Mengubah Buku!',
      'Data Buku Diubah',
      'success'
    )
} else if (desc_in == "suc-del-book") {
    Swal.fire(
      'Berhasil Menghapus!',
      'Data Buku Telah Dihapus',
      'success'
    )
} else if (desc_in == "suc-in-pin") {
    Swal.fire(
      'Berhasil Menambahkan Peminjaman!',
      'Peminjaman Baru Ditambahkan',
      'success'
    )
} else if (desc_in == "suc-ed-pin") {
    Swal.fire(
      'Berhasil Mengubah Peminjaman!',
      'Data Peminjaman Diubah',
      'success'
    )
} else if (desc_in == "suc-del-pin") {
    Swal.fire(
      'Berhasil Menghapus!',
      'Data Peminjaman Telah Dihapus',
      'success'
    )
} else if (desc_in == "suc-del-pinbook") {
    Swal.fire(
      'Berhasil Menghapus!',
      'Data Peminjaman Telah Dihapus',
      'success'
    )
} else if (desc_in == "suc-in-kem") {
    Swal.fire(
      'Berhasil!',
      'Buku Telah Dikembalikan',
      'success'
    )
} else if (desc_in == "suc-del-kem") {
    Swal.fire(
      'Berhasil!',
      'Data Pengembalian Dihapus',
      'success'
    )
} else if (desc_in == "fal-reg-ptg") {
    Swal.fire(
      'Gagal!',
      'Email Telah Digunakan!',
      'error'
    )
} else if (desc_in == "suc-reg-ptg") {
    Swal.fire(
      'Berhasil!',
      'Data Petugas Ditambahkan',
      'success'
    )
} else if (desc_in == "suc-ed-ptg") {
    Swal.fire(
      'Berhasil!',
      'Data Petugas Diubah',
      'success'
    )
} else if (desc_in == "suc-del-ptg") {
    Swal.fire(
      'Berhasil!',
      'Data Petugas Dihapus',
      'success'
    )
}

menu_btn.addEventListener("click", () => {
  sidebar.classList.toggle("active-nav");
  container.classList.toggle("active-cont");
});
// Clear the browser app cache
// document
//   .getElementById('btn-clear-cache')
//   .addEventListener('click', () => {
//     PWA.Navigator.clearCache();
//     var toast = new bootstrap.Toast(toastLiveExample);

//     toast.show();
//   })
// ;
