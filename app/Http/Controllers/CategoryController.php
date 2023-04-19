<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $list = Category::orderBy('id', 'ASC')->get();
        return view('admin.category.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.category.form');
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
                'title' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                'description' => 'required|unique:categories|max:255',
                'status' => 'required',
            ],

            [
                'title.required' => 'Tên danh mục không được bỏ trống',
                'title.unique' => 'Tên danh mục đã tồn tại',
                'slug.required' => 'Slug danh mục không được bỏ trống',
                'slug.unique' => 'Slug danh mục đã tồn tại',
                'description.required' => 'Mô tả danh mục không được bỏ trống',
                'description.unique' => 'Mô tả danh mục đã tồn tại',
            ]
        );
        // $data = $request->all();
        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        try {
            $category->save();
            return redirect()->back()->with('success', 'Thêm danh mục thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm danh mục không thành công');
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
        $category = Category::find($id);
        $list = Category::all();
        return view('admin.category.form', compact('list','category'));
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
                'title.required' => 'Tên danh mục không được bỏ trống',
                'slug.required' => 'Slug danh mục không được bỏ trống',
                'description.required' => 'Mô tả danh mục không được bỏ trống',
            ]
        );
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        try {
            $category->save();
            return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật danh mục không thành công');
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
            Category::find($id)->delete();
            return redirect()->back()->with('success', 'Xóa danh mục thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xóa danh mục không thành công');
        }
    }
}
