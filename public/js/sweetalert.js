$(document).on('click', '.quick-view', function() {
    var carUnitId = $(this).data('id');
    $.ajax({
        url: '/get-carunit-detail/' + carUnitId, 
        method: 'GET',
        success: function(response) {
            Swal.fire({
                title: 'Quick View',
                html: '<div class="carousel-container">' +
                        '<div class="carousel">' +
                            '<div><img src="' + assetUrl + '/' + response.image_url_1 + '" alt="Car Image 1"></div>' +
                            '<div><img src="' + assetUrl + '/' + response.image_url_2 + '" alt="Car Image 2"></div>' +
                            '<div><img src="' + assetUrl + '/' + response.image_url_3 + '" alt="Car Image 3"></div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="quick-view-details">' +
                        '<h3>' + response.name + '</h3>' +
                        '<p>Price: Rp. ' + response.price + '</p>' +
                        '<p>Description: ' + response.description + '</p>' +
                    '</div>'+
                    '<div class="quick-view-buttons">' +
                        '<button class="btn btn-primary"><i class="fa fa-calendar"></i> Booking Now</button>' +
                        '<button class="btn btn-success"><i class="fa fa-whatsapp"></i> Share to WhatsApp</button>' +
                        '<button class="btn btn-info"><i class="fa fa-info-circle"></i> Detail Lengkap</button>' +
                    '</div>',
                showCloseButton: true,
                showConfirmButton: false,
                didOpen: () => {
                    $('.carousel').slick({
                        autoplay: true,
                        autoplaySpeed: 2000,
                        arrows: true,
                        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
                        dots: true,
                        infinite: true
                    });
                }
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
            Swal.fire({
                title: 'Error',
                text: 'Failed to fetch car unit details.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});



//SWEET ALERT LOGOUT
document.addEventListener('DOMContentLoaded', function() {
    var logoutButton = document.getElementById('logout-button');
    if (logoutButton) {
        logoutButton.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form submit default
            Swal.fire({
                title: 'Logout',
                text: 'Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form untuk logout
                    document.getElementById('logout-form').submit();
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            window.location.href = "/login";
        });
    }
});





    