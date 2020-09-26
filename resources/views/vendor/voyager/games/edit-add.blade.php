@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja gry' : 'Dodawanie gry'))

@section('css')
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
        {{ (isset($dataTypeContent->id) ? 'Edycja gry' : 'Dodawanie gry') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="form" class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.games.update', $dataTypeContent->id) }}@else{{ route('voyager.games.store') }}@endif" method="POST" enctype="multipart/form-data">
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
                            <h3 class="panel-title"><i class="fas fa-i-cursor"></i> Tytuł oraz typ gry
                                <span class="panel-desc">Wprowadź tytuł i typ gry.</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label" for="name">Tytuł oryginalny</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? ' has-error' : '' }}" id="name" name="name" value="{{ old('name', $dataTypeContent->name ?? '') }}">
                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('polish_title') has-error @enderror">
                                    <label for="polish_title">Polski tytuł gry (opcjonalnie)</label>
                                    <input type="text" class="form-control" id="polish_title" name="polish_title" value="{{ old('polish_title', $dataTypeContent->polish_title ?? '') }}">
                                    @error('polish_title')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group @error('type_id') has-error @enderror" id="type_selection">
                                    <label class="control-label" for="type_id">Typ gry</label>
                                    <select class="form-control select2" name="type_id" id="type_id">
                                        @foreach(App\Models\GameType::orderBy('id', 'asc')->get() as $type)
                                            <option value="{{ $type->id }}" @if(isset($dataTypeContent->type_id) && $dataTypeContent->type_id == $type->id || old('type_id', $dataTypeContent->type_id)  == $type->id ) selected="selected"@endif>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group @error('parent_game') has-error @enderror" id="parent_game_form">
                                    <label class="control-label" for="parent_game">Wybierz grę (jeśli dodajesz DLC lub edycję istniejącej gry)</label>
                                    <select class="form-control select2" name="parent_game" id="parent_game">
                                        <option disabled selected value>— Wybierz grę —</option>
                                        @foreach(\App\Models\Game::orderBy('name', 'asc')->get() as $game)
                                            <option value="{{ $game->id }}" @if(isset($dataTypeContent->parent_game) && $dataTypeContent->parent_game == $game->id || old('parent_game', $dataTypeContent->parent_game)  == $game->id ) selected="selected"@endif>{{ $game->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_game')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### WSTĘP ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-bullhorn"></i> Opis
                                <span class="panel-desc">Opis powinien zawierać maksymalnie dwa zdania.</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('excerpt') has-error @enderror">
                                <textarea class="form-control" name="excerpt">{{ old('excerpt', $dataTypeContent->excerpt ?? '') }}</textarea>
                                @error('excerpt')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### TREŚĆ ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-book"></i> Fabuła
                                <span class="panel-desc">Niech zawiera dużo treści! Zwróć uwagę na fabułę, rozgrywkę, mechanikę i tryby gry.</span>
                            </h3>
                        </div>
                        <div class="form-group @error('body') has-error @enderror">
                            @error('body')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                            <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">{{ old('body', $dataTypeContent->body ?? '' ) }}</textarea>
                        </div>
                    </div>


                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-laptop"></i> Wymagania systemowe <span class="text-muted">(jeśli dotyczy)</span></h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <h4>Minimalne</h4>
                                    <div class="form-group @error('minReq_os') has-error @enderror">
                                        <label for="minReq_os">System operacyjny</label>
                                        <input type="text" class="form-control" name="minReq_os" value="{{ old('minReq_os', $dataTypeContent->minReq_os ?? '') }}">
                                        @error('minReq_os')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('minReq_cpu') has-error @enderror">
                                        <label for="minReq_cpu">Procesor (CPU)</label>
                                        <input type="text" class="form-control" name="minReq_cpu" value="{{ old('minReq_cpu', $dataTypeContent->minReq_cpu ?? '') }}">
                                        @error('minReq_cpu')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('minReq_ram') has-error @enderror">
                                        <label for="minReq_ram">Pamięć RAM</label>
                                        <input type="text" class="form-control" name="minReq_ram" value="{{ old('minReq_ram', $dataTypeContent->minReq_ram ?? '') }}">
                                        @error('minReq_ram')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('minReq_gpu') has-error @enderror">
                                        <label for="minReq_gpu">Karta graficzna (GPU)</label>
                                        <input type="text" class="form-control" name="minReq_gpu" value="{{ old('minReq_gpu', $dataTypeContent->minReq_gpu ?? '') }}">
                                        @error('minReq_gpu')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('minReq_hdd') has-error @enderror">
                                        <label for="minReq_hdd">Przestrzeń dyskowa</label>
                                        <input type="text" class="form-control" name="minReq_hdd" value="{{ old('minReq_hdd', $dataTypeContent->minReq_hdd ?? '') }}">
                                        @error('minReq_hdd')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('minReq_directx') has-error @enderror">
                                        <label for="minReq_directx">Wersja DirectX</label>
                                        <input type="text" class="form-control" name="minReq_directx" value="{{ old('minReq_directx', $dataTypeContent->minReq_directx ?? '') }}"
                                        @error('minReq_directx')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4>Rekomendowane</h4>
                                    <div class="form-group @error('recReq_os') has-error @enderror">
                                        <label for="recReq_os">System operacyjny</label>
                                        <input type="text" class="form-control" name="recReq_os" value="{{ old('recReq_os', $dataTypeContent->recReq_os ?? '') }}">
                                        @error('recReq_os')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('recReq_cpu') has-error @enderror">
                                        <label for="recReq_cpu">Procesor (CPU)</label>
                                        <input type="text" class="form-control" name="recReq_cpu" value="{{ old('recReq_cpu', $dataTypeContent->recReq_cpu ?? '') }}">
                                        @error('recReq_cpu')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('recReq_ram') has-error @enderror">
                                        <label for="recReq_ram">Pamięć RAM</label>
                                        <input type="text" class="form-control" name="recReq_ram" value="{{ old('recReq_ram', $dataTypeContent->recReq_ram ?? '') }}">
                                        @error('recReq_ram')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('recReq_gpu') has-error @enderror">
                                        <label for="recReq_gpu">Karta graficzna (GPU)</label>
                                        <input type="text" class="form-control" name="recReq_gpu" value="{{ old('recReq_gpu', $dataTypeContent->recReq_gpu ?? '') }}">
                                        @error('recReq_gpu')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('recReq_hdd') has-error @enderror">
                                        <label for="recReq_hdd">Przestrzeń dyskowa</label>
                                        <input type="text" class="form-control" name="recReq_hdd" value="{{ old('recReq_hdd', $dataTypeContent->recReq_hdd ?? '') }}">
                                        @error('recReq_hdd')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('recReq_directx') has-error @enderror">
                                        <label for="recReq_directx">Wersja DirectX</label>
                                        <input type="text" class="form-control" name="recReq_directx" value="{{ old('recReq_directx', $dataTypeContent->recReq_directx ?? '') }}">
                                        @error('recReq_directx')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ### ZDJĘCIA ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-camera"></i> Zdjęcia</h3>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->images))
                                @php $images = json_decode($dataTypeContent->images); @endphp

                                @if($images != null)
                                    @foreach($images as $image)
                                        <div class="img_settings_container" data-field-name="images" style="float:left;padding-right:15px;">
                                            <a href="#" class="voyager-x remove-multi-image" style="position: absolute;"></a>
                                            <img src="{{ Voyager::image( $image ) }}" data-file-name="{{ $image }}" data-id="{{ $dataTypeContent->id }}" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                            <div class="clearfix"></div>
                            <input type="file" name="images[]" multiple="multiple" accept="image/*"/>

                            <div class="form-group @error('images') has-error @enderror">
                                @error('images')
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
                            <div class="form-group">
                                <div class="form-check abc-checkbox abc-checkbox-success">
                                    <input class="form-check-input" type="checkbox" name="visibility" id="visibilityCheckbox" @if(isset($dataTypeContent->visibility) && $dataTypeContent->visibility == '1') {{ 'checked' }}@endif>
                                    <label class="form-check-label" for="visibilityCheckbox">
                                        Widoczna w bazie
                                    </label>
                                </div>
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="platforms">Platformy</label>
                                <select
                                        class="form-control select2-ajax" id="platforms"
                                        name="game_belongstomany_platform_relationship[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_platform_relationship">
                                    @php
                                        $model = \App\Models\Platform::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_platform')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Platform::all();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_platform_relationship')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="genres">Gatunki</label>
                                <select
                                        class="form-control select2-ajax" id="genres"
                                        name="game_belongstomany_genre_relationship[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_genre_relationship">
                                    @php
                                        $model = \App\Models\Genre::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_genre')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Genre::all();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_genre_relationship')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="modes">Tryby gry</label>
                                <select
                                        class="form-control select2-ajax" id="modes"
                                        name="game_belongstomany_mode_relationship[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_mode_relationship">
                                    @php
                                        $model = \App\Models\Mode::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_mode')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Mode::all();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_mode_relationship')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="player_perspectives">Perspektywy gry</label>
                                <select
                                        class="form-control select2-ajax" id="player_perspectives"
                                        name="game_belongstomany_player_perspective_relationship[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_player_perspective_relationship">
                                    @php
                                        $model = \App\Models\PlayerPerspective::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_player_perspective')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\PlayerPerspective::all();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_player_perspective_relationship')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="developers">Producent</label>
                                <select
                                        class="form-control select2-ajax" id="developers"
                                        name="game_belongstomany_company_relationship[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_company_relationship">
                                    @php
                                        $model = \App\Models\Company::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_developer')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Company::all();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_company_relationship')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="publisher">Wydawca</label>
                                <select
                                        class="form-control select2-ajax" id="publisher"
                                        name="game_belongstomany_company_relationship_1[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_company_relationship_1">
                                    @php
                                        $model = \App\Models\Company::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_publisher')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Company::all();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_company_relationship_1')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('game_belongstomany_platform_relationship') has-error @enderror">
                                <label for="polish_publisher">Polski wydawca</label>
                                <select
                                        class="form-control select2-ajax" id="polish_publisher"
                                        name="game_belongstomany_company_relationship_2[]" multiple
                                        data-get-items-route="{{route('voyager.games.relation')}}"
                                        data-get-items-field="game_belongstomany_company_relationship_2">
                                    @php
                                        $model = \App\Models\Company::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($model, 'game_polish_publisher')->get()->map(function ($item, $key) use ($model) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Company::orderBy('name')->get();
                                    @endphp

                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach
                                </select>
                                @error('game_belongstomany_company_relationship_2')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group  @error('release_date') has-error @enderror">
                                <label class="control-label" for="release_date">Data premiery</label>
                                <input id="date" type="date" class="form-control" name="release_date" value="{{ old('release_date', $dataTypeContent->release_date ?? '') }}">
                                @error('release_date')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group  @error('game_engine') has-error @enderror">
                                <label class="control-label" for="engine">Silnik</label>
                                <input type="text" class="form-control" name="game_engine" value="{{ old('game_engine', $dataTypeContent->game_engine ?? '') }}">
                                @error('game_engine')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group  @error('youtube_trailer') has-error @enderror">
                                <label class="control-label" for="youtube_trailer">Zwiastun (YouTube)</label>
                                <input type="text" class="form-control" name="youtube_trailer" value="{{ old('youtube_trailer', $dataTypeContent->youtube_trailer ?? '') }}">
                                @error('youtube_trailer')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group  @error('official_website') has-error @enderror">
                                <label class="control-label" for="official_website">Strona oficjalna</label>
                                <input type="text" class="form-control" name="official_website" placeholder="https://" value="{{ old('official_website', $dataTypeContent->official_website ?? '') }}">
                                @error('official_website')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('slug') has-error @enderror">
                                <label class="control-label" for="slug">Adres URL (automatycznie generowany)</label>
                                <input type="text" class="form-control" id="slug" name="slug"
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
                            <div class="form-group @error('meta_description') has-error @enderror">
                                <label class="control-label" for="meta_description"> Opis</label>
                                <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $dataTypeContent->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('meta_keywords') has-error @enderror">
                                <label class="control-label" for="meta_keywords"> Słowa kluczowe</label>
                                <textarea class="form-control" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords', $dataTypeContent->meta_keywords ?? '') }}</textarea>
                                @error('meta_keywords')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### ZDJĘCIE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-image"></i> Główne grafiki</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('background_image') has-error @enderror">
                                <label class="control-label" for="background_image"><strong>Obraz w tle (nie może zawierać żadnych napisów)</strong></label>
                                @if(isset($dataTypeContent->background_image))
                                    <img src="{{ filter_var($dataTypeContent->background_image, FILTER_VALIDATE_URL) ? $dataTypeContent->background_image : Voyager::image( $dataTypeContent->background_image ) }}" style="width:100%" />
                                @endif
                                <input type="file" name="background_image">
                                @error('background_image')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('box_image') has-error @enderror">
                                <label class="control-label" for="box_image"><strong>Okładka</strong></label>
                                @if(isset($dataTypeContent->box_image))
                                    <img src="{{ filter_var($dataTypeContent->box_image, FILTER_VALIDATE_URL) ? $dataTypeContent->box_image : Voyager::image( $dataTypeContent->box_image ) }}" style="width:100%" />
                                @endif
                                <input type="file" name="box_image">
                                @error('box_image')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary pull-right">
                <i class="fas fa-paper-plane"></i>@if(isset($dataTypeContent->id)) Aktualizuj @else Dodaj @endif grę
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
              enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
            <input name="image" id="upload_file" type="file"
                   onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
            {{ csrf_field() }}
        </form>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Usuwanie obrazu</h4>
                </div>

                <div class="modal-body">
                    <h4>Czy jesteś pewien, że chcesz usunąć ten obraz?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">Tak, usuń</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')

    <script>
        $('document').ready(function () {
            $('#slug').slugify();

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });
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
