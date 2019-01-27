var app=function(){return{$contentHeight:$(".content").height(),fn:{},init:function(){this.cleanInput=new app.fn.Gallery(".main"),this.popup=new app.fn.Popup(".popup"),this.slider=new app.fn.Slider(".slider"),this.fixedMenu=new app.fn.FixedMenu(".fixed-info"),this.expandTable=new app.fn.ExpandTable(".pricing"),this.validation=new app.fn.Validation(".contact__form"),this.slideOut=new app.fn.SlideOut("body"),this.mobileBook=new app.fn.mobileBook(".book-mobile"),this.sendMobilePopup=new app.fn.sendEmailPopup("body")}}}();app.fn.sendEmailPopup=function(e){var i=$(e);"show"==location.search.split("popup=")[1]&&$.magnificPopup.open({items:{src:'<div class="white-popup _email"><h4 class="white-popup__ttl">Message sent! Thank you for your request!</h4></div>',type:"inline"},callbacks:{open:function(){i.addClass("_fixed")},close:function(){i.removeClass("_fixed")}}}),this.closePopup=function(){$.magnificPopup.close(),i.removeClass("_fixed")}},app.fn.SlideOut=function(e){var i=this;i.$window=$(window),i.$headNavBtn=$(".head__nav-btn"),i.$head=$(".head"),i.$pricingTableWrap=$(".pricing__table-wrap"),i.windowScrollTop=0,i.$mobileNavLink=$(".mobile-nav__link"),i.$mobileNavItem=$(".mobile-nav__item"),i.slideout=new Slideout({panel:document.querySelector(".main"),menu:document.querySelector(".mobile-nav"),padding:200,tolerance:70}),i.$mobileNavLink.on("click",function(){var e=$(this);e.next().slideToggle(150),e.parent().toggleClass("_open")}),i.$headNavBtn.on("click",function(){i.slideout.toggle()})},app.fn.mobileBook=function(e){var i=$(".mobile-book");$(e).on("click",function(){$("body").addClass("_fixed"),i.show()}),$(".mobile-book__close").on("click",function(){$("body").removeClass("_fixed"),i.hide()})},app.fn.Gallery=function(e){$(e).magnificPopup({delegate:".gallery__link",type:"image",closeOnContentClick:!1,closeBtnInside:!1,tClose:"Close (Esc)",tLoading:"",mainClass:"mfp-zoom-in",image:{verticalFit:!0},gallery:{enabled:!0},callbacks:{beforeOpen:function(){$(".gallery a").each(function(){$(this).attr("title",$(this).find("img").attr("alt"))})},open:function(){$.magnificPopup.instance.next=function(){var e=this;e.wrap.removeClass("mfp-image-loaded"),setTimeout(function(){$.magnificPopup.proto.next.call(e)},120)},$.magnificPopup.instance.prev=function(){var e=this;e.wrap.removeClass("mfp-image-loaded"),setTimeout(function(){$.magnificPopup.proto.prev.call(e)},120)}},imageLoadComplete:function(){var e=this;setTimeout(function(){e.wrap.addClass("mfp-image-loaded")},16)}}})},app.fn.Popup=function(e){var i=$("body");i.magnificPopup({delegate:".btn-popup",callbacks:{open:function(){i.addClass("_fixed")},close:function(){i.removeClass("_fixed")}}})},app.fn.Slider=function(e){$(e).find(".slider__inner").owlCarousel({loop:!0,nav:!1,mouseDrag:!1,items:1,autoplay:!0,autoplayTimeout:3e3,autoplayHoverPause:!0,animateOut:"fadeOut"})},app.fn.FixedMenu=function(e){var i=this;i.$fixedMenu=$(e),i.$fixedMenu.length&&(i.$window=$(window),i.documentHeight=$(document).height(),i.headHeight=$(".head").height(),i.footerHeight=$(".footer").height(),i.fixedMenuTop=null,i.fixedMenuHeight=null,i.$window.load(function(){i.init(),i.$window.on("scroll",function(){i.setFixed()})}))},app.fn.FixedMenu.prototype.init=function(){var e=this;app.$contentHeight=$(".content").height(),e.fixedMenuTop=e.$fixedMenu.offset().top,e.fixedMenuHeight=e.$fixedMenu.height(),e.$window.scrollTop()>=e.fixedMenuTop-e.headHeight-e.headHeight/1.5?e.$fixedMenu.addClass("_fixed"):e.$fixedMenu.removeClass("_fixed"),e.$window.scrollTop()>=e.fixedMenuTop+app.$contentHeight-e.fixedMenuHeight-250?(e.$fixedMenu.addClass("_fixed-bottom"),e.$fixedMenu.removeClass("_fixed")):e.$fixedMenu.removeClass("_fixed-bottom")},app.fn.FixedMenu.prototype.setFixed=function(){var e=this;e.$window.scrollTop()>=e.fixedMenuTop-e.headHeight-e.headHeight/1.5?e.$fixedMenu.addClass("_fixed"):e.$fixedMenu.removeClass("_fixed"),e.$window.scrollTop()>=e.fixedMenuTop+app.$contentHeight-e.fixedMenuHeight-250?e.$fixedMenu.addClass("_fixed-bottom"):e.$fixedMenu.removeClass("_fixed-bottom")},app.fn.ExpandTable=function(e){var i=this,n=$(e),o=$(".content"),t=$(".fixed-info"),a=n.find(".pricing__show-more"),l=n.find("table"),d=l.find("tbody tr"),p=d.length,s=10;p<=s&&a.hide(),i.showRows=function(e){d.show();for(var i=0;i<p;i++)i>=e&&d.eq(i).hide();s>=p&&a.hide()},a.on("click",function(){s+=10,i.showRows(s),app.$contentHeight=o.height(),t.removeClass("_fixed-bottom").addClass("_fixed")}),i.showRows(s)},app.fn.Validation=function(e){var i=$(e);i.find(".num-valid").on("input",function(){this.value=this.value.replace(/[^\d\+]/g,"")}),i.validate({rules:{name:{required:!0,minlength:2},email:{required:!0,minlength:2},phone:{required:!0,minlength:2},message:{required:!0,minlength:2}},messages:{name:"Please enter your name",email:{required:"Please enter a valid e-mail",email:"Your email address must be in the format of name@domain.com"},phone:"Please enter your phone number",message:"Please enter the message"}})},function(){app.init()}();