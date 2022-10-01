<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg border border-gray-200 w-full text-gray-900">
                @foreach ($noti as $not)
                    @if ($not->type == 'MSGDISSMISS')
                        @php
                            $req = $requests->where('id', '=', $not->request_id);
                        @endphp
                        <div class="flow-root ">
                            <p
                                class="float-left text-red-600 block px-6 py-2 w-full  hover:text-gray-500
                            focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600 transition duration-500 ">

                                Your Manager Has Dissmissed Your Request For {{ $req->value('request') }}
                                <a href="{{ route('employee.mark_as_read', $not->id) }}"
                                    class="float-right text-blue-800 ">Mark As Read</a>
                            </p>
                        </div>
                    @elseif($not->type == 'MSG')
                        @php
                            $req = $requests->where('id', '=', $not->request_id);
                        @endphp
                        <div class="flow-root ">
                            <p
                                class="float-left text-green-600 block px-6 py-2 w-full  hover:text-gray-500
                            focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600 transition duration-500 ">

                                Your Manager Has Accepted Your Request For {{ $req->value('request') }}
                                <a href="{{ route('employee.mark_as_read', $not->id) }}"
                                    class="float-right text-blue-800 ">Mark As Read</a>
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
