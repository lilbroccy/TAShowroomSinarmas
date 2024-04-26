// Add
$(document).ready(function() {
    loadBrandOptions();
    loadCategoryOptions();
    function loadBrandOptions() {
        $.ajax({
            url: '/api/brands', 
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#brand_id').empty();
                $.each(response, function(index, brand) {
                    $('#brand_id').append('<option value="' + brand.id + '">' + brand.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ' + error);
            }
        });
    }

    function loadCategoryOptions() {
        $.ajax({
            url: '/api/categories', 
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#category_id').empty();
                $.each(response, function(index, category) {
                    $('#category_id').append('<option value="' + category.id + '">' + category.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ' + error);
            }
        });
    }

    $('#tambahUnitMobil').on('click', function() {
        $('#tambahModal').modal('show'); 
    });

    $('#simpanButton').on('click', function() {
        simpanData();
    });

    $('.modal .close').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    $('.modal .btn-secondary').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    function simpanData() {
        var formData = $('#tambahModalForm').serialize(); 
        $.ajax({
            url: '/admin/dashboard/car-units/add', 
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data mobil berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tambahkan Foto Mobil?',
                            text: 'Apakah Anda ingin menambahkan foto unit mobil yang baru disimpan?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/admin/dashboard/car-units/' + response.data.id + '/upload';
                            } else {
                                window.location.reload();
                            }
                        });
                    }
                });
                $('#tambahModal').modal('hide');
            },
            
        });
    }

});

// Delete
$(document).ready(function() {
    function handleDeleteButtonClick() {
        $('.deleteBtn').off('click').on('click', function() {
            var carUnitId = $(this).data('carunitid');
            var carName = $(this).data('carunitname');
            $('#deleteModalBody').text('Apakah Anda yakin ingin menghapus data mobil "' + carName + '"?');
            $('#deleteModal').modal('show');
            $('#confirmDelete').off('click').on('click', function() {
                deleteCarUnit(carUnitId);
            });
        });
    }
    
    function deleteCarUnit(carUnitId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/dashboard/car-units/' + carUnitId + '/delete',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log('Data mobil berhasil dihapus:', response);
                $('#deleteModal').modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data mobil berhasil dihapus.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan saat menghapus data mobil:', error);
            }
        });
    }
    $('#carunits').on('draw.dt', function() {
        handleDeleteButtonClick();
    });
    handleDeleteButtonClick();
});

// Update
$(document).ready(function() {
    function handleUpdateButton() {
    $('.updateBtn').off('click').on('click', function(event) {
        var id = $(this).data('carunitid');
        console.log('ID yang diperoleh dari tombol: ' + id);
        $('#updateModal' + id).modal('show');
        $('#updateButton_' + id).data('carunitid', id);
        $('.updateButton').click(function(event) {
            var id = $(this).data('carunitid'); 
            updateCar(id);
        });
    });
    }

    function updateCar(id) {
        event.preventDefault();
        console.log('ID yang diperoleh dari tombol "Simpan Perubahan": ' + id);
        var formData = $('#updateForm_' + id).serialize(); 
        $.ajax({
            url: '/admin/dashboard/car-units/' + id + '/update',
            type: 'PUT',
            data: formData,
            success: function(response) {
                // Handle jika update berhasil
                console.log('Update berhasil');
                $('#updateModal' + id).modal('hide');

                // Tampilkan SweetAlert untuk meminta konfirmasi mengubah foto
                Swal.fire({
                    title: 'Ubah Foto Mobil?',
                    text: 'Apakah Anda ingin mengubah foto unit mobil yang baru diubah?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman untuk mengubah foto mobil
                        window.location.href = '/admin/dashboard/car-units/' + id + '/upload';
                    } else {
                        // Refresh halaman jika pengguna tidak ingin mengubah foto
                        window.location.reload();
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    $('#carunits').on('draw.dt', function() {
        handleUpdateButton();
    });
    handleUpdateButton();
});

