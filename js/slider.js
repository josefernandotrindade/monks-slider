(function($) {
    Drupal.behaviors.monksSlider = {
        attach: function(context, settings) {
            $('.home-slider', context).once('monks-slider').each(function() {
                var container = $(this);
                var nid = this.getAttribute('data-slider-nid');

                container.slick({
                    arrows: true,
                    dots: true,
                    responsive: [{
                        breakpoint: 900,
                        settings: {
                            dots: false
                        }
                    }]
                });

                $.get(Drupal.url('node/' + nid + '/slider'), function(response) {
                    response.data.forEach(function(item) {
                        var sliderTemplate = '<div class="slider-item">\
                                    <div class="slider-item-image">\
                                      <img src="" alt="slider-image">\
                                    </div>\
                                    <div class="slider-item-text">\
                                      <h2 class="slider-item-title"></h2>\
                                      <p class="slider-item-par"></p>\
                                    </div>\
                                  </div>';

                        var slide = $(sliderTemplate);

                        slide.find('.slider-item-title').html(item.title);
                        slide.find('.slider-item-par').html(item.body);
                        slide.find('.slider-item-image img').attr('src', item.image);

                        container.slick('slickAdd', slide.prop('outerHTML'));
                    });
                });
            });
        }
    };
})(jQuery);