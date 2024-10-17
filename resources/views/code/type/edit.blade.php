<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-green-600">Dashboard </a> /
            <a href="/dashboard/type" class="px-2 hover:text-green-600">Types</a> /
            <a href="/dashboard/type/{{ $type->id }}" class="px-2 hover:text-green-600">Info</a> /        
            <a href="/dashboard/type/edit/{{ $type->id }}" class="px-2 font-bold text-black border-b-2 border-b-green-500">Edit</a>
        </div>

        <div class="bg-white shadow rounded-xl">

            <!-- Header -->
            <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
                <div>
                    <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
                    <span class="text-lg text-white px-4">Type Edit</span>
                </div>
            </div>

            <!--Type -->
            <div class="mx-auto w-11/12 py-4 px-2">

                <form action="{{ route('codetype.update', $type) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('PUT')

                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-md font-semibold px-4">Name</span>
                        <input name="name" id="name" type="text" value="{{ $type->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <!-- Errors -->
                    @error('name')
                        <div>
                            <span class="text-red-400 font-semibold px-4">{{ $message }}</span>
                        </div>
                    @enderror
                    <!-- Save -->
                    <div class="py-4">
                        <button type="submit" class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                            Save
                            <i class="fa-solid fa-floppy-disk px-2"></i>
                        </button>
                    </div>

                </form>



            </div>

        </div>


        <!-- Footer -->
        <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
            <a href="{{ route('codetype.show', $type) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
            </a>
        </div>
    </div>

</x-app-layout>
