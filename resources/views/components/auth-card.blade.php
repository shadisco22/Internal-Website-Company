<div style="background-image: url('/img/login.jpg');"
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-700 bg-no-repeat">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full bg-gray-200 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
