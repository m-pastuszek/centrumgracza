@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja firmy' : 'Dodawanie firmy'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ (isset($dataTypeContent->id) ? 'Edycja firmy' : 'Dodawanie firmy') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" id="form" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.companies.update', $dataTypeContent->id) }}@else{{ route('voyager.companies.store') }}@endif" method="POST" enctype="multipart/form-data">
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

                    <div class="panel">
                        <div class="panel panel panel-bordered panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fas fa-building"></i> O firmie</h3>
                                <div class="panel-actions">
                                    <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label for="name">Nazwa firmy</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dataTypeContent->name ?? '' ) }}">
                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group @error('parent_company') has-error @enderror">
                                    <label for="parent_company">Firma macierzysta</label>
                                    <select class="form-control select2" name="parent_id" id="parent_id">
                                        <option disabled selected value> — wybierz firmę, jeśli dotyczy — </option>
                                        @foreach(App\Models\Company::orderBy('name', 'asc')->get() as $company)
                                            <option value="{{ $company->id }}"@if(isset($dataTypeContent->parent_id) && $dataTypeContent->parent_id == $company->id || old('parent_id', $dataTypeContent->parent_id) == $company->id) selected="selected"@endif>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_company')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group @error('status') has-error @enderror">
                                    <label for="country_id">Status firmy</label>
                                    <select class="form-control select2" name="status" id="status">
                                        <option value="active" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'active') selected="selected"@endif>Aktywna</option>
                                        <option value="defunct" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'defunct') selected="selected"@endif>Zamknięta</option>
                                    </select>
                                    @error('status')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group @error('start_date') has-error @enderror">
                                    <label for="start_date">Rok założenia</label>
                                    <input type="number" min="1800" max="2099" step="1" class="form-control" name="start_date" id="start_date"
                                           value="{{ old('start_date', $dataTypeContent->start_date ?? '') }}">
                                    @error('start_date')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group @error('end_date') has-error @enderror">
                                    <label for="start_date">Rok zamknięcia</label>
                                    <input type="number" min="1800" max="2099" step="1" class="form-control" name="end_date" id="end_date" placeholder="(jeśli dotyczy)"
                                           value="{{ old('end_date', $dataTypeContent->end_date ?? '') }}">
                                    @error('end_date')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group @error('country_id') has-error @enderror">
                                    <label for="country_id">Kraj</label>
                                    <select class="form-control select2" name="country_id" id="country_id">
                                        @foreach(App\Models\Country::all() as $country)
                                            <option value="{{ $country->id }}" @if(isset($dataTypeContent->country_id) && $dataTypeContent->country_id == $country->id || old('country_id', $dataTypeContent->country_id)  == $country->id ) selected="selected"@endif>{{ $country->iso }} — {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ### OPIS ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-book"></i> Opis działalności firmy</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('description') has-error @enderror">
                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control" name="description">{{ old('description', $dataTypeContent->description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-info"></i> Informacje</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('website') has-error @enderror">
                                <label for="website">Strona internetowa</label>
                                <input type="text" class="form-control" name="website" id="website"
                                       value="{{ old('website', $dataTypeContent->website ?? '') }}">
                                @error('website')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('slug') has-error @enderror">
                                <label for="slug">Adres URL</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="(wypełniane automatycznie)"
                                       {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                       value="{{ old('slug', $dataTypeContent->slug ?? '') }}">
                                @error('slug')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- ### OBRAZEK WYRÓŻNIAJĄCY ### -->
                    <div class="panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-image"></i> Obrazek wyróżniający</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group @error('logo') has-error @enderror">
                                @if(isset($dataTypeContent->logo))
                                    <img alt src="{{ filter_var($dataTypeContent->logo, FILTER_VALIDATE_URL) ? $dataTypeContent->logo : Voyager::image( $dataTypeContent->logo ) }}" style="width:100%" />
                                @endif
                                <input type="file" name="logo">
                                @error('logo')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fas fa-paper-plane"></i>@if(isset($dataTypeContent->id)) Aktualizuj @else Dodaj @endif firmę
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
            $('#slug').slugify();

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@stop
