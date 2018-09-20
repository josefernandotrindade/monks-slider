(function() {

    Drupal.behaviors.monksSlider = {
        attach: function(context, settings) {
            jQuery('.home-slider', context).once('monks-slider').each(function() {
                var container = jQuery(this);
                var nid = this.getAttribute('data-slider-nid');
                /*
            <div class="slider-item">
				<div class="slider-item-image">
					<img src="images/utilize_science.png" alt="slider-image">
				</div>
				<div class="slider-item-text">
					<h2 class="slider-item-title">Utilize <span class="red-text">science</span></h2>
					<p class="slider-item-par">Hire top talents, the key to successful talent acquisition is in the scientific method</p>
				</div>
			</div>
            */
                jQuery.get(Drupal.url('node/' + nid + '/slider'), function(response) {
                    response.data.forEach(function(item) {
                        var sliderItem = jQuery('<div class="slider-item">');
                        var sliderItemImage = jQuery('<div class="slider-item-image">');
                        var image = jQuery('<img>').attr('src', item.image).attr('alt', item.title);

                        var sliderItemText = jQuery('<div class="slider-item-text">');
                        var h2 = jQuery('<h2 class="slider-item-title">').html(item.title);
                        var body = jQuery('<p class="slider-item-par">').html(item.body);

                        sliderItemImage.append(image);

                        sliderItem.append(sliderItemImage);

                        sliderItemText.append(h2);
                        sliderItemText.append(body);
                        sliderItem.append(sliderItemText);

                        container.append(sliderItem);
                    });

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
                });
            });
        }
    };
})();