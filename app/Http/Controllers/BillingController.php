<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Billing;
use App\Billing_item;
use Redirect;
use PDF;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        $patients = Patient::all();
        $last_billing = Billing::latest()->first();

        if ($last_billing) {
            $opd_no = date('y') . '/0' . ($last_billing->id + 1);
        } else {
            $opd_no = date('y') . '/0' . 1;
        }

        return view('billing.create', ['patients' => $patients, 'opd_no' => $opd_no]);
    }

    public function edit($id)
    {
        $patients = Patient::all();
        $billing = Billing::find($id);
        $billing_items = Billing_item::where('billing_id', $id)->get();

        return view('billing.edit', [
            'patients' => $patients,
            'billing' => $billing,
            'billing_items' => $billing_items
        ]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
                'patient_id' => ['required','exists:patients,id'],
                'payment_mode' => 'required',
                'payment_status' => 'required',
                'invoice_title.*' => 'required',
                'invoice_amount.*' => ['required','numeric'],
                'invoice_status.*' => 'required'
            ]);


        $billing = Billing::where('id', $request->id)
                    ->update([
                        'patient_id' => $request->patient_id,
                        'payment_mode' => $request->payment_mode,
                        'payment_status' => $request->payment_status,
                    ]);

        $i = count($request->invoice_title);

        for ($x = 0; $x < $i; $x++) {
            $invoice_item = Billing_item::where('id', $request->invoice_id[$x])
                            ->update([
                                'invoice_title' => $request->invoice_title[$x],
                                'invoice_amount' => $request->invoice_amount[$x],
                                'invoice_status' => $request->invoice_status[$x],
                            ]);
        };


        return Redirect::route('billing.all')->with('success', 'Invoice Updated Successfully!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'patient_id' => ['required','exists:patients,id'],
         'payment_mode' => 'required',
         'payment_status' => 'required',
         'invoice_title.*' => 'required',
         'invoice_amount.*' => ['required','numeric'],
         'invoice_status.*' => 'required'
     ]);


        $billing = new Billing();

        $billing->patient_id = $request->patient_id;
        $billing->payment_mode = $request->payment_mode;
        $billing->payment_status = $request->payment_status;
        $billing->opd_no = $request->opd_no;
        $billing->reference = 'b'.rand(10000, 99999);

        $billing->save();


        $i = 0;
        if ($request->invoice_title) {
            $i = count($request->invoice_title);
        }

        for ($x = 0; $x < $i; $x++) {
            echo $request->invoice_title[$x];



            $invoice_item = new Billing_item();

            $invoice_item->invoice_title = $request->invoice_title[$x];
            $invoice_item->invoice_amount = $request->invoice_amount[$x];
            $invoice_item->invoice_status = $request->invoice_status[$x];
            $invoice_item->billing_id = $billing->id;

            $invoice_item->save();
        }

        return Redirect::route('billing.all')->with('success', 'Invoice Created Successfully!');
    }

    public function all()
    {
        $invoices = Billing::all();
        return view('billing.all', ['invoices' => $invoices]);
    }


    public function view($id)
    {
        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id', $id)->get();
        $amount_paid = Billing_item::where('billing_id', $id)->where('invoice_status', 'Paid')->sum('invoice_amount');
        $amount_balance = Billing_item::where('billing_id', $id)->where('invoice_status', 'Balance')->sum('invoice_amount');

        return view('billing.view', [
          'billing' => $billing,
          'billing_items' => $billing_items,
          'amount_paid' => $amount_paid,
          'amount_balance' => $amount_balance
        ]);
    }

    public function pdf($id)
    {
        $billing = Billing::findOrfail($id);
        $billing_items = Billing_item::where('billing_id', $id)->get();
        $amount_paid = Billing_item::where('billing_id', $id)->where('invoice_status', 'Paid')->sum('invoice_amount');
        $amount_balance = Billing_item::where('billing_id', $id)->where('invoice_status', 'Balance')->sum('invoice_amount');

        // return view('billing.pdf', [
        //     'billing' => $billing,
        //     'billing_items' => $billing_items,
        //     'amount_paid' => $amount_paid,
        //     'amount_balance' => $amount_balance
        // ]);

        $pdf = PDF::loadView('billing.pdf', [
            'billing' => $billing,
            'billing_items' => $billing_items,
            'amount_paid' => $amount_paid,
            'amount_balance' => $amount_balance
        ]);

        return $pdf->download($billing->opd_no.'-Invoice.pdf');
    }

    public function destroy($id)
    {
        $billing_items = Billing_item::where('billing_id', $id)->get();
        
        for ($i=0; $i < count($billing_items); $i++) {
            Billing_item::destroy($billing_items[$i]->$id);
        }
        
        Billing::destroy($id);


        return Redirect::route('billing.all')->with('success', 'Billing Deleted Successfully!');
    }
}
