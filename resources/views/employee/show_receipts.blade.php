<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <p class="float-left text-green-600">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show Receipts') }}
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
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase ">
                                <tr>
                                    <th scope="col" class="py-3 px-6 bg-gray-50 ">
                                        Purchasing Employee
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 ">
                                        Request
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 ">
                                        Description
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 ">
                                        Quantity
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 ">
                                        Offer
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 ">
                                        Unit Price
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50 ">
                                        Total Price
                                    </th>
                                    <th>
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipts as $rece)
                                    @php
                                        $person = $employees->where('id', '=', $rece->accept_emp_id);
                                        $person_id = $person->value('person_id');
                                        $employee = $people->where('id', '=', $person_id);
                                        $request = $requests->where('id', '=', $rece->request_id);
                                        $offer = $offers->where('req_id', '=', $request->value('id'))->where('chosen', '=', '1');

                                    @endphp
                                    <tr class="border-b border-gray-200 ">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 ">
                                            {{ $employee->value('fname') }} {{ $employee->value('lname') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 ">
                                            {{ $request->value('request') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 ">
                                            {{ $request->value('description') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50  ">
                                            {{ $request->value('quantity') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50  ">
                                            {{ $offer->value('offer') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50  ">
                                            {{ $offer->value('price') }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50  ">
                                            {{ $rece->total_price }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50  ">
                                            <a href="{{ route('employee.receipts.pay', $rece->id) }}">
                                                <button
                                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold  py-2 px-6 rounded">
                                                    Pay
                                                </button>
                                            </a>
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
