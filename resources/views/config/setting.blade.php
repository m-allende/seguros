<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" />
        <style>
            /* arreglo para mostrar autocomplete en modal! */
            .pac-container {
                z-index: 1061 !important;
            }

            .swal2-container {
                z-index: 3000;
            }
        </style>

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('settings.store') }}" class="form-horizontal form"
                        role="form">
                        {!! csrf_field() !!}

                        @if (count(config('setting_fields', [])))
                            @foreach (config('setting_fields') as $section => $fields)
                                <div class="card">
                                    <div class="card-header">
                                        <i class="{{ Arr::get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                        {{ $fields['title'] }}
                                        <p class="text-muted">{{ $fields['desc'] }}</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($fields['elements'] as $field)
                                                <div class="col-6">
                                                    @includeIf('config.fields.' . $field['type'])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endif

                        <div class="row m-b-md">
                            <div class="col-md-12">
                                <button type="button" class="btn-primary btn-save">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script>
            $('.btn-save').click(function(e) {
                e.preventDefault();
                var data = $('.form').serialize()
                console.log(data)
                $.ajax({
                    type: "POST",
                    url: "{{ route('settings.store') }}",
                    data: data,
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: "Grabado Correctamente",
                                confirmButtonClass: 'btn btn-primary w-xs',
                                buttonsStyling: false
                            });
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
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
