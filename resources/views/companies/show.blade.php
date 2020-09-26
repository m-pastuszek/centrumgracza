@extends('layouts.app')
@section('page_title'){{ $company->name }}@endsection
@section('meta_description')Informacje o firmie {{ $company->name }}. Kiedy powstała oraz jakie gry wyprodukowano pod jej skrzydłami? Sprawdź! @endsection
@section('meta_keywords'){{ $company->name }}, producent, wydawca, firma, data założenia @endsection

@section('content')

    <nav class="bg-light" aria-label="breadcrumb">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Centrum Gracza</a></li>
                <li class="breadcrumb-item"><a>Wydawcy i producenci</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $company->name }}</li>
            </ol>
        </div>
    </nav>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 py-4 m-auto text-center">
                    <img src="/storage/{{ $company->logo }}" class="w-75 m-auto" alt="">
                </div>
                <div class="col-lg-8 py-8">
                    <div class="px-1 px-md-0">
                        <h2 class="display-5 font-weight-normal text-dark mb-5 mt-4">{{ $company->name }}</h2>
                        <p class="mb-4">{{ $company->description }}</p>
                        <hr class="my-2">
                        <div class="post-meta text-center">
                            <span class="post-meta-item"><i class="ya ya-calendar"></i> Rok założenia: {{ $company->start_date }}</span>
                            <span class="post-meta-item"><i class="ya ya-ranking"></i> Status:
                            @if($company->status == "active")
                                Aktywna
                            @elseif($company->status == "defunct")
                                Zamknięta
                            @endif
                            </span>
                            @if($company->status == "defunct")
                                <span class="post-meta-item"><i class="ya ya-calendar"></i> Rok zamknięcia: {{ $company->end_date }}</span>
                            @endif
                        </div>
                        <div class="post-meta text-center">
                        @if($company->parent != null)
                                <span class="post-meta-item"><i class="ya ya-ranking"></i> Firma holdingowa: <a href="{{ route('company', $company->parent->slug) }}">{{ $company->parent->name }}</a></span>
                            @endif
                            <span class="post-meta-item"><i class="ya ya-link"></i> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection