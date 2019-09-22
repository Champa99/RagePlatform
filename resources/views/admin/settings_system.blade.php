@extends ('admin.layout')

@section ('scripts')
	<script src="{{ getTheme() }}/js/admin/settings/system.js"></script>
@endsection

@section ('content')
    <div class="admin-container-holder admin-settings">
        <div class="admin-container">
            <div class="admin-page-title-holder">
                <h4>@lang('admin.settings_system')</h4>
                <p>@lang('admin.settings_system_desc')</p>
            </div>

            <div class="admin-window">
                
                 <div class="container">

					@php
						$systemSettings = ['site_name', 'social_facebook', 'social_instagram', 'social_twitter'];
					@endphp

					<form id="system_settings_form">
						
						@csrf

						@foreach(rageConfig() AS $key => $config)
							
							@if (in_array($key, $systemSettings))

							<div class="row rage-input-holder mb-2">
									<div class="col-3 input-col label">
										@lang('admin.'. $key)
									</div>
			
									<div class="col-9 input-col">
										@if (__('admin.plc_'. $key) != 'admin.plc_'. $key)
											<input type="text" name="{{ $key }}"
												class="rage-input" value="{{ $config }}" placeholder="@lang('admin.plc_'. $key)">
										@else
											<input type="text" name="{{ $key }}"
												class="rage-input" value="{{ $config }}">
										@endif
									</div>
								</div>
							@endif
						@endforeach
						
						<div class="row">
							<div class="col mt-4 mb-3">
								<button type="submit" id="save_settings_button" class="btn btn-rage">
									<i class="fas fa-save"></i>
									@lang('admin.save_changes')
								</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
@endsection