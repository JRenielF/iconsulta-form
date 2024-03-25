<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'iConsulta') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ Request::is('dashboard/home') ? 'page' : '' }}">Home</a>
            </div>
          </div>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="px-4 py-4 bg-white shadow sm:rounded-lg">
            <h1 class="text-2xl font-semibold text-gray-900">Create User Information</h1>
            <form id="myForm" action="{{ route('userinformations.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="number" class="form-control col-span-6 sm:col-span-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" id="user_id" name="user_id" value="{{ auth()->user()->id }}" placeholder="User ID" required readonly>
                </div>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                    <div class="mt-2 flex justify-center items-center">
                        <label for="photo-upload" class="relative cursor-pointer bg-white rounded-md font-semibold text-indigo-600 border border-gray-300 hover:border-indigo-500 px-4 py-2 transition duration-300 ease-in-out focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span style="display: inline-block; text-align: justify;">Upload Photo</span>
                            <input id="photo-upload" name="photo-upload" type="file" class="sr-only">
                        </label>
                    </div>
                </div>                        
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Document</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                </svg>
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
                        <div class="mt-2">
                            <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
                        <div class="mt-2">
                            <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3 flex flex-col">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" required>
                    </div>
                    <div class="sm:col-span-3 flex flex-col">
                        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                        <select id="country" name="country" autocomplete="country" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" required>
                            <option value="">Select Country</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Canada">Canada</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
                    <div class="sm:col-span-3">
                        <label for="street_address" class="block text-sm font-medium leading-6 text-gray-900">Street Address</label>
                        <input type="text" name="street_address" id="street_address" autocomplete="street-address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" required>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                        <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" required>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Region</label>
                        <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" required>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="postal_code" class="block text-sm font-medium leading-6 text-gray-900">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" autocomplete="postal-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" required>
                    </div>
                </div>
                <div class="mt-2 sm:col-span-6 flex justify-end items-end">
                    <button type="button" onclick="confirmSubmission()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>
            </form>          
            </div>
            <script>
                function confirmSubmission() {
                    if (confirm("Confirm")) {
                        document.getElementById("myForm").submit();
                    }
                }
            </script>            
            
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
