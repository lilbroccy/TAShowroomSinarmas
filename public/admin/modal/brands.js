$(document).ready(function() {
    $('#tambahBrand').off('click').on('click', function() {
        $('#tambahModalBrand').modal('show'); 
    });

    $('#simpanButtonBrand').off('click').on('click', function() {
        simpanData();
    });

    $('.modal .close').off('click').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    $('.modal .btn-secondary').off('click').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    function simpanData() {
        var formData = $('#tambahModalBrandForm').serialize(); 
        $.ajax({
            url: '/admin/dashboard/brands/add', 
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data brand berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                });
                $('#tambahModalBrand').modal('hide');
            },
        });
    }
});

// Delete
$(document).ready(function() {
    function handleDeleteButtonClick() {
        $('.deleteBtnBrand').off('click').on('click', function() {
            var brandId = $(this).data('brandid');
            var brandName = $(this).data('brandname');
            $('#deleteModalBody').text('Apakah Anda yakin ingin menghapus data brand "' + brandName + '"?');
            $('#deleteModalBrand').modal('show');
            $('#confirmDeleteBrand').off('click').on('click', function() {
                deleteBrand(brandId);
            });
        });
    }
    
    function deleteBrand(brandId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/dashboard/brands/' + brandId + '/delete',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#deleteModalBrand').modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data brand berhasil dihapus.',
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
                console.error('Terjadi kesalahan saat menghapus brand:', error);
            }
        });
    }
    $('#brands').on('draw.dt', function() {
        handleDeleteButtonClick();
    });
    handleDeleteButtonClick();
});

// Update
$(document).ready(function() {
    function handleUpdateButton() {
    $('.updateBtnBrand').off('click').on('click', function(event) {
        var id = $(this).data('brandid');
        $('#updateModalBrand' + id).modal('show');
        $('#updateButtonBrand_' + id).data('brandid', id);
        $('.updateButtonBrand').off('click').on('click',function(event) {
            var id = $(this).data('brandid'); 
            updateBrand(id);
        });
    });
    }

    function updateBrand(id) {
        event.preventDefault();
        var formData = $('#updateFormBrand_' + id).serialize(); 
        $.ajax({
            url: '/admin/dashboard/brands/' + id + '/update',
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#updateModalBrand'+id).modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data brand berhasil diupdate.',
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
                console.error('Terjadi kesalahan saat mengupdate data brand:', error);
            }
        });
    }
    $('#brands').on('draw.dt', function() {
        handleUpdateButton();
    });
    handleUpdateButton();
});