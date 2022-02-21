<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function doctorino_settings(Request $request)
    {
        $settings = Setting::all();
        $language = ['fr' => 'French', 'en' => 'English', 'es' => 'Spanish', 'de' => 'German', 'bn' => 'Bengali'];
        return view('settings.doctorino_settings', ['settings' => $settings, 'language' => $language]);
    }

    public function doctorino_settings_store(Request $request)
    {
        $validatedData = $request->validate([
            'system_name' => 'required',
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'hospital_email' => 'required|email',
            'currency' => 'required',
            'appointment_interval' => 'required',
        ]);

        Setting::update_option('system_name', $request->system_name);
        Setting::update_option('title', $request->title);
        Setting::update_option('address', $request->address);
        Setting::update_option('phone', $request->phone);
        Setting::update_option('hospital_email', $request->hospital_email);
        Setting::update_option('currency', $request->currency);
        Setting::update_option('vat', $request->vat);
        Setting::update_option('language', $request->language);

        Setting::update_option('appointment_interval', $request->appointment_interval);

        Setting::update_option('saturday_from', $request->saturday_from);
        Setting::update_option('saturday_to', $request->saturday_to);

        Setting::update_option('sunday_from', $request->sunday_from);
        Setting::update_option('sunday_to', $request->sunday_to);

        Setting::update_option('monday_from', $request->monday_from);
        Setting::update_option('monday_to', $request->monday_to);

        Setting::update_option('tuesday_from', $request->tuesday_from);
        Setting::update_option('tuesday_to', $request->tuesday_to);

        Setting::update_option('wednesday_from', $request->wednesday_from);
        Setting::update_option('wednesday_to', $request->wednesday_to);

        Setting::update_option('thursday_from', $request->thursday_from);
        Setting::update_option('thursday_to', $request->thursday_to);

        Setting::update_option('friday_from', $request->friday_from);
        Setting::update_option('friday_to', $request->friday_to);



        return Redirect::route('doctorino_settings.edit')->with('success', __("sentence.Settings edited Successfully"));
    }

    public function prescription_settings(Request $request)
    {
        return view('settings.prescription_settings');
    }

    public function prescription_settings_store(Request $request)
    {
        Setting::update_option('header_right', $request->header_right);
        Setting::update_option('header_left', $request->header_left);
        Setting::update_option('footer_right', $request->footer_right);
        Setting::update_option('footer_left', $request->footer_left);

        return Redirect::route('prescription_settings.edit')->with('success', __("sentence.Settings edited Successfully"));
    }
}
