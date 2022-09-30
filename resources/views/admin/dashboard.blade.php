<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg border border-gray-200 w-full text-gray-900">
                {{-- <a href="#!" aria-current="true"
                    class="block px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white cursor-pointer">
                    The current link item
                </a>
                <a href="#!"
                    class="block px-6 py-2 border-b border-gray-200 w-full hover:bg-gray-100 hover:text-gray-500
                    focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600 transition duration-500 cursor-pointer">
                    A second link item
                </a> --}}
            </div>
        </div>
    </div>
</x-app-layout>
