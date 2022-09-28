<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <p class="float-left text-green-600">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show Request') }}
            </h2>
            </p>

            <p class="float-right text-green-800">
                <a href="{{ route('manager.dashboard') }}">
                    <button
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded"
                        type="button">
                        <- Back </button>
                </a>
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                                        Request
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 dark:bg-gray-800">
                                        Description
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 dark:bg-gray-800">
                                        Quantity
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 dark:bg-gray-800">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 dark:bg-gray-800">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $req)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{ $req->request }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{ $req->description }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{ $req->quantity }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{ $req->status }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{ $req->created_at }}
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
