<div class="container-fluid main-content-wrapper twitter-wrapper">
  <div class="row">
    <div class="col-12">
      <div class="card smallest-card-height d-flex justify-content-center align-items-center">
        <div class="card-body text-right">
          <p class="font-45-lh-54-medium">{{$connect_name}}</p>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-12">
            <div class="tab-pane active " id="ads-page">
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <div class="card small-card-height">
                            <div class="card-body  text-right">
                                <div class="top-content">
                                    <p class="font-24-lh-32 card__title">{{__('Total Followers ')}} </p>
                                    <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of people who follow your account')}}</p>
                                </div>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <!-- <img src="{{{url('/assets/image_new/svg/colored/new-followers.svg')}}}"> -->
                                        <svg style="height: 50px;transform: translateY(-9px);margin-inline-end: 37px;" width="61" height="49" viewBox="0 0 58 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28 0.749307C29.5961 0.765002 31.1519 1.25266 32.4714 2.15087C33.7909 3.04907 34.8151 4.31765 35.4151 5.79683C36.015 7.27601 36.1638 8.89964 35.8427 10.4632C35.5216 12.0268 34.7451 13.4604 33.6108 14.5835C32.4765 15.7065 31.0353 16.4689 29.4686 16.7744C27.9019 17.0799 26.2798 16.9151 24.8067 16.3005C23.3335 15.6859 22.0752 14.6492 21.1901 13.3208C20.305 11.9925 19.8328 10.4319 19.833 8.83571C19.8382 7.76849 20.0537 6.71276 20.467 5.7288C20.8803 4.74484 21.4833 3.85192 22.2417 3.10103C23.0001 2.35013 23.8989 1.75597 24.887 1.35246C25.875 0.948951 26.9328 0.743999 28 0.749307ZM11.667 6.52515C12.923 6.51959 14.157 6.85479 15.2376 7.49507C14.8969 10.7713 15.8422 14.0518 17.8741 16.6443C17.3145 17.7536 16.4688 18.6934 15.4245 19.3665C14.3801 20.0396 13.175 20.4217 11.9336 20.4732C10.6922 20.5247 9.45955 20.2438 8.36304 19.6595C7.26653 19.0752 6.34591 18.2088 5.69632 17.1496C5.04673 16.0905 4.69173 14.8771 4.66799 13.6349C4.64425 12.3927 4.95264 11.1666 5.5613 10.0834C6.16995 9.00026 7.05679 8.09925 8.13018 7.47351C9.20357 6.84776 10.4246 6.51998 11.667 6.52403V6.52515ZM12.833 30.2053C12.833 25.4229 19.6224 21.541 28 21.541C36.3776 21.541 43.167 25.4251 43.167 30.2053V34.2485H12.833V30.2053ZM0 34.2507V30.7855C0 27.5744 4.41056 24.8707 10.3835 24.0856C8.93084 25.7915 8.14366 27.9649 8.16704 30.2053V34.2485H0V34.2507Z" fill="#F58B1E"/>
                                            <path d="M50.9898 2.01203C50.9898 1.46011 50.5424 1.0127 49.9905 1.0127C49.4386 1.0127 48.9912 1.46011 48.9912 2.01203V16.0007C48.9912 16.5526 49.4386 17 49.9905 17C50.5424 17 50.9898 16.5526 50.9898 16.0007V2.01203Z" fill="#F58B1E"/>
                                            <path d="M58.001 9.00031C58.001 9.29293 57.8847 9.57357 57.6778 9.78048C57.4709 9.9874 57.1903 10.1036 56.8977 10.1036H43.1046C42.812 10.1036 42.5314 9.9874 42.3245 9.78048C42.1175 9.57357 42.0013 9.29293 42.0013 9.00031C42.0013 8.70768 42.1175 8.42705 42.3245 8.22013C42.5314 8.01322 42.812 7.89697 43.1046 7.89697L56.8977 7.89697C57.1903 7.89697 57.4709 8.01322 57.6778 8.22013C57.8847 8.42705 58.001 8.70768 58.001 9.00031V9.00031Z" fill="#F58B1E"/>
                                        </svg>
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                      <p class="mb-2 font-13-lh-16-medium card__total-title">{{__('Followers ')}}</p>
                                      <h3 class="font-37-lh-44-bold font-42 mb-0 card__total-title-count">{{!empty($total_followers) ? $total_followers : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <p class="font-24-lh-32 card__title">{{__('New Followers')}}</p>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of new people who follow your account')}}</p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <!-- <img src="{{{url('/assets/image_new/svg/colored/new-likes.svg')}}}"> -->
                                        <svg width="61" height="49" style="height: 50px;transform: translateY(-9px);margin-inline-end: 37px;" viewBox="0 0 61 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.8562 0.500144C24.1563 0.522632 26.3982 1.22138 28.2997 2.50839C30.2011 3.7954 31.677 5.6131 32.5415 7.73257C33.406 9.85203 33.6205 12.1785 33.1578 14.4189C32.6951 16.6593 31.576 18.7134 29.9415 20.3227C28.307 21.9319 26.2301 23.0242 23.9725 23.462C21.7148 23.8998 19.3774 23.6635 17.2545 22.7829C15.1316 21.9023 13.3183 20.4168 12.0429 18.5134C10.7675 16.6101 10.087 14.374 10.0872 12.0869C10.0948 10.5577 10.4053 9.04497 11.0009 7.63509C11.5964 6.22521 12.4655 4.94577 13.5583 3.86984C14.6512 2.79391 15.9464 1.94256 17.3702 1.36438C18.794 0.786207 20.3183 0.492538 21.8562 0.500144ZM0 42.7066C0 35.8541 9.7838 30.2918 21.8562 30.2918C33.9286 30.2918 43.7124 35.8573 43.7124 42.7066V48.5H0V42.7066Z" fill="#F58B1E"/>
                                            <path d="M54.7932 9.96124C53.0544 9.96124 51.4981 10.8019 50.5278 12.0914C49.5575 10.8019 48.0012 9.96124 46.2623 9.96124C43.313 9.96124 40.9209 12.3494 40.9209 15.3011C40.9209 16.4378 41.1034 17.4886 41.4205 18.4629C42.9383 23.2391 47.6169 26.0953 49.9322 26.8786C50.2588 26.9932 50.7968 26.9932 51.1234 26.8786C53.4387 26.0953 58.1172 23.2391 59.6351 18.4629C59.9521 17.4886 60.1347 16.4378 60.1347 15.3011C60.1347 12.3494 57.7426 9.96124 54.7932 9.96124Z" fill="#F58B1E"/>
                                        </svg>

                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('New followers')}}</p>
                                        <h3 class="font-37-lh-44-bold font-42 mb-0 card__total-title-count">{{!empty($new_followers) ? $new_followers : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                        <div class="card big-card-height">
                            <div class="card-body text-right">
                                <p class="font-24-lh-32 card__title">{{__('Followers')}}  </p>
                                <p class="font-16-lh-19-regular card__title-text">{{__('The total count of followers daily over the set period')}}</p>
                                <div id="followersChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <p class="font-24-lh-32 card__title">{{__('Total Engagements')}}</p>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('Total number of times a user interacted with a Tweet')}}</p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <!-- <img
                                            src="{{{url('/assets/image_new/svg/colored/new-entries.svg')}}}"> -->
                                            <svg width="56" height="61" style="height: 50px;transform: translateY(-9px);margin-inline-end: 37px;" viewBox="0 0 56 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28 26.7493C29.5961 26.765 31.1519 27.2527 32.4714 28.1509C33.7909 29.0491 34.8151 30.3177 35.4151 31.7969C36.015 33.276 36.1638 34.8997 35.8427 36.4632C35.5216 38.0268 34.7451 39.4604 33.6108 40.5835C32.4765 41.7066 31.0353 42.4689 29.4686 42.7744C27.9019 43.08 26.2798 42.9151 24.8067 42.3005C23.3335 41.6859 22.0752 40.6492 21.1901 39.3208C20.305 37.9925 19.8328 36.4319 19.833 34.8357C19.8382 33.7685 20.0537 32.7128 20.467 31.7288C20.8803 30.7449 21.4833 29.8519 22.2417 29.1011C23.0001 28.3502 23.8989 27.756 24.887 27.3525C25.875 26.949 26.9328 26.744 28 26.7493V26.7493ZM11.667 32.5252C12.923 32.5196 14.157 32.8548 15.2376 33.4951C14.8969 36.7713 15.8422 40.0518 17.8741 42.6444C17.3145 43.7537 16.4688 44.6934 15.4245 45.3665C14.3801 46.0397 13.175 46.4217 11.9336 46.4732C10.6922 46.5247 9.45955 46.2438 8.36304 45.6595C7.26653 45.0753 6.34591 44.2088 5.69632 43.1497C5.04673 42.0905 4.69173 40.8772 4.66799 39.6349C4.64425 38.3927 4.95264 37.1666 5.5613 36.0835C6.16995 35.0003 7.05679 34.0993 8.13018 33.4735C9.20357 32.8478 10.4246 32.52 11.667 32.524V32.5252ZM44.3341 32.524C45.562 32.5333 46.7654 32.8686 47.8211 33.4956C48.8769 34.1227 49.7472 35.0189 50.3429 36.0926C50.9387 37.1663 51.2385 38.3791 51.2117 39.6067C51.1849 40.8343 50.8325 42.0328 50.1905 43.0796C49.5485 44.1263 48.64 44.9837 47.5579 45.5641C46.4758 46.1445 45.2589 46.427 44.0318 46.3827C42.8046 46.3384 41.6113 45.969 40.5738 45.3121C39.5363 44.6553 38.6919 43.7346 38.127 42.6444C40.1603 40.0528 41.1072 36.7727 40.768 33.4962C41.8486 32.8559 43.0826 32.5207 44.3386 32.5263L44.3341 32.524ZM12.833 56.2053C12.833 51.4229 19.6224 47.541 28 47.541C36.3776 47.541 43.167 51.4252 43.167 56.2053V60.2485H12.833V56.2053ZM0 60.2508V56.7855C0 53.5744 4.41056 50.8708 10.3835 50.0856C8.93084 51.7915 8.14366 53.9649 8.16704 56.2053V60.2485H0V60.2508ZM56 60.2485H47.833V56.2053C47.8572 53.9637 47.0699 51.789 45.6165 50.0823C51.5894 50.8663 56 53.5711 56 56.7821V60.2485Z" fill="#F58B1E"/>
                                            <path d="M15.6217 0.941177H6.43249C3.89627 0.941177 1.83789 3.1056 1.83789 5.77473V11.5789V12.5495C1.83789 15.2186 3.89627 17.383 6.43249 17.383H7.81086C8.05897 17.383 8.38978 17.5577 8.546 17.7712L9.92438 19.7027C10.5309 20.5568 11.5233 20.5568 12.1298 19.7027L13.5082 17.7712C13.6828 17.5286 13.9584 17.383 14.2433 17.383H15.6217C18.1579 17.383 20.2163 15.2186 20.2163 12.5495V5.77473C20.2163 3.1056 18.1579 0.941177 15.6217 0.941177Z" fill="#F58B1E"/>
                                            <path d="M13.1739 5.29167C12.4197 5.29167 11.7447 5.65834 11.3239 6.22084C10.9031 5.65834 10.2281 5.29167 9.47389 5.29167C8.19473 5.29167 7.15723 6.33334 7.15723 7.62084C7.15723 8.11667 7.23639 8.57501 7.37389 9.00001C8.03223 11.0833 10.0614 12.3292 11.0656 12.6708C11.2072 12.7208 11.4406 12.7208 11.5822 12.6708C12.5864 12.3292 14.6156 11.0833 15.2739 9.00001C15.4114 8.57501 15.4906 8.11667 15.4906 7.62084C15.4906 6.33334 14.4531 5.29167 13.1739 5.29167Z" fill="white"/>
                                            <path d="M49.6217 0.941177H40.4325C37.8963 0.941177 35.8379 3.1056 35.8379 5.77473V11.5789V12.5495C35.8379 15.2186 37.8963 17.383 40.4325 17.383H41.8109C42.059 17.383 42.3898 17.5577 42.546 17.7712L43.9244 19.7027C44.5309 20.5568 45.5233 20.5568 46.1298 19.7027L47.5082 17.7712C47.6828 17.5286 47.9584 17.383 48.2433 17.383H49.6217C52.1579 17.383 54.2163 15.2186 54.2163 12.5495V5.77473C54.2163 3.1056 52.1579 0.941177 49.6217 0.941177Z" fill="#F58B1E"/>
                                            <path d="M43.6445 12.3012V8.19232C43.6445 8.03055 43.6905 7.87283 43.7747 7.73937L44.82 6.09746C44.9846 5.83459 45.3943 5.64856 45.7427 5.78606C46.118 5.91951 46.3668 6.36437 46.2864 6.76069L46.0873 8.08313C46.072 8.20445 46.1026 8.31364 46.1677 8.39857C46.2328 8.47541 46.3285 8.52394 46.4319 8.52394H48.0056C48.308 8.52394 48.5684 8.65335 48.7216 8.87982C48.8671 9.0982 48.8939 9.38129 48.7981 9.66843L47.8562 12.6975C47.7375 13.199 47.2207 13.6074 46.7076 13.6074H45.2144C44.9578 13.6074 44.5979 13.5144 44.4333 13.3405L43.9432 12.9401C43.7556 12.7905 43.6445 12.5519 43.6445 12.3012Z" fill="white"/>
                                            <path d="M42.4273 7.4037H42.0329C41.4395 7.4037 41.1982 7.64635 41.1982 8.24488V12.3133C41.1982 12.9118 41.4395 13.1545 42.0329 13.1545H42.4273C43.0208 13.1545 43.262 12.9118 43.262 12.3133V8.24488C43.262 7.64635 43.0208 7.4037 42.4273 7.4037Z" fill="white"/>
                                            </svg>

                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Engaged Users')}}</p>
                                        <h3 class="font-37-lh-44-bold font-42  mb-0 card__total-title-count">{{!empty($engagement) ? $engagement : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <p class="font-24-lh-32 card__title">{{__('Engagement Rate')}} </p>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of engagements divided by impressions')}} </p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/group-percent.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Engagements   ')}} </p>
                                        <h3 class="font-37-lh-44-bold font-42 mb-0 card__total-title-count">{{!empty($engagement_rate) ? $engagement_rate : 0}}%</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="card small-card-height">
                            <div class="card-body text-right">
                                <p class="font-24-lh-32 card__title">{{__('Total Tweets')}} </p>
                                <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of tweets posted to account')}}</p>
                                <div class="d-flex-dashbard-data" id="mybasis">
                                    <div class="dashboard-data-1 text-left">
                                        <img
                                            src="{{{url('/assets/image_new/svg/colored/single-like.svg')}}}">
                                    </div>
                                    <div class="dashboard-data-2 text-right">
                                        <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Tweets')}}</p>
                                        <h3 class="font-37-lh-44-bold font-42 mb-0 card__total-title-count">{{!empty($total_tweets) ? $total_tweets : 0}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 col-xs-12">
                    <div class="card big-card-height overflow-auto">
                        <div class="card-body text-right justify-content-start">

                            <p class="font-24-lh-32 card__title">{{__('Tweet Performance')}}</p>
                            <p class="font-16-lh-19-regular mb-3 card__title-text">{{__('The top-performing tweets based on engagement count')}}</p>
                            <div class="my-table table-responsive">
                                @if(!empty($tweets) && count($tweets)>0)
                                <table class="table table-twitter">
                                    <thead>
                                    <tr>
                                        <th scope="col"
                                            class="font-16-lh-19-semi-bold">{{__('Tweet')}}</th>
                                        <th scope="col"
                                            class="font-16-lh-19-semi-bold">{{__('Engagement')}}</th>
                                        <th scope="col"
                                            class="font-16-lh-19-semi-bold">{{__('Retweets')}}</th>
                                        <th scope="col"
                                            class="font-16-lh-19-semi-bold">{{__('Favorites')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($tweets as $tweet)
                                      <tr>
                                          <th scope="row">{{$tweet->text}}</th>
                                          <td class="font-13-lh-20-regular">{{$tweet->engagement}}</td>
                                          <td class="font-13-lh-20-regular">{{$tweet->retweet}}</td>
                                          <td class="font-13-lh-20-regular">{{$tweet->favorites}}</td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <p class="text-center dashboard-notposts">
                                        {{__("Here will be your list of posts")}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-12">
                    <div class="card small-card-height">
                      <div class="card-body text-right">
                          <p class="font-24-lh-32 card__title">{{__('Total Retweets')}} </p>
                          <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The number of times your tweets have been shared')}} </p>
                          <div class="d-flex-dashbard-data" id="mybasis">
                              <div class="dashboard-data-1 text-left">
                                  <img
                                      src="{{{url('/assets/image_new/svg/colored/retweet.svg')}}}">
                              </div>
                              <div class="dashboard-data-2 text-right">
                                <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Retweets')}} </p>
                                <h3 class="font-37-lh-44-bold font-42 mb-0 card__total-title-count"> {{!empty($total_retweets) ? $total_retweets : 0}} </h3>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="card small-card-height">
                    <div class="card-body text-right">
                        <p class="font-24-lh-32 card__title">{{__('Favorites')}} </p>
                        <p class="font-16-lh-19-regular mb-0 card__title-text">{{__('The total number of like of all the tweets')}} </p>
                        <div class="d-flex-dashbard-data" id="mybasis">
                            <div class="dashboard-data-1 text-left">
                                <img
                                    src="{{{url('/assets/image_new/svg/colored/heart.svg')}}}">
                            </div>
                            <div class="dashboard-data-2 text-right">
                              <p class="mb-1 font-13-lh-16-medium card__total-title">{{__('Likes')}} </p>
                              <h3 class="font-37-lh-44-bold font-42 mb-0 card__total-title-count"> {{!empty($total_favorites) ? $total_favorites : 0}} </h3>
                          </div>
                        </div>
                    </div>
                </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.components.topup')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    let graphData = @if(!empty($new_followers_per_day)) @json($new_followers_per_day) @else [] @endif;
    console.log(graphData);

// Data
    var getDaysArray = function(start, end) {
        for(var arr=[],dt=new Date(start); dt<=new Date(end); dt.setDate(dt.getDate()+1)){
            arr.push(new Date(dt));
        }
        return arr;
    };

    let followersData = {
      female: Object.values(graphData),
      dates: Object.keys(graphData),
    };



    if(followersData.dates.length === 0){
        var daylist = getDaysArray(new Date(date_from),new Date(date_to));
        for(let i = 0; i<daylist.length; i++){
            let month1 = (daylist[i].getMonth()+1).toString();
            let day1 = daylist[i].getDate().toString();
            const date1 = `${month1}/${day1}`;
            followersData.female.push(0);
            followersData.dates.push(date1)
        }
    }
// Followers chart

let followersColWidth = '85%';

if (followersData.female.length < 17) {
  followersColWidth = (followersData.female.length * 5) + '%';
};

var followersOptions = {
  series: [{
    name: '{{__('Female')}}',
    data: followersData.female,
  }],
  chart: {
    height: 280,
    width: '93%',
    type: 'bar',
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false,
    },
  },
  dataLabels: {
    enabled: false
  },
  colors: ['#F58B1E'],
  stroke: {
    curve: 'smooth',
    width: 2,
  },
  stroke: {
    show: false,
  },
  xaxis: {
    type: '',
    categories: followersData.dates.map(date => {
      if(date.length === 10) {
        return date.slice(5)
      };
      return date;
    }),
    labels: {
      style: {
          colors: '#B0BBCB',
      },
    },
  },
  yaxis: [
    // {
    //   labels: {
    //   align: 'left',
    //     offsetX: 28,
    //     style: {
    //       colors: '#B0BBCB',
    //     },
    //     },
    // },
    {
        opposite: true,
        labels: {
            align: 'right',
            offsetX: 15,
            style: {
                colors: '#B0BBCB',
            },
        },
    }
  ],
  plotOptions: {
    bar: {
        horizontal: false,
        columnWidth: followersColWidth,
        borderRadius: 8,
    },
  },
  legend: {
    show: true,
    fontSize: '14px',
    fontFamily: 'NotoSansArabic-Regular',
    fontWeight: 400,
    position: 'top',
    horizontalAlign: 'left',
    inverseOrder: 'true',
  },
  markers: {
    size: [3, 3],
    colors: ['#fff', '#fff'],
    strokeColors: ['#F58B1E', '#356792'],
    hover: {
        sizeOffset: 2,
    }
  },
  tooltip: {
    x: {
        format: 'dd/MM/yy HH:mm'
    },
  },
  noData: {
    text: '{{__('No data available')}}',
    align: 'center',
    verticalAlign: 'middle',
    offsetX: 0,
    offsetY: 0,
    style: {
      color: undefined,
      fontSize: '18px',
      fontFamily: 'NotoSansArabic-Regular'
    }
  },
};

const followersChart = new ApexCharts(document.querySelector("#followersChart"), followersOptions);
followersChart.render();
</script>
<script>
    window.dispatchEvent(new Event('resize'));
</script>
