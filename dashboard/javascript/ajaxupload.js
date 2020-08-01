
$(document).ready(function(){

  $('#formtarea').on('submit', function(event){
   event.preventDefault();

    $.ajax({
     url:"server/creartarea.php",
     type:"POST",
     data: new FormData(this),
     contentType: false,
     cache: false,
     processData:false,
     beforeSend:function()
     {
      $('#save').attr('disabled', 'disabled');
      $('#process').css('display', 'block');
     },
     success:function(data)
     {
      var percentage = 0;

      var timer = setInterval(function(){
       percentage = percentage + 20;
       progress_bar_process(percentage, timer);
      }, 1000);
     }
    })

  });

  function progress_bar_process(percentage, timer)
  {
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#formtarea')[0].reset();
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    $('#save').attr('disabled', false);
   }
  }

 });
