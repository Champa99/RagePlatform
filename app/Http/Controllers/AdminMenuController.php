<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packages\Core\Buttons;
use ResponseBuilder;
use App\Packages\ResponseBuilder\Codes;

class AdminMenuController extends Controller
{
    public function index() {

        return view('admin.menumanager');
    }

    public function addButton(Request $request) {

        if($request->filled(['button_lang_str', 'button_link', ])) {

            $expandable = ($request->input('button_expandable') != null) ? true : false;
            $isChild = ($request->input('button_is_child') != null) ? true : false;

            if($isChild) {

                $parent = $request->input('button_parent');
            } else {

                $parent = 0;
            }

            $buttonId = Buttons::add(
                $request->input('button_lang_str'),
                $request->input('button_link'),
                $expandable,
                0,
                $parent
            );

            $html = "<div class='button-preview' id='btn_preview_". $buttonId ."'
                data-btn-id='". $buttonId ."' data-expandable='". $expandable ."'>
                ". __($request->input('button_lang_str')) ."
                
                <div class='button-icons'>";

					if($expandable) {
                        
                        $html .= "<div class='icon collapse-icon' id='collapse_btn_". $buttonId ."'
							data-btn-id='". $buttonId ."' data-collapsed='true'>
							<i class='fas fa-caret-down'></i>
						</div>";
                    }

					$html .= "<div class='icon move-icon' data-btn-id='". $buttonId ."' data-expandable='". $expandable ."'>
						<i class='fas fa-expand-arrows-alt'></i>
					</div>

					<div class='icon delete-icon'>
						<i class='fas fa-trash-alt'></i>
					</div>
                </div>";

                if($expandable) {

                    $html .= "<div class='children-buttons' id='children_btn_". $buttonId ."' data-btn-id='". $buttonId ."' style='display: none;'>
                    </div>";
                }
            $html .= "</div>";

            return ResponseBuilder::success([
                'html' => $html,
                'parent' => $parent
            ]);
        }

        return ResponseBuilder::error(Codes::EMPTY_FIELDS);
    }

    public function saveOrder(Request $request) {

        if($request->filled('buttons')) {

            Buttons::saveOrder($request->input('buttons'));

            return ResponseBuilder::success();
        } else {

            return ResponseBuilder::error(Codes::API_BREACH);
        }
    }
}
