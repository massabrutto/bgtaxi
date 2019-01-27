var app = (function() {
  var $content = $('.content');

  return {
    $contentHeight: $content.height(),
    fn: {},
    init: function() {
      this.cleanInput = new app.fn.Gallery('.main');
      this.popup = new app.fn.Popup('.popup');
      this.slider = new app.fn.Slider('.slider');
      this.fixedMenu = new app.fn.FixedMenu('.fixed-info');
      this.expandTable = new app.fn.ExpandTable('.pricing');
      this.validation = new app.fn.Validation('.contact__form');
      this.slideOut = new app.fn.SlideOut('body');
      this.mobileBook = new app.fn.mobileBook('.book-mobile');
      this.sendMobilePopup = new app.fn.sendEmailPopup('body');
    },
  };
})();

app.fn.sendEmailPopup = function(elem) {
  var self = this;
  var $body = $(elem);
  if (location.search.split('popup=')[1] == 'show') {
    $.magnificPopup.open({
      items: {
        src:
          '<div class="white-popup _email"><h4 class="white-popup__ttl">Message sent! Thank you for your request!</h4></div>',
        type: 'inline',
      },
      callbacks: {
        open: function() {
          $body.addClass('_fixed');
        },
        close: function() {
          $body.removeClass('_fixed');
        },
      },
    });
  }
  this.closePopup = function() {
    $.magnificPopup.close();
    $body.removeClass('_fixed');
  };
};

app.fn.SlideOut = function(elem) {
  var self = this;
  self.$window = $(window);
  self.$headNavBtn = $('.head__nav-btn');
  self.$head = $('.head');
  self.$pricingTableWrap = $('.pricing__table-wrap');
  self.windowScrollTop = 0;
  self.$mobileNavLink = $('.mobile-nav__link');
  self.$mobileNavItem = $('.mobile-nav__item');
  self.slideout = new Slideout({
    panel: document.querySelector('.main'),
    menu: document.querySelector('.mobile-nav'),
    padding: 200,
    tolerance: 70,
  });

  //   checkEnableSlideOut();

  //   function checkEnableSlideOut() {
  //     if (self.$window.width() >= 768) {
  //       self.slideout.disableTouch();
  //       self.slideout.close();
  //     }
  //     if (self.$window.width() < 768) {
  //       self.slideout.enableTouch();
  //     }
  //   }

  //   self.$window.resize(function() {
  //     setTimeout(function() {
  //       checkEnableSlideOut();
  //     }, 300);
  //   });

  self.$mobileNavLink.on('click', function() {
    var self = $(this);
    self.next().slideToggle(150);
    self.parent().toggleClass('_open');
  });

  self.$headNavBtn.on('click', function() {
    self.slideout.toggle();
  });

  //   self.$pricingTableWrap.on('touchstart', function() {
  //     self.slideout.disableTouch();
  //   });

  //   self.$pricingTableWrap.on('touchend', function() {
  //     self.slideout.enableTouch();
  //   });
};

app.fn.mobileBook = function(elem) {
  var self = this;
  var $mobileBookLink = $('.mobile-book');
  $(elem).on('click', function() {
    $('body').addClass('_fixed');
    $mobileBookLink.show();
  });

  $('.mobile-book__close').on('click', function() {
    $('body').removeClass('_fixed');
    $mobileBookLink.hide();
  });
};

app.fn.Gallery = function(elem) {
  var self = this;
  $(elem).magnificPopup({
    delegate: '.gallery__link',
    type: 'image',
    closeOnContentClick: false,
    closeBtnInside: false,
    tClose: 'Close (Esc)',
    tLoading: '',
    mainClass: 'mfp-zoom-in',
    image: {
      verticalFit: true,
    },
    gallery: {
      enabled: true,
    },
    callbacks: {
      beforeOpen: function() {
        $('.gallery a').each(function() {
          $(this).attr(
            'title',
            $(this)
              .find('img')
              .attr('alt')
          );
        });
      },
      open: function() {
        //overwrite default prev + next function. Add timeout for css3 crossfade animation
        $.magnificPopup.instance.next = function() {
          var self = this;
          self.wrap.removeClass('mfp-image-loaded');
          setTimeout(function() {
            $.magnificPopup.proto.next.call(self);
          }, 120);
        };
        $.magnificPopup.instance.prev = function() {
          var self = this;
          self.wrap.removeClass('mfp-image-loaded');
          setTimeout(function() {
            $.magnificPopup.proto.prev.call(self);
          }, 120);
        };
      },
      imageLoadComplete: function() {
        var self = this;
        setTimeout(function() {
          self.wrap.addClass('mfp-image-loaded');
        }, 16);
      },
    },
  });
};

app.fn.Popup = function(elem) {
  var self = this;
  var $body = $('body');
  $body.magnificPopup({
    delegate: '.btn-popup',
    callbacks: {
      open: function() {
        $body.addClass('_fixed');
      },
      close: function() {
        $body.removeClass('_fixed');
      },
    },
  });
};

app.fn.Slider = function(elem) {
  var self = this;
  var sliderInner = $(elem).find('.slider__inner');
  sliderInner.owlCarousel({
    loop: true,
    nav: false,
    mouseDrag: false,
    items: 1,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    animateOut: 'fadeOut',
  });
};

app.fn.FixedMenu = function(elem) {
  var self = this;
  self.$fixedMenu = $(elem);
  if (!self.$fixedMenu.length) return;

  self.$window = $(window);
  self.documentHeight = $(document).height();
  self.headHeight = $('.head').height();
  self.footerHeight = $('.footer').height();
  self.fixedMenuTop = null;
  self.fixedMenuHeight = null;

  self.$window.load(function() {
    self.init();
    self.$window.on('scroll', function() {
      self.setFixed();
    });
  });
};

app.fn.FixedMenu.prototype.init = function() {
  var self = this;
  app.$contentHeight = $('.content').height();
  self.fixedMenuTop = self.$fixedMenu.offset().top;
  self.fixedMenuHeight = self.$fixedMenu.height();

  if (
    self.$window.scrollTop() >=
    self.fixedMenuTop - self.headHeight - self.headHeight / 1.5
  ) {
    self.$fixedMenu.addClass('_fixed');
  } else {
    self.$fixedMenu.removeClass('_fixed');
  }

  if (
    self.$window.scrollTop() >=
    self.fixedMenuTop + app.$contentHeight - self.fixedMenuHeight - 250
  ) {
    self.$fixedMenu.addClass('_fixed-bottom');
    self.$fixedMenu.removeClass('_fixed');
  } else {
    self.$fixedMenu.removeClass('_fixed-bottom');
  }
};

app.fn.FixedMenu.prototype.setFixed = function() {
  var self = this;
  if (
    self.$window.scrollTop() >=
    self.fixedMenuTop - self.headHeight - self.headHeight / 1.5
  ) {
    self.$fixedMenu.addClass('_fixed');
  } else {
    self.$fixedMenu.removeClass('_fixed');
  }

  if (
    self.$window.scrollTop() >=
    self.fixedMenuTop + app.$contentHeight - self.fixedMenuHeight - 250
  ) {
    self.$fixedMenu.addClass('_fixed-bottom');
  } else {
    self.$fixedMenu.removeClass('_fixed-bottom');
  }
};

app.fn.ExpandTable = function(elem) {
  var self = this;
  var $pricing = $(elem);
  var $content = $('.content');
  var $fixedMenu = $('.fixed-info');
  var $pricingShowMore = $pricing.find('.pricing__show-more');
  var $table = $pricing.find('table');
  var $tableTr = $table.find('tbody tr');
  var tRlength = $tableTr.length;
  var showCount = 10;

  if (tRlength <= showCount) $pricingShowMore.hide();

  self.showRows = function(count) {
    $tableTr.show();
    for (var i = 0; i < tRlength; i++) {
      if (i >= count) {
        $tableTr.eq(i).hide();
      }
    }
    if (showCount >= tRlength) $pricingShowMore.hide();
  };

  $pricingShowMore.on('click', function() {
    showCount += 10;
    self.showRows(showCount);
    app.$contentHeight = $content.height();
    $fixedMenu.removeClass('_fixed-bottom').addClass('_fixed');
  });

  self.showRows(showCount);
};

app.fn.Validation = function(elem) {
  var self = this;
  var $form = $(elem);
  var numValidation = $form.find('.num-valid');

  numValidation.on('input', function() {
    this.value = this.value.replace(/[^\d\+]/g, '');
  });

  $form.validate({
    rules: {
      name: {
        required: true,
        minlength: 2,
      },
      email: {
        required: true,
        minlength: 2,
      },
      phone: {
        required: true,
        minlength: 2,
      },
      message: {
        required: true,
        minlength: 2,
      },
    },
    messages: {
      name: 'Please enter your name',
      email: {
        required: 'Please enter a valid e-mail',
        email: 'Your email address must be in the format of name@domain.com',
      },
      phone: 'Please enter your phone number',
      message: 'Please enter the message',
    },
  });
};

(function() {
  app.init();
})();
