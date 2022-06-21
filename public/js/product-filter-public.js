jQuery(function ($) {
  'use strict';
  owelFilter();
  function owelFilter() {
    !(function (o, e) {
      'object' == typeof exports
        ? (module.exports = e(o.jQuery))
        : (o.owlcarousel_filter = e(o.jQuery));
    })(window, function (o, e) {
      'use strict';
      o.fn.owlcarousel_filter = function (o, e) {
        var t = this.data('owl.carousel').options;
        this.trigger('destroy.owl.carousel'),
          this.oc2_filter_clone || (this.oc2_filter_clone = this.clone());
        var l = this.oc2_filter_clone.children(o).clone();
        this.empty().append(l).owlCarousel(t);
      };
    });
    // Source: https://huynhhuynh.github.io/owlcarousel2-filter/dist/owlcarousel2-filter.min.js
  }

  function initSlider() {
    var owl = $('#__product_slider').owlCarousel({
      items: 5,
      margin: 10,
      loop: false,
      mouseDrag: true,
      touchDrag: true,
      slideBy: 1,
      dots: false,
      nav: false,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 5,
        },
      },
    });

    owl.owlcarousel_filter($('.filter_item.active').data('product-filter'));

    $('.__product_filter').on('click', '.filter_item', function () {
      $('.filter_item').removeClass('active');
      $(this).addClass('active');
      var $item = $(this);
      var filter = $item.data('product-filter');
      owl.owlcarousel_filter(filter);
    });
  }

  initSlider();
  $('#product_filter').show();
});
