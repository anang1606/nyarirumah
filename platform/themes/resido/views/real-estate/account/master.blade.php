@php
    Theme::layout('account');
    $user = auth('account')->user();
@endphp
<section class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="filter_search_opt">
                    <a href="javascript:void(0);" class="open_search_menu">
                        {{ __('Dashboard Navigation') }}
                        <i class="ml-2 ti-menu"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="simple-sidebar sm-sidebar" id="filter_search">

                    <div class="search-sidebar_header">
                        <h4 class="ssh_heading">{{ __('Close Filter') }}</h4>
                        <button class="w3-bar-item w3-button w3-large close_search_menu"><i
                                class="ti-close"></i></button>
                    </div>

                    <div class="sidebar-widgets">
                        <div class="dashboard-navbar">
                            <div class="d-user-avater">
                                <img
                                    src="{{ $user->avatar->url ? RvMedia::getImageUrl($user->avatar->url, 'thumb') : $user->avatar_url }}"
                                    alt="{{ $user->name }}" class="img-fluid avater" style="width: 150px;">
                                <h4>{{ $user->name }}</h4>
                                <span>{{ $user->phone }}</span>
                            </div>

                            <div class="d-navigation">
                                <ul>
                                    <li class="{{ request()->routeIs('public.account.dashboard') ? 'active' : '' }}">
                                        <a href="{{ route('public.account.dashboard') }}"
                                           title="{{ trans('plugins/real-estate::dashboard.header_profile_link') }}">
                                            <i class="ti-dashboard"></i>{{ __('Dashboard') }}
                                        </a>
                                    </li>

                                    <li class="{{ request()->routeIs('public.account.settings') ? 'active' : '' }}">
                                        <a
                                            href="{{ route('public.account.settings') }}"
                                            title="{{ trans('plugins/real-estate::dashboard.header_settings_link') }}">
                                            <i class="fas fa-cogs mr1"></i>{{ trans('plugins/real-estate::dashboard.header_settings_link') }}
                                        </a>
                                    </li>
                                    @if (RealEstateHelper::isEnabledCreditsSystem())
                                    <li class="{{ request()->routeIs('public.account.packages') ? 'active' : '' }}">
                                        <a
                                            href="{{ route('public.account.packages') }}"
                                            title="{{ trans('plugins/real-estate::account.credits') }}">
                                            <i class="far fa-credit-card mr1"></i>{{ trans('plugins/real-estate::account.buy_credits') }}
                                            <span
                                                class="badge badge-info">{{ auth('account')->user()->credits }} {{ trans('plugins/real-estate::account.credits') }}</span>
                                        </a>
                                    </li>
                                    @endif

                                    {!! apply_filters(ACCOUNT_TOP_MENU_FILTER, null) !!}
                                    <li class="{{ request()->routeIs('public.account.properties.index') ? 'active' : '' }}">
                                        <a
                                            href="{{ route('public.account.properties.index') }}"
                                            title="{{ trans('plugins/real-estate::account-property.properties') }}">
                                            <i class="far fa-newspaper mr1"></i>{{ trans('plugins/real-estate::account-property.properties') }}
                                        </a>
                                    </li>

                                    @if (auth('account')->user()->canPost())
                                        <li class="{{ request()->routeIs('public.account.properties.create') ? 'active' : '' }}">
                                            <a
                                                href="{{ route('public.account.properties.create') }}"
                                                title="{{ trans('plugins/real-estate::account-property.write_property') }}">
                                                <i class="far fa-edit mr1"></i>{{ trans('plugins/real-estate::account-property.write_property') }}
                                            </a>
                                        </li>
                                    @endif

                                    <li class="{{ request()->routeIs('public.account.security') ? 'active' : '' }}">
                                        <a href="{{ route('public.account.security') }}">
                                            <i class="ti-unlock"></i>
                                            {{ trans('plugins/real-estate::dashboard.sidebar_security') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a class="no-underline mr2 black-50 hover-black-70 pv1 ph2 db"
                                           href="#"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           title="{{ trans('plugins/real-estate::dashboard.header_logout_link') }}">
                                            <i class="fas fa-sign-out-alt mr1"></i>
                                            <span>{{ trans('plugins/real-estate::dashboard.header_logout_link') }}</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('public.account.logout') }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-12">
                <div id="@yield('account_wrap_id', 'app')">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
</section>

@php ob_start(); @endphp
<!-- Put translation key to translate in VueJS -->
<script type="text/javascript">
    "use strict";
    window.trans = JSON.parse('{!! addslashes(json_encode(trans('plugins/real-estate::dashboard'))) !!}');
    var BotbleVariables = BotbleVariables || {};
    BotbleVariables.languages = {
        tables: {!! json_encode(trans('core/base::tables'), JSON_HEX_APOS) !!},
        notices_msg: {!! json_encode(trans('core/base::notices'), JSON_HEX_APOS) !!},
        pagination: {!! json_encode(trans('pagination'), JSON_HEX_APOS) !!},
        system: {
            'character_remain': '{{ trans('core/base::forms.character_remain') }}'
        }
    };
    var RV_MEDIA_URL = {'media_upload_from_editor': '{{ route('public.account.upload-from-editor') }}'};
</script>
@stack('header')
@php $masterHeaderScript = ob_get_clean(); @endphp

@php ob_start(); @endphp
{!! Assets::renderFooter() !!}
@stack('scripts')
@stack('footer')
@php $masterFooterScript = ob_get_clean(); @endphp

@php
    Theme::asset()->container('footer')->usePath(false)->add('lodash-js', asset('vendor/core/core/media/libraries/lodash/lodash.min.js'));
    Theme::asset()->usePath(false)->add('real-estate-app_custom-css', asset('vendor/core/plugins/real-estate/css/app_custom.css'));
    Theme::asset()->container('header')->writeContent('master-header-js', $masterHeaderScript);
    Theme::asset()->container('footer')->writeContent('master-footer-js', "<script> 'use strict'; $(document).ready(function () { $('#preloader').remove(); })</script>" . $masterFooterScript);
    Theme::asset()->container('footer')->usePath()->remove('components-js');
@endphp
