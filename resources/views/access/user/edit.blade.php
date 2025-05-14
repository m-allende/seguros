<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        {{-- @vite(['resources/scss/light/assets/components/timeline.scss']) --}}
        <link rel="stylesheet" href="{{ asset('plugins/filepond/filepond.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/sweetalerts2/sweetalerts2.css') }}">

        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/light/assets/components/tabs.scss'])
        @vite(['resources/scss/light/assets/elements/alert.scss'])
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss'])
        @vite(['resources/scss/light/assets/forms/switches.scss'])
        @vite(['resources/scss/light/assets/components/list-group.scss'])
        @vite(['resources/scss/light/assets/users/account-setting.scss'])

        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/assets/components/tabs.scss'])
        @vite(['resources/scss/dark/assets/elements/alert.scss'])
        @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/dark/plugins/notification/snackbar/custom-snackbar.scss'])
        @vite(['resources/scss/dark/assets/forms/switches.scss'])
        @vite(['resources/scss/dark/assets/components/list-group.scss'])
        @vite(['resources/scss/dark/assets/users/account-setting.scss'])

        <link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.css') }}">
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" />

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Editar Perfil</h2>
                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab"
                                href="#animated-underline-home" role="tab" aria-controls="animated-underline-home"
                                aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> Personal</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab"
                                href="#animated-underline-profile" role="tab"
                                aria-controls="animated-underline-profile" aria-selected="false" tabindex="-1"><svg
                                    viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                                    </rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg> Laboral</button>
                        </li>
                        <!--
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-preferences-tab" data-bs-toggle="tab"
                                href="#animated-underline-preferences" role="tab"
                                aria-controls="animated-underline-preferences" aria-selected="false" tabindex="-1"><svg
                                    viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <path
                                        d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1">
                                    </path>
                                    <polygon points="12 15 17 21 7 21 12 15"></polygon>
                                </svg> Preferencias</button>
                        </li>
                        -->
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel"
                    aria-labelledby="animated-underline-home-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6 class="">Información General</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-12 col-md-4">
                                                    <div class="profile-image  mt-4 pe-md-4">

                                                        <!-- // The classic file input element we'll enhance
                                                        // to a file pond, we moved the configuration
                                                        // properties to JavaScript -->

                                                        <div class="img-uploader-content">
                                                            <input type="file" class="filepond" name="filepond"
                                                                accept="image/png, image/jpeg, image/gif" />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">Nombre de Usuario</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="name" name="name"
                                                                        placeholder="Nombre"
                                                                        value="{{ $user->name }}">
                                                                    <input type="hidden" name="role_id"
                                                                        value="{{ $user->roles[0]->id }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="description">Descripción</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="description" name="description"
                                                                        placeholder="Description"
                                                                        value="{{ $user->description }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="first_name">Nombre</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="first_name" name="first_name"
                                                                        placeholder="Nombre"
                                                                        value="{{ $user->first_name }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="last_name">Apellido</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="last_name" name="last_name"
                                                                        placeholder="Apellido"
                                                                        value="{{ $user->last_name }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="region_id">Región</label>
                                                                    <select class="form-control select2-region"
                                                                        id="region_id" name="region_id">
                                                                        @if (!empty($user->region_id))
                                                                            <option value="{{ $user->region_id }}">
                                                                                {{ $user->region->name }} </option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="city_id">Ciudad</label>
                                                                    <select class="form-control select2-city"
                                                                        id="city_id" name="city_id">
                                                                        @if (!empty($user->city_id))
                                                                            <option value="{{ $user->city_id }}">
                                                                                {{ $user->city->name }} </option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-3">
                                                                    <label for="commune">Comuna</label>
                                                                    <select class="form-control select2-commune"
                                                                        id="commune_id" name="commune_id">
                                                                        @if (!empty($user->commune_id))
                                                                            <option value="{{ $user->commune_id }}">
                                                                                {{ $user->commune->name }} </option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="address">Dirección</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="address" name="address"
                                                                        placeholder="Address"
                                                                        value="{{ $user->address }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone">Teléfono</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="phone" name="phone"
                                                                        placeholder="+9999999999"
                                                                        value="{{ $user->phone }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="email" name="email"
                                                                        placeholder="test@test.cl"
                                                                        value="{{ $user->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="website">Sitio Web</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="website" name="website"
                                                                        placeholder="Ingresa URL"
                                                                        value="{{ $user->website }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="birthday">Fecha de
                                                                        Nacimiento</label><br>
                                                                    @php
                                                                        $birthday = '';
                                                                        if ($user->birthday != null) {
                                                                            $birthday = date(
                                                                                'd/m/Y',
                                                                                strtotime($user->birthday),
                                                                            );
                                                                        }
                                                                    @endphp
                                                                    <input type="text" id="birthday"
                                                                        name="birthday" class="form-control"
                                                                        value="{{ $birthday }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mt-1">
                                                                <div class="form-group text-end">
                                                                    <button
                                                                        class="btn btn-secondary btn-save">@lang('translation.save')</button>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="social" class="section social">
                                <div class="info">
                                    <h5 class="">Social</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group social-linkedin mb-3">
                                                        <span class="input-group-text me-3" id="linkedin"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-linkedin">
                                                                <path
                                                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                                                </path>
                                                                <rect x="2" y="9" width="4" height="12">
                                                                </rect>
                                                                <circle cx="4" cy="4" r="2"></circle>
                                                            </svg></span>
                                                        <input type="text" class="form-control"
                                                            name="social_linkedin" id="social_linkedin"
                                                            placeholder="Usuario en Linkedin" aria-label="Username"
                                                            aria-describedby="linkedin" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group social-tweet mb-3">
                                                        <span class="input-group-text me-3" id="tweet"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-twitter">
                                                                <path
                                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                                </path>
                                                            </svg></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Usuario de Twitter" aria-label="Username"
                                                            name="social_twitter" id="social_twitter"
                                                            aria-describedby="tweet" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group social-fb mb-3">
                                                        <span class="input-group-text me-3" id="fb"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-facebook">
                                                                <path
                                                                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                                </path>
                                                            </svg></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Usuario de Facebook" aria-label="Username"
                                                            name="social_facebook" id="social_facebook"
                                                            aria-describedby="fb" value="">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group social-github mb-3">
                                                        <span class="input-group-text me-3" id="github"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-github">
                                                                <path
                                                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                                </path>
                                                            </svg></span>
                                                        <input type="text" class="form-control"
                                                            placeholder="Usuario de Github" aria-label="Username"
                                                            name="social_github" id="social_github"
                                                            aria-describedby="github" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-1">
                                                    <div class="form-group text-end">
                                                        <button
                                                            class="btn btn-secondary btn-save">@lang('translation.save')</button>
                                                        <input type="hidden" name="where" value="social">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel"
                    aria-labelledby="animated-underline-profile-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6 class="">Información Laboral</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="address_laboral">Dirección</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="address_laboral" name="address_laboral"
                                                                        placeholder="Direcion Laboral"
                                                                        value="{{ $user->address_laboral }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone_laboral_1">Teléfono 1</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="phone_laboral_1" name="phone_laboral_1"
                                                                        placeholder="+9999999999"
                                                                        value="{{ $user->phone_laboral_1 }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone_laboral_2">Teléfono 2</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="phone_laboral_2" name="phone_laboral_2"
                                                                        placeholder="+9999999999"
                                                                        value="{{ $user->phone_laboral_2 }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email_laboral_1">Email 1</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="email_laboral_1" name="email_laboral_1"
                                                                        placeholder="test@test.cl"
                                                                        value="{{ $user->email_laboral_1 }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email_laboral_2">Email 2</label>
                                                                    <input type="text" class="form-control mb-3"
                                                                        id="email_laboral_2" name="email_laboral_2"
                                                                        placeholder="test@test.cl"
                                                                        value="{{ $user->email_laboral_2 }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mt-1">
                                                                <div class="form-group text-end">
                                                                    <input type="hidden" name="where"
                                                                        value="laboral">
                                                                    <button
                                                                        class="btn btn-secondary btn-save">@lang('translation.save')</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--
                <div class="tab-pane fade" id="animated-underline-preferences" role="tabpanel"
                    aria-labelledby="animated-underline-preferences-tab">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Elegir Tema</h6>
                                    <div class="d-sm-flex justify-content-around">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <img class="ms-3" width="100" height="68"
                                                    alt="settings-dark"
                                                    src="{{ Vite::asset('resources/images/settings-light.svg') }}">
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <img class="ms-3" width="100" height="68"
                                                    alt="settings-light"
                                                    src="{{ Vite::asset('resources/images/settings-dark.svg') }}">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Activity data</h6>
                                    <p>Download your Summary, Task and Payment History Data</p>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-primary">Download Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Public Profile</h6>
                                    <p>Your <span class="text-success">Profile</span> will be visible to anyone on the
                                        network.</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch"
                                                id="publicProfile" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Show my email</h6>
                                    <p>Your <span class="text-success">Email</span> will be visible to anyone on the
                                        network.</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch"
                                                id="showMyEmail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Enable keyboard shortcuts</h6>
                                    <p>When enabled, press <code class="text-success">ctrl</code> for help</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch"
                                                id="EnableKeyboardShortcut">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Hide left navigation</h6>
                                    <p>Sidebar will be <span class="text-success">hidden</span> by default</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch"
                                                id="hideLeftNavigation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Advertisements</h6>
                                    <p>Display <span class="text-success">Ads</span> on your dashboard</p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch"
                                                id="advertisements">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Social Profile</h6>
                                    <p>Enable your <span class="text-success">social</span> profiles on this network
                                    </p>
                                    <div class="form-group mt-4">
                                        <div
                                            class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch"
                                                id="socialprofile" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
            </div>

        </div>

    </div>


    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageCrop.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageResize.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageTransform.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/filepondPluginFileValidateSize.min.js') }}"></script>

        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalerts2/sweetalerts2.min.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>

        @vite(['resources/assets/js/users/account-settings.js'])

        @php
            $photo = URL::asset('/img/avatar.jpg');
            if ($user->lastPhoto != null) {
                $photo = URL::asset('img/upl/' . $user->lastPhoto->path);
            }
        @endphp
        <script type="module">
            //userProfile.files("{{ URL::asset('/img/avatar.jpg') }}");

            FilePond.setOptions({
                server: {
                    url: "/user/upload/{{ $user->id }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    load: (uniqueFileId, load) => {
                        fetch(uniqueFileId)
                            .then(res => res.blob())
                            .then(load);
                    },
                },
                files: [{
                    source: "{{ $photo }}",
                    options: {
                        type: 'local',
                    }
                }, ]
            });
        </script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                const birthday = flatpickr("#birthday", config_flatpickr);
                let btnSave = $('.btn-save');
                let form = $('.general-info');

                btnSave.click(function(e) {
                    e.preventDefault();
                    let form = $(this).closest("form");
                    let data = form.serialize()
                    data += "&file=" + userProfile;
                    console.log(data)
                    $.ajax({
                        type: "PUT",
                        url: "/access/user/{{ $user->id }}",
                        data: data,
                        success: function(data) {
                            if (data.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Hecho",
                                    confirmButtonClass: 'btn btn-primary w-xs',
                                    buttonsStyling: false
                                });
                            } else if (data.status == 400) {
                                sweetError(data.errors);
                            } else {
                                var error = '';
                                $.each(data.errors, function(key, err_values) {
                                    error += err_values
                                    error += '<br>';
                                });
                                sweetError(error);
                            }
                        },
                        error: function(data) {
                            sweetError("Error al Grabar");
                        }
                    });
                })
            })
        </script>

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
