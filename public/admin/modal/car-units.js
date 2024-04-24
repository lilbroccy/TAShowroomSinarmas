$(document).ready(function() {
    loadBrandOptions();
    loadCategoryOptions();
    // Fungsi untuk mengambil data brand dan mengisi dropdown
    function loadBrandOptions() {
        $.ajax({
            url: '/api/brands', // Ganti dengan URL endpoint untuk mengambil data brand
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Mengosongkan opsi brand sebelum menambahkan opsi yang baru
                $('#brand_id').empty();
                // Menambahkan opsi brand ke dropdown
                $.each(response, function(index, brand) {
                    $('#brand_id').append('<option value="' + brand.id + '">' + brand.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ' + error);
            }
        });
    }
    // Fungsi untuk mengambil data kategori dan mengisi dropdown
    function loadCategoryOptions() {
        $.ajax({
            url: '/api/categories', // Ganti dengan URL endpoint untuk mengambil data kategori
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Mengosongkan opsi kategori sebelum menambahkan opsi yang baru
                $('#category_id').empty();
                // Menambahkan opsi kategori ke dropdown
                $.each(response, function(index, category) {
                    $('#category_id').append('<option value="' + category.id + '">' + category.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ' + error);
            }
        });
    }

    // Menangani klik tombol "Tambah Unit Mobil"
    $('#tambahUnitMobil').on('click', function() {
        $('#tambahModal').modal('show'); // Menampilkan modal
    });

    // Menangani klik tombol "Simpan"
    $('#simpanButton').on('click', function() {
        // Lakukan proses simpan data ke database
        simpanData();
    });

    $('.modal .close').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    // Menangani klik tombol "Batal"
    $('.modal .btn-secondary').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    // Fungsi untuk menyimpan data ke database menggunakan AJAX
    function simpanData() {
        var formData = $('#tambahModalForm').serialize(); // Mengambil data formulir

        $.ajax({
            url: '/admin/dashboard/car-units/add', // Ganti dengan URL endpoint untuk menyimpan data unit mobil
            method: 'POST',
            data: formData,
            success: function(response) {
                // Mengambil nilai id dari response
                var $carUnitId = response.id;
            
                // Tampilkan pesan sukses
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data mobil berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Jika pengguna menekan tombol "OK"
                    if (result.isConfirmed) {
                        // Tanyakan apakah ingin menambahkan foto unit mobil
                        Swal.fire({
                            title: 'Tambahkan Foto Mobil?',
                            text: 'Apakah Anda ingin menambahkan foto unit mobil yang baru disimpan?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            // Jika pengguna memilih "Ya", alihkan ke form tambah foto mobil
                            if (result.isConfirmed) {
                                window.location.href = '/admin/dashboard/car-units/' + $carUnitId + '/upload';
                            }
                        });
                    }
                });
                // Menutup modal setelah berhasil menyimpan data
                $('#tambahModal').modal('hide');
            },
            
        });
    }
});
