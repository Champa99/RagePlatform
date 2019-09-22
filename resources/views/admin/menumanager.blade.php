@extends ('admin.layout')

@section ('scripts')
	<script src="coreJs/buttonManager.js"></script>
@endsection

@section ('content')
<div class="admin-container-holder admin-button-manager">
    <div class="admin-container">
        <div class="admin-page-title-holder">
            <h4>@lang('admin.menu_manager')</h4>
            <p>@lang('admin.menu_manager_desc')</p>
    	</div>

		<div class="admin-window">
                
			<div class="container">
				<div class="row">

					<div class="col-4">
						<div class="button-list" id="button_list">
							
							@foreach (App\Packages\Core\Buttons::getList() AS $button)
								<div class="button-preview" id="btn_preview_{{ $button->id }}"
									data-btn-id="{{ $button->id }}" data-expandable="{{ $button->expandable }}"
									data-parent="{{ $button->parent }}">
									@lang($button->lang_str)

									<div class="button-icons">

										@if($button->expandable)
											<div class="icon collapse-icon" id="collapse_btn_{{ $button->id }}"
												data-btn-id="{{ $button->id }}" data-collapsed="true">
												<i class="fas fa-caret-down"></i>
											</div>
										@endif

										<div class="icon move-icon" data-btn-id="{{ $button->id }}" data-expandable="{{ $button->expandable }}">
											<i class="fas fa-expand-arrows-alt"></i>
										</div>

										<div class="icon delete-icon">
											<i class="fas fa-trash-alt"></i>
										</div>
									</div>

									@if ($button->expandable)
										<div class="children-buttons" id="children_btn_{{ $button->id }}" data-btn-id="{{ $button->id }}" style="display: none;">

											@if (isset($button->children))
												@foreach ($button->children AS $child)
													<div class="button-preview" id="btn_preview_{{ $child->id }}"
														data-btn-id="{{ $child->id }}" data-expandable="{{ $child->expandable }}"
														data-parent="{{ $child->parent }}">
														@lang($child->lang_str)
		
														<div class="button-icons">

															<div class="icon move-icon" data-btn-id="{{ $child->id }}" data-expandable="{{ $child->expandable }}">
																<i class="fas fa-expand-arrows-alt"></i>
															</div>

															<div class="icon delete-icon">
																<i class="fas fa-trash-alt"></i>
															</div>
														</div>
													</div>
												@endforeach
											@endif
										</div>
									@endif
								</div>
							@endforeach
						</div>

						<div class="row">
							<div class="col mt-4 mb-3">
								<button type="submit" id="save_order_button" class="btn btn-rage">
									<i class="fas fa-save"></i>
									@lang('admin.save_order')
								</button>
							</div>
						</div>
					</div>
					<div class="col-8">
						
						<h4>@lang('admin.create_new_button')</h4>

						<form id="add_button_form">
							@csrf

							<div class="row rage-input-holder mb-2">
								<div class="col-4 input-col label">
									@lang('admin.lang_str')
									<i class="fas fa-question-circle" data-toggle="tooltip"
										title="@lang('admin.lang_str_explain')"></i>
								</div>
								<div class="col-8 input-col">
									<input type="text" name="button_lang_str" class="rage-input"
										placeholder="@lang('admin.lang_str_placeholder')">
								</div>
							</div>

							<div class="row rage-input-holder mb-2">
								<div class="col-4 input-col label">@lang('admin.button_link')</div>
								<div class="col-8 input-col">
									<input type="text" name="button_link" class="rage-input"
										placeholder="@lang('admin.button_link_placeholder')">
								</div>
							</div>

							<div class="row rage-input-holder mb-2" id="button_is_expandable_holder">
								<div class="col-4 input-col label">@lang('admin.is_expandable')</div>
								<div class="col-8 input-col">
									<input type="checkbox" id="button_is_expandable" name="button_expandable">
								</div>
							</div>

							<div class="row rage-input-holder mb-2" id="button_is_child_holder">
								<div class="col-4 input-col label">@lang('admin.is_child')</div>
								<div class="col-8 input-col">
									<input type="checkbox" id="button_is_child" name="button_is_child">
								</div>
							</div>

							<div class="row rage-input-holder mb-2" id="parent_button" style="display: none;">
								<div class="col-4 input-col label">@lang('admin.parent')</div>
								<div class="col-8 input-col">
									<select name="button_parent" class="rage-select">
										@foreach (App\Packages\Core\Buttons::getList() AS $button)
											@if($button->expandable)
												<option value="{{ $button->id }}">@lang($button->lang_str)</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="row rage-input-holder mt-3 mb-2">
								<button id="add_button" class="ml-3 btn btn-rage">
									<i class="fas fa-plus-circle"></i>
									@lang('admin.add_button')
								</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection