//Image Popup
$(document).ready(function() {
    $('.gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] 
        },
        zoom: {
            enabled: true,
            duration: 300, 
            easing: 'ease-in-out', 
            opener: function(openerElement) {
                return openerElement.closest('.gallery').find('.cover-image');
            },
            image: {
                verticalFit: true, 
                fitContainerWidth: true
            }
        },
        callbacks: {
            resize: function() {
                var self = this;
                setTimeout(function() {
                    self.wrap.addClass('mfp-image-loaded');
                }, 16);
            },
            imageLoadComplete: function() {
                var self = this;
                setTimeout(function() {
                    self.wrap.addClass('mfp-image-loaded');
                }, 16);
            }
        }
    });
});

//Handler Check Unit Button
$(document).ready(function() {
    updateTimeConstraints();
    
    $('#checkUnitBtn').click(function() {
        Swal.fire({
            title: 'Info',
            text: 'Layanan ini dikenakan biaya sebesar Rp15.000 untuk biaya operasional. Lanjutkan?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#checkUnitModal').modal('show');
            }
        });
    });
    
    $('#simpanButton').on('click', function() {
        var date = $('#date').val();
        var time = $('#time').val();
        var currentTime = new Date().toLocaleTimeString('en-US', {hour12: false}).slice(0, 5);
        var today = new Date().toISOString().slice(0, 10);
        
        if (date < today && time > currentTime) {
            Swal.fire(
                'Error!',
                'Silakan pilih tanggal yang valid.',
                'error'
            );
            return;
        }
    
        if (date === today && time < currentTime) {
            Swal.fire(
                'Error!',
                'Pilih jam minimal dari jam saat ini (WIB).',
                'error'
            );
            return;
        }
        
        if (time > '22:00' || time < '08:00') {
            Swal.fire(
                'Error!',
                'Pilih jam antara 08:00 hingga 22:00 WIB.',
                'error'
            );
            return;
        }
        var formData = new FormData($('#checkUnitForm')[0]);
        simpanData(formData);
    });

    function simpanData(formData) {
        var date = $('#date').val();
        var time = $('#time').val();
        var formattedDate = new Date(date).toLocaleDateString('en-GB');
        $.ajax({
            url: '/car-units/detail/check-unit',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                Swal.fire(
                    'Terkirim!',
                    `Anda telah memilih cek unit mobil pada tanggal ${formattedDate} jam ${time}. Hubungi admin melalui whatsapp untuk info lebih lanjut.`,
                    'success'
                ).then(function() {
                    location.reload();
                });
                $('#checkUnitModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire(
                    'Error!',
                    'Terjadi kesalahan saat menyimpan data.',
                    'error'
                );
            }
        });
    }
});


function updateTimeConstraints() {
    var selectedDate = document.getElementById('date').value;
    var currentTime = new Date().toLocaleTimeString('en-US', {hour12: false}).slice(0, 5);
    var timeInput = document.getElementById('time');
    var today = new Date().toISOString().slice(0, 10);
    if (selectedDate === today) {
        timeInput.min = currentTime;
    } else {
        timeInput.min = "08:00";
    }
    timeInput.max = "22:00";
}
