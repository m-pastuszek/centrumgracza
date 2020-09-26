@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja filmu' : 'Dodawanie filmu'))

@section('css')
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop


@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ (isset($dataTypeContent->id) ? 'Edycja filmu' : 'Dodawanie filmu') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="video-edit" class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.videos.update', $dataTypeContent->id) }}@else{{ route('voyager.videos.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <h5>Upewnij się, że uzupełniłeś wszystkie wymagane pola!</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- ### TYTUŁ ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fas fa-i-cursor"></i> Tytuł
                                <span class="panel-desc"> Wprowadź tytuł filmu</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tytuł" value="{{ old('name', $dataTypeContent->name ?? '' ) }}">
                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### WYBÓR GRY ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-gamepad"></i> Wybór gry
                                <span class="panel-desc">(Uwaga! Gra musi zostać wcześniej dodana do bazy danych!)</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('game_id') has-error @enderror">
                                <select class="form-control select2" name="game_id">
                                    <option disabled selected value>— Wybierz grę —</option>
                                    @foreach(App\Models\Game::orderBy('name', 'asc')->get() as $game)
                                        <option value="{{ $game->id }}" @if(isset($dataTypeContent->game_id) && $dataTypeContent->game_id == $game->id || old('game_id', $dataTypeContent->game_id) == $game->id ) selected="selected" @endif>{{ $game->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- ### SZCZEGÓŁY ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-clipboard"></i> Szczegóły</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('youtube_video_id') has-error @enderror">
                                <label for="youtube_video_id">Identyfikator filmu — wyróżniona część linku: <br>youtube.com/watch?v=<b><u>cAUIRzgEkX8</u></b></label>
                                <input type="text" class="form-control" name="youtube_video_id" value="{{ old('youtube_video_id', $dataTypeContent->youtube_video_id ?? '') }}">
                                @error('youtube_video_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('slug') has-error @enderror">
                                <label for="slug">Adres URL</label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="(generowany automatycznie)"
                                       {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                       value="{{ old('slug', $dataTypeContent->slug ?? '') }}">
                                @error('slug')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### OPTYMALIZACJA SEO ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-search"></i> SEO</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('meta_keywords') has-error @enderror">
                                <label class="control-label" for="name">Słowa kluczowe</label>
                                <textarea class="form-control" name="meta_keywords">{{ old('meta_keywords', $dataTypeContent->meta_keywords ?? '') }}</textarea>
                                @error('meta_keywords')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                <i class="fas fa-paper-plane"></i>@if(isset($dataTypeContent->id)) Aktualizuj @else Dodaj @endif film
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $(document).on("keypress", 'form', function (e) {
            var code = e.keyCode || e.which;
            console.log(code);
            if (code == 13) {
                console.log('Inside');
                e.preventDefault();
                return false;
            }
        });

        $('document').ready(function () {
            /*
                Blokada zmiany adresu (slug) w przypadku aktualizacji.
                Przeciwdziałanie błędowi 404 udostępnionych linków.
             */
            @if(!isset($dataTypeContent->id))
            $('#slug').slugify();

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });
            @endif

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
