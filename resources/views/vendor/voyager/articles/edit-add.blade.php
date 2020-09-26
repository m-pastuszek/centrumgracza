@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja artykułu' : 'Dodawanie artykułu'))

@section('breadcrumbs')
    <ol class="breadcrumb hidden-xs">
        <li class="active">
            <a href="{{ route('voyager.dashboard')}}"><i class="voyager-controller"></i> {{ __('voyager::generic.dashboard') }}</a>
        </li>
        <li class="active">
            @if(isset($dataType->id))
                <a href="/admin/articles">
                        {{ $dataType->display_name_plural }}
                </a>
            @else
                <a href="{{ route('voyager.bread.create', ['name' => 'articles']) }}">
                    {{ $display_name }}
                </a>
            @endif
        </li>
        <li>
            {{ isset($dataTypeContent->id) ? __('voyager::generic.edit') : __('voyager::generic.add') }}
        </li>
    </ol>
@endsection

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
        {{ (isset($dataTypeContent->id) ? 'Edycja artykułu' : 'Dodawanie artykułu') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="form" class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.articles.update', $dataTypeContent->id) }}@else{{ route('voyager.articles.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
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
                                <span class="panel-desc"> Wprowadź tytuł dla tego artykułu</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" class="form-control" name="name" placeholder="Tytuł" value="{{ old('name', $dataTypeContent->name ?? '') }}">
                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ### WSTĘP ### -->
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-bullhorn"></i> Wstęp</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('name') has-error @enderror">
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
                            <h3 class="panel-title"><i class="fas fa-book"></i> Treść</h3>
                        </div>
                        <div class="form-group @error('body') has-error @enderror">
                            @error('body')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                            <textarea class="form-control richTextBox" name="body" id="richtextbody">
                                {{ old('body', $dataTypeContent->body ?? '') }}
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <!-- ### SZCZEGÓŁY ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clipboard"></i> Szczegóły</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('category_id') has-error @enderror">
                                <label for="category_id">Kategoria</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    @foreach(TCG\Voyager\Models\Category::orderBy('name', 'asc')->get() as $category)
                                        <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id) selected="selected"@endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('status') has-error @enderror">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="DRAFT" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT') selected="selected"@endif>Wersja robocza</option>
                                    <option value="PENDING" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING') selected="selected"@endif>Oczekujący na korektę</option>
                                    <option value="PUBLISHED" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED') selected="selected"@endif>Opublikowany</option>
                                </select>
                                @error('status')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('published_at') has-error @enderror">
                                <label for="datetime">Data publikacji</label>
                                <input type="text" id="datetime" class="form-control flatpickr-input active" name="published_at" value="{{ $dataTypeContent->published_at ?? '' }}" required>
                                @error('published_at')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('slug') has-error @enderror">
                                <label for="slug">Adres URL</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="Wypełniane automatycznie"
                                       {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                       value="{{ $dataTypeContent->slug ?? '' }}">
                                @error('slug')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('author_id') has-error @enderror">
                                <label for="author_id">Autor</label>
                                <select class="form-control select2" name="author_id" id="author_id" required>
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

                    <!-- ### OBRAZEK WYRÓŻNIAJĄCY ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-image"></i> Obrazek wyróżniający</h3>
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
                                <label for="name">Opis</label>
                                <textarea class="form-control" name="meta_description">{{ old('meta_description', $dataTypeContent->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('meta_keywords') has-error @enderror">
                                <label for="name">Słowa kluczowe</label>
                                <textarea class="form-control" name="meta_keywords">{{ old('meta_keywords', $dataTypeContent->meta_keywords ?? '') }}</textarea>
                                @error('meta_keywords')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('tags') has-error @enderror">
                                <label for="tags">Tagi</label>
                                <select
                                        class="form-control select2-ajax" id="tags"
                                        name="article_belongstomany_tag_relationship[]" multiple
                                        data-get-items-route="{{route('voyager.articles.relation')}}"
                                        data-get-items-field="article_belongstomany_tag_relationship">

                                    @php
                                        $tags = \App\Models\Tag::class;
                                        $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($tags, 'article_tag')->get()->map(function ($item, $key) use ($tags) {
                                            return $item->id;
                                        })->all() : array();
                                        $relationshipOptions = \App\Models\Tag::all();
                                    @endphp


                                    @foreach($relationshipOptions as $relationshipOption)
                                        <option value="{{ $relationshipOption->id }}" @if(in_array($relationshipOption->id, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->name }}</option>
                                    @endforeach

                                </select>
                                @error('tags')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id))<i class="fas fa-paper-plane"></i> Aktualizuj @else <i class="fas fa-paper-plane"></i> Dodaj artykuł @endif
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

        $("#category_id").select2({
            minimumResultsForSearch: -1
        });
        $("#status").select2({
            minimumResultsForSearch: -1
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
        });
    </script>

@stop
