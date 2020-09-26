@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->place) ? 'Edycja miejsca TOP5 ' : 'Dodawanie miejsca TOP5 '))

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
        {{ (isset($dataTypeContent->place) ? 'Edycja miejsca TOP5' : 'Dodawanie miejsca TOP5') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="form" class="form-edit-add" role="form" action="@if(isset($dataTypeContent->place)){{ route('voyager.top-games.update', $dataTypeContent->place) }}@else{{ route('voyager.top-games.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->place))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fas fa-i-cursor"></i> Miejsce
                                <span class="panel-desc"> Numer miejsca w rankingu</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="text" class="form-control" name="place" placeholder="Miejsce" readonly value="{{ old('place', $dataTypeContent->place ?? '') }}">
                        </div>
                    </div>

                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-bullhorn"></i> Gra</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <select class="form-control select2" name="game_id" id="game_id">
                                    <option disabled selected value>— Wybierz grę —</option>
                                    @foreach(\App\Models\Game::orderBy('name', 'asc')->get() as $game)
                                        <option value="{{ $game->id }}" @if(isset($dataTypeContent->game_id) && $dataTypeContent->game_id == $game->id || old('game_id', $dataTypeContent->game_id)  == $game->id ) selected="selected"@endif>{{ $game->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->place))<i class="fas fa-paper-plane"></i> Aktualizuj @else <i class="fas fa-paper-plane"></i> Dodaj @endif
            </button>
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
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@stop
