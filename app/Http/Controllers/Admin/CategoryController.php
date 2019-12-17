<?php

namespace App\Http\Controllers\Admin;

use App\Http\Contracts\IUploader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller implements IUploader
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function foods($id)
    {
        return view('admin.category.foods', compact('id'));
    }

    public function uploader(Request $request)
    {
       $images = [];
       if ($request->has('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = pathinfo($image->getClientOriginalName())['filename'] . '_' . time() . '.' . $image->getClientOriginalExtension();
                $request->images[$index]->move(public_path('/category_images'), $imageName);
                $images['image'][$index] = '/category_images/' . $imageName;
            }
        return response()->json($images);
        } else {
            dd('no image');
        }
    }
}
