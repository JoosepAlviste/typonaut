<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>{{ config('app.name', 'Typonaut') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => auth()->user(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">

        <page>

            <template slot="navigation">
                @include('layouts.nav_side')
            </template>

            @yield('content')

        </page>

        <modal :show="modal.show"
               :title="modal.title"
               :body_text="modal.bodyText"
               :primary_btn_text="modal.primaryBtnText"
               :secondary_btn_text="modal.secondaryBtnText"
               v-on:primary-clicked="handlePrimaryClick"
               v-on:secondary-clicked="handleSecondaryClick">
        </modal>
        <spinner :show="spinner.show"
                 :text="spinner.text">
        </spinner>

        <notification :show="notification.show" :text="notification.message" :type="notification.type"></notification>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
