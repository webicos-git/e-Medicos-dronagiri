<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Doctor;
use App\Xray;
use App\Sonography;
use App\BloodTest;
use App\Treatment;
use App\TreatmentXray;
use App\TreatmentSonography;
use App\TreatmentBloodTest;

use Illuminate\Http\Request;
use Redirect;
use DB;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getReportData($year = NULL, $month = NULL, $date = NULL)
    {
        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {
            $treatments_query = Treatment::where('doctor_id', $doctor->id);
            if ($year) {
                $treatments_query->whereYear('created_at', $year);
            }
            if ($month) {
                $treatments_query->whereMonth('created_at', $month);
            }
            if ($date) {
                $treatments_query->whereDate('created_at', $date);
            }

            $treatments = $treatments_query->get();                 
            
            $doctor->patient_count = $treatments->count();

            $doctor->xray_count = 0;
            $doctor->sonography_count = 0;
            $doctor->blood_test_count = 0;

            $doctor->total_amount = 0;

            $all_treatments = Treatment::where('doctor_id', $doctor->id)->get();

            foreach ($all_treatments as $treatment) {
                $doctor_xray_count_query = TreatmentXray::where('treatment_id', $treatment->id);
                $doctor_sonography_count_query = TreatmentSonography::where('treatment_id', $treatment->id);
                $doctor_blood_test_count_query = TreatmentBloodTest::where('treatment_id', $treatment->id);

                $xray_total_amount_query = DB::table('treatment_xrays')
                                        ->select('xrays.amount')
                                        ->join('xrays', 'xrays.id', '=', 'treatment_xrays.xray_id')
                                        ->where('treatment_xrays.treatment_id', $treatment->id);
                            
                $sonography_total_amount_query = DB::table('treatment_sonographies')
                                        ->select('sonographies.amount')
                                        ->join('sonographies', 'sonographies.id', '=', 'treatment_sonographies.sonography_id')
                                        ->where('treatment_sonographies.treatment_id', $treatment->id);
                
                $blood_test_total_amount_query = DB::table('treatment_blood_tests')
                                        ->select('blood_tests.amount')
                                        ->join('blood_tests', 'blood_tests.id', '=', 'treatment_blood_tests.blood_test_id')
                                        ->where('treatment_blood_tests.treatment_id', $treatment->id);

                if ($year) {
                    $doctor_xray_count_query->whereYear('created_at', $year);
                    $doctor_sonography_count_query->whereYear('created_at', $year);
                    $doctor_blood_test_count_query->whereYear('created_at', $year);
                    $xray_total_amount_query->whereYear('treatment_xrays.created_at', $year);
                    $sonography_total_amount_query->whereYear('treatment_sonographies.created_at', $year);
                    $blood_test_total_amount_query->whereYear('treatment_blood_tests.created_at', $year);
                }
                if ($month) {
                    $doctor_xray_count_query->whereMonth('created_at', $month);
                    $doctor_sonography_count_query->whereMonth('created_at', $month);
                    $doctor_blood_test_count_query->whereMonth('created_at', $month);
                    $xray_total_amount_query->whereMonth('treatment_xrays.created_at', $month);
                    $sonography_total_amount_query->whereMonth('treatment_sonographies.created_at', $month);
                    $blood_test_total_amount_query->whereMonth('treatment_blood_tests.created_at', $month);
                }
                if ($date) {
                    $doctor_xray_count_query->whereDate('created_at', $date);
                    $doctor_sonography_count_query->whereDate('created_at', $date);
                    $doctor_blood_test_count_query->whereDate('created_at', $date);
                    $xray_total_amount_query->whereDate('treatment_xrays.created_at', $date);
                    $sonography_total_amount_query->whereDate('treatment_sonographies.created_at', $date);
                    $blood_test_total_amount_query->whereDate('treatment_blood_tests.created_at', $date);
                }
                            
                $doctor->xray_count += $doctor_xray_count_query->count();
                $doctor->sonography_count += $doctor_sonography_count_query->count();
                $doctor->blood_test_count += $doctor_blood_test_count_query->count();
                        
                $doctor->total_amount += $xray_total_amount_query->sum('xrays.amount');
                $doctor->total_amount += $sonography_total_amount_query->sum('sonographies.amount');
                $doctor->total_amount += $blood_test_total_amount_query->sum('blood_tests.amount');
            }
        }

        return [
            'doctors' => $doctors,
            'year' => $year,
            'month' => $month,
            'date' => $date
        ];
    }

    public function all()
    {
        $report_data = $this->getReportData(date("Y"), date("m"));
        return view('report.all', [
            'doctors' => $report_data['doctors'],
            'year' => $report_data['year'],
            'month' => $report_data['month'],
            'date' => $report_data['date']
        ]);
    }

    public function filter(Request $request)
    {
        $report_data = $this->getReportData($request->year, $request->month, $request->date);
        return view('report.all', [
            'doctors' => $report_data['doctors'],
            'year' => $report_data['year'],
            'month' => $report_data['month'],
            'date' => $report_data['date']
        ]);
    }
    
    public function pdf($id)
    {
        $doctor = Doctor::findOrfail($id);
        
        $doctor_xrays = DB::table('xrays')
                        ->select('*', 'xrays.name as xray_name', 'patients.name as patient_name', 'treatment_xrays.created_at as date')
                        ->join('treatment_xrays', 'xrays.id', '=', 'treatment_xrays.xray_id')
                        ->join('treatments', 'treatments.id', '=', 'treatment_xrays.treatment_id')
                        ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                        ->where('treatments.doctor_id', $doctor->id)
                        ->get();
                        
        $doctor_sonography = DB::table('sonographies')
                        ->select('*', 'sonographies.name as sonography_name', 'patients.name as patient_name', 'treatment_sonographies.created_at as date')
                        ->join('treatment_sonographies', 'sonographies.id', '=', 'treatment_sonographies.sonography_id')
                        ->join('treatments', 'treatments.id', '=', 'treatment_sonographies.treatment_id')
                        ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                        ->where('treatments.doctor_id', $doctor->id)
                        ->get();
        
        $doctor_blood_tests = DB::table('blood_tests')
                        ->select('*', 'blood_tests.name as blood_test_name', 'patients.name as patient_name', 'treatment_blood_tests.created_at as date')
                        ->join('treatment_blood_tests', 'blood_tests.id', '=', 'treatment_blood_tests.blood_test_id')
                        ->join('treatments', 'treatments.id', '=', 'treatment_blood_tests.treatment_id')
                        ->join('patients', 'patients.id', '=', 'treatments.patient_id')
                        ->where('treatments.doctor_id', $doctor->id)
                        ->get();
        
        $doctor->total_amount = 0;
        foreach ($doctor_xrays as $xray) {
            $doctor->total_xray_amount += $xray->amount;
        }
        foreach ($doctor_sonography as $sonography) {
            $doctor->total_sonography_amount += $sonography->amount;
        }
        foreach ($doctor_blood_tests as $blood_test) {
            $doctor->total_blood_test_amount += $blood_test->amount;
        }

        $doctor->total_amount = $doctor->total_xray_amount + $doctor->total_sonography_amount;
        
        // return view('report.pdf', [
        //     'doctor' => $doctor, 
        //     'doctor_xrays' => $doctor_xrays, 
        //     'doctor_sonography' => $doctor_sonography,
        //     'doctor_blood_tests' => $doctor_blood_tests,
        // ]);

        $pdf = PDF::loadView('report.pdf', [
            'doctor' => $doctor, 
            'doctor_xrays' => $doctor_xrays, 
            'doctor_sonography' => $doctor_sonography,
            'doctor_blood_tests' => $doctor_blood_tests,
        ]);

        return $pdf->download($doctor->name.'.pdf');
    }
}
