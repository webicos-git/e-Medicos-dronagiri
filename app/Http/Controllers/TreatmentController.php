<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Billing;
use App\Billing_item;
use App\Patient;
use App\Xray;
use App\Sonography;
use App\BloodTest;
use App\Doctor;
use App\Treatment;
use App\TreatmentXray;
use App\TreatmentSonography;
use App\TreatmentBloodTest;
use DB;

class TreatmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $xrays = Xray::all();
        $sonographies = Sonography::all();
        $blood_tests = BloodTest::all();

        return view('treatment.create', [
            'patients' => $patients,
            'doctors' => $doctors,
            'xrays' => $xrays,
            'sonographies' => $sonographies,
            'blood_tests' => $blood_tests
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => ['required','exists:patients,id'],
            'doctor_id' => ['required'],
        ]);

        $treatment = new Treatment();
        $treatment->patient_id = $request->patient_id;
        $treatment->doctor_id = $request->doctor_id  ? $request->doctor_id : NULL;
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
            $billing->patient_id = $request->patient_id;
            $billing->payment_status = 'Unpaid';
            $billing->opd_no = $opd_no;
            $billing->reference = 'b'.rand(10000, 99999);
            $billing->save();
        }
        // Add Patient Xray
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

        // Add Patient Sonography
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

        // Add Patient Blood Test
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

        return Redirect::route('investigation.all')->with('success', __('sentence.Investigation Created Successfully'));
    }

    public function all()
    {
        $patients = Patient::all();

        foreach ($patients as $patient) {
            $patient->xray_count = DB::table('treatments')
                        ->join('treatment_xrays', 'treatments.id', '=', 'treatment_xrays.treatment_id')
                        ->where('treatments.patient_id', $patient->id)->count();
        
            $patient->sonography_count = DB::table('treatments')
                        ->join('treatment_sonographies', 'treatments.id', '=', 'treatment_sonographies.treatment_id')
                        ->where('treatments.patient_id', $patient->id)->count();

            $patient->blood_test_count = DB::table('treatments')
                        ->join('treatment_blood_tests', 'treatments.id', '=', 'treatment_blood_tests.treatment_id')
                        ->where('treatments.patient_id', $patient->id)->count();
        }

        return view('treatment.all', [
            'patients' => $patients
        ]);
    }

}
