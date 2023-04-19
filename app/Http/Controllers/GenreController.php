<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Exception;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $list = Genre::all();
        return view('admin.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.genre.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|unique:genres|max:255',
                'slug' => 'required|unique:genres|max:255',
                'description' => 'required|unique:genres|max:255',
                'status' => 'required',
            ],

            [
                'title.required' => 'Tên thể loại không được bỏ trống',
                'title.unique' => 'Tên thể loại đã tồn tại',
                'slug.required' => 'Slug thể loại không được bỏ trống',
                'slug.unique' => 'Slug thể loại đã tồn tại',
                'description.required' => 'Mô tả thể loại không được bỏ trống',
                'description.unique' => 'Mô tả thể loại đã tồn tại',
            ]
        );
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        try {
            $genre->save();
            return redirect()->back()->with('success', 'Thêm thể loại thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm thể loại không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admin.genre.form', compact('list','genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug' => 'required|max:255',
                'description' => 'required|max:255',
                'status' => 'required',
            ],

            [
                'title.required' => 'Tên thể loại không được bỏ trống',
                'slug.required' => 'Slug thể loại không được bỏ trống',
                'description.required' => 'Mô tả thể loại không được bỏ trống',
            ]
        );
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        try {
            $genre->save();
            return redirect()->back()->with('success', 'Cập nhật thể loại thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật thể loại không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        try {
            Genre::find($id)->delete();
            return redirect()->back()->with('success', 'Xóa thể loại thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xóa thể loại không thành công');
        }
    }
}
