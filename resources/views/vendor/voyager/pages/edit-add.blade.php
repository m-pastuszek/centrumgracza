@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja strony' : 'Dodawanie strony'))

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
        {{ (isset($dataTypeContent->id) ? 'Edycja strony' : 'Dodawanie strony') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="game-edit" class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.pages.update', $dataTypeContent->id) }}@else{{ route('voyager.pages.store') }}@endif" method="POST" enctype="multipart/form-data">
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
                            <h3 class="panel-title"><i class="fas fa-i-cursor"></i> Tytuł strony
                                <span class="panel-desc">Wprowadź tytuł oraz podtytuł.</span></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label" for="name">Tytuł</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dataTypeContent->name ?? '') }}">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
                                    <label class="control-label" for="lead">Podtytuł</label>
                                    <input type="text" class="form-control" id="lead" name="lead" value="{{ old('lead', $dataTypeContent->lead ?? '') }}">
                                    @if ($errors->has('lead'))
                                        @foreach ($errors->get('lead') as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### TREŚĆ ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-book"></i> Treść</h3>
                        </div>
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            @if ($errors->has('body'))
                                @foreach ($errors->get('body') as $error)
                                    <span class="help-block">{{ $error }}</span>
                                @endforeach
                            @endif
                            <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">{{ old('body', $dataTypeContent->body ?? '' ) }}</textarea>
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
                                <label class="control-label" for="slug">Adres URL</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                       value="{{ old('slug', $dataTypeContent->slug ?? '') }}">
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
                            <div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
                                <label class="control-label" for="meta_description"> Opis</label>
                                <textarea class="form-control" name="meta_description">{{ old('meta_description', $dataTypeContent->meta_description ?? '') }}</textarea>
                                @if ($errors->has('meta_description'))
                                    @foreach ($errors->get('meta_description') as $error)
                                        <span class="help-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('meta_keywords') ? ' has-error' : '' }}">
                                <label class="control-label" for="meta_keywords"> Słowa kluczowe</label>
                                <textarea class="form-control" name="meta_keywords">{{ old('meta_keywords', $dataTypeContent->meta_keywords ?? '') }}</textarea>
                                @if ($errors->has('meta_keywords'))
                                    @foreach ($errors->get('meta_keywords') as $error)
                                        <span class="help-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-image"></i> Obraz wyróżniający</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label class="control-label" for="image"><strong>Obraz w tle</strong></label>
                                @if(isset($dataTypeContent->image))
                                    <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                                @endif
                                <input type="file" name="image">
                                @if ($errors->has('image'))
                                    @foreach ($errors->get('image') as $error)
                                        <span class="help-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                <i class="fas fa-paper-plane"></i>@if(isset($dataTypeContent->id)) Aktualizuj @else Dodaj @endif stronę
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

@stop

@section('javascript')

    <script>
        $('document').ready(function () {
            $('#slug').slugify();

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        // Rich Text Body Edytor
        function tinymce_setup_callback(editor) {

            editor.remove();
            editor = null;


            tinymce.init({
                branding: false,
                menubar: false,
                selector: 'textarea.richTextBox',
                skin_url: $('meta[name="assets-path"]').attr('content') + '?path=js/skins/voyager',
                min_height: 600,
                resize: 'vertical',
                plugins: 'link, image, code, table, textcolor, lists',
                extended_valid_elements: 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
                file_browser_callback: function (field_name, url, type, win) {
                    if (type == 'image') {
                        $('#upload_file').trigger('click');
                    }
                },
                toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table | code',
                convert_urls: false,
                image_caption: true,
                image_title: true,

                language_url: "/vendor/tcg/voyager/assets/js/langs/pl.js",
                language: "pl"
            });
        }
    </script>
@stop