<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notification Details For Order') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4" for="Employee">

                <h2 class="font-semibold text-x text-gray-700 leading-tight">
                    @if ($type == 'AA')
                        {{ __('Purchasing Manager') }}
                    @else
                        {{ __('Employee') }}
                    @endif
                </h2>
            </label>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="form-horizontal" action="{{ route('manager.notification.order.details.approve', $id) }}"
                    method="POST">
                    @csrf
                    @method('put')
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex  -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    First Name
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    {{ $fname }}</label>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    Last Name
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    {{ $lname }}</label>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    Job Title
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    {{ $job_title }}</label>
                            </div>
                        </div>




                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="fname">
                                Request
                            </label>
                            <label
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                {{ $req }}</label>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="fname">
                                Description
                            </label>
                            <textarea readonly rows="3" cols="3"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                {{ $req_desc }}</textarea>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="fname">
                                Quantity
                            </label>
                            <label
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                {{ $req_quantity }}</label>
                        </div>
                        @if ($type == 'RTFO')
                            <div class="flex  -mx-0 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="offers">
                                        Offers
                                    </label>
                                    @foreach ($offers as $offer)
                                        <input required type='radio' name='offer_id' value='{{ $offer->id }}'>
                                        Offer: {{ $offer->offer }} | Price : {{ $offer->price }} <br>
                                    @endforeach

                                </div>
                            </div>
                        @else
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    Offer
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    {{ $offer->value('offer') }}</label>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    Price
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    {{ $offer->value('price') }}</label>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    Total Price
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    {{ intval($offer->value('price')) * intval($req_quantity) }}</label>
                            </div>
                        @endif

                        <div class="flex mx-3 mb-6">

                            <div class="md:w-2/4">
                                <button type='submit' name='action' value='approve'
                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                    Approve
                                </button>
                            </div>
                            <div class="md:w-3/4">

                                <button type='submit' name='action' value='dismiss'
                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                                    Dissmiss
                                </button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


</x-app-layout>
