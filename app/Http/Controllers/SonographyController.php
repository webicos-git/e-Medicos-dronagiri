<?php

namespace App\Http\Controllers;

use App\Sonography;
use Illuminate\Http\Request;
use Redirect;

class SonographyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function create()
    {
        return view('sonography.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required'
        ]);

        $sonography = new Sonography();

        $sonography->name = $request->name;
        $sonography->amount = $request->amount;
        $sonography->description = $request->description;

        $sonography->save();


        return Redirect::route('sonography.all')->with('success', __('sentence.Sonography Added Successfully'));
    }

    public function all()
    {
        $sonographies = Sonography::all();

        return view('sonography.all', ['sonographies' => $sonographies]);
    }


    public function edit($id)
    {
        $sonography = Sonography::find($id);
        return view('sonography.edit', ['sonography' => $sonography]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required'
        ]);

        $sonography = Sonography::find($request->sonography_id);

        $sonography->name = $request->name;
        $sonography->amount = $request->amount;
        $sonography->description = $request->description;

        $sonography->save();

        return Redirect::route('sonography.all')->with('success', __('sentence.Sonography Edited Successfully'));
    }

    public function destroy($id)
    {
        Sonography::destroy($id);
        return Redirect::route('sonography.all')->with('success', __('sentence.Sonography Deleted Successfully'));
    }
}
