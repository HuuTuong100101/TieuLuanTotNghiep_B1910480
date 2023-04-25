<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Exception;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $list = Country::all();
        return view('admin.country.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.country.form');
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
                'title' => 'required|unique:countries|max:255',
                'slug' => 'required|unique:countries|max:255',
                'description' => 'required|unique:countries|max:255',
                'status' => 'required',
            ],

            [
                'title.required' => 'Tên quốc gia không được bỏ trống',
                'title.unique' => 'Tên quốc gia đã tồn tại',
                'slug.required' => 'Slug quốc gia không được bỏ trống',
                'slug.unique' => 'Slug quốc gia đã tồn tại',
                'description.required' => 'Mô tả quốc gia không được bỏ trống',
                'description.unique' => 'Mô tả quốc gia đã tồn tại',
            ]
        );
        $country = new Country();
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        try {
            $country = $country->save();
            return redirect()->back()->with('success', 'Thêm quốc gia thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm quốc gia không thành công');
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
        $country = Country::find($id);
        $list = Country::all();
        return view('admin.country.form', compact('list','country'));
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
                'title.required' => 'Tên quốc gia không được bỏ trống',
                'slug.required' => 'Slug quốc gia không được bỏ trống',
                'description.required' => 'Mô tả quốc gia không được bỏ trống',
            ]
        );
        $country = Country::find($id);
        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        try {
            $country = $country->save();
            return redirect()->back()->with('success', 'Cập nhật quốc gia thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật quốc gia không thành công');
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
            Country::find($id)->delete();
            return redirect()->back()->with('success', 'Xóa quốc gia thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xóa quốc gia không thành công');
        }
    }
}
