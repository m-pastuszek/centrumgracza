@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja recenzji' : 'Dodawanie recenzji'))
@section('css')
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        {{(isset($dataTypeContent->id) ? 'Edycja recenzji' : 'Dodawanie recenzji')}}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="review-edit" class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.reviews.update', $dataTypeContent->id) }}@else{{ route('voyager.reviews.store') }}@endif" method="POST" enctype="multipart/form-data">
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
                                <span class="panel-desc"> Wprowadź tytuł swojej recenzji.</span>
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
                                <span class="panel-desc">Wybierz grę, którą chcesz zrecenzować. (Uwaga! Gra musi zostać wcześniej dodana do bazy gier!)</span></h3>
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
                    <!-- ### WYBÓR PLATFORMY ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-laptop"></i> Platforma</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('platform_id') has-error @enderror">
                                <select class="form-control select2" name="platform_id">
                                    <option disabled selected value>— Wybierz platformę —</option>
                                    @foreach(App\Models\Platform::orderBy('name', 'asc')->get() as $platform)
                                        <option value="{{ $platform->id }}" @if(isset($dataTypeContent->platform_id) && $dataTypeContent->platform_id == $platform->id || old('platform_id', $dataTypeContent->platform_id) == $game->id ) selected="selected" @endif>{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                @error('platform_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### WSTĘP ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-bullhorn"></i> Wstęp
                            <span class="panel-desc">Maksymalnie dwa zdania. Pamiętaj, żeby zachęcić Czytelnika do przeczytania recenzji.</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('excerpt') has-error @enderror">
                                @error('excerpt')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control" name="excerpt">{{ old('excerpt', $dataTypeContent->excerpt ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ### TREŚĆ ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-book"></i> Treść recenzji</h3>
                        </div>
                        <div class="panel-body @error('body') has-error @enderror">
                            @error('body')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                            <textarea class="form-control richTextBox" id="body" name="body" style="border:0px; height: 600px">{{ old('body', $dataTypeContent->body ?? '' ) }}</textarea>
                        </div>
                    </div><!-- .panel -->

                    <!-- ### PODSUMOWANIE ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-star"></i> Podsumowanie</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('ending') has-error @enderror">
                                @error('ending')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control" name="ending" style="height: 150px">{{ old('ending', $dataTypeContent->ending ?? '' ) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ### PLUSY ### -->

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-plus-circle"></i> Plusy
                                <span class="panel-desc">UWAGA! Musisz użyć listy wypunktowanej, aby poprawnie wyświetlić zawartość.</span></h3>
                    </div>
                        <div class="panel-body">
                            <div class="form-group @error('positives') has-error @enderror">
                                @error('positives')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control richTextBox" name="positives">{{ old('positives', $dataTypeContent->positives ?? '' ) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ### MINUSY ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-minus-circle"></i> Minusy
                                <span class="panel-desc">UWAGA! Musisz użyć listy wypunktowanej, aby poprawnie wyświetlić zawartość.</span></h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('negatives') has-error @enderror">
                                @error('negatives')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control richTextBox" name="negatives">{{ old('negatives', $dataTypeContent->negatives ?? '') }}</textarea>
                            </div>
                        </div>
                    </div><!-- .panel -->
                </div>
                <div class="col-md-4">

                    <!-- ### OCENA ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading" style="background-color:#5cb85c">
                            <h3 class="panel-title" style="color:#fff"><i class="fas fa-thumbs-up"></i> Ocena</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true" style="color:#fff"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('rating') has-error @enderror">
                                <label class="control-label" for="rating"><b>Ocena końcowa</b> (w skali od 1 do 100)</label>
                                <input type="number" class="form-control" id="rating" name="rating" min="1" max="100" value="{{ old('rating', $dataTypeContent->rating ?? '') }}">
                                @error('rating')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('gameplay') has-error @enderror">
                                <label class="control-label" for="gameplay"><b>Rozgrywka</b> (w skali od 1 do 100)</label>
                                <input type="number" class="form-control" id="gameplay" name="gameplay" min="1" max="100" value="{{ old('gameplay', $dataTypeContent->rating ?? '') }}">
                                @error('gameplay')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('graphics') has-error @enderror">
                                <label class="control-label" for="graphics"><b>Grafika</b> (w skali od 1 do 100)</label>
                                <input type="number" class="form-control" id="graphics" name="graphics" min="1" max="100" value="{{ old('graphics', $dataTypeContent->rating ?? '') }}">
                                @error('graphics')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('sounds') has-error @enderror">
                                <label class="control-label" for="sounds"><b>Muzyka</b> (w skali od 1 do 100)</label>
                                <input type="number" class="form-control" id="sounds" name="sounds" min="1" max="100" value="{{ old('sounds', $dataTypeContent->rating ?? '') }}">
                                @error('sounds')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- ### SZCZEGÓŁY ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-clipboard"></i> Szczegóły</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('status') has-error @enderror">
                                <label class="control-label" for="status">Status</label>
                                <select class="form-control select2" name="status" required>
                                    <option value="DRAFT"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT') selected="selected"@endif>Wersja robocza</option>
                                    <option value="PENDING"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING') selected="selected"@endif>Oczekujący na korektę</option>
                                    <option value="PUBLISHED"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED') selected="selected"@endif>Opublikowany</option>
                                </select>
                                @error('status')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('published_at') has-error @enderror">
                                <label class="control-label" for="datetime">Data publikacji</label>
                                <input type="text" id="datetime" class="form-control flatpickr-input active" name="published_at" value="{{ old('published_at', $dataTypeContent->published_at ?? '') }}">
                                @error('published_at')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('slug') has-error @enderror">
                                <label class="control-label" for="name">Adres URL</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                       value="{{ $dataTypeContent->slug ?? '' }}" placeholder="(generowany automatycznie)">
                                @error('slug')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('author_id') has-error @enderror">
                                <label for="author_id">Autor</label>
                                <select class="form-control select2" name="author_id" id="author_id">
                                    <option disabled selected value>— Wybierz autora —</option>
                                    @foreach(App\Models\User::where('role_id', '3')->orderBy('first_name', 'asc')->get() as $user)
                                        <option value="{{ $user->id }}" @if(isset($dataTypeContent->author_id) && $dataTypeContent->author_id == $user->id || old('author_id', $dataTypeContent->author_id)  == $user->id ) selected="selected"@endif>{{ $user->FullName }}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-image"></i> Obrazek wyróżniający</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('image') has-error @enderror">
                                @if(isset($dataTypeContent->image))
                                    <img alt src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                                @endif
                                <input type="file" name="image">
                                    @error('image')
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
                            <div class="form-group @error('meta_description') has-error @enderror">
                                <label class="control-label" for="name">Opis</label>
                                <textarea class="form-control" name="meta_description">{{ old('meta_description', $dataTypeContent->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
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
                <i class="fas fa-paper-plane"></i>@if(isset($dataTypeContent->id)) Aktualizuj @else Dodaj @endif recenzję
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

            $('.form-group').on('click', '.remove-multi-image', function (e) {
                e.preventDefault();
                $image = $(this).siblings('img');
                params = {
                    slug:   '{{ $dataType->slug }}',
                    image:  $image.data('image'),
                    id:     $image.data('id'),
                    field:  $image.parent().data('field-name'),
                    _token: '{{ csrf_token() }}'
                }
                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });
            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {
                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });
                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@stop
