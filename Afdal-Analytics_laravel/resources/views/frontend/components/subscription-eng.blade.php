<div class='eng'>
<section class="subscription-section">
    <h2 class="subscription-title font-48-lh-56-semi-bold">
        {{__('Join Our Newsletter')}}
    </h2>

    <p class="subscription-text font-24-lh-28-medium">
        {{__('Gain first hand updates, resources, and most recent guides on how to grow your business and product, all curated for the Arabic Market')}}
    </p>

    <form class="subscription-form" onsubmit="subscribe(this, event)">
        
        <input class="subscription-input font-20-lh-42-medium order-2-en"
               type="text"
               name="email"
               placeholder="{{__('Your Email')}}"
        >

        <button
            class="orange-button subscription-orange-button font-20-lh-42-semi-bold" type="submit">
            {{__('JOIN')}}
        </button>
        <div class="tooltip email font-16-lh-19-regular">
            يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
        </div>
        
        <button class="blog-page-success-modal font-40-lh-45-bold">
            {{__("Successful")}}
        </button>
    </form>

</section>
</div>

<script>
    const buttonD = document.querySelector('.subscription-orange-button');
    const subrInput = document.querySelector('.subscription-input');

    // buttonD.disabled = true;

    subrInput.addEventListener("change", stateHandle);

    function stateHandle() {
        if (subrInput.value.length <= 3) {
            // buttonD.disabled = true;
        } else {
            buttonD.disabled = false;
        }
    }
</script>
<script>
    function subscribe(event, e) {
        e.preventDefault();
        if($('.subscription-input').val() != ''){
            const emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            const inputElement = event.parentElement.querySelector('.subscription-input');
            const tooltip = $(".tooltip.email")[0];
            const modal = $(".blog-page-success-modal")[0];
            let emailInputValue = $('.subscription-input').val();

            let sendData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: emailInputValue,
            }

            if (emailRegEx.test(inputElement.value)) {
                //send data to back

                inputElement.classList.remove('border-danger')
                tooltip.classList.remove('show-tooltip')
                inputElement.value = ''

                modal.classList.add('show')
                setTimeout(() => {
                    modal.classList.remove('show')
                }, 3000)

                try {
                    fetch('/subscribe-mailchimp', {
                        method: 'post',
                        headers: {
                            "Content-type": "application/json; charset=UTF-8",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify(sendData)
                    })
                    toastr.success("{{__('Thank you')}}");
                } catch (e) {
                    toastr.warning("{{__('Error')}}");
                }


            } else {
                inputElement.classList.add('border-danger')
                tooltip.classList.add('show-tooltip')
            }
        }
    }
</script>
