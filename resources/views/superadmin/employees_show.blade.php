<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <p class="float-left text-green-600">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show Employees') }}
            </h2>
            </p>

            <p class="float-right text-green-800">
                <a href="{{ route('superadmin.employee.index') }}">
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
                                    <th scope="col" class="py-3 px-6 bg-gray-50">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Department
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Job Title
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Role
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Salary
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $emp)
                                    <tr class="border-b border-gray-200 dark:border-gray-200">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $people->where('id', '=', $emp->person_id)->value('fname') }}
                                            {{ $people->where('id', '=', $emp->person_id)->value('lname') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $departments->where('id', '=', $emp->dep_id)->value('name') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $emp->title }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $emp->role }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $emp->salary }} SP
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
