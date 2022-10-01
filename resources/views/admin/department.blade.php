<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Department') }}
        </h2>
    </x-slot>

    <form class="form-horizontal" action="{{ route('admin.department.store') }}" method="POST">
        @csrf
        @method('put')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="mx-1 mb-1">
                            <div class="w-full md:w-1/2 px-2 mb-8 md:mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                    Name
                                </label>
                                <select
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="grid-first-name" name='name' type="text" placeholder="Name Dapartment">
                                    <option value="hr"> Human Resources </option>
                                    <option value="purchasing"> Purchasing</option>
                                    <option value="it"> IT </option>
                                    <option value="logic">Logic</option>
                                    <option value="accounting"> Accounting and Finance </option>
                                    <option value=marketing> Marketing </option>
                                    <option value="r&d"> Research and Development R&D </option>
                                    <option value="production"> Production </option>
                                </select>
                            </div>
                            <div class="w-full md:w-1/2 px-2 mb-8 md:mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Description
                                </label>
                                <textarea
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" name="description" placeholder="" rows="5" col="5" required></textarea>
                            </div>
                            <div class="py-8 px-4">
                                <button
                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold  py-2 px-6 rounded">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="py-3 px-6 bg-gray-50">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6  bg-gray-50">
                                        Description
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $dep)
                                    <tr class="border-b border-gray-200 dark:border-gray-200">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $dep->name }}
                                        </th>
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            {{ $dep->description }}
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
