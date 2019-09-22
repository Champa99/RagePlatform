<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packages\System\Settings;
use Logger;
use ResponseBuilder;

class AdminSettingsController extends Controller
{
    public function system(Request $request) {

        if($request->isMethod('GET')) {

            return view('admin.settings_system');
        }

        if($request->isMethod('POST')) {

            $changes = $request->input();
            unset($changes['_token']);

            if(Settings::saveChanges($changes)) {

                Logger::write('systemSettingsChange', 'admin.changed_system_settings');
            }

            return ResponseBuilder::success();
        }
    }
}
