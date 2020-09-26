@extends('layouts.app')

@section('page_title', 'Profil użytkownika')

@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection

@section('content')

    <section class="bg-image bg-dark d-flex align-items-end py-3" style="background-color: #3a3a3c !important;min-height: 320px;">
        <img class="background" src="/storage/{{ $user->profile->background }}" alt="" ya-style="opacity: .25">
        <div class="container position-relative">
            <div class="row">
                <div class="col d-flex flex-column flex-lg-row align-items-center text-center position-absolute bottom left pl-lg-8">
                    <a class="avatar-thumbnail avatar-lg d-lg-none bg-dark mb-3 mb-lg-0 border-0" href="#">
                        <img src="/storage/{{ $user->profile->avatar }}" alt="">
                    </a>
                    <h2 class="h4 text-white mb-0 ml-2 pl-lg-8">
                        @if($user->profile->verified_user == 1)
                            <i class="ya ya-check bg-primary float-left font-size-xs rounded-circle p-2 mr-2"  data-toggle="tooltip" title="Zweryfikowany"></i>
                        @endif
                        {{ $user->FullName }}</h2>
                    <div class="ml-lg-auto mt-4 mb-3 my-lg-0">
                        <a class="btn btn-primary btn-sm btn-icon-left font-weight-semibold ml-2" href="{{ route('voyager.dashboard') }}"><i class="ya ya-content"></i> Przejdź do Panelu Administracyjnego</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white border-bottom nav-profile py-0" ya-sticky>
        <div class="container">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <a class="avatar-thumbnail avatar-xl position-absolute d-none d-lg-block" href="#">
                        <img src="/storage/{{ $user->profile->avatar }}" alt="">
                    </a>
                    <div class="avatar-fixed d-none d-lg-block">
                        <a class="avatar-tile" href="#">
                            <img src="/storage/{{ $user->profile->avatar }}" alt="">
                            <div>
                                <strong>{{ $user->FullName }}</strong>
                                <span class="d-block">&#64;{{ $user->username }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="nav-scroll">
                        <div class="nav nav-list nav-list-profile" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#about" role="tab" aria-controls="about">O mnie</a>
                        </div>
                    </div>
                    <div class="dropdown d-none d-xl-inline-block ml-auto">
                        <div class="btn-group" role="group" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a class="btn btn-outline-primary btn-icon" href="#" role="button"><i class="ya ya-gear"></i></a>
                            <a class="btn btn-outline-primary" href="#" role="button">Zarządzanie kontem</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('user.profile-edit') }}">Ustawienia</a>
                            <a class="dropdown-item" href="{{ route('user.password-change') }}">Zabezpieczenia</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="widget mt-4">
                        <div class="widget-header">O mnie</div>
                        <div class="widget-body">
                            <p>{{ $user->profile->bio }}</p>
                            <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-pin mr-1"></i> {{ $user->profile->country->name }}</p>
                            @if(!is_null($user->profile->facebook_url))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-facebook mr-1"></i> <a href="{{ $user->profile->facebook_url }}" target="_blank">{{ $user->FullName }}</a></p>
                            @endif

                            @if(!is_null($user->profile->twitter_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-twitter mr-1"></i> <a href="https://twitter.com/{{ $user->profile->twitter_url }}" target="_blank">{{ $user->profile->twitter_url }}</a></p>
                            @endif

                            @if(!is_null($user->profile->instagram_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-instagram mr-1"></i> <a href="https://instragram.com/{{ $user->profile->instagram_url }}" target="_blank">{{ $user->profile->instagram_url }}</a></p>
                            @endif

                            @if(!is_null($user->profile->twitch_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-twitch mr-1"></i> <a href="https://twitch.com/{{ $user->profile->twitch_url }}" target="_blank">{{ $user->profile->twitch_url }}</a></p>
                            @endif

                            @if(!is_null($user->profile->website_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-link mr-1"></i> <a href="{{ $user->profile->website_url }}" target="_blank">{{ $user->profile->website_url }}</a></p>
                            @endif

                            <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-calendar mr-1"></i> Dołączył: {{ Carbon::createFromTimestamp(strtotime($user->created_at))->isoFormat('MMMM YYYY') }}</p>

                            @if(!is_null($user->profile->birth_date ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-star-o mr-1"></i> Wiek: {{ Carbon::createFromTimestamp(strtotime($user->profile->birth_date))->diff(Carbon::now())->format('%y lat') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="widget widget-users">
                        <div class="widget-header">Redaktorzy</div>
                        <div class="widget-body">
                            @foreach ($editors as $editor)
                                <a href="/redaktor/{{ $editor->username }}" data-toggle="tooltip" title="{{ $editor->FullName }}" target="_blank">
                                    <img src="/storage/{{ $editor->profile->avatar }}" alt="{{ $editor->FullName }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card border-warning mb-3">
                                <div class="card-header">
                                    Oh nie!
                                </div>
                                <div class="card-body">
                                    <h1 class="display-6">Strona w budowie.</h1>
                                    <p class="card-text lead">
                                        Ta strona jeszcze jest w budowie. Niebawem pojawią się tutaj nowe funkcjonalności
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="/storage/other/404-dribb.gif" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
