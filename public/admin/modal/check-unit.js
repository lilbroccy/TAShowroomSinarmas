$(document).ready(function() {
    $('.done-button').click(function() {
        var checkUnitId = $(this).data('id');
        doneButtonHandler(checkUnitId);
    });
    $('.action-button').click(actionButtonHandler);

    $('.detail-button').click(function() {
        var checkUnitId = $(this).data('id');
        $('#detailModal' + checkUnitId).modal('show');
    });
    $('.car-name').click(function() {
        var checkUnitId = $(this).data('id');
        $('#detailModal' + checkUnitId).modal('show');
    });
    $('.user').click(function() {
        var userId = $(this).data('id');
        $('#userProfileModal' + userId).modal('show');
    });
    $('.whatsapp-link').click(function(e) {
        e.preventDefault();
        var phoneNumber = $(this).data('phone');
        phoneNumber = phoneNumber.replace(/^0/, '62');
        var url = 'https://wa.me/' + phoneNumber;
        window.open(url, '_blank');
    });
});

function doneButtonHandler(checkUnitId) {
    Swal.fire({
        title: 'Apakah mobil terjual?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa fa-check"></i> Ya',
        cancelButtonText: '<i class="fa fa-times"></i> Tidak',
        showCloseButton: true,
        allowOutsideClick: false, 
    }).then((result) => {
        if (result.isConfirmed) {
            showPaymentMethodDialog(checkUnitId);
        } else {
            markCheckUnitAsDone(checkUnitId);
        }
    });
}

function markCheckUnitAsDone(checkUnitId) {
    $.ajax({
        url: '/update-check-unit-status/' + checkUnitId,
        method: 'PUT',
        data: {
            car_status: 'Tidak Terjual',
            status: 'Selesai',
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response) {
            Swal.fire({
                title: 'Sukses',
                text: 'Status check unit berhasil diperbarui',
                icon: 'success'
            }).then(() => {
                location.reload();
            });
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui status check unit',
                icon: 'error'
            });
        }
    });
}

function showPaymentMethodDialog(checkUnitId) {
    Swal.fire({
        title: 'Pilih Sistem Penjualan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa fa-money"></i> Tunai',
        cancelButtonText: '<i class="fa fa-credit-card"></i> Kredit',
        showCloseButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            saveSalesData(checkUnitId, 'Tunai');
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            saveSalesData(checkUnitId, 'Kredit');
        }
    });
}

function saveSalesData(checkUnitId, paymentMethod) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/save-sales-data', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            checkUnitId: checkUnitId,
            paymentMethod: paymentMethod
        })
    }).then(response => {
        if (response.ok) {
            return response.json();
        }
        return response.json().then(error => {
            throw new Error(error.message || 'Terjadi kesalahan yang tidak diketahui.');
        });
    }).then(data => {
        Swal.fire(data.message);
        setTimeout(function() {
            location.reload();
        }, 1000);
    }).catch(error => {
        console.error('Error:', error);
        Swal.fire('Terjadi Kesalahan', error.message, 'error');
    });
}



function actionButtonHandler() {
    var checkUnitId = $(this).data('id');
    var status = $(this).closest('.card-footer').data('status');

    if (status === 'Selesai') {
        Swal.fire({
            title: 'Anda tidak bisa memilih opsi',
            text: 'Jadwal ini telah selesai dilaksanakan.',
            icon: 'info',
            confirmButtonText: 'Tutup'
        });
        
    } else if (status === 'Dibatalkan Oleh Sistem'| status === 'Dibatalkan Oleh Admin') {
        Swal.fire({
            title: 'Anda tidak bisa memilih opsi',
            text: 'Jadwal ini telah dibatalkan karena unit telah terjual sebelumnya.',
            icon: 'info',
            confirmButtonText: 'Tutup'
        });
        
    } else if (status === 'Ditolak') {
        Swal.fire({
            title: 'Anda tidak bisa memilih opsi',
            text: 'Jadwal ini telah ditolak.',
            icon: 'info',
            confirmButtonText: 'Tutup'
        });
        
    } else if (status === 'Dibatalkan Oleh User') {
        Swal.fire({
            title: 'Anda tidak bisa memilih opsi',
            text: 'Jadwal ini telah dibatalkan oleh Pengguna.',
            icon: 'info',
            confirmButtonText: 'Tutup'
        });
        
    } else {
        Swal.fire({
            title: 'Pilih Opsi',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-check"></i> Setujui',
            cancelButtonText: '<i class="fa fa-times"></i> Tolak',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            showCloseButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Catatan Tambahan',
                    input: 'text',
                    inputPlaceholder: 'Kosongkan jika tidak ada catatan tambahan',
                    showCancelButton: true,
                    confirmButtonText: 'Kirim',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    allowOutsideClick: false,
                    showCloseButton: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        var note = result.value ? result.value : '';
                        fetch('/rubah-status-check-unit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                checkUnitId: checkUnitId,
                                status: 'Disetujui',
                                note: note
                            })
                        }).then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        }).then(data => {
                            Swal.fire(data.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }).catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Terjadi Kesalahan');
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.close) {
                // Do nothing if closed
            } else {
                Swal.fire({
                    title: 'Alasan Penolakan',
                    input: 'text',
                    inputPlaceholder: 'Masukkan alasan penolakan',
                    showCancelButton: true,
                    confirmButtonText: 'Kirim',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Alasan penolakan diperlukan!';
                        }
                    },
                    allowOutsideClick: false,
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/rubah-status-check-unit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                checkUnitId: checkUnitId,
                                status: 'Ditolak',
                                note: result.value
                            })
                        }).then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        }).then(data => {
                            Swal.fire(data.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }).catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Terjadi Kesalahan');
                        });
                    }
                });
            }
        });
    }
}
