@include('layout.userhead')


<main class="glossary-page">
    {{-- @include('frontend.components.header-circle') --}}
    @include('frontend.components.header-menu')
    <div class="header-circle-wrapper glossary-header-circle">
        <div class="header-circle"></div>
    </div>
    <div class="glossary-page-search-block">
        <h1 class="glossary-page-search-title font-64-lh-89-semi-bold">
            {{__("Analytics & Marketing Terms")}}
            <br>
            {{__('Defined For You')}}
        </h1>
        <form class="glossary-page-search-form">
            <input class="glossary-page-search-input font-20-lh-42-regular" maxlength="40" type="text" placeholder="{{__(" Call to action")}}" oninput="search(this)" />
            <button type="button" class="glossary-page-search-button font-20-lh-42-semi-bold">
                {{__("Search")}}
                <div class="glossary-page-search-icon"></div>
            </button>
        </form>
        <section class="glossary-page-main-content">
            <div class="glossary-page-glossary-bar">
                <p class="glossary-page-glossary-bar-jump-to font-13-lh-27-semi-bold">
                    {{__("JUMP TO")}}
                </p>
                <div class="glossary-page-glossary-alphabet" onclick="changeGlossaryLetter(event)">
                    <a onclick="smoothScroll('ا')" class="glossary-page-glossary-letter current a 1s ا font-22-lh-28-bold">ا</a>
                    <a onclick="smoothScroll('ب')" class="glossary-page-glossary-letter b 2s ب font-22-lh-28-bold">ب</a>
                    <a onclick="smoothScroll('ت')" class="glossary-page-glossary-letter c 3s ت font-22-lh-28-bold">ت</a>
                    <a onclick="smoothScroll('ث')" class="glossary-page-glossary-letter d 4s ث font-22-lh-28-bold">ث</a>
                    <a onclick="smoothScroll('ج')" class="glossary-page-glossary-letter e 5s ج font-22-lh-28-bold">ج</a>
                    <a onclick="smoothScroll('ح')" class="glossary-page-glossary-letter f 6s ح font-22-lh-28-bold">ح</a>
                    <a onclick="smoothScroll('خ')" class="glossary-page-glossary-letter g 7s خ font-22-lh-28-bold">خ</a>
                    <a onclick="smoothScroll('د')" class="glossary-page-glossary-letter h 8s د font-22-lh-28-bold">د</a>
                    <a onclick="smoothScroll('ذ')" class="glossary-page-glossary-letter i 9s ذ font-22-lh-28-bold">ذ</a>
                    <a onclick="smoothScroll('ر')" class="glossary-page-glossary-letter j 10s ر font-22-lh-28-bold">ر</a>
                    <a onclick="smoothScroll('ز')" class="glossary-page-glossary-letter k 11s ز font-22-lh-28-bold">ز</a>
                    <a onclick="smoothScroll('س')" class="glossary-page-glossary-letter l 12s س font-22-lh-28-bold">س</a>
                    <a onclick="smoothScroll('ش')" class="glossary-page-glossary-letter m 13s ش font-22-lh-28-bold">ش</a>
                    <a onclick="smoothScroll('ص')" class="glossary-page-glossary-letter n 14s ص font-22-lh-28-bold">ص</a>
                    <a onclick="smoothScroll('ض')" class="glossary-page-glossary-letter o 15s ض font-22-lh-28-bold">ض</a>
                    <a onclick="smoothScroll('ط')" class="glossary-page-glossary-letter p 16s ط font-22-lh-28-bold">ط</a>
                    <a onclick="smoothScroll('ظ')" class="glossary-page-glossary-letter q 17s ظ font-22-lh-28-bold">ظ</a>
                    <a onclick="smoothScroll('ع')" class="glossary-page-glossary-letter r 18s ع font-22-lh-28-bold">ع</a>
                    <a onclick="smoothScroll('غ')" class="glossary-page-glossary-letter 19s s غ font-22-lh-28-bold">غ</a>
                    <a onclick="smoothScroll('ف')" class="glossary-page-glossary-letter 20s ss ف font-22-lh-28-bold">ف</a>
                    <a onclick="smoothScroll('ق')" class="glossary-page-glossary-letter 21s t ق font-22-lh-28-bold">ق</a>
                    <a onclick="smoothScroll('ك')" class="glossary-page-glossary-letter 22s u ك font-22-lh-28-bold">ك</a>
                    <a onclick="smoothScroll('ل')" class="glossary-page-glossary-letter 23s v ل font-22-lh-28-bold">ل</a>
                    <a onclick="smoothScroll('م')" class="glossary-page-glossary-letter 24s w م font-22-lh-28-bold">م</a>
                    <a onclick="smoothScroll('ن')" class="glossary-page-glossary-letter 25s x ن font-22-lh-28-bold">ن</a>
                    <a onclick="smoothScroll('ه')" class="glossary-page-glossary-letter 26s y ه font-22-lh-28-bold">ه</a>
                    <a onclick="smoothScroll('و')" class="glossary-page-glossary-letter 27s z و font-22-lh-28-bold">و</a>
                    <a onclick="smoothScroll('ي')" class="glossary-page-glossary-letter 28s zz ي font-22-lh-28-bold">ي</a>
                </div>
                <div class="glossary-page-glossary-bar-share-page-block">
                    <p class="glossary-page-glossary-bar-share-page-title font-13-lh-27-semi-bold">
                        {{__("SHARE THIS PAGE")}}
                    </p>
                    <div class="glossary-page-glossary-bar-share-page-icons-block">

                        <a href="mailto:?body={{Request::url()}} ." class="glossary-page-glossary-bar-share-page-icon email"></a>
                        @foreach($socialShare as $key => $value)
                        @switch($key)

                        @case($key == "linkedin")
                        <a href="{{$value}}" id="share-linkedin" class="glossary-page-glossary-bar-share-page-icon linkedin" target="_blanc"></a>
                        @break

                        @case($key == "twitter")
                        <a href="{{$value}}" id="share-twitter" class="glossary-page-glossary-bar-share-page-icon twitter" target="_blanc"></a>
                        @break

                        @case($key == "facebook")
                        <a href="{{$value}}" id="share-facebook" class="glossary-page-glossary-bar-share-page-icon facebook" target="_blanc"></a>
                        @break
                        @endswitch
                        @endforeach
                        {{-- <a class="glossary-page-glossary-bar-share-page-icon instagram" --}} {{-- href="https://www.instagram.com/afdalanalytics/" target="_blanc"></a>--}}
                    </div>
                </div>
            </div>
            <div class="glossary-page-content" id="glossary-page-content">
                <div class="glossary-page-content-letter-wrapper ا">
                    <div id="ا" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold a 1 ا">ا</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ب">
                    <div id="ب" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 2 b ب">ب</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ت">
                    <div id="ت" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 3 c ت">ت</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ث">
                    <div id="ث" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 4 d ث">ث</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ج">
                    <div id="ج" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 5 e ج">ج</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ح">
                    <div id="ح" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 6 f ح">ح</p>
                </div>
                <div class="glossary-page-content-letter-wrapper خ">
                    <div id="خ" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 7 g خ">خ</p>
                </div>
                <div class="glossary-page-content-letter-wrapper د">
                    <div id="د" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold h 8 د">د</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ذ">
                    <div id="ذ" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold i 9 ذ">ذ</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ر">
                    <div id="ر" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold j 10 ر">ر</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ز">
                    <div id="ز" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold k 11 ">ز</p>
                </div>
                <div class="glossary-page-content-letter-wrapper س">
                    <div id="س" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold 12 l">س</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ش">
                    <div id="ش" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold m 13 ش">ش</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ص">
                    <div id="ص" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold n 14 ص">ص</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ض">
                    <div id="ض" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold o 15 ض">ض</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ط">
                    <div id="ط" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold p 16 ط">ط</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ظ">
                    <div id="ظ" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold q 17 ظ">ظ</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ع">
                    <div id="ع" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold r 18 ع">ع</p>
                </div>
                <div class="glossary-page-content-letter-wrapper غ">
                    <div id="غ" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold s 19 غ">غ</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ف">
                    <div id="ف" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold ss 20 ف">ف</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ق">
                    <div id="ق" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold t 21 ق">ق</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ك">
                    <div id="ك" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold u 22 ك">ك</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ل">
                    <div id="ل" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold v 23 ل">ل</p>
                </div>
                <div class="glossary-page-content-letter-wrapper م">
                    <div id="م" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold w 24 م">م</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ن">
                    <div id="ن" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold x 25 ن">ن</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ه">
                    <div id="ه" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold y 26 ه">ه</p>
                </div>
                <div class="glossary-page-content-letter-wrapper و">
                    <div id="و" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold z و 27">و</p>
                </div>
                <div class="glossary-page-content-letter-wrapper ي">
                    <div id="ي" class="glossary-page-anchor"></div>
                    <p class="glossary-page-content-title-letter font-72-lh-84-bold zz ي 28">ي</p>
                </div>
            </div>
        </section>
    </div>


    <div class="product-page-wrapper-position-relative glossary-footer-circle">
        <div class="footer-circle-wrapper">
        </div>
        <div class="footer-animation animated-circle-wrapper glossary-footer-animated-circle">
            <div class="footer-circle"></div>
            <div class="footer-circle-orange-small">
            </div>
            <div class="footer-circle-orange-medium">
            </div>
            <div class="footer-circle-orange-large">
            </div>
        </div>

        <section class="subscription-section glossary-subcr">
            <h2 class="subscription-title font-48-lh-100-semi-bold">
                {{__('Join Our Newsletter')}}
            </h2>

            <p class="subscription-text font-18-lh-25-medium">
                {{__('Gain first hand updates, resources, and most recent guides on how to grow your business and product, all curated for the Arabic Market')}}
            </p>

            <form class="subscription-form glossary-subscription-form">
                <input class="subscription-input font-20-lh-42-medium" type="text" name="email" placeholder="{{__('Your Email')}}">
                <div class="tooltip email font-16-lh-19-regular">
                    يرجى ملء هذا الحقل ببيانات صحيحة ، فهو مطلوب
                </div>
                <div onclick="subscribe(this)" class="orange-button subscription-orange-button glossary-subscription-btn font-20-lh-42-semi-bold" type="submit">
                    {{__('JOIN')}}
                </div>
                <div class="blog-page-success-modal font-40-lh-45-bold">
                    {{__("Successful")}}
                </div>
            </form>

            @include('frontend.components.topup')
        </section>
    </div>

    @include('frontend.components.loader')

</main>

@include('frontend.components.footer')
@include('frontend.components.cookie')
<script>
    let linkedin = $('#share-linkedin').attr('href');
    let twitter = $('#share-twitter').attr('href');
    let facebook = $('#share-facebook').attr('href');

    function smoothScroll(item){
        let titleItems = document.querySelectorAll('.glossary-page-content-title-letter');


        $('#share-linkedin').attr('href', linkedin);
        $('#share-twitter').attr('href', twitter);
        $('#share-facebook').attr('href', facebook);

        $('#share-linkedin').attr('href', $('#share-linkedin').attr('href') + "%23" + item);
        $('#share-twitter').attr('href', $('#share-twitter').attr('href') + "%23" + item);
        $('#share-facebook').attr('href', $('#share-facebook').attr('href') + "%23" + item);


        for(let i = 0; i<titleItems.length;i++){
            if(titleItems[i].innerHTML === item){
                titleItems[i].scrollIntoView({block: "center", behavior: "smooth"})
                return;
            }
        }
    }

    function subscribe(event) {

        const emailRegEx = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        const inputElement = event.parentElement.querySelector('.subscription-input');
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

<script>
    const likeData = @if(!empty($glossaries))@json($glossaries)@endif;
    let previousActive = null;
    let allTitles = []
    const arabicAlphabet = ['ا', 'أ', 'آ', 'إ', 'ب', 'ت', 'ث', 'ج', 'ح', 'خ', 'د', 'ذ',
        'ر', 'ز', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ك', 'ل',
        'م', 'ن', 'ه', 'و', 'ي'];
    const lettersToDisable = [...arabicAlphabet];
    let isClicked = false;
    let clickedTimer = null;


    $(document).ready(() => {
        let incorectData = []

        likeData.forEach(glossaryElem => {

            if(glossaryElem.title === '. طريقة العرض السريع') {

            }

            if (arabicAlphabet.includes(glossaryElem.title[0])) {
                const letterInd = lettersToDisable.indexOf(glossaryElem.title[0]);
                if (letterInd !== -1) {
                    lettersToDisable.splice(letterInd, 1);
                }

                let alphabetLetterBlock;
                switch (glossaryElem.title[0]) {
                    case('أ'):
                    case('آ'):
                    case('إ'):
                        alphabetLetterBlock = document.querySelector('.glossary-page-content-letter-wrapper.ا');
                        break
                    default:
                        alphabetLetterBlock = document.querySelector('.glossary-page-content-letter-wrapper.' + glossaryElem.title[0]);
                }

                const singleBlogPost = document.createElement("div");
                singleBlogPost.classList.add('glossary-page-content-item')
                singleBlogPost.innerHTML = '<div id="' + glossaryElem.id + '"' + ' class="glossary-page-anchor"></div>' +
                    '<h3 class="glossary-page-content-item-title  font-48-lh-56-semi-bold">' +
                    glossaryElem.title + '</h3>' +
                    '<p class="glossary-page-content-item-text font-18-lh-21-regular">' +
                    glossaryElem.description + '</p>'


                alphabetLetterBlock.appendChild(singleBlogPost);


                allTitles.push(glossaryElem.title)
                $('.glossary-page-glossary-letter.a')[0].classList.add('active')
            } else {
                incorectData.push(glossaryElem.title)
            }
        });
        let excluded = ['أ', 'آ', 'إ'];
        lettersToDisable.forEach((letter) => {
            if(excluded.includes(letter)){
                return;
            }
            $(`a[onclick*="smoothScroll('${letter}')"]`)[0].classList.add('disabled')
            $(".glossary-page-content-letter-wrapper." + `${letter}`).hide();
        })

    })

    function changeGlossaryLetter(event) {
        if(event.target.classList.contains('glossary-page-glossary-alphabet')) {
                return
        }

        isClicked = true;
        clickedTimer = setTimeout(() => {
        }, 150)
        // event.target.classList.add('current')

        if (previousActive && previousActive !== event.target) {
            previousActive.classList.remove('current')
        } else {
            $('.glossary-page-glossary-letter.a')[0].classList.remove('current')
        }
        previousActive = event.target;
    }


    let options = {
        rootMargin: '0px',
    }
    let disabled = []
    let a = document.querySelectorAll('.glossary-page-glossary-letter');
    for(let i = 0; i < a.length; i++){
        if(a[i].classList.contains('disabled')){
            disabled.push(a[i]);
        }
    }
    for(let i = 0; i < disabled.length; i++){
        let index = a.indexOf(disabled[i]);
        if (index !== -1) {
            a.splice(index, 1);
        }
    }

    let target = document.querySelectorAll('.glossary-page-content-title-letter');
    let observers = []
    for(let i = 0; i<target.length;i++){
        observers.push(new IntersectionObserver(function (entries, observer){
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    for(let i = 0; i<a.length;i++){
                        a[i].classList.remove('current');
                    }
                    a[i].classList.add('current');
                }

            });
        }, options));
    }
    for(let i = 0; i<observers.length;i++){
        observers[i].observe(target[i]);
    }

    function search(event) {

        const writeMoreLettersBlock = document.createElement("div");
        writeMoreLettersBlock.classList.add('glossary-page-suggestion-item')
        writeMoreLettersBlock.classList.add('more-letter')
        writeMoreLettersBlock.classList.add('font-24-lh-32-medium')
        writeMoreLettersBlock.innerHTML = '{{__("Type more words for get suggestions")}}'

        const falseSearchBlock = document.createElement("div");
        falseSearchBlock.classList.add('glossary-page-suggestion-item')
        falseSearchBlock.classList.add('false-search')
        falseSearchBlock.classList.add('font-24-lh-32-medium')
        falseSearchBlock.innerHTML = '{{__("Failed to search this text")}}'

        const singleSearchResultBlock = document.createElement("a");
        singleSearchResultBlock.classList.add('glossary-page-suggestion-item')
        singleSearchResultBlock.classList.add('font-24-lh-32-medium')

        const suggestionBlock = document.createElement("div")
        suggestionBlock.classList.add('glossary-page-suggestion-list')

        const form = $('.glossary-page-search-form')[0];
        const titles = $('.glossary-page-content-item-title')


        if (event.value !== '') {
            if (event.value.length < 3) {
                if (!$('.glossary-page-suggestion-list')[0]) {
                    form.appendChild(suggestionBlock)
                }

                clearAllSuggestions()

                $('.glossary-page-suggestion-list')[0].appendChild(writeMoreLettersBlock)

            } else {

                if ($('.glossary-page-suggestion-item.more-letter')[0]) {
                    $('.glossary-page-suggestion-item.more-letter')[0].remove();
                }
                if ($('.glossary-page-suggestion-item.search-false')[0]) {
                    $('.glossary-page-suggestion-item.search-false')[0].remove()
                }

                let searchResult = [];

                for (let i = 0; i < titles.length; i++) {
                    const headerText = titles[i].innerHTML;

                    if (headerText.includes(event.value)) {
                        searchResult.push(titles[i])

                    }
                }

                if (searchResult.length > 0) {

                    clearAllSuggestions()

                    searchResult.forEach((headerText, index) => {
                        if (index < 10) {
                            const resultBLock = singleSearchResultBlock.cloneNode(true)

                            resultBLock.innerHTML = headerText.innerHTML.slice(0, headerText.innerHTML.indexOf(event.value)) + '<b>' + event.value + '</b>' + headerText.innerHTML.slice(headerText.innerHTML.indexOf(event.value )).replace(event.value, '');
                            resultBLock.setAttribute('href', '#' + headerText.parentElement.firstChild.id)

                            if (!$('.glossary-page-suggestion-list')[0]) {
                                form.appendChild(suggestionBlock)
                            }

                            $('.glossary-page-suggestion-list')[0].appendChild(resultBLock)
                        }
                    })
                } else {
                    $('.glossary-page-suggestion-list').html(falseSearchBlock)
                }
            }
        } else {
            $('.glossary-page-suggestion-list')[0].remove()
        }
    }

    function clearAllSuggestions() {
        const suggestionsItems = $('.glossary-page-suggestion-item')
        for (let i = 0; i < suggestionsItems.length; i++) {
            suggestionsItems[i].remove();
        }
    }


    $(window).scroll(function () {
        if(isClicked) {
                clearTimeout(clickedTimer);


                clickedTimer = setTimeout(() => {
                    isClicked = false;
                }, 150)

                return;
            }

            const id = ['#1', '#2', '#3', '#4', '#5', '#6', '#7', '#8', '#9',
                '#10', '#11', '#12', '#13', '#14', '#15', '#16', '#17', '#18', '#19', '#20', '#21', '#22', '#23',
                '#24', '#25', '#26', '#27', '#28']

            id.forEach((currentId) => {
                let searchedClass = '.' + currentId.slice(1)

                var hT = $(searchedClass).offset().top,
                    hH = $(searchedClass).outerHeight(),
                    wH = $(window).height(),
                    wS = $(this).scrollTop();


                searchedClass +='s'

                if (currentId === '#1') {
                    if (wS > (hT + hH - wH) && wS - (hT + hH - wH) < 1000) {

                        $('.current')[0].classList.remove('current')
                        $(searchedClass)[0].classList.add('current')
                        previousActive = $(searchedClass)[0];
                    }
                } else if (wS > (hT + hH - wH) && wS - (hT + hH - wH) < 150) {
                    $('.current')[0].classList.remove('current')
                    $(searchedClass)[0].classList.add('current')
                    previousActive = $(searchedClass)[0];
                }
            })

    });
</script>