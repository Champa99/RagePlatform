@extends ('admin.layout')

@section ('scripts')
    <script src="coreJs/languageAdder.js"></script>
@endsection

@section ('content')
    
    <div id="select_file_alert"></div>

    <div class="admin-container-holder admin-languages">
       <div class="admin-container">

            <div class="admin-page-title-holder">
                    <h4>@lang('admin.language_add')</h4>
                    <p>@lang('admin.languages_add_desc')</p>
                </div>
        
                <div class="admin-window language-installer">

                    <div class="row">

                        <div class="col-5">
                            <h4>@lang('admin.install_language')</h4>

                            <div class="input-group mt-5 mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="install_language">@lang('admin.install')</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="install_file" aria-describedby="install_language">
                                    <label class="custom-file-label" for="install_file">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="or-divider">
                                <div class="line"></div>
                                <p class="or">@lang('admin.or')</p>
                            </div>
                        </div>

                        <div class="col-5">
                            <h4>@lang('admin.create_language')</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection