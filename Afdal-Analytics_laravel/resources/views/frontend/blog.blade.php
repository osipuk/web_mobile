@include('layout.userhead')
@section('metahead')
    <link rel="shortcut icon" type="image/jpg" href="{{url('/assets/image_new/favicon.png')}}"/>
@endsection


<main class="blog-page">
    @include('frontend.components.header-circle')
    @include('frontend.components.header-menu')

    <h2 class="blog-page-title font-80-lh-106-semi-bold">
        {{!empty($blog->title) ? $blog->title : ''}}
    </h2>
    <p class="blog-page-text font-19-lh-25-semi-bold">
        {{__("With an always growing list of integrations, we get the data you need, and if it’s not there, request it and we will make it happen.")}}
    </p>
    <img class="blog-page-image"
         src="{{url(!empty($blog->image) ? '/storage/' . $blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}"
         alt="Placeholder image"
    >
    <p class="blog-page-content font-20-lh-25-semi-bold">
        {{!empty($blog->description) ? $blog->description : ''}}
    </p>


    <form class="blog-page-subscribe">
        <label for="email" class="blog-page-subscribe-text font-30-lh-50-bold">
            {{__("Get valuable insights right in your inbox.")}}
        </label>
        <div class="blog-page-input-wrapper">
            <input
                id="email"
                type="email"
                class="blog-page-input-email font-24-lh-32-medium"
                value=""
                name="email"
                maxlength="50"
                placeholder="{{__("Your Email")}}"
            >
            <div class="blog-page-subscribe-btn font-24-lh-32-bold"
                 onclick="subscribe(this)"
                 type="submit"
            >
                {{__("subscribe")}}
            </div>
            <div class="tooltip email font-16-lh-19-regular">
                يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
            </div>
            <div class="blog-page-success-modal font-45-lh-54-bold">
                {{__("Successful")}}
            </div>
        </div>
    </form>

@include('frontend.components.loader')

</main>


@include('frontend.components.footer')
@include('frontend.components.cookie')



<script>


    function subscribe(event) {
        const emailRegEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        const inputElement = event.parentElement.querySelector('.blog-page-input-email');
        const tooltip = $(".tooltip.email")[0];
        const modal = $(".blog-page-success-modal")[0];


        if (emailRegEx.test(inputElement.value)) {
            //send data to back

            inputElement.classList.remove('border-danger')
            tooltip.classList.remove('show-tooltip')
            inputElement.value = ''

            modal.classList.add('show')
            setTimeout(() => {
                modal.classList.remove('show')
            }, 3000)


        } else {
            console.log('not valid')
            inputElement.classList.add('border-danger')
            tooltip.classList.add('show-tooltip')
        }

    }
</script>
