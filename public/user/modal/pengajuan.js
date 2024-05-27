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
                $('#brand_id').prepend('<option disabled selected>--Pilih Brand--</option>');
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
                $('#category_id').prepend('<option disabled selected>--Pilih Kategori--</option>');
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ' + error);
            }
        });
    }

    function previewPhotos(input) {
        var selectedPhotosContainer = document.getElementById('selectedPhotos');
        selectedPhotosContainer.innerHTML = '';

        if (input.files) {
            var filesAmount = input.files.length;
            for (var i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var photoContainer = document.createElement('div');
                    photoContainer.className = 'selected-photo';
                    var image = document.createElement('img');
                    image.src = event.target.result;
                    photoContainer.appendChild(image);
                    selectedPhotosContainer.appendChild(photoContainer);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    document.getElementById('photos').addEventListener('change', function() {
        previewPhotos(this);
    });
    document.getElementById('simpanButton').addEventListener('click', function() {
        var formData = new FormData(document.getElementById('tambahModalForm'));
        var photosInput = document.getElementById('photos');
        $.ajax({
            url: '/pengajuan-titipan',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData, photosInput,
            success: function(response) {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data mobil Anda sudah terkirim. Kami akan segera menghubungi Anda.',
                }).then(() => {
                    window.location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan: ' + error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan data mobil. Silahkan periksa kembali data yang Anda masukkan.',
                });
            }
        });
    });
});
