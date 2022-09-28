<x-app-layout>
    <x-slot name="header">
        <p class="float-left text-green-600">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Personal Profile') }}
        </h2>
        </p>
    </x-slot>

    <form method="post" action="{{ route('employee.profile.index') }}" class="form-horizontal">
        @csrf
        @method('put')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4" for="personal_info">

                    <h2 class="font-semibold text-x text-gray-700 leading-tight">
                        {{ __('Personal Information') }}
                    </h2>
                </label>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $person_id = $employees->where('id', '=', Auth::user()->id)->value('person_id') }}
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="fname">
                                    First Name
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="fname" name='fname' type="text">
                                    {{ $people->where('id', '=', $person_id)->value('fname') }}

                                </label>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="lname">
                                    Last Name
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="lname" name="lname" type="text" placeholder="Doe">
                                    {{ $lname = $people->where('id', '=', $person_id)->value('lname') }}
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="p_email">
                                    Personal Email
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="p_email" name="p_email" type="email" placeholder="personal@example.com">
                                    {{ $email = $people->where('id', '=', $person_id)->value('email') }}
                                </label>
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="email">
                                    Company Email
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="email" name="email" type="email" placeholder="exaple@company.com">
                                    {{ $email = $employees->where('id', '=', Auth::user()->id)->value('email') }}
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4"
                                    for="address">
                                    Address
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="address" name='address' type="text" placeholder="Governorate - City">
                                    {{ $address = $people->where('id', '=', $person_id)->value('address') }}
                                </label>

                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4"
                                    for="phonenumber">
                                    Phone Number
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="phonenumber" name='phonenumber' type="text" placeholder="+963 9** *** ***">
                                    {{ $people->where('id', '=', $person_id)->value('phonenumber') }}
                                </label>

                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="title">
                                    Department
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="title" name='title' type="text"
                                    placeholder="Human resource information specialist">
                                    {{ $departments->where('id', '=', Auth::user()->dep_id)->value('name') }}
                                </label>

                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="title">
                                    Job Title
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="title" name='title' type="text"
                                    placeholder="Human resource information specialist">
                                    {{ $employees->where('id', '=', Auth::user()->id)->value('title') }}
                                </label>

                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="salary">
                                    Salary
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="salary" name="salary" type="text" placeholder="300,000 SP">
                                    {{ $employees->where('id', '=', Auth::user()->id)->value('salary') }}
                                </label>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="salary">
                                    Duties
                                </label>
                                <label
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="salary" name="salary" type="text" placeholder="300,000 SP">
                                    {{ $employees->where('id', '=', Auth::user()->id)->value('duties') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
