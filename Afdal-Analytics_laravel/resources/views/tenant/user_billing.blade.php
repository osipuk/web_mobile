@extends('layout.userhead')

@section('css')

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

    @if($get_locale == 'en')
        <style type="text/css">
            .float-left{
                float: right!important;
            }
            .float-right{
                float: left!important;
            }

            .no-en-ml-24 {
                margin-left: 0px!important;
            }

            .text-align-left{
                text-align: right!important;
            }

            .text-align-right{
                text-align: left!important;
            }

            .mt-12-en{
                margin-top: 12px!important;
            }

            .ml-24-en{
                margin-left: 24px!important;
            }

            .mr-10-en{
                margin-right: 10px!important;
            }

            .pl-0-en{
                padding-left: 0px!important;
            }

            .ml-0-en{
                margin-left: 0px!important;
                text-align: left;

            }

            .text-right-en{
                margin-left: 30px;
            }

            .mr-15-percent-en{
                margin-right: 15%;
            }

            .text-left-en{
                text-align: left!important;
            }

            
        </style>
    @endif

    <style type="text/css">
        .text-light{
            color:#737F96!important;
        }

    
        .user-billing-history{
            width: 58%;
        }

        .user-billing-details{
            width: 39%;
        }
    </style>


    
@endsection


@section('metahead')
    <title>{{__("User Billing")}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{!! asset('assets/image_new/favicon.png')  !!}"/>
@endsection

<body class="user-billing-page">
@include('layout.usersidenav')
<div class="user-billing-content-wrapper">
    @include('tenant.components.settings-header')

    <main class="user-billing-main">
        <div class="user-billing-history padding-0 border-radius-0 shadow-none">

            <div class="custom-bg-grey-light padding-20-40 border-radius-10 shadow-display">
            <h2 class="user-billing-history-title font-24-lh-28-medium">
                <span class="text-light float-right" style="color: #737F96;">{{__('Your Subscription')}}  </span>

                <button data-toggle="modal" data-target="#edit-subscription"
                        class="font-18-lh-21-regular float-left btn btn-link btn-link-warning" type="button">
                    {{__('Edit Subscription')}}
                </button>
            </h2>


                @if($subscription_data || Auth::user()->trial())
                    <div class="user-billing-subscription-package">
                        <div class="user-billing-subscription-package-image"></div>
                        <p class="user-billing-subscription-text font-16-lh-19-light">
                            <span style="color: #0B243A;font-family: 'Segoe UI';font-style: normal;font-weight: 400;font-size: 22px;line-height: 29px;">{{__($user_plan_name)}}</span> <br/> 
                            <span style="font-family: 'Segoe UI';font-style: normal;font-weight: 600;font-size: 18px;line-height: 24px;color: #707070;">{{__('Number of connections') . ': ' . UserPlanHelper::subscription_info()->connections}}</span>
                        </p>
                    </div>


                    <div class="user-billing-subscription-users">
                        @if($subscription_info)
                            <p style="font-family: 'Segoe UI';font-style: normal;font-weight: 600;font-size: 18px;line-height: 24px;color: #0B243A;">
                                ${{$subscription_info['next_payment_full']}}
                            </p>
                        @elseif(auth()->user()->company->onTrial())
                            <p style="font-family: 'Segoe UI';font-style: normal;font-weight: 600;font-size: 18px;line-height: 24px;color: #0B243A;">{{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}</p>
                        @else
                            <p style="font-family: 'Segoe UI';font-style: normal;font-weight: 600;font-size: 18px;line-height: 24px;color: #0B243A;">{{__('No plan')}}</p>
                        @endif
                    </div>
                @else
                    <div class="user-billing-subscription-package">
                        <div class="user-billing-subscription-package-image"></div>
                        <p class="user-billing-subscription-text" style="font-family: 'Segoe UI';font-style: normal;font-weight: 600;font-size: 18px;line-height: 24px;color: #0B243A;">
                            {{__('No plan')}}
                        </p>
                    </div>
                @endif
            </div>


        <div class="display-flex display-block-mobile">
            <div class="padding-50-40 mt-24 border-radius-10 shadow-display ml-24 no-en-ml-24 width-50 width-100-mobile">
            
                <h2 class="user-billing-history-title margin-bottom-30 font-24-lh-28-medium list-background-white">
                    <span class="text-dark float-right" style="font-size: 18px;">{{__('Features')}} </span>

                    <button data-toggle="modal" data-target="#edit-subscription"
                            class="font-16-lh-21-regular float-left btn btn-link btn-link-warning" style="padding: 0px;" type="button">
                        {{__('Upgrade')}}
                    </button>
                </h2>


                <div class="user-billing-history-title margin-bottom-10">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__('Number of Users')}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">   
                    @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Trial')
                    5
                    @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                    {{__("Unlimited")}}
                    @endif
                    </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-light">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Minimum Connection")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">{{$number_of_links}} </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-white">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Data Guarantee")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                        @if($user_plan_name == 'Essentials Plan')
                        -
                        @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                        <i class="fas fa-check" style="color: #f7993a!important;"></i>
                        @else
                        -
                        @endif
                    </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-light">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Data Volume")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                        @if($user_plan_name == 'Essentials Plan')
                        {{__("10 Gig")}}
                        @elseif($user_plan_name == 'Plus Plan' || $user_plan_name == 'Enterprise Plan')
                        <i class="fas fa-check" style="color: #f7993a!important;"></i>
                        @else
                        {{__("Unlimited")}}
                        @endif
                    </div>

                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-white">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Roles & Permissions Control")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Essentials Plan' || $user_plan_name == 'Plus Plan')
                    -
                    @elseif($user_plan_name == 'Enterprise Plan')
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @else
                    -
                    @endif    
                    </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-light">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__('Custom Dashboards')}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                        @if($user_plan_name == 'Essentials Plan')
                        -
                        @elseif($user_plan_name == 'Plus Plan')
                        {{__('Per Connection')}}
                        @elseif($user_plan_name == 'Enterprise Plan')
                        {{__("Unlimited")}}
                        @else
                        -
                        @endif 
                    </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-white">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Prebuilt Templates")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Trial')
                    -
                    @else
                    {{__("Unlimited")}}
                    @endif   
                    </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-light">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Knowledge Base")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Trial')
                    -
                    @else
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @endif  
                    </div>
                </div>


                <div class="user-billing-history-title margin-bottom-10 list-background-white">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Guided Setup ")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Trial')
                    -
                    @else
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @endif 
                    </div>
                </div>
                <!-- <div class="user-billing-history-title margin-bottom-10 list-background-white">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__('Monthly team Training')}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Enterprise Plan')
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @else
                    -
                    @endif 
                    </div>
                </div> -->

                <div class="user-billing-history-title margin-bottom-10 list-background-light">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Live chat and Email Support")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Trial')
                    -
                    @else
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @endif 
                    </div>
                </div>
                <div class="user-billing-history-title margin-bottom-10 list-background-white">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__("Video Support")}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Trial' || $user_plan_name == 'Essentials Plan')
                    -
                    @else
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @endif 
                    </div>
                </div>
                <div class="user-billing-history-title margin-bottom-10 list-background-light">
                    <span class="text-dark">
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.38321 9.02571C5.7898 8.5058 3.7274 6.74368 0.428711 7.56241C0.428711 7.56241 4.31043 9.68478 6.74623 14.5C8.79244 10.2114 12.0667 3.72302 16.0001 0.5C9.99984 2.98298 7.03943 7.72832 6.38321 9.02593V9.02571Z" fill="#2DA771"/>
                        </svg>
                        {{__('Monthly team Training')}}
                    </span>
                    <div class="font-16-lh-21-regular float-left">
                    @if($user_plan_name == 'Trial' || $user_plan_name == 'Essentials Plan')
                    -
                    @else
                    <i class="fas fa-check" style="color: #f7993a!important;"></i>
                    @endif 
                    </div>
                </div>
            </div>

            <div class="padding-50-40 mt-24 border-radius-10 shadow-display width-50 width-100-mobile ml-24-en" style="min-height: 350px; ">
            
                <h2 class="user-billing-history-title margin-bottom-10 font-24-lh-28-medium list-background-white">
                    <span class="text-light" style="font-size: 18px;">{{__('Billing History')}} </span>
                </h2>
                @if($billing_history->isNotEmpty())
                <table cols="6" class="user-billing-spreadsheet">

                <tbody class="user-billing-transactions-list">
                    @php $tablestripe = 1; @endphp
                    @foreach($billing_history as $item)
                        <tr class="user-billing-transaction-item @if($tablestripe%2 == 0) list-background-light @endif">
                            <td class="user-billing-transaction-date font-14-lh-16-light">
                                {{ $item->date }}
                            </td>
                            <td class="user-billing-transaction-amount font-14-lh-16-light">
                                ${{ $item->amount }}
                            </td>
                            <td class="user-billing-transaction-status mt-12-en">
                                @if($item->invoice_pdf !== 'test')
                                    <a href="{{ $item->invoice_pdf }}" class="user-billing-invoice-button"></a>
                                @else
                                    <a href="{{ url('/invoice/' . $item->transaction_id) }}" target="_blank" class="user-billing-invoice-button"></a>
                                @endif

                                @if($item->status === 'paid' || 'APPROVED')
                                    <div class="text-success font-13-lh-15-medium mr-auto text-align-left w-100">
                                        {{__('SUCCESSFUL')}}
                                    </div>
                                @else
                                    <div class="text-success font-13-lh-15-medium mr-auto text-align-left w-100">
                                        {{__('FAILED')}}
                                    </div>
                                @endif
                                
                            </td>
                        </tr>
                        @php $tablestripe++; @endphp

                    @endforeach

                    </tbody>
                </table>
                @else
                    <img src="{{url('/assets/image_new/svg/invoice-user-profile.svg')}}">   
                    <span class="empty-billing mt-3 text-dark">{{__('You have not made any payments')}}</span>
                @endif
            </div>
        </div>
        </div>


        <div class="user-billing-details">
            <div class="user-billing-subscription-details">

                <div class="user-billing-subscription-package box-shadow" style="align-items: normal;">
                    <div >
                    <svg width="46" height="41" viewBox="0 0 46 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.8442 14.7071L20.1815 13.7537C20.8489 14.1827 21.5639 14.5641 22.3268 14.7071C26.3794 15.6131 30.0026 12.7047 30.2411 8.84307C30.2411 8.65251 30.0981 8.46162 29.9072 8.46162H24.1862C23.9956 8.46162 23.8523 8.31862 23.8523 8.12773V2.40669C23.8523 2.21613 23.6617 2.02524 23.4708 2.0728C19.6091 2.26336 16.7008 5.88696 17.6068 9.9871C17.7022 10.3685 17.8452 10.75 17.9882 11.0836L16.3194 13.9918C16.1288 14.3736 16.4627 14.8026 16.8442 14.7071H16.8442Z" fill="#447097"/>
                        <path d="M25.8064 6.88854H31.5274C31.718 6.88854 31.9089 6.69798 31.8613 6.50709C31.6708 3.26529 29.0961 0.643028 25.8542 0.5C25.6637 0.5 25.4728 0.643002 25.4728 0.833893V6.55492C25.4249 6.74548 25.6158 6.88849 25.8064 6.88849L25.8064 6.88854Z" fill="#447097"/>
                        <path d="M11.7417 10.4165C11.7417 12.4704 10.0768 14.1352 8.02292 14.1352C5.96903 14.1352 4.3042 12.4704 4.3042 10.4165C4.3042 8.36258 5.96903 6.69775 8.02292 6.69775C10.0768 6.69775 11.7417 8.36258 11.7417 10.4165Z" fill="#447097"/>
                        <path d="M11.9801 30.8218H7.02193C5.7346 30.8218 4.68573 29.9159 4.4476 28.6286L2.96939 19.141C2.87395 18.5211 2.30194 18.0922 1.68206 18.1876C1.06217 18.283 0.633184 18.8551 0.728621 19.4749L2.20649 28.9625C2.58794 31.3463 4.59029 33.0626 6.97409 33.0626H11.9322C12.5521 33.0626 13.0765 32.5381 13.0765 31.9183C13.0765 31.3459 12.6 30.8215 11.9801 30.8215V30.8218Z" fill="#447097"/>
                        <path d="M15.5558 26.054H12.1231L11.6941 20.0469C12.9336 20.7619 14.2685 21.1912 15.6988 21.1912H18.7976C19.5605 21.1912 20.228 20.5713 20.228 19.7608C20.228 18.9979 19.6081 18.3305 18.7976 18.3305H15.7463C14.7929 18.3305 13.7915 18.0445 12.9811 17.52L10.1683 15.7082C9.64388 15.3268 9.02403 15.1362 8.30897 15.1362H7.78452C6.78315 15.1362 5.87765 15.5652 5.21019 16.3281C4.54272 17.091 4.25675 18.0445 4.39974 19.0458L5.78217 28.0566C5.92517 28.867 6.64017 29.487 7.451 29.487H13.601C13.887 29.487 14.1255 29.6775 14.173 29.9639L15.7939 38.8793C15.9369 39.6897 16.6519 40.2617 17.4628 40.2617C17.5582 40.2617 17.6533 40.2617 17.7488 40.2141C18.6547 40.0711 19.2746 39.1653 19.1312 38.2593L17.1764 27.4369C17.0813 26.6261 16.4138 26.0541 15.5558 26.0541L15.5558 26.054Z" fill="#447097"/>
                        <path d="M42.445 10.4165C42.445 12.4704 40.7802 14.1352 38.7263 14.1352C36.6724 14.1352 35.0076 12.4704 35.0076 10.4165C35.0076 8.36258 36.6724 6.69775 38.7263 6.69775C40.7802 6.69775 42.445 8.36258 42.445 10.4165Z" fill="#447097"/>
                        <path d="M45.0666 18.1876C44.4467 18.0922 43.8747 18.5215 43.7793 19.141L42.3014 28.6286C42.1108 29.9159 41.014 30.8218 39.727 30.8218L34.7686 30.8215C34.1487 30.8215 33.6243 31.3459 33.6243 31.9658C33.6243 32.5856 34.1487 33.1101 34.7686 33.1101H39.7267C42.1105 33.1101 44.1604 31.3938 44.4943 29.01L45.9722 19.5225C46.1155 18.855 45.6862 18.2827 45.0666 18.1875V18.1876Z" fill="#447097"/>
                        <path d="M39.2498 29.4391C40.1078 29.4391 40.7756 28.8192 40.9186 28.0087L42.301 18.998C42.444 18.0445 42.158 17.0432 41.4906 16.2803C40.8231 15.5174 39.9173 15.0884 38.9162 15.0884H38.3918C37.7243 15.0884 37.0569 15.3268 36.5324 15.6604L33.7196 17.5198C32.9092 18.0442 31.9557 18.3302 30.9544 18.3302H27.8557C27.0928 18.3302 26.4253 18.9501 26.4253 19.7606C26.4253 20.5235 27.0452 21.1909 27.8557 21.1909H31.002C32.4324 21.1909 33.8148 20.8095 35.0067 20.0466L34.5777 26.0537H31.145C30.3346 26.0537 29.6192 26.6257 29.4762 27.4361L27.5214 38.2586C27.3784 39.1645 27.9504 40.0704 28.9038 40.2134C28.9993 40.2134 29.0944 40.2609 29.1898 40.2609C30.0003 40.2609 30.7156 39.6889 30.8587 38.8785L32.4796 29.9631C32.5271 29.6771 32.7656 29.4862 33.0516 29.4862L39.2498 29.4391Z" fill="#447097"/>
                        <path d="M32.8149 23.6702C32.8149 23.0503 32.2905 22.5259 31.6706 22.5259H15.0794C14.4595 22.5259 13.9351 23.0503 13.9351 23.6702C13.9351 24.29 14.4595 24.8145 15.0794 24.8145H22.2784V39.3557C22.2784 39.9756 22.8028 40.5 23.4227 40.5C24.0425 40.5 24.567 39.9755 24.567 39.3557V24.7668H31.766C32.2904 24.7668 32.8148 24.2903 32.8148 23.6704L32.8149 23.6702Z" fill="#447097"/>
                        </svg>
                    </div>
                    
                    <p class="user-billing-subscription-text font-16-lh-19-light">
                        <span style="color:#737F96; font-size: 18px; font-weight:  bold;">{{__('Analytics consulting')}}</span>
                  
                        <br/>
                        <br/>
                        <span style="font-weight: 600;font-size: 16px;line-height: 21px;color: #0B243A;">{{__('Our marketing experts will help you understand your marketing performance, discover the strengths and weaknesses of your advertising campaigns, and increase your return on investment.')}}</span>
                        
                    </p>

                    <div class="user-billing-subscription-text font-16-lh-19-light" style="margin: auto;">
                        <span style="color:#0B243A;font-weight: 600;">$80/{{__('mo')}}</span>
                        <br/>
                        <p style="font-weight: 600;color: #0B243A;margin-top:3px">{{__('Monthly payment')}}</p>
                        <br/>
                        <br/>

                        @if($consulting_subscription_info == NULL)
                            <button data-toggle="modal" data-target="#analytics-consulting" class="user-billing-payment-button font-18-lh-21-regular btn btn-sm btn-primary" style="background-color: #0B243A;border-radius: 8px; border-color: #0B243A; font-size: 16px;width: 106px;height:40px;padding:0px" type="button">{{__('Start now')}}</button>
                        @else

                            {{--
                            <button data-toggle="modal" data-target="#analytics-consulting-end" class="user-billing-payment-button font-18-lh-21-regular btn btn-sm btn-primary" style="background-color: #0B243A; border-color: #0B243A; font-size: 16px;" type="button">{{__('End Service')}}

                          
                            </button>

                            --}}

                            
                        @endif

                            </div>
                </div>


                <div class="user-billing-subscription-package box-shadow display-block">
                    <h3 class="user-billing-payment-title font-24-lh-28-medium" style="font-family: 'Segoe UI';font-weight: 600;font-size: 18px;line-height: 24px;color: #737F96;">
                        {{__('Billing & Payment')}}
                    </h3>


                    <div class="user-billing-payment-date d-flex align-items-center">
                        <div class="user-billing-payment-date-image"></div>
                        @if($subscription_info)
                            <div style="font-weight: 400;font-size: 22px;line-height: 29px;color: #0B243A;">
                                ${{$subscription_info['only_payment']}}
                                <div style="font-weight: 600;font-size: 16px;line-height: 21px;color: #707070;">{{$subscription_info['only_next_payment']}}</div>
                            </div>
                        @elseif(auth()->user()->company->onTrial())
                            <p class="font-16-lh-19-ligh" style="font-weight: 600;font-size: 16px;line-height: 21px;color: #707070;">{{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}</p>
                        @else
                            <p class="user-billing-payment-text font-16-lh-19-ligh">{{__('No plan')}}</p>
                        @endif
                    </div>
                    <h3 class="user-billing-payment-title font-24-lh-28-medium" style="font-family: 'Segoe UI';font-weight: 600;font-size: 18px;line-height: 24px;color: #737F96;">
                        {{__('Payment method')}}
                    </h3>
                    <div class="user-billing-payment-paypal d-flex align-items-center">
                        @if($default_payment_method && !$user_company->paypal_default)
                            <div class="user-billing-payment-visa-image"></div>
                            <div class="user-billing-payment-mc-image"></div>
                            <p class="user-billing-payment-text font-16-lh-19-ligh">
                                {{ ucfirst($default_payment_method->card->brand) }} {{__('card')}}
                            </p>
                        @elseif($user_company->paypal_method && $user_company->paypal_default)
                            <div class="user-billing-payment-paypal-image"></div>
                            <p class="user-billing-payment-text font-16-lh-19-ligh">
                                {{__('PayPal')}}
                            </p>
                        @else
                            <div class="user-billing-nopayment-image"></div>
                            <p class="user-billing-payment-text font-16-lh-19-ligh">
                                {{__('No payment method')}}
                            </p>
                        @endif
                    </div>

                    <button data-toggle="modal" data-target="#payment-method"
                            class="user-billing-payment-button font-18-lh-21-regular" type="button">
                            {{__('Add Payment Method')}}
                    </button>






                </div>


            </div>

     
        </div>
    </main>
</div>
<div class='loader-wrap'>
    <div id="main-loader" class="preloader">
        <div class="heartbeat">
          <div class="loading"></div>
          <p class='font-loader font-18-lh-20-light'>{{__('Loading...')}}</p>
        </div>
    </div>
</div>
{{-- INVOICE MODAL --}}
{{-- <div id='modal' class="invoice-modal">
  <div id='back' class="invoice-modal-background"></div>
  <div class="invoice-modal-content">
    <div class='invoice-modal-header-wrap'>
    <button id="close" type="button" class="invoice-modal-close"></button>
<h3 class="invoice-modal-title font-28-lh-42-semi-bold">Invoice DH626EN602</h3>
</div>
<hr>
<div class='invoice-modal-invoice'>
<h4 class='font-24-lh-28-medium'>{{__('Invoice To')}}</h4>
<div class='invoice-modal-invoice-info-wrap'>
<div>
<h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Date Created')}}</h5>
<p class='font-14-lh-16-light'>25-06-2021</p>
</div>
<div>
<h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Address')}}</h5>
<p class='font-14-lh-16-light'>Street Name Nr. 69</p>
</div>
<div>
<h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Company')}}</h5>
<p class='font-14-lh-16-light'>ACME LLC</p>
</div>

{{-- INVOICE MODAL --}}
{{--<div id='invoice' class="invoice-modal modal fade" tabindex="-1" role="dialog" aria-labelledby="paymentMethodLabel" aria-hidden="true">--}}
{{--    <div id='back' class="invoice-modal-background"></div>--}}
{{--    <div class="invoice-modal-content">--}}
{{--        <div class='invoice-modal-header-wrap'>--}}
{{--            <button id="close" type="button" class="invoice-modal-close"></button>--}}
{{--            <h3 class="invoice-modal-title font-28-lh-42-semi-bold">Invoice DH626EN602</h3>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        <div class='invoice-modal-invoice'>--}}
{{--            <h4 class='font-24-lh-28-medium'>{{__('Invoice To')}}</h4>--}}
{{--            <div class='invoice-modal-invoice-info-wrap'>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Date Created')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>25-06-2021</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Address')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>Street Name Nr. 69</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Company')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>ACME LLC</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h5 class='invoice-modal-invoice-title font-18-lh-21-medium'>{{__('Name')}}</h5>--}}
{{--                    <p class='font-14-lh-16-light'>Seid Takroni</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <h4 class='font-24-lh-28-medium'>{{__('Payment method')}}</h4>--}}
{{--            <div class='invoice-modal-invoice-payMethod'>--}}
{{--                <div>--}}
{{--                    <p class='font-15-lh-20-semi-medium '>{{__('Paypal signed in as seid@gmail.com')}}</p>--}}
{{--                    <p class='invoice-modal-invoice-payMethod-name font-15-lh-20-semi-medium '>Seid Takroni</p>--}}
{{--                </div>--}}
{{--                <div class='invoice-modal-invoice-payMethod-icon'></div>--}}
{{--            </div>--}}
{{--            <button class='invoice-modal-invoice-payMethod-btn font-16-lh-26-bold '--}}
{{--                    type='button'>{{__('Change')}}</button>--}}
{{--            <hr>--}}
{{--            <div class='invoice-modal-details'>--}}
{{--                <h4 class='invoice-modal-details-title-main font-24-lh-28-medium'>{{__('Details')}}</h4>--}}
{{--                <div class='invoice-modal-details-info-wrap'>--}}
{{--                    <div>--}}
{{--                        <h5 class='invoice-modal-details-title font-18-lh-21-medium'>{{__('Amount')}}</h5>--}}
{{--                        <p class='font-14-lh-16-light'>$39.00</p>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <h5 class='invoice-modal-details-title font-18-lh-21-medium'>{{__('Transaction')}}</h5>--}}
{{--                        <p class='font-14-lh-16-light'>{{__('Monthly Subscription Payment')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button class='invoice-modal-btn font-18-lh-21-medium'>{{__('Download')}}--}}
{{--                    <div class='invoice-modal-btn-icon'></div>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}




{{-- ANALYTICS CONSULTING --}}
<div id='analytics-consulting' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="paymant-method-modal-content modal-dialog" style="max-width: 500px!important;" role="document">
        <div class='paymant-method-modal-header-wrap'>



                    <svg width="46" height="41" viewBox="0 0 46 41" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top:7px;">
                        <path d="M16.8442 14.7071L20.1815 13.7537C20.8489 14.1827 21.5639 14.5641 22.3268 14.7071C26.3794 15.6131 30.0026 12.7047 30.2411 8.84307C30.2411 8.65251 30.0981 8.46162 29.9072 8.46162H24.1862C23.9956 8.46162 23.8523 8.31862 23.8523 8.12773V2.40669C23.8523 2.21613 23.6617 2.02524 23.4708 2.0728C19.6091 2.26336 16.7008 5.88696 17.6068 9.9871C17.7022 10.3685 17.8452 10.75 17.9882 11.0836L16.3194 13.9918C16.1288 14.3736 16.4627 14.8026 16.8442 14.7071H16.8442Z" fill="#447097"/>
                        <path d="M25.8064 6.88854H31.5274C31.718 6.88854 31.9089 6.69798 31.8613 6.50709C31.6708 3.26529 29.0961 0.643028 25.8542 0.5C25.6637 0.5 25.4728 0.643002 25.4728 0.833893V6.55492C25.4249 6.74548 25.6158 6.88849 25.8064 6.88849L25.8064 6.88854Z" fill="#447097"/>
                        <path d="M11.7417 10.4165C11.7417 12.4704 10.0768 14.1352 8.02292 14.1352C5.96903 14.1352 4.3042 12.4704 4.3042 10.4165C4.3042 8.36258 5.96903 6.69775 8.02292 6.69775C10.0768 6.69775 11.7417 8.36258 11.7417 10.4165Z" fill="#447097"/>
                        <path d="M11.9801 30.8218H7.02193C5.7346 30.8218 4.68573 29.9159 4.4476 28.6286L2.96939 19.141C2.87395 18.5211 2.30194 18.0922 1.68206 18.1876C1.06217 18.283 0.633184 18.8551 0.728621 19.4749L2.20649 28.9625C2.58794 31.3463 4.59029 33.0626 6.97409 33.0626H11.9322C12.5521 33.0626 13.0765 32.5381 13.0765 31.9183C13.0765 31.3459 12.6 30.8215 11.9801 30.8215V30.8218Z" fill="#447097"/>
                        <path d="M15.5558 26.054H12.1231L11.6941 20.0469C12.9336 20.7619 14.2685 21.1912 15.6988 21.1912H18.7976C19.5605 21.1912 20.228 20.5713 20.228 19.7608C20.228 18.9979 19.6081 18.3305 18.7976 18.3305H15.7463C14.7929 18.3305 13.7915 18.0445 12.9811 17.52L10.1683 15.7082C9.64388 15.3268 9.02403 15.1362 8.30897 15.1362H7.78452C6.78315 15.1362 5.87765 15.5652 5.21019 16.3281C4.54272 17.091 4.25675 18.0445 4.39974 19.0458L5.78217 28.0566C5.92517 28.867 6.64017 29.487 7.451 29.487H13.601C13.887 29.487 14.1255 29.6775 14.173 29.9639L15.7939 38.8793C15.9369 39.6897 16.6519 40.2617 17.4628 40.2617C17.5582 40.2617 17.6533 40.2617 17.7488 40.2141C18.6547 40.0711 19.2746 39.1653 19.1312 38.2593L17.1764 27.4369C17.0813 26.6261 16.4138 26.0541 15.5558 26.0541L15.5558 26.054Z" fill="#447097"/>
                        <path d="M42.445 10.4165C42.445 12.4704 40.7802 14.1352 38.7263 14.1352C36.6724 14.1352 35.0076 12.4704 35.0076 10.4165C35.0076 8.36258 36.6724 6.69775 38.7263 6.69775C40.7802 6.69775 42.445 8.36258 42.445 10.4165Z" fill="#447097"/>
                        <path d="M45.0666 18.1876C44.4467 18.0922 43.8747 18.5215 43.7793 19.141L42.3014 28.6286C42.1108 29.9159 41.014 30.8218 39.727 30.8218L34.7686 30.8215C34.1487 30.8215 33.6243 31.3459 33.6243 31.9658C33.6243 32.5856 34.1487 33.1101 34.7686 33.1101H39.7267C42.1105 33.1101 44.1604 31.3938 44.4943 29.01L45.9722 19.5225C46.1155 18.855 45.6862 18.2827 45.0666 18.1875V18.1876Z" fill="#447097"/>
                        <path d="M39.2498 29.4391C40.1078 29.4391 40.7756 28.8192 40.9186 28.0087L42.301 18.998C42.444 18.0445 42.158 17.0432 41.4906 16.2803C40.8231 15.5174 39.9173 15.0884 38.9162 15.0884H38.3918C37.7243 15.0884 37.0569 15.3268 36.5324 15.6604L33.7196 17.5198C32.9092 18.0442 31.9557 18.3302 30.9544 18.3302H27.8557C27.0928 18.3302 26.4253 18.9501 26.4253 19.7606C26.4253 20.5235 27.0452 21.1909 27.8557 21.1909H31.002C32.4324 21.1909 33.8148 20.8095 35.0067 20.0466L34.5777 26.0537H31.145C30.3346 26.0537 29.6192 26.6257 29.4762 27.4361L27.5214 38.2586C27.3784 39.1645 27.9504 40.0704 28.9038 40.2134C28.9993 40.2134 29.0944 40.2609 29.1898 40.2609C30.0003 40.2609 30.7156 39.6889 30.8587 38.8785L32.4796 29.9631C32.5271 29.6771 32.7656 29.4862 33.0516 29.4862L39.2498 29.4391Z" fill="#447097"/>
                        <path d="M32.8149 23.6702C32.8149 23.0503 32.2905 22.5259 31.6706 22.5259H15.0794C14.4595 22.5259 13.9351 23.0503 13.9351 23.6702C13.9351 24.29 14.4595 24.8145 15.0794 24.8145H22.2784V39.3557C22.2784 39.9756 22.8028 40.5 23.4227 40.5C24.0425 40.5 24.567 39.9755 24.567 39.3557V24.7668H31.766C32.2904 24.7668 32.8148 24.2903 32.8148 23.6704L32.8149 23.6702Z" fill="#447097"/>
                        </svg>

            <button type="button" class="modal-close float-right" style="right:0px;" data-dismiss="modal" aria-label="Close"></button>


        </div>
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap'>
            <div class='paymant-method-modal-left-side' style="margin-right: 0px!important;">
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium text-center'>{{__('Marketing Analytics Consulting')}}</h3>
                <p class="mb-3">{{__('Subscribing to the Marketing Analytics Consulting will add $100 to your monthly bill and will be prorated until your billing date.')}}</p>
                
                <button onclick="subscribeNewConsultingPlan('consulting')" class="btn btn-sm mb-3" style="background-color: #0B243A; border-color: #0B243A; font-size: 16px; color:#fff;">{{__('Enable consulting')}}</button>
                <a href="https://intercom.help/afdal-analytics/ar/articles/6359383-%D9%85%D8%A7-%D9%87%D9%8A-%D8%AE%D8%AF%D9%85%D8%A9-%D8%A7%D8%B3%D8%AA%D8%B4%D8%A7%D8%B1%D8%A7%D8%AA-%D8%AA%D8%AD%D9%84%D9%8A%D9%84-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA" target="_blank" class="btn btn-sm" style="background-color: #fff; border: 1px solid #0B243A!important; font-size: 16px; color:#000;">{{__('I want to know more')}}</a>
            </div>
        </div>
    </div>
</div>



{{-- ANALYTICS CONSULTING END --}}
<div id='analytics-consulting-end' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="paymant-method-modal-content modal-dialog" style="max-width: 500px!important;" role="document">
        <div class='paymant-method-modal-header-wrap'>



                    <svg width="46" height="41" viewBox="0 0 46 41" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top:7px;">
                        <path d="M16.8442 14.7071L20.1815 13.7537C20.8489 14.1827 21.5639 14.5641 22.3268 14.7071C26.3794 15.6131 30.0026 12.7047 30.2411 8.84307C30.2411 8.65251 30.0981 8.46162 29.9072 8.46162H24.1862C23.9956 8.46162 23.8523 8.31862 23.8523 8.12773V2.40669C23.8523 2.21613 23.6617 2.02524 23.4708 2.0728C19.6091 2.26336 16.7008 5.88696 17.6068 9.9871C17.7022 10.3685 17.8452 10.75 17.9882 11.0836L16.3194 13.9918C16.1288 14.3736 16.4627 14.8026 16.8442 14.7071H16.8442Z" fill="#447097"/>
                        <path d="M25.8064 6.88854H31.5274C31.718 6.88854 31.9089 6.69798 31.8613 6.50709C31.6708 3.26529 29.0961 0.643028 25.8542 0.5C25.6637 0.5 25.4728 0.643002 25.4728 0.833893V6.55492C25.4249 6.74548 25.6158 6.88849 25.8064 6.88849L25.8064 6.88854Z" fill="#447097"/>
                        <path d="M11.7417 10.4165C11.7417 12.4704 10.0768 14.1352 8.02292 14.1352C5.96903 14.1352 4.3042 12.4704 4.3042 10.4165C4.3042 8.36258 5.96903 6.69775 8.02292 6.69775C10.0768 6.69775 11.7417 8.36258 11.7417 10.4165Z" fill="#447097"/>
                        <path d="M11.9801 30.8218H7.02193C5.7346 30.8218 4.68573 29.9159 4.4476 28.6286L2.96939 19.141C2.87395 18.5211 2.30194 18.0922 1.68206 18.1876C1.06217 18.283 0.633184 18.8551 0.728621 19.4749L2.20649 28.9625C2.58794 31.3463 4.59029 33.0626 6.97409 33.0626H11.9322C12.5521 33.0626 13.0765 32.5381 13.0765 31.9183C13.0765 31.3459 12.6 30.8215 11.9801 30.8215V30.8218Z" fill="#447097"/>
                        <path d="M15.5558 26.054H12.1231L11.6941 20.0469C12.9336 20.7619 14.2685 21.1912 15.6988 21.1912H18.7976C19.5605 21.1912 20.228 20.5713 20.228 19.7608C20.228 18.9979 19.6081 18.3305 18.7976 18.3305H15.7463C14.7929 18.3305 13.7915 18.0445 12.9811 17.52L10.1683 15.7082C9.64388 15.3268 9.02403 15.1362 8.30897 15.1362H7.78452C6.78315 15.1362 5.87765 15.5652 5.21019 16.3281C4.54272 17.091 4.25675 18.0445 4.39974 19.0458L5.78217 28.0566C5.92517 28.867 6.64017 29.487 7.451 29.487H13.601C13.887 29.487 14.1255 29.6775 14.173 29.9639L15.7939 38.8793C15.9369 39.6897 16.6519 40.2617 17.4628 40.2617C17.5582 40.2617 17.6533 40.2617 17.7488 40.2141C18.6547 40.0711 19.2746 39.1653 19.1312 38.2593L17.1764 27.4369C17.0813 26.6261 16.4138 26.0541 15.5558 26.0541L15.5558 26.054Z" fill="#447097"/>
                        <path d="M42.445 10.4165C42.445 12.4704 40.7802 14.1352 38.7263 14.1352C36.6724 14.1352 35.0076 12.4704 35.0076 10.4165C35.0076 8.36258 36.6724 6.69775 38.7263 6.69775C40.7802 6.69775 42.445 8.36258 42.445 10.4165Z" fill="#447097"/>
                        <path d="M45.0666 18.1876C44.4467 18.0922 43.8747 18.5215 43.7793 19.141L42.3014 28.6286C42.1108 29.9159 41.014 30.8218 39.727 30.8218L34.7686 30.8215C34.1487 30.8215 33.6243 31.3459 33.6243 31.9658C33.6243 32.5856 34.1487 33.1101 34.7686 33.1101H39.7267C42.1105 33.1101 44.1604 31.3938 44.4943 29.01L45.9722 19.5225C46.1155 18.855 45.6862 18.2827 45.0666 18.1875V18.1876Z" fill="#447097"/>
                        <path d="M39.2498 29.4391C40.1078 29.4391 40.7756 28.8192 40.9186 28.0087L42.301 18.998C42.444 18.0445 42.158 17.0432 41.4906 16.2803C40.8231 15.5174 39.9173 15.0884 38.9162 15.0884H38.3918C37.7243 15.0884 37.0569 15.3268 36.5324 15.6604L33.7196 17.5198C32.9092 18.0442 31.9557 18.3302 30.9544 18.3302H27.8557C27.0928 18.3302 26.4253 18.9501 26.4253 19.7606C26.4253 20.5235 27.0452 21.1909 27.8557 21.1909H31.002C32.4324 21.1909 33.8148 20.8095 35.0067 20.0466L34.5777 26.0537H31.145C30.3346 26.0537 29.6192 26.6257 29.4762 27.4361L27.5214 38.2586C27.3784 39.1645 27.9504 40.0704 28.9038 40.2134C28.9993 40.2134 29.0944 40.2609 29.1898 40.2609C30.0003 40.2609 30.7156 39.6889 30.8587 38.8785L32.4796 29.9631C32.5271 29.6771 32.7656 29.4862 33.0516 29.4862L39.2498 29.4391Z" fill="#447097"/>
                        <path d="M32.8149 23.6702C32.8149 23.0503 32.2905 22.5259 31.6706 22.5259H15.0794C14.4595 22.5259 13.9351 23.0503 13.9351 23.6702C13.9351 24.29 14.4595 24.8145 15.0794 24.8145H22.2784V39.3557C22.2784 39.9756 22.8028 40.5 23.4227 40.5C24.0425 40.5 24.567 39.9755 24.567 39.3557V24.7668H31.766C32.2904 24.7668 32.8148 24.2903 32.8148 23.6704L32.8149 23.6702Z" fill="#447097"/>
                        </svg>

            <button type="button" class="modal-close float-right" style="right:0px;" data-dismiss="modal" aria-label="Close"></button>


        </div>
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap'>
            <div class='paymant-method-modal-left-side' style="margin-right: 0px!important;">
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium text-center'>{{__('Are you sure to end the subscription?')}}</h3>
                <p class="mb-3">Cancel Now</p>
                
                <button onclick="cancelConsultingSubscription()" class="btn btn-sm mb-3" style="background-color: #0B243A; border-color: #0B243A; font-size: 16px; color:#fff;">{{__('End Service')}}</button>
                <button type="button" class="btn btn-sm" style="background-color: #fff; border: 1px solid #0B243A!important; font-size: 16px; color:#000;" data-dismiss="modal" aria-label="Close">{{__('Back')}}</button>
            </div>




        </div>
    </div>
</div>




{{-- PAYMENT METHOD --}}
<div id='payment-method' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="paymant-method-modal-content modal-dialog" role="document">
        <div class='paymant-method-modal-header-wrap'>
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('Manage payment method')}}</h3>
{{--            <div>--}}
{{--                <button type="button" class="paymant-method-modal-back font-22-lh-27-bold ">{{__('Back')}}</button>--}}
{{--            </div>--}}
{{--            <div class='paymant-method-modal-back-arrow'></div>--}}
        </div>
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap'>
            <div class='paymant-method-modal-left-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium ml-0-en'>{{__('Your Subscription')}}</h3>
                <div class='paymant-method-modal-left-side-info'>
                    <div class='paymant-method-modal-left-side-wrap-title'>
                        <div class='paymant-method-modal-left-side-logo'></div>
                        <h4 class='paymant-method-modal-left-side-card-title font-22-lh-25-medium'>{{__('Afdal Analytics') . ' ' . __($user_plan_name) }}</h4>
                    </div>
                    @if($subscription_info)
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light text-left-en'>{{__('Commitment')}}</p>
                        @if($subscription_info['interval'] == 'month')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Paid monthly') }}</p>
                        @elseif($subscription_info['interval'] == 'year')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Annual plan') }}</p>
                        @endif
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light text-left-en'>{{__('Next regular payment*')}}</p>
                        <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>${{$subscription_info['next_payment']}}</p>
                    @elseif(auth()->user()->company->onTrial())
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light text-left-en'>{{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}</p>
                    @else
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light text-left-en'>{{__('No plan')}}</p>
                    @endif
                    <hr>
                    <div class='paymant-method-modal-left-side-card-bottom-text'>
                        <p class='paymant-method-modal-left-side-card-text-medium font-17-lh-19-medium'>{{__('Requires use with only one account*')}}</p>
                        <div class='paymant-method-modal-left-side-card-text-icon mr-10-en'></div>
                    </div>

                </div>
            </div>

            <div id="current-payment-method" class='paymant-method-modal-right-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium ml-0-en'>{{__('Your payment method')}}</h3>

                @if($subscription_info)
                    <div id="confirm-paypal" style="display: none">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light'>{{ __('Confirm new payment method:') }}</p>
                            <a href="" onclick="backPaymentMethod(event)">{{ __('Back') }}</a>
                        </div>
                        <div class="monthly-pp-btn mt-2" id="{{ $paypalPlanId }}"></div>
                    </div>
                @endif

                <div id="current-payment-method-inner">
                    @if(!$payment_methods->isEmpty() || $user_company->paypal_method)
                        @foreach($payment_methods as $payment_method)
                            <div class="paymant-method-modal-right-side-info-wrap {{!$isPaypalDefault && ($payment_method == $default_payment_method) ? 'default-method' : 'additional-method'}}"
                                 id="{{ $payment_method->id }}">
                                <div class='paymant-method-modal-right-side-info d-flex justify-content-between align-items-center'
                                     style="width: 405px;">
                                    <div class="mr-3">
                                        <p class='paymant-method-modal-right-side-card-title font-15-lh-20-semi-medium '>
                                            {{__('Your')}} {{ $payment_method->card->brand }} {{__('card signed in as')}} {{ $user_company->name }}</p>
                                    </div>
                                    <div class='paymant-method-modal-right-side-first-field-{{$payment_method->card->brand}}'></div>
                                </div>
                                @if(($payment_method != $default_payment_method) || $isPaypalDefault)
                                    <a href="" class="delete-method" onclick="deletePM(event, '{{ $payment_method->id }}')">
                                        <img src="{{url('assets/image_new/svg/colored/close.svg')}}" alt="">
                                    </a>
                                @endif
                            </div>
                        @endforeach

                        @if($user_company->paypal_method)
                            <div class="paymant-method-modal-right-side-info-wrap {{$isPaypalDefault ? 'default-method' : 'additional-method'}}"
                                 id="paypal-method">
                                <div class='paymant-method-modal-right-side-info' style="width: 405px;">
                                    <div class="mr-3">
                                        <p class='paymant-method-modal-right-side-card-title font-15-lh-20-semi-medium '>
                                            {{__('PayPal')}} {{ $user_company->name}}
                                        </p>
                                    </div>
                                    <div class='paymant-method-modal-right-side-first-field-paypal ml-auto'></div>
                                </div>
                                @if(!$isPaypalDefault)
                                    <a href="" class="delete-method" onclick="deletePM(event, 'paypal-method')">
                                        <img src="{{url('assets/image_new/svg/colored/close.svg')}}" alt="">
                                    </a>
                                @endif
                            </div>
                        @endif

                    @else

                        <span>{{__('No payment methods')}}</span>

                    @endif

                    <div class='paymant-method-modal-right-side-boottom mr-15-percent-en'>
                        <div class='paymant-method-modal-right-side-btn-wrap'>
                            <button type="button" id="savePM" disabled onclick="saveDefaultPM()"
                                    class="paymant-method-modal-right-side-btn font-18-lh-21-regular">{{__('Save')}}</button>
                            <div class='paymant-method-modal-right-side-lock'></div>
                        </div>
                        <div></div>
                        <div class='paymant-method-modal-right-side-edad-wrap'>
                            @if((count($payment_methods) > 1) || ($user_company->paypal_method && (count($payment_methods) == 1)))
                                <a href="" onclick="managePM(event)" class='paymant-method-modal-right-side-ed font-16-lh-26-medium'>{{__('Edit')}}</a>
                            @endif
                            <a href="" onclick="addPaymentMethod(event)" id="add-payment-method-btn"
                               class='paymant-method-modal-right-side-edad font-16-lh-26-medium ml-0-en'>{{__('Add New')}}</a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ADD PAYMENT --}}

            <div id="add-payment-method" class='paymant-method-modal-right-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium'>{{__('Add Payment Method')}}</h3>
                <div class='paymant-method-modal-right-side-first-wrap'>
                    <div class='paymant-method-modal-right-side-first-field-paypal'></div>
                    <div class='paymant-method-modal-right-side-first-field-mastercard'></div>
                    <div class='paymant-method-modal-right-side-first-field-visa'></div>
                    <select onchange="selectPaymentMethod()" class='paymant-method-modal-right-side-first-field' name="select" id="payment-selector">
                        <option class='paymant-method-modal-right-side-first-field-option font-15-lh-20-semi-bold'
                                value="paypal">{{__('PayPal')}}.,
                        </option>
                        <option class='paymant-method-modal-right-side-first-field-option font-15-lh-20-semi-bold'
                                value="card" selected>{{__('Visa/Mastercard')}}
                        </option>
                    </select>
                </div>

                <div class="paymant-method-modal-right-side-second-wrap" id="cardMethod">
                    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">
                        <div class="form-group">
                            <label for="">{{__('Name')}} <span class='user-billing-star'>*</span></label>
                            <input type="text" name="name" id="card-holder-name" class="form-control" value=""
                                   placeholder="{{__('Name on the card')}}">
                        </div>
                        <div class="form-group">
                            <label for="">{{__("Card details")}}<span class='user-billing-star'>*</span> </label>
                            <div id="card-element"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn paymant-method-modal-right-side-btn" id="card-button"
                                    data-secret="{{ $intent->client_secret }}">{{__("Add new payment method")}}
                            </button>
                            <a href="" onclick="backPaymentMethod(event)">{{ __('Back') }}</a>
                        </div>

                    </form>
                </div>

                <div class="paymant-method-modal-right-side-second-wrap mt-3" id="paypalMethod" style="display:none;">
                    <div class="d-flex flex-column">
                        <span class="paypal-label">{{__("Use PayPal payment method by default:")}}</span>
                        <button class="btn paymant-method-modal-right-side-btn paypal ml-auto w-auto mt-3 mr-0"
                                onclick="setPaypalMethod()">{{__('Add new payment method')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- EDIT SUBSCRIPTION --}}

<div id='edit-subscription' class="paymant-method-modal modal fade" tabindex="-1" role="dialog"
     aria-labelledby="editSubscriptionLabel" aria-hidden="true">
    <div class="paymant-method-modal-content modal-dialog" role="document">
        <div class='paymant-method-modal-header-wrap'>
            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
            <h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('Manage your subscription')}}</h3>
{{--            <div>--}}
{{--                <button type="button" class="paymant-method-modal-back font-22-lh-27-bold ">{{__('Back')}}</button>--}}
{{--            </div>--}}
{{--            <div class='paymant-method-modal-back-arrow'></div>--}}
        </div>
        {{-- <div class='paymant-method-modal-header-wrap'>
          <button type="button" class="paymant-method-modal-close"></button>
<h3 class="paymant-method-modal-title font-28-lh-42-semi-bold">{{__('We will be waiting you back')}}</h3>
        </div> --}}
        <hr class='paymant-method-modal-line'>
        <div class='paymant-method-modal-wrap' style="position: relative">
            <div class='overlay'></div>
            {{-- SUBSCRIPTION SUCCESSFUL --}}
            {{--             <div>--}}
            {{--            <div class='paymant-method-modal-succes-wrap'>--}}
            {{--            <h3 class='paymant-method-modal-succes-title font-20-lh-24-semi-bold '>{{__('Your subscription was successfully cancelled!')}}</h3>--}}
            {{--            <div class='paymant-method-modal-succes-icon'></div>--}}
            {{--            </div>--}}
            {{--            <div class="paymant-method-modal-succes-link-wrap">--}}
            {{--              <a class="paymant-method-modal-succes-link-left font-14-lh-26-bold" href="/">{{__('Chose another subscription')}}</a>--}}
            {{--              <a class="paymant-method-modal-succes-link-right font-14-lh-26-bold" href="/">{{__('Get free 14-day trial')}}</a>--}}
            {{--            </div>--}}
            {{--            </div>--}}
            {{-- YOUR Subscription --}}
            <div class='paymant-method-modal-left-side'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium ml-0-en'>{{__('Your Subscription')}}</h3>
                <div class='paymant-method-modal-left-side-info'>
                    <div class='paymant-method-modal-left-side-wrap-title'>
                        <div class='paymant-method-modal-left-side-logo'></div>
                        <h4 class='paymant-method-modal-left-side-card-title font-22-lh-25-medium'>{{__('Afdal Analytics') . ' ' . __($user_plan_name) }}</h4>
                    </div>
                    @if($subscription_info)
                        <p class='paymant-method-modal-left-side-card-text mr-10-ent-16-lh-19-light text-left-en'>{{__('Commitment')}}</p>
                        @if($subscription_info['interval'] == 'month')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Paid monthly') }}</p>
                        @elseif($subscription_info['interval'] == 'year')
                            <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>{{ __('Annual plan') }}</p>
                        @endif
                        <p class='paymant-method-modal-left-side-card-text mr-10-en'>{{__('Next regular payment*')}}</p>
                        <p class='paymant-method-modal-left-side-card-text-regular font-20-lh-23-regular'>${{$subscription_info['next_payment']}}</p>
                    @elseif(auth()->user()->company->onTrial())
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light text-left-en'>
                            {{__('The trial period will end in ')}} {{ ceil(abs(strtotime(auth()->user()->company->trialEndsAt()) - time()) / 86400) }} {{__('days')}}
                        </p>
                    @else
                        <p class='paymant-method-modal-left-side-card-text font-16-lh-19-light text-left-en'>{{__('No plan')}}</p>
                    @endif
                    <hr>
                    <div class='paymant-method-modal-left-side-card-bottom-text'>
                        <p class='paymant-method-modal-left-side-card-text-medium font-17-lh-19-medium'>{{__('Requires use with only one account*')}}</p>
                        <div class='paymant-method-modal-left-side-card-text-icon mr-10-en'></div>
                    </div>

                </div>
            </div>

            {{-- AVAIBLE ACTIONS --}}

            <div class='paymant-method-modal-right-side mr-10-en'>
                <h3 class='paymant-method-modal-second-title font-24-lh-28-medium pl-0-en text-left-en'>{{__('Available Actions')}}</h3>
                <div class='paymant-method-modal-right-side-wrap'>
                    <div class='paymant-method-modal-right-side-wrap-title'>
                        <h4 class='paymant-method-modal-right-side-card-title font-22-lh-25-medium'>{{__('Find a Better Plan')}}</h4>
                        <div class='paymant-method-modal-right-side-icon ml-0-en'></div>
                    </div>
                    <p class='paymant-method-modal-text font-16-lh-19-regular text-left-en'>{{__('Not enough connections in your plan? Let us help you find the right plan for your needs, and make the switch quick and easy.')}}</p>
                    <a href="{{ url('/dashboard/subscribe-plan') }}"
                       class="paymant-method-modal-right-side-card-btn">{{__('Change')}}</a>
                </div>
                @if($subscription_data && (empty($ends_at) || $isPaypal))
                    <div class='paymant-method-modal-right-side-wrap'>
                        <div class='paymant-method-modal-right-side-wrap-title'>
                            <h4 class='paymant-method-modal-right-side-card-title font-22-lh-25-medium'>{{__('End Your Subscription')}}</h4>
                            <div class='paymant-method-modal-right-side-icon-cross'></div>
                        </div>
                        <p class='paymant-method-modal-text font-16-lh-19-regular'>{{__('Sometimes you just need to call it quits. We get it and would love to have you back. Make sure to keep an eye out on our offers!')}}</p>
                        <button type="button" onclick="endSubBlock()"
                                class="paymant-method-modal-right-side-card-btn">{{__('End Service')}}</button>
                    </div>
                @endif
            </div>

        </div>

        {{-- END THE Subscription --}}

        <div id="endSubscription">
            <hr class='paymant-method-modal-line-bottom'>
            <div class='paymant-method-modal-bottom-side'>
                <div class='paymant-method-modal-bottom-side-left-wrap'>
                    <p class='paymant-method-modal-bottom-side-left-title font-17-lh-20-medium'>{{__('Need Help?')}}</p>
                    <div class='paymant-method-modal-bottom-side-left-text'>
                        <a class='font-14-lh-16-light payment-method-modal-bottom-side-left-link' href="/">{{__('Watch Video')}}</a>
                        <div class='paymant-method-modal-bottom-side-delta'></div>
                    </div>
                    <div class='paymant-method-modal-bottom-side-left-text'>
                        <a class='font-14-lh-16-light payment-method-modal-bottom-side-left-link' href="/">{{__('View Demo')}}</a>
                        <div class='paymant-method-modal-bottom-side-search'></div>
                    </div>
                    <div class='paymant-method-modal-bottom-side-left-text'>
                        <a class='font-14-lh-16-light payment-method-modal-bottom-side-left-link' href="/">{{__('Read Help Article')}}</a>
                        <div class='paymant-method-modal-bottom-side-info'></div>
                    </div>
                </div>
                <div>
                    <p class='paymant-method-modal-bottom-side-right-title font-28-lh-42-semi-bold'>{{__('Are you sure to end the subscription?')}}</p>
                    <div class='paymant-method-modal-bottom-side-right-wrap-btn'>
                        <button onclick="endSubBlock()"
                            class='paymant-method-modal-bottom-side-right-back font-18-lh-21-regular'>{{__('Back')}}</button>
                        <button onclick="cancelSubscription()"
                            class='paymant-method-modal-bottom-side-right-end font-18-lh-21-regular'>{{__('End Subscription')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{'https://www.paypal.com/sdk/js?client-id=' . (env('PAYPAL_MODE') === 'live' ? env('PAYPAL_LIVE_CLIENT_ID') : env('PAYPAL_SANDBOX_CLIENT_ID')) . '&vault=true&intent=subscription'}}" data-sdk-integration-source="button-factory"></script>

<script>
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'horizontal',
            label: 'subscribe',
            tagline: false
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                /* Creates the subscription */
                plan_id: '{{ $paypalPlanId }}',
                start_time: '{{ $nextPaymentDate }}T00:00:00Z'
            });
        },
        onApprove: function(data, actions) {
            updatePMReq(data.subscriptionID, data.orderID);
        }
    }).render('#{{ $paypalPlanId }}');
</script>

<script>
    var noPaymentMethod = '{{ session()->get('noPaymentMethod') }}';
    var paymentMethodAdded = '{{ session()->get('paymentMethodAdded') }}';
    var subscriptionCanceled = '{{ session()->get('subscriptionCanceled') }}';
    var subscriptionCreated = '{{ session()->get('subscriptionCreated') }}';
    var pmUpdated = '{{ session()->get('pmUpdated') }}';

    document.body.onload = function () {
        setTimeout(function () {
            const preloader = document.getElementById('main-loader');
            if (!preloader.classList.contains('done')) {
                preloader.classList.add('done');
            }
            if (noPaymentMethod) {
                
                toastr.warning('{{__('Add a new payment method')}}');

                @php
                    request()->session()->forget('noPaymentMethod');
                @endphp
            }
            if (paymentMethodAdded) {
                toastr.success('{{__('A new payment method was added')}}');

                @php
                    request()->session()->forget('paymentMethodAdded');
                @endphp
            }
            if (subscriptionCanceled) {
                toastr.success('{{__('Your subscription has been canceled')}}');

                @php
                    request()->session()->forget('subscriptionCanceled');
                @endphp
            }
            if (subscriptionCreated) {
                toastr.success('{{__('Your subscription has been created')}}');

                @php
                    request()->session()->forget('subscriptionCreated');
                @endphp
            }
            if (pmUpdated) {
                toastr.success('{{__('The new payment method is set')}}');

                @php
                    request()->session()->forget('pmUpdated');
                @endphp
            }
        }, 1000);
    };
</script>

<script>
    ifSubEnd = false;

    function selectPaymentMethod() {
        if ($('#payment-selector').val() === 'card') {
            $('#paypalMethod').hide();
            $('#cardMethod').show();
        } else {
            $('#paypalMethod').show();
            $('#cardMethod').hide();
        }
    }

    function setPaypalMethod() {
        toggleLoader(true);
        $.ajax({
            type: 'POST',
            url: '{{ url('/set-paypal') }}'+'?set_defual=true',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: () => {
                location.reload()
            }
        })
    }

    function addPaymentMethod(event) {
        event.preventDefault();
        $('#current-payment-method').hide();
        $('#add-payment-method').show();
    }

    function backPaymentMethod(event) {
        event.preventDefault();
        $('#current-payment-method').show();
        $('#add-payment-method').hide();

        $('#confirm-paypal').hide();
        $('#current-payment-method-inner').show();
    }

    function endSubBlock () {
        if (!ifSubEnd) {
            $('#endSubscription').show();
            document.querySelector('.overlay').style.display = "block";
            document.querySelectorAll('.paymant-method-modal-title')[1].innerHTML = "{{__('End Your Subscription')}}"
        } else {
            $('#endSubscription').hide()
            document.querySelector('.overlay').style.display = "none";
            document.querySelectorAll('.paymant-method-modal-title')[1].innerHTML = "{{__('Manage your subscription')}}"
        }
        ifSubEnd = !ifSubEnd
    }

    function cancelSubscription() {
        toggleLoader(true);

        $.ajax({
            type: 'POST',
            url: '{{ $isPaypal ? url('/cancel-paypal-subscription') : url('/cancel-subscription') }}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: res => {
                console.log(res);
                if (res.subscriptionCanceled) {
                    location.reload()
                }
            }
        })
    }

    function cancelConsultingSubscription() {
        toggleLoader(true);

        $.ajax({
            type: 'POST',
            url: '{{ url('/cancel-consulting-subscription')}}',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: res => {
                console.log(res);
                if (res.subscriptionCanceled) {
                    location.reload()
                }
            }
        })
    }
</script>


<script>
    const stripe = Stripe('{{ config('cashier.key') }}')

    const elements = stripe.elements()
    const cardElement = elements.create('card')

    cardElement.mount('#card-element')

    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')

    let isEditing = false;
    let selectedPM = null;

    function toggleLoader(loaderStatus) {
        const preloader = $('#main-loader');
        if (loaderStatus) {
            preloader.removeClass('done');
        } else {
            preloader.addClass('done');
        };
    };

    function managePM(event) {
        event.preventDefault();
        isEditing = !isEditing;

        if (isEditing) {
            $('.paymant-method-modal-right-side-info').css({'width': '375px'});
            $('.delete-method').show();

            const additionalMethods = $('.additional-method');
            $.each(additionalMethods, (i, item) => {
                $(`#${item.id} .paymant-method-modal-right-side-info`).attr('onclick', `selectPM('${item.id}')`).addClass('selectable-PM');
            })

        } else {
            $('.paymant-method-modal-right-side-info').css({'width': '405px'});
            setTimeout(() => $('.delete-method').hide(), 300);
            $('.additional-method .paymant-method-modal-right-side-info').removeClass('selectable-PM').removeClass('selected-PM').removeAttr('onclick');
            $('#savePM').removeClass('active-btn').attr('disabled', 'true');
            $('.paymant-method-modal-right-side-lock').css({'right': '-15px'});
            selectedPM = null;
        }
    }

    function selectPM(id) {
        $('.additional-method .paymant-method-modal-right-side-info').removeClass('selected-PM');
        $(`#${id} .paymant-method-modal-right-side-info`).addClass('selected-PM');
        selectedPM = id;

        $('#savePM').addClass('active-btn').removeAttr('disabled');
        $('.paymant-method-modal-right-side-lock').css({'right': '15px'});
    }

    function updatePMReq(subscriptionID = null, orderID = null) {
        $.ajax({
            type: 'POST',
            url: '{{ url('/update-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: selectedPM,
                subscriptionID: subscriptionID,
                orderID: orderID
            },
            success: res => {

                setTimeout(() => {
                    isEditing = !isEditing;

                    $('.default-method').removeClass('default-method');
                    $(`#${selectedPM}`).addClass('default-method').css({'opacity': '1'});
                    $('.paymant-method-modal-right-side-info').css({'width': '405px'});
                    $('.additional-method .paymant-method-modal-right-side-info').removeClass('selectable-PM').removeClass('selected-PM').removeAttr('onclick');
                    $('.delete-method').css({'pointer-events': 'all'}).hide();
                    selectedPM = null;

                    toggleLoader(true);
                    location.reload();
                }, 300)
            }
        })
    }

    function saveDefaultPM() {
        event.preventDefault();

        $('#savePM').removeClass('active-btn').attr('disabled', 'true');
        $('.paymant-method-modal-right-side-lock').css({'right': '-15px'});

        $('.delete-method').css({'pointer-events': 'none'});
        $(`#${selectedPM}`).css({'opacity': '.6'});

        if ('{{ json_encode($subscription_info) }}' !== 'null' && !+'{{ $user_company->paypal_default }}' && selectedPM === 'paypal-method') {
            $('#confirm-paypal').show();
            $('#current-payment-method-inner').hide();
            return;
        }

        updatePMReq();
    }

    function deletePM(event, id) {
        event.preventDefault();

        $('#savePM').removeClass('active-btn').attr('disabled', 'true');
        $('.paymant-method-modal-right-side-lock').css({'right': '-15px'});

        $('.delete-method').css({'pointer-events': 'none'});
        $(`#${id}`).css({'opacity': '.6'});

        $.ajax({
            type: 'POST',
            url: '{{ url('/delete-payment-method') }}',
            data: {
                _token: '{{ csrf_token() }}',
                pm_id: id
            },
            success: res => {
                $(`#${id}`).css({'opacity': '0'});

                setTimeout(() => {
                    $(`#${id}`).css({'display': 'none'});
                    if (res.paymentMethods.length < 2) {
                        isEditing = !isEditing;

                        if (isEditing) {
                            $('.paymant-method-modal-right-side-info').css({'width': '375px'});
                            $('.delete-method').show();
                        } else {
                            $('.paymant-method-modal-right-side-info').css({'width': '405px'});
                            setTimeout(() => $('.delete-method').hide(), 300);
                        }
                    } else {
                        $('.delete-method').css({'pointer-events': 'all'});
                    }
                    selectedPM = null;
                }, 300)
            }
        })
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        const {setupIntent, error} = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if (error) {
            toastr.error(error.message);
        } else {
            let token = document.createElement('input')

            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            form.appendChild(token)

            form.submit();

            toggleLoader(true);

            $('#current-payment-method').show();
            $('#add-payment-method').hide();
        }
    })



    function subscribeNewConsultingPlan(plan) {
        console.log(plan);
        if ('{{auth()->user()}}') {
            toggleLoader(true);

            $.ajax({
                type: 'POST',
                url: '{{ url('/subscribe-consulting-plan') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    plan: plan, //currentPeriod === 'year' ? plan + '_yearly' : plan
                },
                success: function (data) {
                    window.location.replace('{{ url('/dashboard/user-billing') }}');
                },
                error: function(error){

                    // window.location.replace('{{ url('/dashboard/user-billing') }}');
                }
            })
        } else window.location.replace('{{ url('/login') }}');
    }




</script>

</body>
