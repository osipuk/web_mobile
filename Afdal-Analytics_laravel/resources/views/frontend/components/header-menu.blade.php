
    @php

        $get_locale = NULL;

        if( null !== session()->get('locale') ):
            if(session()->get('locale') == 'en'):
                $get_locale = 'en';
            else:
                $get_locale = 'ar';
            endif;

        else:
                $get_locale = 'ar';
        endif;
    @endphp 


    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <a class="navbar-brand" href="/">
            <img class=""
                src="{{url('/assets/image_new/svg/colored/afdal-logo.svg')}}"
                alt="{{__('Afdal Analytics Platform')}}">
        </a>
        <a class="navbar-brand-text" href="/">
        @if($get_locale == 'en')
            <img class=""
                src="{{url('/assets/image_new/svg/colored/afdal-logo-text-en.svg')}}" style="margin-top:10px;width: 239px;" 
                alt="{{__('Afdal Analytics Platform')}}">
        @else
            <img class=""
                src="{{url('/assets/image_new/svg/colored/afdal-logo-text.svg')}}"
                alt="{{__('Afdal Analytics Platform')}}">
        @endif
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/">{{__('Home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/about-afdal">{{__('Platform')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/why-us">{{__('Why Afdal')}}</a>
                </li>

                @if($get_locale == 'ar')
                <li class="nav-item submenu" >
                    <a class="nav-link font-20-lh-42-w400 text-white not-start  {{Request::path() == 'glossary' || Request::path() ==  'guides'|| Request::path() ==  'blog' ? 'active-nav-item' : ''}}"
                    href="#" id="navbarDropdownMenuLink"
                    onclick="subdropdown()"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{__('Resources')}}
                    </a>
                    <img class="header-chevron-down not-start"
                        src="{{url('/assets/image_new/svg/colored/chevron-down-white.svg')}}"
                        alt=""
                        onclick="subdropdown()"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        id="header-chevron-down">
                    <div class="dropdown-menu drop-header" aria-labelledby="navbarDropdownMenuLink">
                        <div class="header-element-triangle-up"></div>
                        <a class="dropdown-item second-menu-padding" href="/glossary" onclick="clearSubmenuStyles()">
                            <div class="dropdown-item-glossary-image"></div>
                            <p class="item-title font-20-lh-32-regular text-white {{Request::path() == 'glossary' ? 'active-nav-item' : ''}}">
                                {{__("Glossary  ")}}
                            </p>
                            <p class="item-text header-dropdown-glossary-text font-18-lh-22-regular text-white">
                                {{__('Marketing & Analytics terms defined for you')}}
                            </p>
                        </a>
                        <a class="dropdown-item second-menu-padding" href="/guides" onclick="clearSubmenuStyles()">
                            <div class="dropdown-item-guides-image"></div>
                            <p class="item-title font-20-lh-32-regular text-white {{Request::path() == 'guides' ? 'active-nav-item' : ''}}">
                                {{__("Guides    ")}}
                            </p>
                            <p class="item-text header-dropdown-guides-text font-18-lh-22-regular text-white">
                                {{__('Free marketing & analytics resources')}}
                            </p>
                        </a>
                        <a class="dropdown-item second-menu-padding" href="/blog" onclick="clearSubmenuStyles()">
                            <div class="dropdown-item-blog-image"></div>
                            <p class="item-title font-20-lh-32-regular text-white {{Request::path() == 'blog' ? 'active-nav-item' : ''}}">
                                {{__("Blogs ")}}
                            </p>
                            <p class="item-text header-dropdown-blog-text font-18-lh-22-regular text-white">
                                {{__('Recent news & product releases')}}
                            </p>
                        </a>
                    </div>
                </li>

                @endif
                <li class="nav-item" id="mainmenu-aftersub-item1">
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/pricing">{{__('Pricing')}}</a>
                </li>
                <li class="nav-item" id="mainmenu-aftersub-item2">
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/contact-us">{{__('Contact Us')}}</a>
                </li>



                <li class="nav-item" id="mainmenu-aftersub-item2">
                @if($get_locale == 'en')
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/lang/ar">العربية</a>
                @else
                    <a class="nav-link font-20-lh-42-w400 text-white" href="/lang/en">EN</a>
                @endif
                </li>


            </ul>
        </div>

        @guest
        <a href="/signup" class="btn btn-signup font-18-lh-22-semi-bold" role="button">{{__('Free Sign Up')}}</a>
        <a href="/login" class="btn btn-signin font-18-lh-22-semi-bold" style="margin-left:18px;" role="button">{{__('Sign In ')}}</a>

        @else
        <a href="/dashboard" class="btn btn-signup font-18-lh-22-semi-bold" role="button">{{__('Dashboards')}}</a>
        <a href="/logout" class="btn btn-signin font-18-lh-22-semi-bold" style="margin-left:18px;" role="button">{{__('Sign Out')}}</a>
        @endguest



        <button class="navbar-toggler not-start" type="button" data-toggle="collapse"
                onclick="clearSubmenuStyles();"
                data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

<div class="navbar-fake-wrapper"></div>

<script>
    const currentLoc = location.href;
    const link = document.querySelectorAll('.nav-link');
    const menuLeng = link.length
    for (let i = 0; i < menuLeng; i++) {
        if (link[i].href === currentLoc) {
            link[i].classList.add('active-nav-item')
        }
    }

    var secondDropDownPressed = false;
    $('body').click(function(event) {
        if (!$(event.target).closest(".not-start").length) {
            clearSubmenuStyles();
        }
    });
    function subdropdown() {
        console.log('subdropdown');
        let mediaQuery = window.matchMedia('(max-width: 1199px)');
        if (mediaQuery.matches) {
            secondDropDownPressed = !secondDropDownPressed;
            if (secondDropDownPressed) {
                $('#mainmenu-aftersub-item1').addClass('testtt');
                $('#header-chevron-down').addClass('header-chevron-down-anim-top');
            } else {
                $('#mainmenu-aftersub-item1').removeClass('testtt');
                $('#header-chevron-down').addClass('header-chevron-down-anim-bot');
                setTimeout(() => {
                    $('#header-chevron-down').removeClass('header-chevron-down-anim-top');
                    $('#header-chevron-down').removeClass('header-chevron-down-anim-bot');
                }, 500);
            }
        }
    }

    function clearSubmenuStyles() {
        $('#mainmenu-aftersub-item1').removeClass('testtt');
        $('#header-chevron-down').removeClass('header-chevron-down-anim-top');
        $('#header-chevron-down').removeClass('header-chevron-down-anim-bot');
        secondDropDownPressed = false;
    }
</script>
