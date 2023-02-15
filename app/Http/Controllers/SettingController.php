<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function rateUpdate(Request $request): RedirectResponse
    {
        $setting = Setting::findOrFail(1);
        $setting->dollar_value = $request->rate;
        $setting->save();

        return Redirect::route('profile.edit')->with('status', 'currency-updated');
    }
}
