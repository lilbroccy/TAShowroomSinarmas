$(document).ready(function(){
    // Function to handle Quick View button click
    $('.quick-view').on('click', function() {
        var carUnitId = $(this).data('id');
        $.ajax({
            url: '/get-car-units-detail/' + carUnitId,
            method: 'GET',
            success: function(response) {
                // Memasukkan URL gambar ke dalam elemen HTML
                var modalContent = '<div class="row">' +
                                        '<div class="col-md-6">' +
                                            '<div class="car-image-container">' +
                                            '<img src="' + assetUrl + '/' + response.image_url_1 + '" alt="Car Image">' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="col-md-6">' +
                                            '<div class="quick-view-details">' +
                                                '<h3>' + response.name + '</h3>' +
                                                '<p>Price: Rp. ' + response.price + '</p>' +
                                            '</div>' +
                                            '<div class="quick-view-buttons">' +
                                                '<button class="btn btn-primary"><i class="fa fa-calendar"></i> Booking Now</button>' +
                                                '<button class="btn btn-success"><i class="fa fa-whatsapp"></i> Share to WhatsApp</button>' +
                                                '<button class="btn btn-info" ><i class="fa fa-info-circle"></i> Detail Lengkap</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                // Memasukkan konten modal ke dalam .modal-body di blade template
                $('#quick-view-modal .modal-body').html(modalContent);
                // Menampilkan modal
                $('#quick-view-modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to fetch car unit details.');
            }
        });
    });
});







//SWEET ALERT LOGOUT
