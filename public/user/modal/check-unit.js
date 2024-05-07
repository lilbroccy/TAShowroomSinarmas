$(document).ready(function() {
    updateTimeConstraints();
    $('#checkUnitBtn').click(function() {
        $('#checkUnitModal').modal('show');
    });
    $('#simpanButton').on('click', function() {
        var date = $('#date').val();
        var time = $('#time').val();
        var currentTime = new Date().toLocaleTimeString('en-US', {hour12: false}).slice(0, 5);
        var today = new Date().toISOString().slice(0, 10);
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
        simpanData();
    });

    function simpanData(){
        var date = $('#date').val();
        var time = $('#time').val();
        var formattedDate = new Date(date).toLocaleDateString('en-GB');
        var formData = $('#checkUnitForm').serialize(); 
        $.ajax({
            url: '/car-units/detail/check-unit',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                Swal.fire(
                    'Terkirim!',
                    `Anda telah memilih cek unit mobil pada tanggal ${formattedDate} jam ${time}. Kami akan menghubungi Anda segera.`,
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
        })
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