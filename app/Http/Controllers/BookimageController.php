<?php

namespace App\Http\Controllers;

use App\Models\bookimage;
use App\Http\Requests\StorebookimageRequest;
use App\Http\Requests\UpdatebookimageRequest;

class BookimageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebookimageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebookimageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bookimage  $bookimage
     * @return \Illuminate\Http\Response
     */
    public function show(bookimage $bookimage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bookimage  $bookimage
     * @return \Illuminate\Http\Response
     */
    public function edit(bookimage $bookimage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebookimageRequest  $request
     * @param  \App\Models\bookimage  $bookimage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebookimageRequest $request, bookimage $bookimage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bookimage  $bookimage
     * @return \Illuminate\Http\Response
     */
    public function destroy(bookimage $bookimage)
    {
        //
    }
}
