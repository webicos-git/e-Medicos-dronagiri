<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\Billing;
use App\Billing_item;
use App\Doctor;
use App\Xray;
use App\Sonography;
use App\BloodTest;
use App\Treatment;
use App\TreatmentXray;
use App\TreatmentSonography;
use App\TreatmentBloodTest;

use Hash;
use Redirect;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function all()
    {
        $patients = Patient::all();

        return view('patient.all', ['patients' => $patients]);
    }

    public function create()
    {
        $doctors = Doctor::all();
        $xrays = Xray::all();
        $sonographies = Sonography::all();
        $blood_tests = BloodTest::all();
        
        return view('patient.create', [
            'doctors' => $doctors,
            'xrays' => $xrays,
            'sonographies' => $sonographies,
            'blood_tests' => $blood_tests
        ]);
    }

    public function edit($id)
    {
        $patient = Patient::find($id);
        $doctors = Doctor::all();

        return view('patient.edit', ['patient' => $patient, 'doctors' => $doctors]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'min:10'],
            'gender' => ['required']
        ]);


        $patient = Patient::where('id', $request->id)
                     ->update([
                        'name' => $request->name,
                        'birthday' => $request->birthday,
                        'phone' => $request->phone,
                        'gender' => $request->gender,
                        'marital_status' => $request->marital_status,
                        'blood' => $request->blood,
                        'address' => $request->address,
                    ]);




        return Redirect::back()->with('success', __('sentence.Patient Updated Successfully'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'min:10'],
            'gender' => ['required'],
            'doctor_id' => ['required']
        ]);


        $patient = new Patient();
        $patient->name = $request->name;
        $patient->birthday = $request->birthday;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->marital_status = $request->marital_status;
        $patient->blood = $request->blood;
        $patient->address = $request->address;
        $patient->save();

        $treatment = new Treatment();
        $treatment->patient_id = $patient->id;
        $treatment->doctor_id = $request->doctor_id ? $request->doctor_id : NULL;
        $treatment->history = $request->history;
        $treatment->reason = $request->reason;
        $treatment->save();
        
        $last_billing = Billing::latest()->first();
        if ($last_billing) {
            $opd_no = date('y') . '/0' . ($last_billing->id + 1);
        } else {
            $opd_no = date('y') . '/0' . 1;
        }

        $xray_count = 0;
        if ($request->xray_id) {
            $xray_count = count($request->xray_id);
        }
        $sonography_count = 0;
        if ($request->sonography_id) {
            $sonography_count = count($request->sonography_id);
        }
        $blood_test_count = 0;
        if ($request->blood_test_id) {
            $blood_test_count = count($request->blood_test_id);
        }

        if ($xray_count || $sonography_count || $blood_test_count) {
            $billing = new Billing();
            $billing->patient_id = $patient->id;
            $billing->payment_status = 'Unpaid';
            $billing->opd_no = $opd_no;
            $billing->reference = 'b'.rand(10000, 99999);
            $billing->save();
        }

        // Add Treatment Xray
        for ($x = 0; $x < $xray_count; $x++) {
            $treatment_xray = new TreatmentXray();
            $treatment_xray->treatment_id = $treatment->id;
            $treatment_xray->xray_id = $request->xray_id[$x];
            $treatment_xray->save();

            $xray = Xray::find($request->xray_id[$x]);
            $invoice_item = new Billing_item();
            $invoice_item->invoice_title = $xray->name;
            $invoice_item->invoice_amount = $xray->amount;
            $invoice_item->invoice_status = 'Balance';
            $invoice_item->billing_id = $billing->id;
            $invoice_item->save();
        }
        
        // Add Treatment Sonography
        for ($x = 0; $x < $sonography_count; $x++) {
            $treatment_sonography = new TreatmentSonography();
            $treatment_sonography->treatment_id = $treatment->id;
            $treatment_sonography->sonography_id = $request->sonography_id[$x];
            $treatment_sonography->save();

            $sonography = Sonography::find($request->sonography_id[$x]);
            $invoice_item = new Billing_item();
            $invoice_item->invoice_title = $sonography->name;
            $invoice_item->invoice_amount = $sonography->amount;
            $invoice_item->invoice_status = 'Balance';
            $invoice_item->billing_id = $billing->id;
            $invoice_item->save();
        }
        
        // Add Treatment Blood Test
        for ($x = 0; $x < $blood_test_count; $x++) {
            $treatment_blood_test = new TreatmentBloodTest();
            $treatment_blood_test->treatment_id = $treatment->id;
            $treatment_blood_test->blood_test_id = $request->blood_test_id[$x];
            $treatment_blood_test->save();
            
            $blood_test = BloodTest::find($request->blood_test_id[$x]);
            $invoice_item = new Billing_item();
            $invoice_item->invoice_title = $blood_test->name;
            $invoice_item->invoice_amount = $blood_test->amount;
            $invoice_item->invoice_status = 'Balance';
            $invoice_item->billing_id = $billing->id;
            $invoice_item->save();
        }
        
        return Redirect::route('patient.all')->with('success', __('sentence.Patient Created Successfully'));
    }


    public function view($id)
    {
        $patient = Patient::findOrfail($id);
        $appointments = Appointment::where('patient_id', $id)->OrderBy('id', 'Desc')->get();
        $invoices = Billing::where('patient_id', $id)->OrderBy('id', 'Desc')->get();

        if ($patient->doctor_id) {
            $doctor = Doctor::findOrfail($patient->doctor_id);
            $patient->referred_doctor = $doctor->name;
        }

        return view('patient.view', ['patient' => $patient, 'appointments' => $appointments, 'invoices' => $invoices]);
    }
}
