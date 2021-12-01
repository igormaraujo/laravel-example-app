<x-app-layout>
  <x-slot name="header">
    <div class="flex">
      <a href="{{ route('home') }}" class="font-semibold text-xl text-gray-800 hover:text-gray-900 mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </a>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l border-gray-300 pl-2">
        {{ $company->name }} - Employees
      </h2>
    </div>
  </x-slot>

  <div class="py-12 container mx-auto">
    <div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
          @if (session('success'))
            <div class="bg-green-300 border border-green-500 p-2 my-2 text-green-800 rounded">
              {{ session('success') }}
            </div>
          @endif
          <a href="{{ route('company.employee.create', $company->id) }}">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Add Employee
            </button>
          </a>
          <div class="p-6 bg-white border-b border-gray-200">
            Employee list
          </div>
          <!-- This example requires Tailwind CSS v2.0+ -->
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Fisrt Name
                        </th>
                        <th scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Last Name
                        </th>
                        <th scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Email
                        </th>
                        <th scope="col"
                          class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Phone
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($employees as $employee)
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ $employee->first_name }}
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ $employee->last_name }}
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ $employee->email ?? '--' }}
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ $employee->phone ?? '--' }}
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('employee.edit', $employee->id) }}"
                              class="text-yellow-600 hover:text-yellow-900 mx-2">Edit</a>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                              class="inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $employees->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
