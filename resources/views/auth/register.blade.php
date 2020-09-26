@extends('layouts.app')
@section('page_title', 'Rejestracja')
@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection
@section('additional_css')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection
@section('additional_js')

@endsection
@section('content')

    <section class="py-lg-5 bg-image" ya-style="background-color: #464242">
        <img class="background" src="/storage/other/register-bg.jpg" alt="">

        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <register-form></register-form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="terms">
            <div class="modal-dialog modal-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-file-text-o"></i> Regulamin Serwisu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            $page = \App\Models\Page::where('slug', 'regulamin-serwisu')->first();
                        @endphp
                        {!! $page->body !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="privacy_policy">
            <div class="modal-dialog modal-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-file-text-o"></i> Polityka prywatności</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            $page = \App\Models\Page::where('slug', 'polityka-prywatnosci')->first();
                        @endphp
                        {!! $page->body !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection
