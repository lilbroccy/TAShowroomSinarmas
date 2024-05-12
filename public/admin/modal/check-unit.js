$(document).ready(function() {
    $('.done-button').click(doneButtonHandler);
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

function doneButtonHandler() {
    Swal.fire({
        title: 'Apakah mobil terjual?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa fa-check"></i> Ya',
        cancelButtonText: '<i class="fa fa-times"></i> Tidak',
        showCloseButton: true,
        showClass: {
            popup: 'swal2-noanimation',
            backdrop: 'swal2-noanimation'
        },
        hideClass: {
            popup: '',
            backdrop: ''
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Pilih Sistem Penjualan',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-money"></i> Tunai',
                cancelButtonText: '<i class="fa fa-credit-card"></i> Kredit',
                showCloseButton: true,
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                hideClass: {
                    popup: '',
                    backdrop: ''
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Anda memilih Tunai');
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Anda memilih Kredit');
                }
            });
        }
    });
}


function actionButtonHandler() {
    var checkUnitId = $(this).data('id');
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
                        return 'Alasan penolakan diperlukan!'
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
