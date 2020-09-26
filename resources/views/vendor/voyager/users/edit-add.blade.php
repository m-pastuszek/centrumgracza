@extends('voyager::master')

@section('page_title', (isset($dataTypeContent->id) ? 'Edycja konta użytkownika' : 'Dodawanie nowego użytkownika'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ (isset($dataTypeContent->id) ? 'Edycja konta użytkownika' : 'Dodawanie nowego użytkownika') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <p><strong>Uwaga! </strong>Nowo utworzony użytkownik nie jest domyślnie powiązany z profilem. <br/>
                            Aby to zrobić musisz dodać i edytować użytkownika, a potem ponownie go zapisać.</p><hr/>
                        <p>Ponadto, w tej chwili nie ma możliwości edycji profilu użytkownika z poziomu Panelu Administracyjnego.<br/>
                        Można edytować dane tylko swojego konta pod adresem: <a href="{{ route('user.profile-edit') }}" style="color: white; font-weight: bolder">Edycja profilu</a></p>
                    </div>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-user"></i> Dane użytkownika</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="username"> Nazwa użytkownika</label>
                                <input type="text" class="form-control @error('username') has-error @enderror" id="username" name="username"
                                       value="{{ old('username', $dataTypeContent->username ?? '') }}">
                                @error('username')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first_name">Imię</label>
                                <input type="text" class="form-control @error('first_name') has-error @enderror" id="first_name" name="first_name"
                                       value="{{ old('first_name', $dataTypeContent->first_name ?? '') }}">
                                @error('first_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">Nazwisko</label>
                                <input type="text" class="form-control @error('last_name') has-error @enderror" id="last_name" name="last_name"
                                       value="{{ old('last_name', $dataTypeContent->last_name ?? '') }}">
                                @error('last_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Adres e-mail</label>
                                <input type="email" class="form-control @error('email') has-error @enderror" id="email" name="email"
                                       value="{{ old('email', $dataTypeContent->email ?? '') }}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            @php
                                $roles = \TCG\Voyager\Models\Role::first();
                            @endphp

                            @can('read', $roles)
                                <div class="form-group">
                                    <label for="role_id">Podstawowa rola</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <label for="additional_roles">Dodatkowa rola</label>
                                    @php
                                        $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan
                            @php
                                if (isset($dataTypeContent->locale)) {
                                    $selected_locale = $dataTypeContent->locale;
                                } else {
                                    $selected_locale = config('app.locale', 'pl');
                                }

                            @endphp
                            <div class="form-group">
                                <label for="locale">Język</label>
                                <select class="form-control select2" id="locale" name="locale">
                                    @foreach (Voyager::getLocales() as $locale)
                                        <option value="{{ $locale }}"
                                                {{ ($locale == $selected_locale ? 'selected' : '') }}>{{ $locale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fas fa-lock"></i> Hasło</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="password">Hasło</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control @error('password') has-error @enderror" id="password" name="password" value="" autocomplete="new-password">
                                @error('password')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
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
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
