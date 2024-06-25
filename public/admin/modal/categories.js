$(document).ready(function() {
    $('#tambahKategori').off('click').on('click', function() {
        $('#tambahModalKategori').modal('show'); 
    });

    $('#simpanButtonKategori').off('click').on('click', function() {
        simpanData();
    });

    $('.modal .close').off('click').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    $('.modal .btn-secondary').off('click').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    function simpanData() {
        var formData = $('#tambahModalKategoriForm').serialize(); 
        $.ajax({
            url: '/admin/dashboard/categories/add', 
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data kategori berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                });
                $('#tambahModalKategori').modal('hide');
            },
        });
    }
});

// Delete
$(document).ready(function() {
    function handleDeleteButtonClick() {
        $('.deleteBtnCate').off('click').on('click', function() {
            var categoryId = $(this).data('categoryid');
            var categoryName = $(this).data('categoryname');
            $('#deleteModalBodyCate').text('Apakah Anda yakin ingin menghapus data kategori "' + categoryName + '"?');
            $('#deleteModalCate').modal('show');
            $('#confirmDeleteCate').off('click').on('click', function() {
                deleteCategory(categoryId);
            });
        });
    }
    
    function deleteCategory(categoryId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/dashboard/categories/' + categoryId + '/delete',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#deleteModalCate').modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data kategori berhasil dihapus.',
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
                console.error('Terjadi kesalahan saat menghapus kategori:', error);
            }
        });
    }
    $('#categories').on('draw.dt', function() {
        handleDeleteButtonClick();
    });
    handleDeleteButtonClick();
});

// Update
$(document).ready(function() {
    function handleUpdateButton() {
    $('.updateBtnCate').off('click').on('click', function(event) {
        var id = $(this).data('categoryid');
        $('#updateModalCate' + id).modal('show');
        $('#updateButtonCate_' + id).data('categoryid', id);
        $('.updateButtonCate').off('click').on('click',function(event) {
            var id = $(this).data('categoryid'); 
            updateCategory(id);
        });
    });
    }

    function updateCategory(id) {
        event.preventDefault();
        var formData = $('#updateFormCate_' + id).serialize(); 
        $.ajax({
            url: '/admin/dashboard/categories/' + id + '/update',
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#updateModalCate'+id).modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data kategori berhasil diupdate.',
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
                console.error('Terjadi kesalahan saat mengupdate kategori:', error);
            }
        });
    }
    $('#categories').on('draw.dt', function() {
        handleUpdateButton();
    });
    handleUpdateButton();
});