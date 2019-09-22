<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packages\System\Language;

class AdminLanguagesController extends Controller
{
    public function index() {

        return view('admin.languages', [
            'languages' => Language::loadInstalled()
        ]);
    }

    public function add(Request $request) {

        if($request->isMethod('GET')) {

            return view('admin.languages_add');
        }
    }
}
