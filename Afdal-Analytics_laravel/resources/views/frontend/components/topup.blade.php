<div id='scrol' class="stt" onclick='scrollToTop()'></div>
<!--<script src="{!!asset('web_public/assets/assets/node_modules/jquery/jquery-3.2.1.min.js')!!}"></script>-->
<script>
  //   window.addEventListener('scroll', function(){
  //   const scroll = document.querySelector('.stt');
  //   scroll.classList.toggle('stt__active', window.scrollY > 500)
  // })
    $('body').on('scroll', function(){
    if(document.body.scrollTop > 350) {
        $('#scrol').addClass('stt__active');
    } else {
        $('#scrol').removeClass('stt__active');
    }
    });

  function scrollToTop(){
$('body').scrollTop({
  top: 0
})
  }
</script>
