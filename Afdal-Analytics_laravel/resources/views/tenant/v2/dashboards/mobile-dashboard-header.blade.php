<div class="mx-3 mx-sm-5 d-flex align-items-center justify-content-between d-md-none">
    <p class="m-0 primary-text-color dashboard-connector-page-heading-sm">{{__('Instagram Page Insight Overview')}}</p>
    <div class="dropdown">
        <button type="button" class="border-0 bg-white pages-dropdown d-flex flex-column align-items-center justify-content-center" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.5 6.18644H16M1 1H16M5.5 11.3729H16" stroke="#0B243A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <ul class="dropdown-menu @if($get_locale=='ar') dropdown-menu-ar @endif g-10 px-2" style="width: 196px;height: 318px;" aria-labelledby="dropdownMenuButton1">
            <li>
                <span class="@if($get_locale=='ar') float-start @else float-end @endif">
                    <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 6.18644H16M1 1H16M5.5 11.3729H16" stroke="#0B243A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </li>
            @if(Auth::user()->company?->dashboard->isNotEmpty())
                @foreach(Auth::user()->company->dashboard as $dashboard)
                @if($dashboard->name === 'facebook-overview')
                <li>
                    <a href="{{url('dashboard/facebook-overview')}}" class="dropdown-item py-2 d-flex g-6 align-items-center" >
                        <span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.766 8.00049C15.766 5.9097 14.9354 3.90452 13.457 2.42611C11.9786 0.947695 9.97346 0.117187 7.88267 0.117188C5.79199 0.117364 3.78701 0.947958 2.30874 2.42635C0.830471 3.90474 -7.47573e-09 5.90981 0 8.00049C0.000201236 9.87778 0.67016 11.6935 1.8894 13.1209C3.10864 14.5484 4.79717 15.4941 6.65133 15.7878V10.2791H4.65133V8.00049H6.65133V6.26383C6.65133 4.28783 7.828 3.19718 9.62867 3.19718C10.2199 3.20537 10.8097 3.25681 11.3933 3.35116V5.29118H10.4C10.2306 5.2687 10.0583 5.2846 9.8959 5.33773C9.73348 5.39085 9.58509 5.47982 9.46172 5.59806C9.33836 5.71631 9.24317 5.86081 9.18321 6.02083C9.12325 6.18085 9.10005 6.35226 9.11533 6.52246V8.00114H11.302L10.9527 10.2798H9.11467V15.7885C10.9688 15.4947 12.6574 14.5491 13.8766 13.1216C15.0958 11.6941 15.7658 9.87844 15.766 8.00114" fill="#B0BBCB" />
                            </svg>
                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #B0BBCB;">{{__('Pages')}}</p>
                    </a>
                </li>
                @elseif($dashboard->name === 'facebook-ads-overview')
                <li>
                    <a href="{{url('dashboard/facebook-ads-overview')}}" class="dropdown-item py-2 d-flex g-6 align-items-center">
                        <span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.766 8.00049C15.766 5.9097 14.9354 3.90452 13.457 2.42611C11.9786 0.947695 9.97346 0.117187 7.88267 0.117188C5.79199 0.117364 3.78701 0.947958 2.30874 2.42635C0.830471 3.90474 -7.47573e-09 5.90981 0 8.00049C0.000201236 9.87778 0.67016 11.6935 1.8894 13.1209C3.10864 14.5484 4.79717 15.4941 6.65133 15.7878V10.2791H4.65133V8.00049H6.65133V6.26383C6.65133 4.28783 7.828 3.19718 9.62867 3.19718C10.2199 3.20537 10.8097 3.25681 11.3933 3.35116V5.29118H10.4C10.2306 5.2687 10.0583 5.2846 9.8959 5.33773C9.73348 5.39085 9.58509 5.47982 9.46172 5.59806C9.33836 5.71631 9.24317 5.86081 9.18321 6.02083C9.12325 6.18085 9.10005 6.35226 9.11533 6.52246V8.00114H11.302L10.9527 10.2798H9.11467V15.7885C10.9688 15.4947 12.6574 14.5491 13.8766 13.1216C15.0958 11.6941 15.7658 9.87844 15.766 8.00114" fill="#B0BBCB" />
                            </svg>
                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #B0BBCB;">{{__('Ads')}}</p>
                    </a>
                </li>
                @elseif($dashboard->name === 'facebook-engagement')
                <li>
                    <a href="{{url('dashboard/facebook-engagement')}}" class="dropdown-item py-2 d-flex g-6 align-items-center">
                        <span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.766 8.00049C15.766 5.9097 14.9354 3.90452 13.457 2.42611C11.9786 0.947695 9.97346 0.117187 7.88267 0.117188C5.79199 0.117364 3.78701 0.947958 2.30874 2.42635C0.830471 3.90474 -7.47573e-09 5.90981 0 8.00049C0.000201236 9.87778 0.67016 11.6935 1.8894 13.1209C3.10864 14.5484 4.79717 15.4941 6.65133 15.7878V10.2791H4.65133V8.00049H6.65133V6.26383C6.65133 4.28783 7.828 3.19718 9.62867 3.19718C10.2199 3.20537 10.8097 3.25681 11.3933 3.35116V5.29118H10.4C10.2306 5.2687 10.0583 5.2846 9.8959 5.33773C9.73348 5.39085 9.58509 5.47982 9.46172 5.59806C9.33836 5.71631 9.24317 5.86081 9.18321 6.02083C9.12325 6.18085 9.10005 6.35226 9.11533 6.52246V8.00114H11.302L10.9527 10.2798H9.11467V15.7885C10.9688 15.4947 12.6574 14.5491 13.8766 13.1216C15.0958 11.6941 15.7658 9.87844 15.766 8.00114" fill="#B0BBCB" />
                            </svg>
                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #B0BBCB;">{{__('Engagment ')}} </p>
                    </a>
                </li>
                @elseif($dashboard->name === 'twitter-overview')
                <li>
                    <a href="{{url('dashboard/twitter-overview')}}" class="dropdown-item py-2 d-flex g-6 align-items-center">
                        <span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.03267 14.5018C6.26157 14.5102 7.47988 14.2744 8.61686 13.808C9.75385 13.3416 10.7868 12.654 11.6558 11.785C12.5248 10.916 13.2125 9.88299 13.6789 8.746C14.1453 7.60902 14.3811 6.39071 14.3727 5.16181C14.3727 5.01959 14.3695 4.87827 14.3633 4.73782C15.0057 4.2729 15.5602 3.69725 16.0007 3.03783C15.4016 3.30344 14.7661 3.47758 14.1154 3.55447C14.8006 3.14429 15.3135 2.49921 15.5587 1.73917C14.9144 2.12259 14.2094 2.39312 13.474 2.53913C12.9792 2.01271 12.3246 1.66408 11.6117 1.54719C10.8987 1.4303 10.1672 1.55171 9.53015 1.89257C8.89315 2.23343 8.38628 2.77472 8.08797 3.43273C7.78967 4.09074 7.71656 4.82876 7.88 5.5325C6.57467 5.46715 5.29767 5.12798 4.13192 4.53706C2.96616 3.94614 1.93769 3.11668 1.11332 2.10249C0.693386 2.82518 0.564698 3.68078 0.753459 4.49503C0.94222 5.30927 1.43427 6.02093 2.12935 6.48514C1.60808 6.46919 1.09821 6.32837 0.64266 6.07449C0.64266 6.08849 0.64266 6.10182 0.64266 6.11649C0.64274 6.87439 0.905032 7.60892 1.38501 8.19547C1.86499 8.78201 2.5331 9.18446 3.276 9.3345C2.79261 9.46647 2.28539 9.48583 1.79333 9.39114C2.00298 10.0435 2.41132 10.614 2.96118 11.0228C3.51105 11.4316 4.17492 11.6583 4.85999 11.6711C3.69714 12.584 2.261 13.079 0.782674 13.0765C0.521122 13.0767 0.259775 13.0616 0 13.0312C1.50098 13.9956 3.2479 14.5075 5.03202 14.5058" fill="#B0BBCB" />
                            </svg>
                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #B0BBCB;">{{__('Twitter')}} </p>
                    </a>
                </li>
                @elseif($dashboard->name === 'instagram-overview')
                <li>
                    <a href="{{url('dashboard/instagram-overview')}}" class="dropdown-item py-2 d-flex g-6 align-items-center">
                        <span>
                            
                            @if($current_dashboard=='instagram')
                            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.79473 1.00474C5.45278 1.00474 4.47554 1.00807 4.28543 1.02408C3.73809 1.046 3.2012 1.18091 2.70851 1.42032C2.36474 1.58793 2.05385 1.8159 1.79064 2.09337C1.27985 2.62579 0.954036 3.30852 0.861434 4.04051C0.773139 4.82481 0.749267 5.61502 0.790059 6.40322C0.790059 7.04026 0.790059 7.87942 0.790059 9.00474C0.790059 12.3447 0.790059 13.3199 0.80807 13.5094C0.831083 14.0451 0.961041 14.5708 1.19029 15.0556C1.404 15.4933 1.71 15.8795 2.08724 16.1877C2.46448 16.4958 2.904 16.7186 3.37557 16.8406C3.75655 16.9319 4.14596 16.9836 4.53758 16.9947C4.7377 17.0034 6.75621 17.0094 8.77805 17.0094C10.7999 17.0094 12.8217 17.0094 13.0145 16.9974C13.4205 16.9898 13.8243 16.937 14.2186 16.84C14.6911 16.7188 15.1314 16.4959 15.5089 16.1869C15.8863 15.8779 16.1917 15.4902 16.4038 15.0509C16.6293 14.5757 16.7576 14.0602 16.7814 13.5347C16.7921 13.3966 16.7967 11.2 16.7967 9.00274C16.7967 6.80546 16.7921 4.61218 16.7807 4.4741C16.7594 3.94182 16.6296 3.4195 16.3992 2.9392C16.2292 2.58829 15.9961 2.27171 15.7114 2.00532C15.1774 1.49609 14.4943 1.17117 13.7623 1.07812C12.9783 0.989099 12.1883 0.964558 11.4002 1.00474H8.79473Z" fill="#DF3E8A"/>
                            <path d="M8.79146 3.09729C7.18653 3.09729 6.98507 3.10463 6.35471 3.13331C5.86455 3.14318 5.37962 3.23611 4.92054 3.40814C4.52788 3.55996 4.17127 3.79212 3.87353 4.08974C3.57579 4.38736 3.3435 4.74388 3.19153 5.13648C3.01915 5.59546 2.92621 6.08046 2.9167 6.57065C2.88869 7.20102 2.88135 7.40247 2.88135 9.0074C2.88135 10.6123 2.88869 10.8131 2.91737 11.4435C2.92738 11.9336 3.0203 12.4185 3.1922 12.8777C3.34409 13.2703 3.57627 13.6269 3.87388 13.9246C4.1715 14.2223 4.52799 14.4546 4.92054 14.6067C5.37985 14.7787 5.865 14.8716 6.35537 14.8815C6.98574 14.9102 7.18719 14.9175 8.79213 14.9175C10.3971 14.9175 10.5978 14.9102 11.2282 14.8815C11.7186 14.8716 12.2037 14.7786 12.6631 14.6067C13.0555 14.4544 13.4119 14.2221 13.7095 13.9244C14.0071 13.6267 14.2393 13.2702 14.3914 12.8777C14.5626 12.4183 14.6555 11.9336 14.6662 11.4435C14.6942 10.8131 14.7022 10.6123 14.7022 9.0074C14.7022 7.40247 14.6949 7.20102 14.6662 6.57065C14.6555 6.08058 14.5626 5.59578 14.3914 5.13648C14.2394 4.74391 14.0071 4.3874 13.7093 4.08978C13.4116 3.79216 13.055 3.55999 12.6624 3.40814C12.2028 3.23623 11.7175 3.14331 11.2269 3.13331C10.5965 3.10463 10.3957 3.09729 8.79013 3.09729H8.79146ZM8.26115 4.16458H8.79146C10.3697 4.16458 10.5565 4.16992 11.1795 4.1986C11.5542 4.20308 11.9254 4.27189 12.2768 4.40205C12.5316 4.50052 12.7631 4.65121 12.9562 4.84444C13.1493 5.03767 13.2998 5.26916 13.3981 5.52404C13.5284 5.87544 13.5972 6.24662 13.6016 6.62135C13.6296 7.24438 13.6363 7.43182 13.6363 9.00874C13.6363 10.5857 13.6303 10.7731 13.6016 11.3961C13.5972 11.7709 13.5284 12.142 13.3981 12.4934C13.2996 12.748 13.149 12.9792 12.9559 13.1722C12.7628 13.3652 12.5315 13.5157 12.2768 13.6141C11.9255 13.7445 11.5543 13.8133 11.1795 13.8175C10.5565 13.8456 10.369 13.8522 8.79146 13.8522C7.21387 13.8522 7.02643 13.8462 6.4034 13.8175C6.02869 13.8129 5.65755 13.7441 5.3061 13.6141C5.05119 13.5158 4.81968 13.3653 4.62645 13.1722C4.43322 12.979 4.28254 12.7476 4.18411 12.4928C4.05389 12.1414 3.98507 11.7702 3.98066 11.3955C3.95264 10.7724 3.94664 10.585 3.94664 9.0074C3.94664 7.42982 3.95197 7.24304 3.98066 6.62001C3.98513 6.24529 4.05395 5.87412 4.18411 5.5227C4.2825 5.26776 4.43315 5.03623 4.62639 4.84299C4.81962 4.64976 5.05115 4.49911 5.3061 4.40072C5.65748 4.27042 6.02867 4.2016 6.4034 4.19727C6.94839 4.17258 7.15984 4.16525 8.26115 4.16391V4.16458ZM11.946 5.14582C11.8057 5.14582 11.6686 5.1874 11.552 5.26532C11.4354 5.34323 11.3445 5.45398 11.2909 5.58354C11.2372 5.71311 11.2232 5.85568 11.2505 5.99323C11.2779 6.13078 11.3454 6.25713 11.4446 6.35629C11.5437 6.45546 11.6701 6.52299 11.8076 6.55035C11.9452 6.57771 12.0878 6.56367 12.2173 6.51C12.3469 6.45633 12.4576 6.36545 12.5355 6.24884C12.6135 6.13223 12.655 5.99514 12.655 5.8549C12.655 5.66684 12.5803 5.48648 12.4474 5.3535C12.3144 5.22052 12.134 5.14582 11.946 5.14582ZM8.79146 5.9723C8.19134 5.9723 7.60468 6.15025 7.10569 6.48365C6.60669 6.81705 6.21776 7.29092 5.98807 7.84535C5.75838 8.39979 5.69825 9.00988 5.81528 9.59848C5.93231 10.1871 6.22125 10.7278 6.64556 11.1522C7.06986 11.5766 7.61048 11.8656 8.19906 11.9828C8.78764 12.0999 9.39775 12.0399 9.95223 11.8104C10.5067 11.5808 10.9807 11.192 11.3142 10.6931C11.6477 10.1941 11.8258 9.60753 11.8259 9.0074C11.8259 8.20256 11.5062 7.43067 10.9372 6.8615C10.3681 6.29232 9.59631 5.97248 8.79146 5.9723ZM8.79146 7.03959C9.18105 7.03959 9.5619 7.15512 9.88583 7.37156C10.2098 7.58801 10.4622 7.89565 10.6113 8.25559C10.7604 8.61553 10.7994 9.01159 10.7234 9.3937C10.6474 9.7758 10.4598 10.1268 10.1843 10.4023C9.90885 10.6778 9.55786 10.8654 9.17575 10.9414C8.79365 11.0174 8.39758 10.9784 8.03765 10.8293C7.67771 10.6802 7.37007 10.4277 7.15362 10.1038C6.93717 9.77984 6.82165 9.399 6.82165 9.00941C6.82138 8.75056 6.87214 8.49419 6.97101 8.25497C7.06989 8.01575 7.21494 7.79837 7.39788 7.61524C7.58082 7.43211 7.79806 7.28684 8.03718 7.18772C8.2763 7.08861 8.53261 7.03759 8.79146 7.03759V7.03959Z" fill="white"/>
                            </svg>
                            @else
                            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.02398 1.00309C4.68203 1.00309 3.70479 1.00643 3.51468 1.02244C2.96734 1.04435 2.43045 1.17926 1.93776 1.41867C1.59399 1.58628 1.2831 1.81425 1.01989 2.09173C0.509094 2.62415 0.183284 3.30687 0.0906825 4.03886C0.0023867 4.82316 -0.0214849 5.61338 0.0193075 6.40157C0.0193075 7.03861 0.0193075 7.87777 0.0193075 9.00309C0.0193075 12.343 0.0193075 13.3183 0.037318 13.5077C0.0603313 14.0435 0.190289 14.5692 0.419541 15.054C0.633245 15.4917 0.939246 15.8779 1.31649 16.186C1.69373 16.4942 2.13325 16.717 2.60482 16.839C2.9858 16.9303 3.37521 16.9819 3.76683 16.9931C3.96694 17.0018 5.98545 17.0078 8.0073 17.0078C10.0291 17.0078 12.051 17.0078 12.2438 16.9958C12.6497 16.9881 13.0535 16.9353 13.4478 16.8383C13.9203 16.7171 14.3607 16.4942 14.7381 16.1852C15.1155 15.8762 15.421 15.4886 15.6331 15.0493C15.8585 14.574 15.9869 14.0586 16.0106 13.5331C16.0213 13.395 16.026 11.1984 16.026 9.00109C16.026 6.80381 16.0213 4.61053 16.01 4.47245C15.9887 3.94017 15.8588 3.41785 15.6284 2.93755C15.4585 2.58665 15.2254 2.27006 14.9407 2.00368C14.4066 1.49444 13.7236 1.16952 12.9915 1.07647C12.2075 0.987451 11.4175 0.96291 10.6295 1.00309H8.02398Z" fill="#B0BBCB" />
                                <path d="M8.02071 3.09375C6.41577 3.09375 6.21432 3.10109 5.58396 3.12977C5.0938 3.13964 4.60887 3.23257 4.14979 3.4046C3.75713 3.55642 3.40052 3.78858 3.10278 4.0862C2.80504 4.38382 2.57275 4.74034 2.42078 5.13294C2.2484 5.59192 2.15546 6.07692 2.14595 6.56711C2.11793 7.19748 2.1106 7.39893 2.1106 9.00386C2.1106 10.6088 2.11793 10.8096 2.14662 11.44C2.15663 11.9301 2.24955 12.415 2.42144 12.8741C2.57334 13.2667 2.80552 13.6233 3.10313 13.921C3.40074 14.2188 3.75723 14.4511 4.14979 14.6031C4.6091 14.7751 5.09425 14.8681 5.58462 14.878C6.21499 14.9066 6.41644 14.914 8.02138 14.914C9.62631 14.914 9.8271 14.9066 10.4575 14.878C10.9478 14.868 11.433 14.7751 11.8923 14.6031C12.2847 14.4509 12.6411 14.2185 12.9387 13.9208C13.2363 13.6231 13.4686 13.2666 13.6206 12.8741C13.7918 12.4148 13.8847 11.93 13.8955 11.44C13.9235 10.8096 13.9315 10.6088 13.9315 9.00386C13.9315 7.39893 13.9242 7.19748 13.8955 6.56711C13.8848 6.07704 13.7919 5.59224 13.6206 5.13294C13.4686 4.74037 13.2363 4.38386 12.9386 4.08624C12.6409 3.78862 12.2843 3.55645 11.8916 3.4046C11.4321 3.23269 10.9467 3.13977 10.4561 3.12977C9.82576 3.10109 9.62498 3.09375 8.01938 3.09375H8.02071ZM7.4904 4.16104H8.02071C9.59896 4.16104 9.78574 4.16638 10.4088 4.19506C10.7835 4.19954 11.1547 4.26835 11.5061 4.39851C11.7609 4.49698 11.9923 4.64767 12.1854 4.8409C12.3785 5.03413 12.5291 5.26562 12.6274 5.5205C12.7576 5.8719 12.8264 6.24308 12.8308 6.61781C12.8589 7.24084 12.8655 7.42828 12.8655 9.0052C12.8655 10.5821 12.8595 10.7696 12.8308 11.3926C12.8264 11.7673 12.7576 12.1385 12.6274 12.4899C12.5289 12.7445 12.3782 12.9757 12.1851 13.1687C11.992 13.3616 11.7607 13.5122 11.5061 13.6105C11.1547 13.7409 10.7835 13.8098 10.4088 13.814C9.78574 13.842 9.5983 13.8487 8.02071 13.8487C6.44312 13.8487 6.25568 13.8427 5.63265 13.814C5.25794 13.8094 4.8868 13.7406 4.53534 13.6105C4.28044 13.5123 4.04893 13.3617 3.8557 13.1686C3.66247 12.9755 3.51179 12.7441 3.41336 12.4892C3.28314 12.1378 3.21431 11.7667 3.2099 11.3919C3.18189 10.7689 3.17588 10.5815 3.17588 9.00386C3.17588 7.42628 3.18122 7.2395 3.2099 6.61647C3.21438 6.24175 3.2832 5.87058 3.41336 5.51916C3.51175 5.26422 3.6624 5.03269 3.85563 4.83945C4.04887 4.64622 4.2804 4.49557 4.53534 4.39718C4.88672 4.26688 5.25792 4.19806 5.63265 4.19372C6.17763 4.16904 6.38909 4.16171 7.4904 4.16037V4.16104ZM11.1752 5.14228C11.035 5.14228 10.8979 5.18386 10.7813 5.26178C10.6647 5.33969 10.5738 5.45044 10.5201 5.58C10.4664 5.70957 10.4524 5.85214 10.4798 5.98969C10.5071 6.12724 10.5747 6.25359 10.6738 6.35275C10.773 6.45192 10.8993 6.51945 11.0369 6.54681C11.1744 6.57417 11.317 6.56013 11.4466 6.50646C11.5761 6.45279 11.6869 6.36191 11.7648 6.2453C11.8427 6.12869 11.8843 5.9916 11.8843 5.85136C11.8843 5.6633 11.8096 5.48294 11.6766 5.34996C11.5436 5.21698 11.3633 5.14228 11.1752 5.14228ZM8.02071 5.96876C7.42058 5.96876 6.83393 6.14671 6.33494 6.48011C5.83594 6.81351 5.44701 7.28738 5.21732 7.84181C4.98763 8.39625 4.9275 9.00634 5.04453 9.59494C5.16156 10.1835 5.4505 10.7242 5.8748 11.1486C6.29911 11.573 6.83973 11.8621 7.42831 11.9792C8.01689 12.0964 8.62699 12.0364 9.18148 11.8068C9.73596 11.5773 10.2099 11.1884 10.5434 10.6895C10.8769 10.1906 11.055 9.60399 11.0551 9.00386C11.0551 8.19902 10.7355 7.42713 10.1664 6.85796C9.59737 6.28878 8.82555 5.96894 8.02071 5.96876ZM8.02071 7.03605C8.4103 7.03605 8.79115 7.15158 9.11508 7.36802C9.43901 7.58447 9.69149 7.89211 9.84058 8.25205C9.98967 8.61199 10.0287 9.00805 9.95268 9.39016C9.87667 9.77226 9.68906 10.1233 9.41358 10.3987C9.1381 10.6742 8.78711 10.8618 8.405 10.9378C8.02289 11.0138 7.62683 10.9748 7.26689 10.8257C6.90696 10.6766 6.59931 10.4242 6.38287 10.1002C6.16642 9.7763 6.05089 9.39546 6.05089 9.00587C6.05063 8.74702 6.10139 8.49065 6.20026 8.25143C6.29914 8.01221 6.44419 7.79483 6.62713 7.6117C6.81007 7.42857 7.02731 7.2833 7.26643 7.18418C7.50555 7.08507 7.76186 7.03405 8.02071 7.03405V7.03605Z" fill="white" />
                            </svg>
                            @endif

                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="@if($current_dashboard!='instagram') color: #B0BBCB; @endif">{{__('Instagram ')}} </p>
                    </a>
                </li>
                @elseif($dashboard->name == 'google-analytics-overview')
                <li>
                    <a href="{{url('dashboard/google-analytics-overview')}}" class="dropdown-item py-2 d-flex g-6 align-items-center" href="#">
                        <span>
                        <svg width="16" height="16" viewBox="0 0 43 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="31.4819" width="11.4078" height="49" rx="5.70388" fill="#D1D1D1"/>
                        <rect x="15.3208" y="18.8477" width="12.3584" height="30.1538" rx="6.1792" fill="#B4B4B4"/>
                        <rect x="0.110352" y="37.6953" width="11.4078" height="11.3077" rx="5.65385" fill="#B4B4B4"/>
                        </svg>
                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #B0BBCB;">{{__('Google Analytics')}}</p>
                    </a>
                </li>
                @elseif($dashboard->name == 'google-ads-overview')
                <li>
                    <a href="{{url('dashboard/google-ads-overview')}}" class="dropdown-item py-2 d-flex g-6 align-items-center">
                        <span>
                            <svg width="16" height="16" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6765 7.75313C17.1169 6.50496 17.8315 5.3714 18.7678 4.43583C19.6715 3.556 20.7662 2.8967 21.9665 2.5093C23.1668 2.12191 24.4403 2.01687 25.6879 2.20239C26.9354 2.3879 28.1233 2.85894 29.159 3.57883C30.1946 4.29871 31.0501 5.24799 31.6587 6.35271C33.6324 9.94441 35.7237 13.4567 37.7563 17.0092C41.15 22.9098 44.5839 28.8104 47.9385 34.7296C48.4581 35.6664 48.7881 36.6964 48.9096 37.7608C49.0312 38.8252 48.9419 39.9031 48.6468 40.9329C48.3518 41.9628 47.8568 42.9245 47.1901 43.763C46.5235 44.6016 45.6981 45.3006 44.7613 45.8202C43.8245 46.3399 42.7945 46.6698 41.7301 46.7914C40.6657 46.9129 39.5878 46.8236 38.558 46.5286C37.5281 46.2336 36.5664 45.7386 35.7279 45.0719C34.8893 44.4052 34.1903 43.5799 33.6706 42.6431C30.6908 37.453 27.7044 32.2698 24.7115 27.0934C24.6508 26.9808 24.5782 26.875 24.4949 26.7779C24.2204 26.4979 23.9996 26.1701 23.8432 25.8106C22.5212 23.4821 21.159 21.1732 19.837 18.8644C18.9883 17.365 18.1004 15.8842 17.2517 14.3848C16.4928 13.0669 16.1168 11.5634 16.1659 10.0434C16.186 9.2541 16.3605 8.47638 16.6794 7.75411" fill="#A2A2A2"/>
                            <path d="M16.6736 7.75C16.4784 8.45968 16.3527 9.18667 16.2983 9.9207C16.2421 11.5478 16.6529 13.157 17.4821 14.5581C19.6545 18.2879 21.8193 22.0293 23.9766 25.782C24.1726 26.1172 24.3314 26.4533 24.5293 26.7689C23.3455 28.8259 22.1616 30.8584 20.9572 32.9105C19.3 35.7721 17.6419 38.6533 15.9651 41.5139C15.8857 41.5139 15.8671 41.4747 15.8465 41.4159C15.844 41.261 15.8709 41.1071 15.9259 40.9622C16.3371 39.6064 16.3779 38.1653 16.0441 36.7884C15.7103 35.4115 15.014 34.149 14.0276 33.132C12.8163 31.8082 11.1715 30.9611 9.39029 30.7437C8.27025 30.5716 7.12643 30.6392 6.03444 30.9419C4.94244 31.2446 3.92711 31.7757 3.05557 32.4999C2.72041 32.7567 2.50285 33.131 2.10791 33.329C2.07701 33.3316 2.04619 33.3232 2.0209 33.3052C1.99561 33.2873 1.97748 33.261 1.96973 33.231C2.91739 31.5934 3.84447 29.9548 4.79115 28.3173C8.69808 21.5291 12.6119 14.7472 16.5325 7.97148C16.5717 7.8921 16.6305 7.8333 16.6707 7.7549" fill="#CACACA"/>
                            <path d="M2.05722 33.2863C2.43256 32.9512 2.78732 32.6003 3.18226 32.2799C4.28756 31.4163 5.59686 30.8524 6.98371 30.6426C8.37055 30.4327 9.78808 30.5841 11.0994 31.082C12.4106 31.5799 13.5714 32.4076 14.4694 33.485C15.3675 34.5625 15.9725 35.8533 16.2261 37.2328C16.4681 38.6385 16.3597 40.0822 15.9105 41.436C15.8934 41.5497 15.8669 41.6618 15.8311 41.7712C15.6537 42.0867 15.496 42.4219 15.298 42.7384C14.5562 44.1096 13.427 45.2319 12.0515 45.9654C10.6759 46.699 9.11477 47.0112 7.56286 46.8632C5.69086 46.7342 3.92172 45.9592 2.55761 44.6707C1.19349 43.3822 0.319007 41.66 0.0835046 39.7984C-0.178812 37.9762 0.203886 36.1195 1.16542 34.5495C1.36142 34.1948 1.59956 33.8782 1.81614 33.5235C1.91414 33.4441 1.87494 33.2863 2.0533 33.2863" fill="#A8A8A8"/>
                            </svg>
                        </span>
                        <p class="m-0 pages-dropdown-text-sm @if($get_locale=='ar') font-NotoSansArabic-Regular @endif" style="color: #B0BBCB;">{{__('Google Ads')}}</p>
                    </a>
                </li>
                @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>