<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
            <a href="/dashboard/category" class="hover:text-orange-600">Categories</a> /
            <a href="/dashboard/category/{{ $category->id }}" class="hover:text-orange-600">Info</a> /
            <a href="/dashboard/category/edit/{{ $category->id }}" class="font-bold text-black border-b-2 border-b-orange-500">Edit</a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Header -->
            <div class="flex flex-row justify-between items-center py-4 bg-black">
                <div>
                    <span class="text-lg text-white px-4">Category Edit</span>
                </div>
            </div>
            <!--category -->
            <div class="mx-auto w-11/12 py-4 px-2">
                <form action="{{ route('codecategory.update', $category) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('PUT')

                    <div class="flex flex-col justify-start items-start w-full sm:w-2/3 gap-4 py-2">
                        <span class="text-md font-semibold px-2">Name</span>
                        <input name="name" id="name" type="text" value="{{ $category->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-full sm:w-2/3 p-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <!-- Errors -->
                    @error('name')
                        <div>
                            <span class="text-sm text-red-400 font-bold px-2">{{ $message }}</span>
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
        <div class="flex flex-row justify-end items-center py-4 px-4 bg-black sm:rounded-b-lg">
            <a href="{{ route('codecategory.show', $category) }}">
                <i class="fa-lg fa-solid fa-backward-step text-white hover:text-orange-600 transition duration-1000 ease-in-out" title="Go Back"></i>
            </a>
        </div>
    </div>

</x-app-layout>
