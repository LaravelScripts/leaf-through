<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getForm()
    {
    	return view('settings.form');
    }

    public function postForm(Request $request)
    {
    	cache()->forget('settings');
    	$settings = getAllSettings();

    	$rules = collect($settings)->filter(function($value) {
    		return $value->required;
    	})->mapWithKeys(function($value) {
    		return [$value->name => 'required'];
    	})->toArray();

    	$this->validate($request, $rules);

    	collect($request->all())->each(function($value, $key) {
    		$setting = Setting::where('name', $key)->first();
    		if ($setting) {
    			$setting->value = $value;
    			$setting->save();
    		}
    	});

    	cache()->forget('settings');

    	return back();
    }
}
