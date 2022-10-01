<x-app-layout>
    <x-slot name="header">
        <div class="flow-root ">
            <p class="float-left text-green-600">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Make Offer') }}
            </h2>
            </p>

            <p class="float-right text-green-800 lg:px-2">
                <a href="{{ route('employee.offer.show', $request_id) }}">
                    <button
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Show Offers
                    </button>
                </a>
            </p>
            <p class="float-right text-green-800">
                <a href="{{ route('employee.dashboard.orders') }}">
                    <button
                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-6 rounded"
                        type="button">
                        <- Back </button>
                </a>
            </p>

        </div>
    </x-slot>

    <form class="form-horizontal" action="{{ route('employee.offer.store', $request_id) }}" method="POST">
        @csrf
        @method('put')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="mx-1 mb-1">
                            <div class="w-full md:w-1/2 px-2 mb-8 md:mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="offer">
                                    Offer
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="offer" name='offer' type="text" placeholder="Enter Your Offer">
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-8 md:mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="price">
                                    Price
                                </label>
                                <input type="number"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="price" name="price" placeholder="**** SYP">
                            </div>

                            <div class="py-8
                                    px-4">
                                <button
                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold  py-2 px-6 rounded">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
