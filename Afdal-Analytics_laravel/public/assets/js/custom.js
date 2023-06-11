const NUMBERS_LIST = [
    '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '+'
]

// $('#blog-slider').owlCarousel({
//     loop: true,
//     center: true,
//     items: 3,
//     margin: 20,
//     autoplay: true,
//     dots: true,
//     autoplayTimeout: 8500,
//     smartSpeed: 450,
//     responsive: {
//         0: {
//             items: 1
//         },
//         768: {
//             items: 2
//         },
//         1170: {
//             items: 3
//         }
//     }
// });

let isMenuOpen = false;
let isMenuBig = false;
$(document).ready(function() {
    // $("#close-sidebar").click();
    if (window.innerWidth > 768 && window.innerWidth <= 992) {
        $(".dashboard-header").removeClass("addpaddingforhome");
        $(".dashboard-header").addClass("addpaddingforhome50");
        $("#upgrade-alert").hide();

        isMenuOpen = false;
    }else if (window.innerWidth <= 768) {
        $(".dashboard-header").removeClass("addpaddingforhome");
        $(".dashboard-header").removeClass("addpaddingforhome50");
        $(".sidebar-wrapper").addClass("d-none");
        $("#upgrade-alert").hide();
    }else{
        $("#close-sidebar").click();
    }

})

function openMenu(){

    $(".sidebar-wrapper .menu-close-icon").toggleClass("icon-rotate-en-remove");
}

   

$(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if (
        $(this)
            .parent()
            .hasClass("active")
    ) {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
            .parent()
            .removeClass("active");
    } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
            .next(".sidebar-submenu")
            .slideDown(200);
        $(this)
            .parent()
            .addClass("active");
    }
});




function reportWindowSize() {

    if (window.innerWidth <= 768) {

    }
    if (window.innerWidth <= 992 && isMenuOpen && !isMenuBig) {
        $(".sidebar-wrapper").addClass("full-width");
        isMenuBig = true
    }
    if (window.innerWidth >= 768 && isMenuOpen && isMenuBig) {
        $(".sidebar-wrapper").removeClass("full-width");
        isMenuBig = false
    }
}

window.onresize = reportWindowSize


function closeMenu() {
    $(".sidebar-wrapper").toggleClass("width-set-sidebar");

    if (window.innerWidth <= 992) {
        $(".sidebar-wrapper").toggleClass("full-width");
        isMenuBig = true
    }

    if (isMenuOpen) {
        $(".sidebar-wrapper .show-menu-name").toggleClass("hide-menu-name");
        // $(".dashboard-header").css("width", "calc(100% - 70px)")
        //$(".dashboard-header").css("padding-right", "50px")
        $(".dashboard-header").removeClass("addpaddingforhome");
        $(".dashboard-header").addClass("addpaddingforhome50");
        $("#upgrade-alert").hide();
        isMenuOpen = false;
    } else {
        isMenuOpen = true;
        setTimeout(() => {
            $(".sidebar-wrapper .show-menu-name").toggleClass("hide-menu-name");
            // $(".dashboard-header").css("width", "calc(100% - 270px)")
            //$(".dashboard-header").css("padding-right", "270px");
            $(".dashboard-header").removeClass("addpaddingforhome50");
            $(".dashboard-header").addClass("addpaddingforhome");
            $("#upgrade-alert").show()
        }, 200)
    }

    $(".dashboard-header-spacer").toggleClass("active");
    $(".sidebar-wrapper .menu-close-icon").toggleClass("icon-rotate");
    $(".sidebar-wrapper .home-wrapper").toggleClass("border-none");
    $(".sidebar-wrapper .connection-wrapper").toggleClass("border-none");
    $(".sidebar-wrapper .home-icon").toggleClass("margin-left-none");
    $(".sidebar-wrapper .menu-icon").toggleClass("margin-left-none");
    $(".sidebar-wrapper .connection-icon").toggleClass("margin-left-none");
    $(".sidebar-wrapper .setting-icon").toggleClass("margin-left-none");
    $(".sidebar-wrapper .help-icon").toggleClass("margin-left-none");

}

$("#close-sidebar").click(closeMenu);
$("#small-icon-open").click(function(){
    $("#sidebar-mobile").toggleClass("d-none");
});

$("#show-sidebar").click(function () {
    $(".page-wrapper").toggleClass("toggled");
});


jQuery(function ($) {
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $('.sidebar-menu ul li a').each(function () {
        if (this.href === path) {
            $(this).addClass('active');
        }
    });
});

$(".create-new-ticket").click(function () {
    $(".create-ticket-button-col").hide();
    $(".create-ticket-new-row").show();
});

$(".close-ticket").click(function () {
    $(".create-ticket-button-col").show();
    $(".create-ticket-new-row").hide();
})


function parallax() {
    const s = document.querySelector(".header-features");

    if (!s) {
        return;
    }

    const yPos = 0 - window.pageYOffset / 115;


    if (yPos < 9) {
        s.style.top = 50 + yPos + "%";
    }

}

window.addEventListener("scroll", function () {
    parallax();
});


// Home page

const nameEnglishRegEx = /^([a-zA-Z\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF]+\s)+[a-zA-Z\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF]+$/;
const emailRegEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const arabicNameRegEx = /[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF]/;
const facilityRegEx = /^[a-zA-Z0-9\u0621-\u064A\u0660-\u0669\s]{2,}$/;
// const phoneRegEx = /^\d{1}\d{4}\d{4}\d{2}$/;
// const phoneRegExWithPlus = /^\+\d{1}\d{4}\d{4}\d{2}$/;
// const countryEnglishRegEx = /^[a-zA-Z]*$/;
// const countryArabRegEx = /[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF\s]/
let passCapcha = false;
let allSubscribeFormInputsAreValid = false;
const errorMap = ["Invalid number", "Invalid country code", "Your phone number is too short", "Your phone number is too long"];
const errorMapArab = ["رقم هاتفك غير صالح", "رمز بلدك غير صالح", "رقم هاتفك قصير جدًا", "رقم هاتفك طويل جدًا"];

let iti;

$(document).ready(() => {


    //
    // $('.iti__country').addEventListener('click', ()=>{
    //     validateInput('phone')
    // }  )


    if (window.hasOwnProperty('intlTelInputGlobals')) {
        window.intlTelInputGlobals.loadUtils("assets/js/input-phone/utils.js");
        iti = window.intlTelInput($(".subscribe .subscribe__input.phone")[0], {
            utilsScript: "assets/js/input-phone/utils.js",
            initialCountry: "ae",
        });
    }

    const $flagContainer = $(".iti__flag-container")

    if ($flagContainer.length) {
      $flagContainer[0].remove()
    }


    const $subscribeInputName = $(".subscribe .subscribe__input.name")

    if ($subscribeInputName.length) {
        $subscribeInputName[0].addEventListener('blur', (event) => {
            if (!nameEnglishRegEx.test($(".subscribe .subscribe__input.name")[0].value)) {
                $(".subscribe .subscribe__input.name")[0].classList.add('error-border');
                $(".subscribe .tooltip.name")[0].classList.add('show-tooltip')
                $(".subscribe .subscribe__submit")[0].classList.add('disabled')
                $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
            }
        })
    }

    const $subscribeInputEmail = $(".subscribe .subscribe__input.name")

    if ($subscribeInputEmail.length) {
        $subscribeInputEmail[0].addEventListener('blur', (event) => {
            if (!emailRegEx.test($(".subscribe .subscribe__input.email")[0].value)) {
                $(".subscribe .subscribe__input.email")[0].classList.add('error-border');
                $(".subscribe .tooltip.email")[0].classList.add('show-tooltip')
                $(".subscribe .subscribe__submit")[0].classList.add('disabled')
                $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
            }
        })
    }

    const $subscribeInputPhone = $(".subscribe .subscribe__input.phone")

    if ($subscribeInputPhone.length) {
        $subscribeInputPhone[0].addEventListener('blur', (event) => {
            if (!iti.isValidNumber() || !isPhoneNumberValid()) {
                let errorCode = iti.getValidationError();
                errorCode = errorMapArab[errorCode];
                $(".subscribe .tooltip.phone")[0].innerHTML = errorCode === undefined ? 'يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب' : errorCode;
                $(".subscribe .subscribe__input.phone")[0].classList.add('error-border');
                $(".subscribe .tooltip.phone")[0].classList.add('show-tooltip')
                $(".subscribe .subscribe__submit")[0].classList.add('disabled')
                $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
            }
        })
    }

    const $subscribeInputFacilityName = $(".subscribe .subscribe__input.facility-name")

    if ($subscribeInputFacilityName.length) {
        $subscribeInputFacilityName[0].addEventListener('blur', (event) => {
            if (!facilityRegEx.test($(".subscribe .subscribe__input.facility-name")[0].value)) {
                $(".subscribe .subscribe__input.facility-name")[0].classList.add('error-border');
                $(".subscribe .tooltip.facility-name")[0].classList.add('show-tooltip')
                $(".subscribe .subscribe__submit")[0].classList.add('disabled')
                $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
            }
        })
    }

    const $subscribeInputCountry = $(".subscribe .subscribe__input.country")

    if ($subscribeInputCountry.length) {
        $subscribeInputCountry[0].addEventListener('blur', (event) => {
            if ($(".subscribe .subscribe__input.country")[0].value === '') {
                $(".subscribe .subscribe__input.country")[0].classList.add('error-border');
                $(".subscribe .tooltip.country")[0].classList.add('show-tooltip')
                $(".subscribe .subscribe__submit")[0].classList.add('disabled')
                $(".subscribe .subscribe__input.country")[0].classList.add('placeholder-color');
                $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
            }
        })
    }


    $(".subscribe .subscribe__submit").click(function (event) {
        if (grecaptcha.getResponse() == "") {
            $(".subscribe .subscribe__submit")[0].classList.add('disabled')
            $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
        } else {
            if ($(".subscribe__submit.disabled").length === 0) {


                let phoneValue = $(".subscribe .subscribe__input.phone")[0].value

                phoneValue = iti.getSelectedCountryData().dialCode + phoneValue
                if (!iti.isValidNumber()) {
                    phoneValue = phoneValue.slice(iti.getSelectedCountryData().dialCode.length)
                }

                const sendetData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: $(".subscribe .subscribe__input.name")[0].value,
                    email: $(".subscribe .subscribe__input.email")[0].value,
                    phone: phoneValue,
                    facility_name: $(".subscribe .subscribe__input.facility-name")[0].value,
                    country: $(".subscribe .subscribe__input.country")[0].value,
                    comment: $(".subscribe .subscribe__input.textarea")[0].value,
                }

                fetch('/subscribe-mailchimp', {
                    method: 'post',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(sendetData)
                })

                $(".subscribe .subscribe__input.name")[0].value = '';
                $(".subscribe .subscribe__input.email")[0].value = '';
                $(".subscribe .subscribe__input.phone")[0].value = '';
                $(".subscribe .subscribe__input.facility-name")[0].value = '';
                $(".subscribe .subscribe__input.country")[0].value = '';
                $(".subscribe .subscribe__input.textarea")[0].value = '';

                allSubscribeFormInputsAreValid = false;
                passCapcha = false
                // $(".subscribe .modal-window")[0].classList.add('show')
                $(".subscribe .subscribe__input.country")[0].classList.add('placeholder-color');
                $(".subscribe .subscribe__submit")[0].classList.add('disabled');
                $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true');
                window.location.href = '/subscription-successful'
            }
        }
    })
})

function validateInput(inputType) {
    switch (inputType) {
        case 'name':
            $(".subscribe .subscribe__input.name")[0].classList.remove('error-border');
            $(".subscribe .tooltip.name")[0].classList.remove('show-tooltip')
            if ($(".subscribe .subscribe__input.name")[0].value[0] === ' ' && $(".subscribe .subscribe__input.name")[0].value.length > 0) {

                $(".subscribe .subscribe__input.name")[0].value = $(".subscribe .subscribe__input.name")[0].value.split('').slice(1).join('')
            }
            break;
        case 'email':
            $(".subscribe .subscribe__input.email")[0].classList.remove('error-border');
            $(".subscribe .tooltip.email")[0].classList.remove('show-tooltip')
            break;
        case 'phone':
            $(".subscribe .subscribe__input.phone")[0].classList.remove('error-border');
            $(".subscribe .tooltip.phone")[0].classList.remove('show-tooltip')

            if (iti.getValidationError() === 3) {
                $(".subscribe .subscribe__input.phone")[0].value = $(".subscribe .subscribe__input.phone")[0].value.split('').slice(0, -1).join('')
            }

            $(".subscribe .subscribe__input.phone")[0].value = $(".subscribe .subscribe__input.phone")[0].value.split('').map((letter) => {
                if (NUMBERS_LIST.includes(letter)) {
                    return letter
                }
                return ''

            }).join('')

            if (!NUMBERS_LIST.includes($(".subscribe .subscribe__input.phone")[0].value[$(".subscribe .subscribe__input.phone")[0].value.length - 1])) {
                $(".subscribe .subscribe__input.phone")[0].value = $(".subscribe .subscribe__input.phone")[0].value.split('').slice(0, -1).join('')
            }
            break;
        case 'facilityName':
            $(".subscribe .subscribe__input.facility-name")[0].classList.remove('error-border');
            $(".subscribe .tooltip.facility-name")[0].classList.remove('show-tooltip')
            break;
        case 'country':
            $(".subscribe .subscribe__input.country")[0].classList.remove('error-border');
            $(".subscribe .tooltip.country")[0].classList.remove('show-tooltip')
            if ($(".subscribe .subscribe__input.country")[0].value !== '') {
                $(".subscribe .subscribe__input.country")[0].classList.remove('placeholder-color')
            }
            break;
    }

    if (checkAllInputsValid() === false) {
        allSubscribeFormInputsAreValid = false

        $(".subscribe .subscribe__submit")[0].classList.add('disabled')
        $(".subscribe .subscribe__submit")[0].setAttribute('disabled', 'true')
    }

}

function checkAllInputsValid() {
    if ($(".subscribe .subscribe__input.name")[0].value.length > 0) {

        if (!nameEnglishRegEx.test($(".subscribe .subscribe__input.name")[0].value)) {

            return false
        }
    } else {

        return false
    }

    if ($(".subscribe .subscribe__input.email")[0].value.length > 0) {
        if (!emailRegEx.test($(".subscribe .subscribe__input.email")[0].value)) {

            return false
        }
    } else {

        return false
    }

    if (($(".subscribe .subscribe__input.phone")[0].value.length > 0)) {
        if (!iti.isValidNumber()) {
            return false
        }
    } else {

        return false
    }

    if ($(".subscribe .subscribe__input.facility-name")[0].value.length === 0) {

        return false
    }

    if ($(".subscribe .subscribe__input.country")[0].value.length === 0) {

        return false
    }

    allSubscribeFormInputsAreValid = true;

    if (!passCapcha) {
        return false
    }

    $(".subscribe .subscribe__submit")[0].classList.remove('disabled')
    $(".subscribe .subscribe__submit")[0].removeAttribute('disabled')

    return true
}

function capchaResponse() {
    passCapcha = true;

    checkAllInputsValid()
    if (allSubscribeFormInputsAreValid) {
        $(".subscribe .subscribe__submit")[0].classList.remove('disabled')
        $(".subscribe .subscribe__submit")[0].removeAttribute('disabled')
    }
}

function isPhoneNumberValid() {
    if (iti.isValidNumber()) {
        return !!iti.getSelectedCountryData().dialCode;
    }
}

function check() {
    setTimeout(() => {
        const countryLength = $('.iti__country').length;

        for (let i = 0; i < countryLength; i++) {
            $('.iti__country')[i].addEventListener('click', () => {
                validateInput('phone')
            })
        }
    }, 50)
}