<!DOCTYPE html>
<html lang="en">
@include('layouts._head')

<body>
    <div id="app">
        @include('layouts._header')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>

</html>
