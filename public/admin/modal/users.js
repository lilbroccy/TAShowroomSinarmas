// Delete
$(document).ready(function() {
    function handleDeleteButtonClick() {
        $('.deleteBtn').off('click').on('click', function() {
            var userId = $(this).data('userid');
            var userName = $(this).data('username');
            $('#deleteModalBody').text('Apakah Anda yakin ingin menghapus data pengguna "' + userName + '"?');
            $('#deleteModal').modal('show');
            $('#confirmDelete').off('click').on('click', function() {
                deleteUser(userId);
            });
        });
    }
    
    function deleteUser(userId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/admin/dashboard/users/' + userId + '/delete',
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data pengguna berhasil dihapus.',
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
                console.error('Terjadi kesalahan saat menghapus pengguna:', error);
            }
        });
    }
    $('#users').on('draw.dt', function() {
        handleDeleteButtonClick();
    });
    handleDeleteButtonClick();
});

$(document).ready(function() {
    function handleUpdateButton() {
    $('.updateBtn').off('click').on('click', function(event) {
        var id = $(this).data('userid');
        $('#updateModal' + id).modal('show');
        $('#updateButton_' + id).data('userid', id);
        $('.updateButton').off('click').on('click',function(event) {
            var id = $(this).data('userid'); 
            updateUser(id);
        });
    });
    }

    function updateUser(id) {
        event.preventDefault();
        var formData = $('#updateForm_' + id).serialize(); 
        $.ajax({
            url: '/admin/dashboard/users/' + id + '/update',
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#updateModal'+id).modal('hide');
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data pengguna berhasil diupdate.',
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
                console.error('Terjadi kesalahan saat mengupdate pengguna:', error);
            }
        });
    }
    $('#users').on('draw.dt', function() {
        handleUpdateButton();
    });
    handleUpdateButton();
});