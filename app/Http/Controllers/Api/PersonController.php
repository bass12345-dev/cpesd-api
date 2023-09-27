<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = PersonModel::all();

        return json_encode($items);

        //  return response()->json([
        //     // 'status' => true,
        //     // 'items' => $items
        //     $items
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $items = PersonModel::all();

         return response()->json([
            'status' => true,
            'items' => $items
        ]);
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
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function show(PersoModel $persoModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PersoModel $persoModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersoModel $persoModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersoModel $persoModel)
    {
        //
    }
}
