<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Gets the settings form.
     *
     * @return   \Illuminate\View\View  The form.
     */
    public function getForm() : \Illuminate\View\View {
    	return view('settings.form');
    }

    /**
     * Process the settings form.
     *
     * @param   \Illuminate\Http\Request  $request  The request
     *
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function postForm(Request $request) : \Illuminate\Http\RedirectResponse {

    	$this->validate($request, $this->buildRules());

    	collect($request->all())->each(function($value, $key) {
    		$setting = Setting::where('name', $key)->first();
            ($setting) ? $this->save($setting, $value) : null;
    	});

        // Remove already cached settings.
        // getAllSettings() in helpers.php will take care of re-caching.
    	cache()->forget('settings');

    	return back();
    }

    /**
     * Builds rules for validation
     *
     * @return  array  The rules.
     */
    private function buildRules() :array{

        $settings = getAllSettings();

        return collect($settings)->filter(function($value) {
            return $value->required;
        })->mapWithKeys(function($value) {
            return [$value->name => 'required'];
        })->toArray();
    }

    /**
     * Saves setting instance
     *
     * @param      <type>  $setting  The setting
     * @param      <type>  $value    The value
     */
    private function save(Setting $setting, string $value) {
		$setting->value = $value;
		$setting->save();
    }
}
