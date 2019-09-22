@extends ('admin.layout')

@section ('scripts')
	<script src="coreJs/buttonManager.js"></script>
@endsection

@section ('content')
    
    <div class="admin-container-holder admin-languages">
       <div class="admin-container">

            <div class="admin-page-title-holder">
                    <h4>@lang('admin.languages')</h4>
                    <p>@lang('admin.languages_desc')</p>
                </div>
        
                <div class="admin-window">

                    <div class="top-controls text-right">
                        <a href="/admin/settings/languages/edit" class="btn btn-outline-secondary"><i class="fas fa-language"></i> @lang('admin.edit_language')</a>
                        <a href="/admin/settings/languages/add" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('admin.add_language')</a>
                    </div>

                    <div class="language-list">

                        <div class="list-group">
                            @foreach ($languages AS $language)
                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $language->language }} ({{ $language->locale }})
                                    <span class="badge badge-primary badge-pill">{{ $language->strings_num }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection