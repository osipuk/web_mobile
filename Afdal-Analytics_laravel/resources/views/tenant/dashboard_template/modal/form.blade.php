<p class="font-24-lh-29-medium">{{__('Select one of your connectors')}}</p>
@if (count($social_accounts))
    <form class="mb-5" style="margin-top: 20px;" action="{{ url('dashboard/create') }}" method="POST" name="dashboardForm" id="dashboardForm">
        @csrf
        <input type="hidden" name="name" value="{{ $type }}">
        <div class="px-4 conections-scroll">
        {{-- move logic to model controller from view--}}
        @foreach($social_accounts as $account)
            @if(in_array($account->provider_name, ['instagram', 'facebook']) && count($account->page))
                <div class="row"><b>{{ $account->full_name }}</b></div>
                @foreach($account->page as $page)
                    <div class="row input-container">
                        <input type="radio" name="page_id" id="checkbox-button-{{$page->id}}" class="cursor-p"
                               value="{{ $page->id }}"
                               @if($page->id == $dashboard_page_id) checked @endif
                        />
                        <label for="checkbox-button-{{$page->id}}"><p class="mr-1 mb-0 cursor-p">{{ $page->name }}</p></label>
                    </div>
                @endforeach
            @elseif($account->provider_name == 'facebookAds' && count($account->ads_account))
                <div class="row"><b>{{ $account->full_name }}</b></div>
                @foreach($account->ads_account as $account)
                    <div class="row input-container">
                        <input type="radio" name="ads_account_id" id="checkbox-button-{{$account->id}}" class="cursor-p"
                               value="{{ $account->id }}"
                               @if($account->id == $dashboard_page_id) checked @endif/>
                        <label for="checkbox-button-{{$account->id}}"><p class="mr-1 mb-0 cursor-p">{{ $account->name }}</p></label>
                    </div>
                @endforeach
            @elseif(in_array($account->provider_name, ['googleAnalytics', 'google-analytics-ua']) && count($account->google_analytics_account))
                <div class="row"><b>{{ $account->full_name }}</b></div>
                @foreach($account->google_analytics_account as $gaAccount)
                        <div class="row input-container">{{ $gaAccount->name }}</div>
                        @foreach($gaAccount->properties as $property)
                            <div class="row input-container">
                                @if(!empty($propery->profiles))
                                    <div class="row input-container">{{ $property->name }}</div>
                                    @foreach($propery->profiles as $profile)
                                        <div class="row input-container">
                                        <input type="radio" name="google_analytics_profile_id" id="checkbox-button-{{$profile->id}}" class="cursor-p"
                                               value="{{ $profile->id }}"
                                               @if($profile->id == $dashboard_page_id) checked @endif
                                        />
                                        <label for="checkbox-button-{{$profile->id}}"><p class="mr-1 mb-0 cursor-p">{{ $profile->name }}</p></label>
                                        </div>
                                    @endforeach
                                @else
                                <input type="radio" name="google_analytics_property_id" id="checkbox-button-{{$property->id}}" class="cursor-p"
                                       value="{{ $property->id }}"
                                       @if($property->id == $dashboard_page_id) checked @endif
                                />
                                <label for="checkbox-button-{{$property->id}}"><p class="mr-1 mb-0 cursor-p">{{ $property->name }}</p></label>
                                @endif
                            </div>
                        @endforeach
                @endforeach
            @elseif($account->provider_name == 'googleAds' && count($account->google_ads_account))
                    <div class="row"><b>{{ $account->full_name }}</b></div>
                    @foreach($account->google_ads_account as $adsAccount)
                        <div class="row input-container">
                            <input type="radio" name="google_ads_account_id" id="checkbox-button-{{$adsAccount->id}}" class="cursor-p"
                                   value="{{ $adsAccount->id }}"
                                   @if($adsAccount->id == $dashboard_page_id) checked @endif
                            />
                            <label for="checkbox-button-{{$adsAccount->id}}"><p class="mr-1 mb-0 cursor-p">{{ $adsAccount->name !== "" ?  $adsAccount->name : $adsAccount->provider_id}}</p></label>
                        </div>
                    @endforeach
            @else
                <div class="row input-container">
                    <input type="radio" name="social_account_id" id="checkbox-button-{{$account->id}}" class="cursor-p"
                           value="{{ $account->id }}"
                           @if($account->id == $social_account_id) checked @endif
                    />
                    <label for="checkbox-button-{{$account->id}}"><p class="mr-1 mb-0 cursor-p">{{ $account->full_name }}</p></label>
                </div>
            @endif
        @endforeach
        </div>
        <div class="text-center mb-3">
            <button type="submit" style="margin-top:20px;" name="submit" class="Add-dash font-18-lh-22-regular">
                {{__('Add Dashboard')}}
            </button>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#dashboardForm").on('submit', function(event) {
                document.querySelector('.Add-dash').disabled = true
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(data)
                    {
                        if (data.status == true) {
                            toastr.success(data.message);
                            setTimeout(function(){
                                document.location = "{{ url('dashboard/' . $type) }}";
                            }, 1000);
                        } else {
                            toastr.warning(data.message);
                        }
                    }
                });
                event.preventDefault();
            });
        });
    </script>
@else
    <div class="text-center" style="margin-top:20px;">
        <p style="margin:auto;width: 109px;color: #8797AF;">
            {{__("Can't find what you're looking for")}}
        </p>
        <a href="{{ url('dashboard/connections') }}" class="addConn">{{__('Add New Connector')}}</a>
    </div>
@endif
