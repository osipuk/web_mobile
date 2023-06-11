jQuery(document).ready(function($) {
    var fbEditor = document.getElementById('build-wrap'),
      options = {
  
      };
    $(fbEditor).formBuilder(options);
  });


$('.Show').click(function() {
    $('#target').show(1500);
   
});
$('.Hide').click(function() {
    $('#target').hide(1500);
 
});


$('.Show2').click(function() {
    $('#target2').show(1500);
   
});
$('.Hide2').click(function() {
    $('#target2').hide(1500);
 
});

$('.Showbtn').click(function() {
    $('#targettable').show(1500);
    $('#targetadd').hide(1500);
});
$('.Hidebtn').click(function() {
    $('#targetadd').hide(1500);
    $('#targettable').show(1500);
});




