<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} || Create Page
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.pages.store') }}">
                    @csrf
                    <!-- Name -->
                        <div>
                            <label for="newstitle" class="block font-medium text-sm text-gray-700">Title <strong>*</strong></label>
                            <input type="text" name="title" value="{{old('title')}}" placeholder="Enter post title." class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="newstitle">
                            @if($errors -> has('title'))
                                <span class="help-block">
                                 <strong> {{$errors->first('title')}} </strong>
                                </span>
                            @endif
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="newstitle" class="block font-medium text-sm text-gray-700">Description <strong>*</strong></label>
                            <textarea type="text" name="description" placeholder="Enter post description." class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="newstitle">
                                {{old('description')}}
                            </textarea>
                            @if($errors -> has('description'))
                                <span class="help-block">
                                 <strong> {{$errors->first('description')}} </strong>
                                </span>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="newstitle" class="">Image <strong>*</strong></label>
                            <input type="file" accept="image/*" name="main_image" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @if($errors -> has('main_image'))
                                    <span class="help-block">
                                     <strong> {{$errors->first('main_image')}} </strong>
                                    </span>
                                @endif
                        </div>
                        <div class="mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Create
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
