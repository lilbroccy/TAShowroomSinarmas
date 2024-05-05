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