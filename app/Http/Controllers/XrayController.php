<?php

namespace App\Http\Controllers;

use App\Xray;
use Illuminate\Http\Request;
use Redirect;

class XrayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function create()
    {
        return view('xray.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required'
        ]);

        $xray = new Xray();
        $xray->name = $request->name;
        $xray->amount = $request->amount;
        $xray->description = $request->description;
        $xray->save();

        return Redirect::route('xray.all')->with('success', __('sentence.Xray Added Successfully'));
    }

    public function all()
    {
        $xrays = Xray::all();

        return view('xray.all', ['xrays' => $xrays]);
    }


    public function edit($id)
    {
        $xray = Xray::find($id);
        return view('xray.edit', ['xray' => $xray]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required'
        ]);

        $xray = Xray::find($request->xray_id);

        $xray->name = $request->name;
        $xray->amount = $request->amount;
        $xray->description = $request->description;

        $xray->save();

        return Redirect::route('xray.all')->with('success', __('sentence.Xray Edited Successfully'));
    }

    public function destroy($id)
    {
        Xray::destroy($id);
        return Redirect::route('xray.all')->with('success', __('sentence.Xray Deleted Successfully'));
    }
}
