<div class='loader-wrap'>
    <div id="main-loader" class="preloader">
        <div class="heartbeat">
        <div class="loading"></div>
        <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
    </div>
    </div></div>

<script>
        setTimeout(function () {
            const preloader = document.getElementById('main-loader');
            if (!preloader.classList.contains('done')) {
                preloader.classList.add('done');
            }
        }, 400);
</script>
