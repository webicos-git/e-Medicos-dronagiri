<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use DB;

use App\Patient;
use App\Doctor;
use App\Xray;
use App\Sonography;
use App\BloodTest;
use App\TreatmentXray;
use App\TreatmentSonography;
use App\TreatmentBloodTest;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function view($id)
    {
        $doctor = Doctor::findOrfail($id);
        
        $doctor_xrays = DB::table('xrays')
                        ->select('*', 'xrays.name as xray_name', 'patients.name as patient_name')
                        ->join('treatment_xrays', 'xrays.id', '=', 'treatment_xrays.xray_id')
                        ->join('treatments', 'treatments.id', '=', 'treatment_xrays.treatment_id')
                        ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                        ->where('treatments.doctor_id', $doctor->id)
                        ->get();
                        
        $doctor_sonography = DB::table('sonographies')
                        ->select('*', 'sonographies.name as sonography_name', 'patients.name as patient_name')
                        ->join('treatment_sonographies', 'sonographies.id', '=', 'treatment_sonographies.sonography_id')
                        ->join('treatments', 'treatments.id', '=', 'treatment_sonographies.treatment_id')
                        ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                        ->where('treatments.doctor_id', $doctor->id)
                        ->get();
        
        $doctor_blood_tests = DB::table('blood_tests')
                        ->select('*', 'blood_tests.name as blood_test_name', 'patients.name as patient_name')
                        ->join('treatment_blood_tests', 'blood_tests.id', '=', 'treatment_blood_tests.blood_test_id')
                        ->join('treatments', 'treatments.id', '=', 'treatment_blood_tests.treatment_id')
                        ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                        ->where('treatments.doctor_id', $doctor->id)
                        ->get();
        
        return view('doctor.view', [
            'doctor' => $doctor, 
            'doctor_xrays' => $doctor_xrays, 
            'doctor_sonography' => $doctor_sonography,
            'doctor_blood_tests' => $doctor_blood_tests,
        ]);
    }

    public function create()
    {
        return view('doctor.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $doctor = new Doctor();

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->clinic_name = $request->clinic_name;
        $doctor->address = $request->address;

        $doctor->save();

        return Redirect::route('doctor.all')->with('success', __('sentence.Doctor Added Successfully'));
    }

    public function all()
    {
        $doctors = Doctor::all();

        return view('doctor.all', ['doctors' => $doctors]);
    }


    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('doctor.edit', ['doctor' => $doctor]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $doctor = Doctor::find($request->doctor_id);

        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->clinic_name = $request->clinic_name;
        $doctor->address = $request->address;

        $doctor->save();

        return Redirect::route('doctor.all')->with('success', __('sentence.Doctor Edited Successfully'));
    }

    public function destroy($id)
    {
        $patients = Patient::where('doctor_id', $id)->get();

        foreach ($patients as $patient) {
            $patient->doctor_id = NULL;
            $patient->save();
        }

        Doctor::destroy($id);
        return Redirect::route('doctor.all')->with('success', __('sentence.Doctor Deleted Successfully'));
    }
}
