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
        @if ($company->id)
          Edit company
        @else
          Crate a company
        @endif
      </h2>
    </div>
  </x-slot>

  <div>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="mt-5 md:mt-0">
        <form action="{{ $company->id ? route('company.update', $company->id) : route('company.store') }}"
          method="POST" enctype="multipart/form-data">
          @method($company->id ? 'PUT' : 'POST')
          @csrf
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">
                    Name
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input type="text" name="name" id="name"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('name') border-red-500 @enderror"
                      placeholder="Company Name" value="{{ old('name') ?? $company->name }}">
                  </div>
                  @error('name')
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
                      placeholder="Company Email" value="{{ old('email') ?? $company->email }}">
                  </div>
                  @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                  <label for="website" class="block text-sm font-medium text-gray-700">
                    Website
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <span
                      class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                      https://
                    </span>
                    <input type="text" name="website" id="website"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('website') border-red-500 @enderror"
                      placeholder="www.example.com"
                      value="{{ old('website') ?? $company->website ? str_replace($company->website, 'https://', '') : null }}">
                  </div>
                  @error('website')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Logo
                </label>
                <div class="mt-1 flex items-center">
                  <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <img id="image-preview" src="{{ $company->logo ? Storage::url($company->logo) : '#' }}"
                      style="display: {{ $company->logo ? 'block' : 'none' }}" />
                    <svg id="current-image" class="h-full w-full text-gray-300" fill="currentColor"
                      style="display: {{ $company->logo ? 'none' : 'block' }}" viewBox="0 0 24 24">
                      <path
                        d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  </span>
                  <input type="file" id="selectedFile" accept="image/*" name="logo" style="display: none;"
                    onchange="onChangeImage(event)" />
                  <button type="button" onclick="document.getElementById('selectedFile').click();"
                    class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 @error('logo') border-red-500 @enderror">
                    Change
                  </button>
                </div>
                @error('logo')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
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
  <script>
    function onChangeImage(evt) {
      const imagePreview = document.getElementById('image-preview');
      const currentImage = document.getElementById('current-image');
      const selectedFile = document.getElementById('selectedFile');
      const [file] = selectedFile.files
      if (file) {
        imagePreview.src = URL.createObjectURL(file)
      }
      imagePreview.style.display = 'block';
      currentImage.style.display = 'none';
    }
  </script>
</x-app-layout>
