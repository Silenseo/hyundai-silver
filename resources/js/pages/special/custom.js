$(document).ready(function() {
  let tabs          = $('.tabs-mobile');
  let tabHeader     = $('.tabs-mobile-header');
  let tabHeaderText = $('.tabs-mobile-header__text');
  let tabsContent   = $('.tabs-mobile-content');
  let tabMobile     = $('.tabs-mobile .df-tabs__button');
  let tab           = $('.df-tabs__button');

  tabHeader.on('click', function() {
    tabsContent.slideToggle();
    tabs.toggleClass('menu-opened');
  });

  tabMobile.on('click', function() {
    tabsContent.slideUp();
    tabs.removeClass('menu-opened');
    tabHeaderText.html($(this).html());
  });

  tab.on('click', function() {
    tab.removeClass('df-tabs__button--active');
    $(this).addClass('df-tabs__button--active');

    var type = parseInt($(this).data('type'));

    if(type == -1)
        $('.special-content .row .col-lg-3').show();
    else
    {
        $('.special-content .row .col-lg-3').hide();
        $('.special-content .row .col-lg-3[data-type=' + type + ']').show();
    }
  });

  let hashValue = location.hash;  
  hashValue = hashValue.replace(/^#/, '');
  
  tab.each(function() {
    if (hashValue == $(this).data('button')) {
      $(this).trigger('click');
    }
  });    
  
});
