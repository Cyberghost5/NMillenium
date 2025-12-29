@extends('layouts.main')
@section('title')
    {{ __('App Setup') }}
@endsection
@section('content')
    <section class="section">
        <form action="{{ route('app_settings.store') }}" method="post" class="create-form">
            @csrf
            <div class="card">
                <div class="card-header">
                    <p class="card-header-new-style"> {{ __('App Setup') }}</p>
                </div>
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label">{{ __('Dual Website') }}</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="dual_website" value="0">
                                    <input class="form-check-input" type="checkbox" id="dual_website" name="dual_website" value="1"
                                           {{ isset($appsettings['dual_website']) && $appsettings['dual_website'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="dual_website"></label>
                                </div>
                            </div>
                        </div>

                        <div id="website_urls" style="display: none;">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label">{{ __('Primary URL') }}</label>
                                    <input type="url" name="primary_url" id="primary_url" class="form-control"
                                           value="{{ $appsettings['primary_url'] ?? '' }}">
                                </div>

                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label">{{ __('Secondary URL') }}</label>
                                    <input type="url" name="secondary_url" id="secondary_url" class="form-control"
                                           value="{{ $appsettings['secondary_url'] ?? '' }}">
                                </div>

                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label">{{ __('First Bottom Nav') }}</label>
                                    <input type="text" name="first_bottom_nav_web" id="first_bottom_nav_web" class="form-control" maxlength="8"
                                           value="{{ $appsettings['first_bottom_nav_web'] ?? '' }}">
                                </div>

                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label">{{ __('Second Bottom Nav') }}</label>
                                    <input type="text" name="second_bottom_nav_web" id="second_bottom_nav_web" class="form-control" maxlength="8"
                                           value="{{ $appsettings['second_bottom_nav_web'] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div id="website_url_single" style="display: none;">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="website_url" class="mandatory form-label">{{ __('Website URL') }}</label>
                                <input type="url" name="website_url" id="website_url" class="form-control"
                                       data-parsley-required="true" value="{{ $appsettings['website_url'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mandatory">
                                <label for="color_code" class="mandatory form-label">Loader Color </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <input type="color" name="loader_color" id="loader_color"
                                            class="form-control color-input"
                                            value="{{ $appsettings['loader_color'] ?? '#ae590a' }}">
                                    </div>
                                    <input type="text" name="color_code" id="color_code" class="form-control"
                                        value="{{ $appsettings['loader_color'] ?? '#ae590a' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mandatory">
                                <label for="share_app_message" class="mandatory form-label">{{ __('Share App Message') }}</label>
                                <input type="text" name="share_app_message" id="share_app_message" class="form-control"
                                    data-parsley-required="true" value="{{ $appsettings['share_app_message'] ?? '' }}">
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="radio-group mandatory">
                                <label class="mandatory form-label">{{ __('Pull to Refresh') }}</label><br>
                                <input type="radio" id="pull_to_refresh_active" name="pull_to_refresh" value="true"
                                    class="form-check-input"
                                    {{ isset($appsettings['pull_to_refresh']) && $appsettings['pull_to_refresh'] === 'true' ? 'checked' : '' }} checked>
                                <label for="pull_to_refresh_active" class="form-check-label">{{ __('Active') }}</label>
                                <input type="radio" id="pull_to_refresh_inactive" name="pull_to_refresh" value="false"
                                    class="form-check-input"
                                    {{ isset($appsettings['pull_to_refresh']) && $appsettings['pull_to_refresh'] === 'false' ? 'checked' : '' }}>
                                <label for="pull_to_refresh_inactive" class="form-check-label">{{ __('Inactive') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="radio-group mandatory">
                                <label class="mandatory form-label">{{ __('Onboarding Screen') }}</label><br>
                                <input type="radio" id="onboarding_screen_active" name="onboarding_screen" value="true"
                                    class="form-check-input" checked
                                    {{ isset($appsettings['onboarding_screen']) && $appsettings['onboarding_screen'] == 'true' ? 'checked' : '' }} checked>
                                <label for="onboarding_screen_active" class="form-check-label">{{ __('Active') }}</label>
                                <input type="radio" id="onboarding_screen_inactive" name="onboarding_screen"
                                    value="false" class="form-check-input"
                                    {{ isset($appsettings['onboarding_screen']) && $appsettings['onboarding_screen'] == 'false' ? 'checked' : '' }}>
                                <label for="onboarding_screen_inactive"
                                    class="form-check-label">{{ __('Inactive') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="radio-group mandatory">
                                <label class="mandatory form-label">{{ __('Exit Popup Screen') }}</label><br>
                                <input type="radio" id="exit_popup_screen_active" name="exit_popup_screen" value="true"
                                    class="form-check-input" checked
                                    {{ isset($appsettings['exit_popup_screen']) && $appsettings['exit_popup_screen'] == 'true' ? 'checked' : '' }} checked>
                                <label for="exit_popup_screen_active" class="form-check-label">{{ __('Active') }}</label>
                                <input type="radio" id="exit_popup_screen_inactive" name="exit_popup_screen"
                                    value="false" class="form-check-input"
                                    {{ isset($appsettings['exit_popup_screen']) && $appsettings['exit_popup_screen'] == 'false' ? 'checked' : '' }}>
                                <label for="exit_popup_screen_inactive"
                                    class="form-check-label">{{ __('Inactive') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="radio-group mandatory">
                                <label class="mandatory form-label">{{ __('Hide Footer') }}</label><br>
                                <input type="radio" id="hide_footer_active" name="hide_footer" value="true"
                                    class="form-check-input"
                                    {{ isset($appsettings['hide_footer']) && $appsettings['hide_footer'] === 'true' ? 'checked' : '' }} checked>
                                <label for="hide_footer_active" class="form-check-label">{{ __('Active') }}</label>
                                <input type="radio" id="hide_footer_inactive" name="hide_footer" value="false"
                                    class="form-check-input"
                                    {{ isset($appsettings['hide_footer']) && $appsettings['hide_footer'] === 'false' ? 'checked' : '' }}>
                                <label for="hide_footer_inactive" class="form-check-label">{{ __('Inactive') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <div class="radio-group mandatory">
                                <label class="mandatory form-label">{{ __('Hide Header') }}</label><br>
                                <input type="radio" id="hide_header_active" name="hide_header" value="true"
                                    class="form-check-input"
                                    {{ isset($appsettings['hide_header']) && $appsettings['hide_header'] === 'true' ? 'checked' : '' }} checked>
                                <label for="hide_header_active" class="form-check-label">{{ __('Active') }}</label>
                                <input type="radio" id="hide_header_inactive" name="hide_header" value="false"
                                    class="form-check-input"
                                    {{ isset($appsettings['hide_header']) && $appsettings['hide_header'] === 'false' ? 'checked' : '' }}>
                                <label for="hide_header_inactive" class="form-check-label">{{ __('Inactive') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <p class="card-header-new-style"> {{ __('Notification Setting') }}</p>
                </div>
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label class="form-label col-md-12 col-sm-12">Project Id</label>
                            <input class="form-control" type="text" name="project_id"
                                value="{{ $appsettings['project_id'] ?? '' }}" placeholder="Enter Project Id" autofocus
                                required />
                        </div>
                        <div class="col-md-6 ">
                            <label class="d-flex col-sm-12 col-form-label align-items-center">
                                {{ __('Service File') }}
                                @if (isset($appsettings['service_file']) ? $appsettings['service_file'] : '')
                                    <p style="margin-left: 10px; margin-bottom: 0;"><label
                                            class="rounded-pill-success">File Exists</label></p>
                                @else
                                    <p style="margin-left: 10px; margin-bottom: 0;"><label class="rounded-pill-danger">Not
                                            Exists</label></p>
                                @endif
                            </label>
                            <div class="col-sm-12">
                                <input type="file" name="service_file" class="form-control mb-2" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2 d-flex justify-content-end">
                        <button class="btn btn-primary me-1 mb-1" type="submit"
                            name="submit">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('script')
<script>
    document.getElementById('dual_website').addEventListener('change', function() {
    const isDualWebsite = this.checked;
    document.getElementById('website_urls').style.display = isDualWebsite ? 'block' : 'none';
    document.getElementById('website_url_single').style.display = isDualWebsite ? 'none' : 'block';

    document.getElementById('primary_url').required = isDualWebsite;
    document.getElementById('secondary_url').required = isDualWebsite;
    document.getElementById('first_bottom_nav_web').required = isDualWebsite;
    document.getElementById('second_bottom_nav_web').required = isDualWebsite;
    document.getElementById('website_url').required = !isDualWebsite;
});

window.onload = function() {
    const isDualWebsite = document.getElementById('dual_website').checked;

    document.getElementById('website_urls').style.display = isDualWebsite ? 'block' : 'none';
    document.getElementById('website_url_single').style.display = isDualWebsite ? 'none' : 'block';

    document.getElementById('primary_url').required = isDualWebsite;
    document.getElementById('secondary_url').required = isDualWebsite;
    document.getElementById('first_bottom_nav_web').required = isDualWebsite;
    document.getElementById('second_bottom_nav_web').required = isDualWebsite;
    document.getElementById('website_url').required = !isDualWebsite;
    
    // Initialize color picker sync with text input
    const colorPicker = document.getElementById('loader_color');
    const colorText = document.getElementById('color_code');
    
    // Add event listener to update text input when color picker changes
    colorPicker.addEventListener('input', function() {
        colorText.value = this.value;
    });
    
    // Add event listener to update color picker when text input changes
    colorText.addEventListener('input', function() {
        colorPicker.value = this.value;
    });
};

</script>
@endsection
