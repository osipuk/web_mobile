@section('metahead')

    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        a:hover{
            text-decoration: none !important;
        }
    </style>
@endsection

@include('layout.userhead')
@include('frontend.components.header-menu')
<main class="contact-us">
{{--    <div class="contact-us-circles-background-wrapper">--}}
{{--        <div class="contact-us-second-orange-circle"></div>--}}
{{--    </div>--}}
    <div class="contact-us-animation animated-circle-wrapper">
        <div class="footer-circle"></div>
        <div class="footer-circle-orange-small">
        </div>
        <div class="footer-circle-orange-medium">
        </div>
        <div class="footer-circle-orange-large">
        </div>
    </div>
    <div class="contact-us-content">
        <h2 class="contact-us-title font-64-lh-135-semi-bold">
            {{__('Contact us')}}
        </h2>
        <h3 class="contact-us-subtitle font-22-lh-46-light">
            {{__('Drop us a message in the form or get in touch at:')}}
        </h3>
        <a href="mailto:info@afdalanalytics.com" class="contact-us-email-title font-30-lh-35-medium white-no-underline text-orange-hover">
            info@afdalanalytics.com
        </a>
        <form class="contact-us-form">
            <div class="input-wrapper">
                <input
                    class="contact-us-form-input name font-20-lh-42-regular"
                    type="text"
                    value=""
                    name="name"
                    placeholder="{{__('Name')}}"
                    maxlength="50"
                    oninput="onFieldInput('name', this)"
                    onblur="onFieldBlur('name', this)"
                />
                <p class="error-p name-error" id="message"></p>
{{--                <div class="tooltip contact-us-tooltip name font-16-lh-19-regular">--}}
{{--                {{__('Please, enter your name')}}--}}
{{--                </div>--}}
            </div>
            <div class="input-wrapper">
                <input class="contact-us-form-input email font-20-lh-42-regular"
                       type="email"
                       value=""
                       name="email"
                       placeholder="{{__('Email')}}"
                       maxlength="50"
                       oninput="onFieldInput('email', this)"
                       onblur="onFieldBlur('email', this)"
                />
                <p class="error-p email-error" id="message"></p>
{{--                <div class="tooltip contact-us-tooltip email font-16-lh-19-regular">--}}
{{--                {{__('Please, enter a valid email')}}--}}
{{--                </div>--}}
            </div>
            <div class="input-wrapper">
                <input
                    class="contact-us-form-input subject font-20-lh-42-regular"
                    type="text"
                    value=""
                    name="name"
                    placeholder="{{__('Subject')}}"
                    maxlength="50"
                    oninput="onFieldInput('subject', this)"
                    onblur="onFieldBlur('subject', this)"
                />
                <p class="error-p subject-error" id="message"></p>
{{--                <div class="tooltip contact-us-tooltip name font-16-lh-19-regular">--}}
{{--                {{__('Please, enter your subject')}}--}}
{{--                </div>--}}
            </div>
            <div class="input-wrapper">
                  <textarea class="contact-us-form-input textarea font-20-lh-42-regular"
                            placeholder="رسالة إلى فريق أفضل التحليلات"
                            rows="5"
                            maxlength="670"
                            oninput="onFieldInput('message', this)"
                            onblur="onFieldBlur('message', this)"
                  ></textarea>
            </div>
            <p class="contact-us-form-info-text font-16-lh-22-medium">
                {{__('Afdal needs the contact information you provide to us to contact you about our products and services. You may unsubscribe from these communications at any time. For information on how to unsubscribe, as well as our privacy practices and commitment to protecting your privacy, please review our Privacy Policy.')}}
            </p>
            <div class="capcha-wrapper" style="text-align: initial;">
                <div class="g-recaptcha"
                     style="display:inline-block; margin-top:20px"
                     data-callback="captchaResponse"
                     data-sitekey="6Lc-aA0eAAAAAOdimM9103VEQEl51mHFUXEuJ9BZ"
                >
                </div>
            </div>
            <button
                type="submit"
                class="contact-us-form-button orange-button  disabled"
                style="font-family: 'Gilroy-SemiBold';font-size: 20px;line-height: 23px;text-align: center;color: #FFFFFF;width: 192px;height: 65px;"
                disabled >
                {{__('Contact Us')}}
            </button>
                <div class="contact-us-form-success-modal-content">
                    <p class="contact-us-form-success-modal-text font-53-lh-100-semi-bold">
                        {{__("Form successfully sent")}}
                    </p>
                    <div class="contact-us-form-success-modal-icon"></div>
                </div>
                <div class="contact-us-form-fail-modal-content">
                    <p class="contact-us-form-success-modal-text font-53-lh-100-semi-bold">
                        {{__("User with this email is subscribed")}}
                    </p>
                </div>
        </form>


    </div>
    <div class="contact-us-form-success-modal-opacity-wrapper"></div>
    <div class="contact-us-form-fail-modal-opacity-wrapper"></div>

@include('frontend.components.loader')
    <div class="stt stt__circle__black" onclick='scrollToTop()'></div>

</main>

@include('frontend.components.footer')
@include('frontend.components.cookie')

<script>
  window.addEventListener('scroll', function(){
    const scroll = document.querySelector('.stt');
    scroll.classList.toggle('stt__active', window.scrollY > 500)
  })

  function scrollToTop(){
    window.scrollTo({ top: 0 })
  }
</script>

<script>

    $(document).ready(() => {
        $('.contact-us-form-button')[0].addEventListener('click',contactUs)
    })

    const nameRegContactUs = /[a-zA-Z]+$/;
    // const nameRegContactUs = /^([a-zA-Z]+\s)+[a-zA-Z]+$/;
    const arabicNameRegEx1ContactUs = /[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF]/;
    const emailRegEx1ContactUs = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    let isCaptchaPass = false;

    let name_message = "{{__('Please, enter your name')}}";
    let email_message = "{{__('Please, enter a valid email')}}";
    let subject_message = "{{__('Please, enter your subject')}}";

    function onFieldInput(type, inputElement) {

        inputElement.classList.remove('border-error')
        inputElement.nextSibling.parentNode.querySelector('.error-p').textContent = ''

        if (checkAllFieldsValid(inputElement) && isCaptchaPass) {
            $('.contact-us-form-button')[0].classList.remove('disabled')
            $('.contact-us-form-button')[0].removeAttribute('disabled')
        } else {
            $('.contact-us-form-button')[0].classList.add('disabled')
            $('.contact-us-form-button')[0].setAttribute('disabled', 'true')
        }
    }

    function onFieldBlur(type, inputElement) {
        if (inputElement.value === '') {
            inputElement.nextSibling.parentNode.querySelector('.error-p').textContent = '';
            inputElement.classList.add('border-error')
        } else {
            switch (type) {
                case 'name':
                    if (!nameRegContactUs.test(inputElement.value) && !arabicNameRegEx1ContactUs.test(inputElement.value)) {
                        inputElement.nextSibling.parentNode.querySelector('.name-error').textContent = name_message;
                        inputElement.classList.add('border-error')
                    }
                    break;
                case 'email':
                    if (!emailRegEx1ContactUs.test(inputElement.value)) {
                        inputElement.nextSibling.parentNode.querySelector('.email-error').textContent = email_message;
                        inputElement.classList.add('border-error')
                    }
                    break
                case 'subject':
                    if (!nameRegContactUs.test(inputElement.value) && !arabicNameRegEx1ContactUs.test(inputElement.value)) {
                        inputElement.nextSibling.parentNode.querySelector('.subject-error').textContent = subject_message;
                        inputElement.classList.add('border-error')
                    }
                    break;
            }
        }
    }

    function checkAllFieldsValid(fieldValue) {
        console.log('here in check all fields')

        const nameInputValue = $('.contact-us-form-input.name')[0].value;
        const emailInputValue = $('.contact-us-form-input.email')[0].value;
        const messageInputValue = $('.contact-us-form-input.textarea')[0].value;

        if(fieldValue) {
            fieldValue.classList.remove('border-error')
            fieldValue.classList.remove('show-tooltip')
        }

        if (nameInputValue === '' || (nameInputValue !== '' && !nameRegContactUs.test(nameInputValue) && !arabicNameRegEx1ContactUs.test(nameInputValue))) {
            return false
        }

        if (emailInputValue === '' || (emailInputValue !== '' && !emailRegEx1ContactUs.test(emailInputValue))) {
            return false
        }

        if (messageInputValue === '') {
            return false
        }

        return isCaptchaPass
    }

    function captchaResponse(test) {
        isCaptchaPass = true;
        console.log(isCaptchaPass);

        if (checkAllFieldsValid()) {
            $('.contact-us-form-button')[0].classList.remove('disabled')
            $('.contact-us-form-button')[0].removeAttribute('disabled')
        }

    }


    $(".contact-us-form-input").on("input", function() {

            console.log(isCaptchaPass);
    
            if (checkAllFieldsValid() && isCaptchaPass) {
                $('.contact-us-form-button')[0].classList.remove('disabled')
                $('.contact-us-form-button')[0].removeAttribute('disabled')
            } else {
                $('.contact-us-form-button')[0].classList.add('disabled')
                $('.contact-us-form-button')[0].setAttribute('disabled', 'true')
            }

    });



    function contactUs(event) {
        event.preventDefault();

        let nameInputValue = $('.contact-us-form-input.name')[0].value;
        let emailInputValue = $('.contact-us-form-input.email')[0].value;
        let subjectInputValue = $('.contact-us-form-input.subject')[0].value;
        let messageInputValue = $('.contact-us-form-input.textarea')[0].value;

        let sendData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name:nameInputValue,
            email:emailInputValue,
            subject:subjectInputValue,
            comment:messageInputValue,
        }

        fetch('/subscribe-mailchimp', {
            method: 'post',
            headers: {
                "Content-type": "application/json; charset=UTF-8",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(sendData)
        }).then((resp) => resp.json())
            .then(function(data) {
                $('.contact-us-form-input.name')[0].value = '';
                $('.contact-us-form-input.email')[0].value = '';
                $('.contact-us-form-input.subject')[0].value = '';
                $('.contact-us-form-input.textarea')[0].value = '';
                if(data.title && data.title === "Member Exists"){
                    $('.contact-us-form-fail-modal-content')[0].classList.add('show')
                    $('.contact-us-form-fail-modal-opacity-wrapper')[0].classList.add('show')


                    setTimeout(() => {
                        $('.contact-us-form-fail-modal-content')[0].classList.remove('show');
                        $('.contact-us-form-fail-modal-opacity-wrapper')[0].classList.remove('show')
                    }, 2500)
                }
                else{

                    $('.contact-us-form-success-modal-content')[0].classList.add('show')
                    $('.contact-us-form-success-modal-opacity-wrapper')[0].classList.add('show')


                    setTimeout(() => {
                        $('.contact-us-form-success-modal-content')[0].classList.remove('show');
                        $('.contact-us-form-success-modal-opacity-wrapper')[0].classList.remove('show')
                    }, 2500)

                    window.location.href = "https://afdalanalytics.com/subscription-successful";
                }
            })

        // Here we need to send our Data to Server



    }

</script>
