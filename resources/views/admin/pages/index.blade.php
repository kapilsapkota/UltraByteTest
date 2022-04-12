
@extends('admin.common.layout')

@section('head')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }} || Page
    </h2>
@endsection


@section('body')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <a style="float: right" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900" href="{{route('admin.pages.create')}}">Create Page</a>
                    </div>
                    <div class="table-responsive">
                        <table id="category-table" class="table">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Details</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data['pages'] as $key=>$news)
                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td> {{ $news->title }} </td>
                                    <td> {{ $news->slug }} </td>
                                    <td> {{ \Illuminate\Support\Str::limit($news->description,100) }} </td>
                                    <td><img src="{{asset('images/'.$news->image)}}" alt=""> </td>
                                    <td>
                                        <a href="{{ route('admin.pages.edit',$news->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900"><i class="fa fa-edit"></i>Edit</a>
                                        <a href="javascript:void(0)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900" onclick="event.preventDefault();
                                                                                               document.getElementById('news-delete-form-{{$news->id}}').submit();">
                                                                                            <i class="fa fa-trash"></i>
                                        Delete</a>
                                        <form id="news-delete-form-{{$news->id}}" action="{{ route('admin.pages.destroy',$news->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <div>


                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
