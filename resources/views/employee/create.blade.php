<x-app-layout>
  <x-slot name="header">
    <div class="flex">
      <a href="{{ route('home') }}" class="font-semibold text-xl text-gray-800 hover:text-gray-900 mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </a>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l border-gray-300 pl-2">
        @if ($employee->id)
          Edit employee
        @else
          Crate a employee
        @endif
      </h2>
    </div>
  </x-slot>

  <div>
    <div class="container smcontainer min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="mt-5 md:mt-0">
        <form action="{{ $employee->id ? route('employee.update', $employee->id) : route('company.employee.store', $company->id) }}"
          method="POST">
          @method($employee->id ? 'PUT' : 'POST')
          @csrf
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label fofirst_r="name" class="block text-sm font-medium text-gray-700">
                    First Name
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="first_name" id="first_name"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('first_name') border-red-500 @enderror"
                      placeholder="Employee's First Name" value="{{ old('first_name') ?? $employee->first_name }}">
                  </div>
                  @error('first_name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label fofirst_r="name" class="block text-sm font-medium text-gray-700">
                    Last Name
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="last_name" id="last_name"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('last_name') border-red-500 @enderror"
                      placeholder="Employee's Last Name" value="{{ old('last_name') ?? $employee->last_name }}">
                  </div>
                  @error('last_name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="email" id="email"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('email') border-red-500 @enderror"
                      placeholder="Employee's Email" value="{{ old('email') ?? $employee->email }}">
                  </div>
                  @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label for="phone" class="block text-sm font-medium text-gray-700">
                    Phone
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="phone" id="phone"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('phone') border-red-500 @enderror"
                      placeholder="Employee's Phone" value="{{ old('phone') ?? $employee->phone }}">
                  </div>
                  @error('phone')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label for="company" class="block text-sm font-medium text-gray-700">
                    Company
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="phone" id="phone"
                      class="flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 bg-gray-100 text-gray-500"
                      value="{{ $company->name }}" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
