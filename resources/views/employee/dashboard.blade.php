<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifications') }}
            </h2>
            <p class="float-right text-green-800 ">
                <a href="{{ route('employee.dashboard.show') }}">
                    <button
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Show Request
                    </button>
                </a>
            </p>
            @if ($department_name == 'purchasing')
                <p class="float-right text-green-800 lg:px-2">
                    <a href="{{ route('employee.dashboard.orders') }}">
                        <button
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                            Show Orders
                        </button>
                    </a>
                </p>
            @else
                <p class="float-right text-green-800 lg:px-2">
                    <a href="{{ route('employee.dashboard.receipts') }}">
                        <button
                            class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                            Show Receipts
                        </button>
                    </a>
                </p>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg border border-gray-200 w-full text-gray-900">
                @if ($department_name == 'purchasing')
                    @foreach ($noti_dep as $not)
                        <a href="{{ route('employee.notification.details', $not->id) }}"
                            class="block px-6 py-2 border-b border-gray-200 w-full hover:bg-gray-100 hover:text-gray-500
                    focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600 transition duration-500 cursor-pointer">
                            @php
                                $person_id = $employees->where('id', '=', $not->sender_emp_id)->value('person_id');

                                $fname = $people->where('id', '=', $person_id)->value('fname');
                                $lname = $people->where('id', '=', $person_id)->value('lname');
                                $created_at = $not->created_at;
                                echo '<h3> ORDER </h3>' . $fname . ' ' . $lname . ' ............................... at : ' . $created_at;
                            @endphp
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
