<header class="registration-header">
  @if(!empty($return_route))
  <a class="registration-header-back-button" href="{{url()->previous()}}">
    <p class="registration-header-back-text font-16-lh-26-medium mb-0" style="margin-inline-end:5px">
      {{__("Back")}}
    </p>
    <div class="registration-header-back-icon"></div>
    
  </a>
  @endif
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
  <div class="registration-header-logo-wrapper">
    @if($get_locale == 'ar')
    <a href="{{env('APP_URL')}}" class="registration-header-logo"></a>
    @else
    <a href="{{env('APP_URL')}}" class="registration-header-logo-eng"></a>
    @endif
    
  </div>
</header>
