<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifications') }}
            </h2>
            <p class="float-right text-green-800">
                <a href="{{ route('manager.dashboard.show') }}">
                    <button
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                        type="button">
                        Show Request
                    </button>
                </a>
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-300 rounded-lg border border-gray-200 w-full text-gray-900">
                @foreach ($noti as $not)
                    @if ($not->type == 'RTFO')
                        <a href="{{ route('notification.order.details', $not->id) }}"
                            class="block px-6 py-2 border-b border-gray-200 w-full hover:bg-gray-100 hover:text-gray-500
                    focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600 transition duration-500 cursor-pointer">
                            @php
                                $person_id = $employees->where('id', '=', $not->sender_emp_id)->value('person_id');

                                $fname = $people->where('id', '=', $person_id)->value('fname');
                                $lname = $people->where('id', '=', $person_id)->value('lname');
                                $created_at = $not->created_at;
                                echo '<h3>' . $fname . ' Wants To Fullfill This Order </h3>' . $fname . ' ' . $lname . ' ............................... at : ' . $created_at;
                            @endphp
                        </a>
                    @endif
                    @if ($not->type == 'AA')
                        <a href="{{ route('notification.order.details', $not->id) }}"
                            class="block px-6 py-2 border-b border-gray-200 w-full hover:bg-gray-100 hover:text-gray-500
                focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600 transition duration-500 cursor-pointer">
                            @php
                                $person_id = $employees->where('id', '=', $not->sender_emp_id)->value('person_id');

                                $fname = $people->where('id', '=', $person_id)->value('fname');
                                $lname = $people->where('id', '=', $person_id)->value('lname');
                                $created_at = $not->created_at;
                                echo '<h3> Purchasing Manager ' . $fname . ' Wants To Fullfill This Order </h3>' . $fname . ' ' . $lname . ' ............................... at : ' . $created_at;
                            @endphp
                        </a>
                    @endif
                    @if ($not->type == 'R')
                        <a href="{{ route('manager.notification.details', $not->id) }}" aria-current="true"
                            class="block px-6 py-2 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white cursor-pointer">
                            @php
                                $person_id = $employees->where('id', '=', $not->sender_emp_id)->value('person_id');

                                $fname = $people->where('id', '=', $person_id)->value('fname');
                                $lname = $people->where('id', '=', $person_id)->value('lname');
                                $created_at = $not->created_at;
                                echo $fname . ' ' . $lname . '<br>' . $created_at;
                            @endphp
                        </a>
                    @endif
                @endforeach


            </div>
        </div>
    </div>
</x-app-layout>
