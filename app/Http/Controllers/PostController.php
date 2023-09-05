<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //* get
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //* get
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //* post

        // $user = new User();
        // $user->email = $request->email;
        // $user->save();

        //* submit data untuk dikirim ke database
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //* get
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //* get
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //* put/patch
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //* delete
    }
}
