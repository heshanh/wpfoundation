$(function()
{
  $('#home-msg-btn').click(function(){
    $('#home-msg').toggle();
      $('html, body').animate({
         scrollTop: $("#home-msg-start").offset().top
     }, 1000);
  });

  $('#commercial-finance-sub-nav dd a').click(function()
  {
      $('.sub-nav dd').removeClass('active');
      $(this).parent().addClass('active');
  })

})