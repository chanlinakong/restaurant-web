@extends('adminlte::page')

@section('title', $title ?? 'Bites Restaurant')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>
            @yield('page_header')
        </div>

        <div class="d-flex align-items-center">

            {{-- Dark Mode Button --}}
            <button
                id="theme-toggle"
                type="button"
                class="btn btn-outline-secondary btn-sm mr-2"
                title="Toggle dark mode"
            >
                <i id="theme-icon" class="fas fa-moon"></i>
            </button>
        </div>

    </div>

@stop


@section('content')

    @yield('admin_content')

@stop


@push('js')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;
    const html = document.documentElement;

    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    /*
    |--------------------------------------------------------------------------
    | Apply Theme
    |--------------------------------------------------------------------------
    */

    function applyTheme() {

        const darkMode =
            localStorage.getItem('bites-dark-mode') === 'true';

        /*
         * AdminLTE
         */
        body.classList.toggle('dark-mode', darkMode);

        /*
         * Tailwind
         */
        html.classList.toggle('dark', darkMode);

        /*
         * Change icon
         */
        if (themeIcon) {

            if (darkMode) {

                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');

            } else {

                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');

            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Load saved theme
    |--------------------------------------------------------------------------
    */

    applyTheme();


    /*
    |--------------------------------------------------------------------------
    | Toggle Theme
    |--------------------------------------------------------------------------
    */

    if (themeToggle) {

        themeToggle.addEventListener('click', function () {

            const darkMode =
                !body.classList.contains('dark-mode');

            localStorage.setItem(
                'bites-dark-mode',
                darkMode ? 'true' : 'false'
            );

            applyTheme();

        });

    }

     const logoutButton = document.getElementById('logout-button');

    if (logoutButton) {

        logoutButton.addEventListener('click', function (event) {

            event.preventDefault();

            const form = document.createElement('form');

            form.method = 'POST';
            form.action = '{{ route('logout') }}';

            const csrf = document.createElement('input');

            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';

            form.appendChild(csrf);

            document.body.appendChild(form);

            form.submit();
        });
    }

});
</script>

@endpush