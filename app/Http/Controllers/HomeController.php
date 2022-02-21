<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\Billing;
use App\Billing_item;
use App\Treatment;
use App\TreatmentXray;
use App\TreatmentSonography;
use App\TreatmentBloodTest;
use App;
use DB;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboard = $this->getDashboardData();
        $total_patients_today = $this->getDailyPatientReportData(date('Y-m-d'));

        return view('home', [
            'total_patients' => $dashboard['total_patients'],
            'total_appointments' => $dashboard['total_appointments'],
            'total_appointments_today' => $dashboard['total_appointments_today'],
            'upcoming_appointments' => $dashboard['upcoming_appointments'],
            'total_payments' => $dashboard['total_payments'],
            'total_payments_month' => $dashboard['total_payments_month'],
            'total_payments_year' => $dashboard['total_payments_year'],
            'total_xrays' => $dashboard['total_xrays'],
            'total_sonography' => $dashboard['total_sonography'],
            'total_blood_test' => $dashboard['total_blood_test'],

            'total_patients_today' => $total_patients_today,
            'date' => date('Y-m-d')
        ]);
    }

    public function getDashboardData()
    {
        $total_patients = Patient::all()->count();
        $total_appointments = Appointment::all()->count();
        $total_appointments_today = Appointment::wheredate('date', Today())->get();
        $upcoming_appointments = Appointment::wheredate('date', '<=', date('Y-m-d', strtotime('+3 day')))
                                                ->wheredate('date', '>', date('Y-m-d'))
                                                ->where('visited', 0)
                                                ->get();
        
        $total_payments = Billing::all()->count();
        $total_payments = Billing::all()->count();
        $total_payments_month = Billing_item::where('invoice_status', 'Paid')->whereMonth('created_at', date('m'))->sum('invoice_amount');
        $total_payments_year = Billing_item::where('invoice_status', 'Paid')->whereYear('created_at', date('Y'))->sum('invoice_amount');

        $total_xrays = TreatmentXray::all()->count();
        $total_sonography = TreatmentSonography::all()->count();
        $total_blood_test = TreatmentBloodTest::all()->count();

        return [
            'total_patients' => $total_patients,
            'total_appointments' => $total_appointments,
            'total_appointments_today' => $total_appointments_today,
            'upcoming_appointments' => $upcoming_appointments,
            'total_payments' => $total_payments,
            'total_payments_month' => $total_payments_month,
            'total_payments_year' => $total_payments_year,
            'total_xrays' => $total_xrays,
            'total_sonography' => $total_sonography,
            'total_blood_test' => $total_blood_test
        ];
    }

    public function getDailyPatientReportData($date)
    {
        $total_patients_today = DB::table('treatments')
                                ->select(
                                    '*',
                                    'treatments.id as id',
                                    'treatments.created_at as date',
                                    'patients.name as patient_name',
                                    'doctors.name as doctor_name',
                                )
                                ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                                ->leftjoin('doctors', 'doctors.id', '=', 'treatments.doctor_id')
                                ->wheredate('treatments.created_at', $date)
                                ->get();
        
        foreach ($total_patients_today as $patient) {
            $patient->amount = 0;
            $patient->xrays = DB::table('treatment_xrays')
                                ->select('xrays.amount', 'xrays.name')
                                ->join('xrays', 'xrays.id', '=', 'treatment_xrays.xray_id')
                                ->where('treatment_xrays.treatment_id', $patient->id)
                                ->get();

            $patient->sonographies = DB::table('treatment_sonographies')
                                ->select('sonographies.amount', 'sonographies.name')
                                ->join('sonographies', 'sonographies.id', '=', 'treatment_sonographies.sonography_id')
                                ->where('treatment_sonographies.treatment_id', $patient->id)
                                ->get();

            $patient->blood_tests = DB::table('treatment_blood_tests')
                                ->select('blood_tests.amount', 'blood_tests.name')
                                ->join('blood_tests', 'blood_tests.id', '=', 'treatment_blood_tests.blood_test_id')
                                ->where('treatment_blood_tests.treatment_id', $patient->id)
                                ->get();

            $patient->amount = $patient->xrays->sum('amount') + $patient->sonographies->sum('amount') + $patient->blood_tests->sum('amount');
            
            $investigations = collect();
            $investigations = $investigations->merge($patient->xrays);
            $investigations = $investigations->merge($patient->sonographies);
            $investigations = $investigations->merge($patient->blood_tests);
            
            $patient->investigations= implode(', ', $investigations->pluck('name')->toArray());

            $billing = Billing::where('patient_id', $patient->patient_id)
                            ->where('created_at', $patient->date)
                            ->first();
            
            $patient->payment_mode = '-';
            if ($billing) {
                $patient->payment_mode = $billing->payment_mode;
            }
        }                        
        
        return $total_patients_today;
    }

    public function filter_daily_patients(Request $request)
    {
        $dashboard = $this->getDashboardData();
        $total_patients_today = $this->getDailyPatientReportData($request->date);

        return view('home', [
            'total_patients' => $dashboard['total_patients'],
            'total_appointments' => $dashboard['total_appointments'],
            'total_appointments_today' => $dashboard['total_appointments_today'],
            'upcoming_appointments' => $dashboard['upcoming_appointments'],
            'total_payments' => $dashboard['total_payments'],
            'total_payments_month' => $dashboard['total_payments_month'],
            'total_payments_year' => $dashboard['total_payments_year'],
            'total_xrays' => $dashboard['total_xrays'],
            'total_sonography' => $dashboard['total_sonography'],
            'total_blood_test' => $dashboard['total_blood_test'],

            'total_patients_today' => $total_patients_today,
            'date' => $request->date
        ]);
    }

    public function pdf_daily_patients($date)
    {
        $dashboard = $this->getDashboardData();
        $total_patients_today = $this->getDailyPatientReportData($date);

        // return view('daily-report-pdf', [
        //     'total_patients' => $dashboard['total_patients'],
        //     'total_appointments' => $dashboard['total_appointments'],
        //     'total_appointments_today' => $dashboard['total_appointments_today'],
        //     'upcoming_appointments' => $dashboard['upcoming_appointments'],
        //     'total_payments' => $dashboard['total_payments'],
        //     'total_payments_month' => $dashboard['total_payments_month'],
        //     'total_payments_year' => $dashboard['total_payments_year'],
        //     'total_xrays' => $dashboard['total_xrays'],
        //     'total_sonography' => $dashboard['total_sonography'],
        //     'total_blood_test' => $dashboard['total_blood_test'],

        //     'total_patients_today' => $total_patients_today,
        //     'date' => $date
        // ]);

        $pdf = PDF::loadView('daily-report-pdf', [
            'total_patients' => $dashboard['total_patients'],
            'total_appointments' => $dashboard['total_appointments'],
            'total_appointments_today' => $dashboard['total_appointments_today'],
            'upcoming_appointments' => $dashboard['upcoming_appointments'],
            'total_payments' => $dashboard['total_payments'],
            'total_payments_month' => $dashboard['total_payments_month'],
            'total_payments_year' => $dashboard['total_payments_year'],
            'total_xrays' => $dashboard['total_xrays'],
            'total_sonography' => $dashboard['total_sonography'],
            'total_blood_test' => $dashboard['total_blood_test'],

            'total_patients_today' => $total_patients_today,
            'date' => $date
        ]);
        
        return $pdf->download($date.'-Daily-Patient-Report.pdf');
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
