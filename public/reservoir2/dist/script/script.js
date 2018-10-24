;(function($) {
  const WaitingTime = 350
  var isDesktop = true
  var isExpand = true
  function toggleNavList() {
    $('.nav-list').animate({height: 'toggle'}, WaitingTime)
  }
  function collapseOnResize() {
    if ($(window).width() < 992) {
      if (isDesktop) {
        $('.nav-list').animate({height: 0},{duration: WaitingTime,
          complete: function() {
            $('.nav-list').attr('style', 'display: none')
            $('circle').attr('r', '5.5')
            isDesktop = false
          },
        })
      } else {
        return false
      }
    } else {  // width >= 992
      if (!isDesktop) {
        $('.nav-list').attr('style', '')
        $('circle').attr('r', '4.5')
        isDesktop = true
      } else {
        return false
      }
    }
  }

  function toggleFooter() {
    $('.collapse').toggleClass('expand')
    isExpand
      ? $('.footer').animate({height: '29px'}, WaitingTime)
      : $('.footer').animate({height: '130px'}, WaitingTime)
    $('.footer').toggleClass('hide')
    isExpand = !isExpand
  }

  function displayInfo() {
    $('.box>.title').text($(this).next('.text').text());
    $('.box>.info1').text($(this).nextAll('[data-name="info1"]').text());
    $('.box>.info2').text($(this).nextAll('[data-name="info2"]').text());
    $('.box>.info3').html($(this).nextAll('[data-name="info3"]').text());
    $('.box>.info4').html($(this).nextAll('[data-name="info4"]').text());
      //
    $('circle').attr('style', '');
    $(this).css({fill: '#fff', stroke: '#3a3837', strokeWidth: '2'});
  }

  function init() {
    if ($(window).width() < 992) {
      isDesktop = false
      $('.nav-list').css({display: 'none'})
      $('circle').attr('r', '5.5')
    }
    $(window).on('resize', _.debounce(collapseOnResize, WaitingTime))
    $('.btn-hamburger').on('click', _.throttle(toggleNavList, WaitingTime))
    $('.btn-collapse').on('click', _.throttle(toggleFooter, WaitingTime))
    $('circle').on('click', displayInfo);

    $('g[data-id]').each(function() {
      $(this).find('.text').each(function(index){
        $(this).attr('data-name', 'info' + index)
      })
    })
  }

  $(document).ready(init)
})(jQuery)
