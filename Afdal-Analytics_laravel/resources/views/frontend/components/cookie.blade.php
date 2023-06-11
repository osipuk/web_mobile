<div id="backD" class="cookie-wrap">
<div class="cookies-block" dir="rtl">
    <div class="main-block">
{{--        <p class="title font-35-lh-42-bold">--}}
{{--            {{__('We use cookies')}}--}}
{{--        </p>--}}
        <div id="cookie-close-btn" class="cookies-close"></div>
        <p class="text font-20-lh-30-semi-bold">
            {{__('We use cookies on our website for identification and analysis purposes. By using this website you consent to the storage and accessibility of cookies on your device.')}}
        </p>
        <button class="accept-btn font-18-lh-38-semi-bold"
                onclick="acceptCookie()"
        >
            {{__('ACCEPT')}}
        </button>
{{--        <a href="/cookie-policy" class="cookie-policy font-18-lh-22-light">--}}
{{--            {{__('Cookie Policy')}}--}}
{{--        </a>--}}
    </div>
{{--    <div class="icon"></div>--}}
</div>
</div>
<script>
       const closeModalBtn = document.querySelector('#cookie-close-btn');
      const  backClose = document.querySelector('#backD');

    function toggleModal() {
        backClose.classList.add('visually-hidden');
    };

    closeModalBtn.addEventListener('click', toggleModal);
    backClose.addEventListener('click', toggleModal);
</script>
<script>
    if (localStorage.getItem('acceptCookie') !== null) {
        document.querySelector('.cookies-block').setAttribute('style', 'display:none')
        document.querySelector('.cookie-wrap').setAttribute('style', 'display:none')
    }

    function acceptCookie() {
        localStorage.setItem('acceptCookie', 'true')
        document.querySelector('.cookies-block').setAttribute('style', 'display:none')
        document.querySelector('.cookie-wrap').setAttribute('style', 'display:none')
    }
</script>
