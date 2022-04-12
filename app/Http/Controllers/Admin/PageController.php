<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageCreateValidation;
use App\Http\Requests\PostEditValidation;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['pages']=Page::get();

        return  view('admin.pages.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCreateValidation $request)
    {
//       dd($request->all());
        $request->merge(['slug' => Str::slug($request->get('title'))]);
        //file uploading
        if ($request->hasFile('main_image')) {
            $file=$request->file('main_image');
            $file_name = rand(1111,9999).'_'. $file->getClientOriginalName();

            //check if folder exist
            $file->move(public_path('image'), $file_name);
            $folder='image';
            $image = Image::make(public_path('image').DIRECTORY_SEPARATOR.$file_name);
            $image-> fit(200, 200);
            $image->save(public_path($folder). DIRECTORY_SEPARATOR . '200_200_'.$file_name);

            $request->merge(['image' => $file_name]);
        }

         $page = Page::create($request->all());

        $request->session()->flash('success_message', $page->title . ' added Successfully');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page']= Page::find($id);

        return  view('admin.pages.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditValidation $request, $id)
    {
        $page=Page::find($id);

        $slug = Str::slug($request->title);
        if ($page->slug != $slug) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        if($request->hasFile('main_image')){
            $file=$request->file('main_image');
            $file_name = rand(1111,9999).'_'. $file->getClientOriginalName();
            //check if folder exist
            $file->move(public_path('image'), $file_name);
            $folder='image';
            $image = Image::make(public_path('image').DIRECTORY_SEPARATOR.$file_name);
            $image->fit(200, 200);
            $image->save(public_path($folder). DIRECTORY_SEPARATOR . '200_200_'.$file_name);

            if ($page->image && file_exists('images/'.$page->image)) {
                @unlink('images/'.$page->image);
                @unlink('images/200_200_'.$page->image);
            }


        }

        $request->merge(['image' => $request->hasFile('main_image')? $file_name:$page->image]);
        $page->update($request->all());

        $request->session()->flash('success_message', $page->title . ' updated Successfully');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page= Page::find($id);
        if ($page->image && file_exists('images/'.$page->image)) {
            @unlink('images/'.$page->image);
        }
        $page->delete();

        return redirect()->route('admin.pages.index');
    }

    public function checkDirectoryExists($folder_path)
    {
        if (!file_exists(public_path($folder_path)))
        {
            mkdir(public_path($folder_path));
        }
    }
}
