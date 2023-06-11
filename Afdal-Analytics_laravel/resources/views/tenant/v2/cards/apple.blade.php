<button type="button" class="position-relative d-flex flex-column justify-content-center align-items-center bg-transparent connections-connector-wrapper">
    <span>
        <svg width="45" height="49" viewBox="0 0 45 49" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M35.7296 25.1138C35.7308 23.1849 36.2112 21.2865 37.1275 19.5891C38.0439 17.8917 39.3675 16.4484 40.9795 15.3891C40.0105 13.8961 38.697 12.6578 37.1497 11.7783C35.6023 10.8987 33.8663 10.4038 32.0878 10.3351C28.348 9.92159 24.7192 12.6887 22.812 12.6887C20.8685 12.6887 17.9349 10.3758 14.7725 10.4435C12.6956 10.5342 10.6797 11.1732 8.9297 12.2955C7.17974 13.4179 5.75812 14.9835 4.80933 16.8333C0.500889 24.6769 3.71445 36.2031 7.84345 42.5435C9.90838 45.6487 12.3209 49.1154 15.4799 48.9932C18.5695 48.8588 19.7277 46.9222 23.4553 46.9222C27.15 46.9222 28.2336 48.9932 31.4549 48.916C34.7708 48.8597 36.8591 45.7952 38.8513 42.664C40.341 40.436 41.4812 37.9932 42.2321 35.4203C40.2637 34.5204 38.6003 33.0663 37.4454 31.2358C36.2905 29.4053 35.6943 27.2779 35.7296 25.1138Z" fill="black" />
            <path d="M28.2153 6.11678C29.638 4.40992 30.3389 2.21554 30.1692 0C27.9968 0.228954 25.9901 1.26727 24.5483 2.90842C23.843 3.7109 23.3029 4.64465 22.959 5.65618C22.615 6.66772 22.4741 7.73717 22.5441 8.80327C23.6311 8.8139 24.7063 8.57763 25.6886 8.11226C26.671 7.6469 27.5349 6.96459 28.2153 6.11678Z" fill="black" />
        </svg>
    </span>
    <p class="m-0 primary-text-color connector-primary-name">{{__('Apple')}}</p>
    @include('tenant.v2.cards.coming-soon',['get_locale'=>$get_locale])
</button>