<?php

namespace App\Http\Controllers;

use App\BloodTest;
use Illuminate\Http\Request;
use Redirect;

class BloodTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function create()
    {
        return view('blood_test.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required'
        ]);

        $blood_test = new BloodTest();

        $blood_test->name = $request->name;
        $blood_test->amount = $request->amount;
        $blood_test->description = $request->description;

        $blood_test->save();

        return Redirect::route('blood_test.all')->with('success', __('sentence.Blood Test Added Successfully'));
    }

    public function all()
    {
        $blood_tests = BloodTest::all();

        return view('blood_test.all', ['blood_tests' => $blood_tests]);
    }


    public function edit($id)
    {
        $blood_test = BloodTest::find($id);
        return view('blood_test.edit', ['blood_test' => $blood_test]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required'
        ]);

        $blood_test = BloodTest::find($request->blood_test_id);

        $blood_test->name = $request->name;
        $blood_test->amount = $request->amount;
        $blood_test->description = $request->description;

        $blood_test->save();

        return Redirect::route('blood_test.all')->with('success', __('sentence.Blood Test Edited Successfully'));
    }

    public function destroy($id)
    {
        BloodTest::destroy($id);
        return Redirect::route('blood_test.all')->with('success', __('sentence.Blood Test Deleted Successfully'));
    }
}
