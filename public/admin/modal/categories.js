$(document).ready(function() {
    $('#tambahKategori').on('click', function() {
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
                $('#tambahModal').modal('hide');
            },
        });
    }
});

// Delete
$(document).ready(function() {
    function handleDeleteButtonClick() {
        $('.deleteBtn').off('click').on('click', function() {
            var categoryId = $(this).data('categoryid');
            var categoryName = $(this).data('categoryname');
            $('#deleteModalBody').text('Apakah Anda yakin ingin menghapus data kategori "' + categoryName + '"?');
            $('#deleteModal').modal('show');
            $('#confirmDelete').off('click').on('click', function() {
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
                $('#deleteModal').modal('hide');
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
    $('.updateBtn').off('click').on('click', function(event) {
        var id = $(this).data('categoryid');
        $('#updateModal' + id).modal('show');
        $('#updateButton_' + id).data('categoryid', id);
        $('.updateButton').click(function(event) {
            var id = $(this).data('categoryid'); 
            updateCategory(id);
        });
    });
    }

    function updateCategory(id) {
        event.preventDefault();
        var formData = $('#updateForm_' + id).serialize(); 
        $.ajax({
            url: '/admin/dashboard/categories/' + id + '/update',
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#updateModal'+id).modal('hide');
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