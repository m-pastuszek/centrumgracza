@extends('layouts.app')
@section('page_title', $page->name)

@section('meta_description'){{ $page->meta_description }}@endsection
@section('meta_keywords'){{ $page->meta_keywords }}@endsection

@section('other_metas')
    <meta property="og:image" content="{{ $page->image }}">
@endsection

@section('content')

    <section class="overflow-hidden py-8 px-3 px-md-0" data-parallax="scroll" data-image-src="/storage/{{ $page->image }}">
        <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="display-3 text-white mb-3">{{ $page->name }}</h2>
                    <p class="h5 font-weight-light text-light mb-0">{!! $page->lead !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-lg-6 px-1">
        <div class="container">
            <div class="row">
                <div class="col">
                    {!! $page->body !!}
                </div>
            </div>
        </div>
    </section>

@endsection