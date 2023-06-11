@if(env('APP_ENV') !== "production")
    <div class="language-selector dropup" style="display: none;">
  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
       @php $locale = session()->get('locale'); @endphp
       @switch($locale)
    @case('ar')
    Arabic
    @break
    @case('en')
    English
    @break
    @default
    Arabic
    @endswitch
    <span class="caret"></span>
  </a>

  <div class="languages">
  <ul class="dropdown-menu languages" aria-labelledby="languages">
    <li class="d-block"><a href="/lang/en"> English </a></li>
    <li  class="d-block"><a href="/lang/ar"> Arabic </a></li>
  </ul>
  </div>
</div>
@endif
