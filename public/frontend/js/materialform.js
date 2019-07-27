$(function(){
    
    $('.form-control').each(function(){
        changeClass($(this));
    });
  
    $('.form-control').on('focusout', function(){
      
        changeClass($(this));
    });
  function changeClass($formcontrol){
    if($formcontrol.val().length > 0){
          $formcontrol.addClass('has-value');
        }
        else{
          $formcontrol.removeClass('has-value');
        }
  }
  $('.datepicker').datepicker();
});