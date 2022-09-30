<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <p class="float-left text-green-600">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inprogress Orders') }}
            </h2>
            </p>

            <p class="float-right text-green-800">
                <a href="{{ route('employee.dashboard') }}">
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
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="py-3 px-6 bg-gray-50">
                                        Request
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Description
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Quantity
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Offers
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Price
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Department Name
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inprogress as $inpro)
                                    @php
                                        $offer = $offers->where('req_id', '=', $inpro->id)->where('chosen', '=', '1');
                                        $employee = $employees->where('id', '=', $inpro->emp_id);
                                        $department = $departments->where('id', '=', $employee->value('dep_id'));
                                    @endphp
                                    <tr class="border-b border-gray-200 dark:border-gray-200">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $inpro->request }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $inpro->description }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $inpro->quantity }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $offer->value('offer') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $offer->value('price') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $department->value('name') }}
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
