<div class="pay-range-block monthly-range">
    <div class="monthly-wrapper">
        <div class="check-mark--orange"></div>
        <p class="pay-monthly monthly font-20-lh-23-medium">
            {{__('Pay Monthly')}}
        </p>
    </div>
    <div class="radio monthly">
        <div class="radio-dot monthly"></div>
    </div>
    <div class="annually-wrapper">
        <p class="pay-annually monthly font-20-lh-42-regular">{{__('Pay Annually')}}</p>
        <p class="two-month-block monthly font-20-lh-42-regular">{{__('2 months for free')}}</p>
        <div class="check-mark--blue transparent"></div>
    </div>
</div>
<script>
    let paymentPeriod = "monthly";


    const switchButton = document.querySelector('.radio');

    switchButton.addEventListener('click', () => {
        switchPaymentPeriod()
    });

    function openFaq(event) {
        let textWrapper = event.querySelector('.about-pricing-faq-list-item-text-wrapper');
        let icon = event.querySelector('.about-pricing-faq-list-item-icon');

        textWrapper.classList.toggle('hide')
        icon.classList.toggle('closed')
    }
</script>
