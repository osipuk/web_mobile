<section class="latest-news-section">
    <div class="latest-news-title-wrapper">
        <h2 class="latest-news-title font-48-lh-67-semi-bold">
            {{__('Blogs')}}
        </h2>
        <a class="latest-news-all-button font-18-lh-38-semi-bold" href="/blog">
            {{__('See all')}}
        </a>
    </div>
    @if(!empty($blogs))
    <div class="latest-news-title-wrapper">
        <ul class="latest-news-list">
            @foreach ($blogs as $blog)
            <li class="latest-news-card">
                <a href="{{url('/blog/'.$blog->category->seo_url.'/' . $blog->seo_url)}}" style="text-decoration: none">
                    <img class="latest-news-card-image" loading="lazy" src="{{url(!empty($blog->image) ? '/storage/' . $blog->image : '/assets/image_new/svg/colored/image-placeholder.svg')}}" alt="Image placeholder">

                    <div class="latest-news-card-text">

                        <p class="latest-news-card-info font-13-lh-17-semi-bold blog-latest-news-card-text">
                            @if(!empty($blog->date) && !empty($blog->category->name))
                            {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y') . " - " }}
                            {{$blog->category->name}}
                            @elseif(!empty($blog->date))
                            {{\Carbon\Carbon::parse($blog->date)->translatedFormat('j F Y')}}
                            @elseif(!empty($blog->category->name))
                            {{$blog->category->name}}
                            @endif
                            {{-- {{ !empty($blog->date) ? date('F j, Y', strtotime($blog->date)) . ' - ' : '' . __(strtoupper($blog->category->name))}}--}}

                        </p>

                        <h3 class="font-22-lh-28-bold" style="padding-bottom: 20px;">
                            {{$blog->title}}
                        </h3>

                        <p class="latest-news-card-subtitle font-15-lh-17-medium">
                            {!! Str::limit($blog->description, 250) !!}
                        </p>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</section>
