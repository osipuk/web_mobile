@if ($paginator->hasPages())
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
    <div class="analytics-blog-pages-list font-22-lh-28-bold">
        @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="analytics-blog-pages-btn-prev prev"><div style="display: inline-block;"></div>{{__("Previous")}} </a>
        @endif

        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                            <span class="analytics-blog-page-number page-number-active">{{ $page }}</span>
                    @else
                            <span class="analytics-blog-page-number"><a href="{{ $url }}">{{ $page }}</a></span>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="analytics-blog-pages-btn-next next">{{__("Next")}}<div style="display: inline-block; @if($get_locale=='ar') transform: rotate(180deg); @endif"></div> </a>
        @endif

    </div>

    <p class="analytics-blog-pages-info-block font-13-lh-17-semi-bold">
            <span class="analytics-blog-pages-info-from">
                {{$paginator->firstItem()}} - {{$paginator->lastItem()}}
            </span>
        <span class="analytics-blog-pages-info-to">
        &nbsp; {{__('of')}} {{$paginator->total()}}  {{__('posts')}}
                
            </span>
    </p>
@endif
