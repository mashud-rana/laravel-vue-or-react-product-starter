@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <!-- Sidebar Navigation -->
                            <div class="col-lg-3 col-md-4 border-end">
                                <div class="settings-sidebar p-4">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active d-flex align-items-center mb-2" id="pills-home-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">
                                            <i class="mdi mdi-cog-outline me-2 font-size-18"></i>
                                            <span>{{ __('General Settings') }}</span>
                                        </button>
                                        <button class="nav-link d-flex align-items-center mb-2" id="pills-profile-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">
                                            <i class="mdi mdi-email-outline me-2 font-size-18"></i>
                                            <span>{{ __('Email Settings') }}</span>
                                        </button>
                                        <button class="nav-link d-flex align-items-center mb-2" id="pills-contact-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                            aria-controls="pills-contact" aria-selected="false">
                                            <i class="mdi mdi-share-variant me-2 font-size-18"></i>
                                            <span>{{ __('Social Media') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Content Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content p-4" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <!-- Header -->
                                        <div class="settings-header mb-4">
                                            <h5 class="mb-1 font-weight-bold">
                                                <i class="mdi mdi-cog text-primary me-2"></i>{{ __('General Settings') }}
                                            </h5>
                                            <p class="text-muted small">{{ __('Manage your site basic configuration and branding') }}</p>
                                        </div>

                                        <form action="{{ route('settings.store') }}" method="post" class="custom-validation"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Basic Information Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-information-outline text-info me-2"></i>{{ __('Basic Information') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-medium" for="site_title">
                                                                {{ __('Site Title') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-web"></i></span>
                                                                <input type="text" class="form-control" name="site_title" id="site_title"
                                                                    required placeholder="Enter site title"
                                                                    value="{{ config('settings.site_title') }}">
                                                            </div>
                                                            @error('site_title')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-medium" for="contact_email">
                                                                {{ __('Contact Email') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                                <input type="email" class="form-control" name="contact_email" id="contact_email"
                                                                    required placeholder="Enter contact email"
                                                                    value="{{ config('settings.contact_email') }}">
                                                            </div>
                                                            @error('contact_email')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-medium" for="contact_phone">
                                                                {{ __('Phone Number') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                                <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                                                                    required placeholder="Enter phone number"
                                                                    value="{{ config('settings.contact_phone') }}">
                                                            </div>
                                                            @error('contact_phone')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-medium" for="contact_address">
                                                                {{ __('Address') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-map-marker"></i></span>
                                                                <input class="form-control" name="contact_address" id="contact_address"
                                                                    value="{{ config('settings.contact_address') }}" placeholder="Enter address">
                                                            </div>
                                                            @error('contact_address')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Localization Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-earth text-success me-2"></i>{{ __('Localization') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-medium">{{ __('Timezone') }}</label>
                                                            <select name="timezone" class="select-two form-control">
                                                                @foreach (all_timezones() as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ config('app.timezone') ? (config('app.timezone') == $key ? 'selected' : '') : '' }}>
                                                                        {{ $value }} ({{ $key }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('timezone')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        @php
                                                            $currencies = [
                                                                '$' => 'US Dollar ($)',
                                                                '€' => 'Euro (€)',
                                                                '£' => 'British Pound (£)',
                                                                '¥' => 'Japanese Yen (¥)',
                                                                '₹' => 'Indian Rupee (₹)',
                                                                '₩' => 'South Korean Won (₩)',
                                                                '₽' => 'Russian Ruble (₽)',
                                                                '₺' => 'Turkish Lira (₺)',
                                                                '₫' => 'Vietnamese Dong (₫)',
                                                                '₴' => 'Ukrainian Hryvnia (₴)',
                                                                'R$' => 'Brazilian Real (R$)',
                                                                'C$' => 'Canadian Dollar (C$)',
                                                                'A$' => 'Australian Dollar (A$)',
                                                                'S$' => 'Singapore Dollar (S$)',
                                                                'CHF' => 'Swiss Franc (CHF)',
                                                                'HK$' => 'Hong Kong Dollar (HK$)',
                                                                'NZ$' => 'New Zealand Dollar (NZ$)',
                                                                '₦' => 'Nigerian Naira (₦)',
                                                                '₱' => 'Philippine Peso (₱)',
                                                                '₪' => 'Israeli Shekel (₪)',
                                                                '฿' => 'Thai Baht (฿)',
                                                                '₡' => 'Costa Rican Colón (₡)',
                                                                '₭' => 'Lao Kip (₭)',
                                                                '₨' => 'Various Rupee (₨)',
                                                                '₮' => 'Mongolian Tögrög (₮)',
                                                            ];
                                                        @endphp
                                                        <div class="mb-3">
                                                            <label class="form-label fw-medium" for="currency_symbol">
                                                                {{ __('Currency Symbol') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control currency" name="currency_symbol" id="currency_symbol" required>
                                                                @foreach ($currencies as $symbol => $label)
                                                                    <option value="{{ $symbol }}"
                                                                        {{ config('settings.currency_symbol') == $symbol ? 'selected' : '' }}>
                                                                        {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Branding Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-image-multiple text-warning me-2"></i>{{ __('Branding & Logos') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <div class="logo-upload-card text-center p-3 border rounded">
                                                            <label class="form-label fw-medium d-block">
                                                                {{ __('Site Logo') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <label for="imgInp" class="cursor-pointer">
                                                                <div class="logo-preview-wrapper mb-2">
                                                                    <img src="{{ config('settings.site_logo') ? getStorageImage(config('settings.site_logo'), false, 'logo') : getDefaultLogo() }}"
                                                                        class="img-thumbnail" style="height: 80px; width: 80px; object-fit: contain;"
                                                                        id="site_logo_preview" />
                                                                </div>
                                                                <span class="btn btn-sm btn-outline-primary">
                                                                    <i class="mdi mdi-upload me-1"></i>{{ __('Upload') }}
                                                                </span>
                                                            </label>
                                                            <input type="file" name="site_logo"
                                                                {{ config('settings.site_logo') ? '' : 'required' }}
                                                                class="hdn-uploder image d-none" data-preview="site_logo_preview"
                                                                id="imgInp" accept="image/*" />
                                                            @error('site_logo')
                                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <div class="logo-upload-card text-center p-3 border rounded">
                                                            <label class="form-label fw-medium d-block">
                                                                {{ __('Wide Logo') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <label for="wide_site_logo" class="cursor-pointer">
                                                                <div class="logo-preview-wrapper mb-2">
                                                                    <img src="{{ config('settings.wide_site_logo') ? getStorageImage(config('settings.wide_site_logo'), false, 'wide_logo') : getDefaultWideLogo() }}"
                                                                        class="img-thumbnail" style="height: 80px; width: 120px; object-fit: contain;"
                                                                        id="wide_site_logo_preview" />
                                                                </div>
                                                                <span class="btn btn-sm btn-outline-primary">
                                                                    <i class="mdi mdi-upload me-1"></i>{{ __('Upload') }}
                                                                </span>
                                                            </label>
                                                            <input type="file" name="wide_site_logo"
                                                                {{ config('settings.wide_site_logo') ? '' : 'required' }}
                                                                class="hdn-uploder image d-none" data-preview="wide_site_logo_preview"
                                                                id="wide_site_logo" accept="image/*" />
                                                            @error('wide_site_logo')
                                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <div class="logo-upload-card text-center p-3 border rounded">
                                                            <label class="form-label fw-medium d-block">
                                                                {{ __('Favicon') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <label for="imgInpFavicom" class="cursor-pointer">
                                                                <div class="logo-preview-wrapper mb-2">
                                                                    <img src="{{ config('settings.site_favicon') ? getStorageImage(config('settings.site_favicon'), false, 'favicon') : getDefaultFavicon() }}"
                                                                        class="img-thumbnail" style="height: 80px; width: 80px; object-fit: contain;"
                                                                        id="site_favicon_preview" />
                                                                </div>
                                                                <span class="btn btn-sm btn-outline-primary">
                                                                    <i class="mdi mdi-upload me-1"></i>{{ __('Upload') }}
                                                                </span>
                                                            </label>
                                                            <input type="file" name="site_favicon"
                                                                {{ config('settings.site_favicon') ? '' : 'required' }}
                                                                class="hdn-uploder image d-none" data-preview="site_favicon_preview"
                                                                id="imgInpFavicom" accept="image/*" />
                                                            @error('site_favicon')
                                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <div class="logo-upload-card text-center p-3 border rounded">
                                                            <label class="form-label fw-medium d-block">
                                                                {{ __('Default Logo') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <label for="default_logo" class="cursor-pointer">
                                                                <div class="logo-preview-wrapper mb-2">
                                                                    <img src="{{ config('settings.default_logo') ? getStorageImage(config('settings.default_logo'), false, 'logo') : getDefaultLogo() }}"
                                                                        class="img-thumbnail" style="height: 80px; width: 80px; object-fit: contain;"
                                                                        id="default_logo_preview" />
                                                                </div>
                                                                <span class="btn btn-sm btn-outline-primary">
                                                                    <i class="mdi mdi-upload me-1"></i>{{ __('Upload') }}
                                                                </span>
                                                            </label>
                                                            <input type="file" name="default_logo"
                                                                {{ config('settings.default_logo') ? '' : 'required' }}
                                                                class="hdn-uploder image d-none" data-preview="default_logo_preview"
                                                                id="default_logo" accept="image/*" />
                                                            @error('default_logo')
                                                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 pt-3 border-top">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('dashboard') }}" class="btn btn-light">
                                                        <i class="mdi mdi-close me-1"></i>{{ __('Cancel') }}
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="mdi mdi-content-save me-1"></i>{{ __('Save Changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <!-- Header -->
                                        <div class="settings-header mb-4">
                                            <h5 class="mb-1 font-weight-bold">
                                                <i class="mdi mdi-email text-primary me-2"></i>{{ __('Email Settings') }}
                                            </h5>
                                            <p class="text-muted small">{{ __('Configure your email server settings for sending notifications') }}</p>
                                        </div>

                                        <form action="{{ route('settings.store') }}" method="post" class="custom-validation"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- SMTP Configuration Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-server text-info me-2"></i>{{ __('SMTP Configuration') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_mailer" class="form-label fw-medium">
                                                                <i class="mdi mdi-email-send-outline me-1"></i>{{ __('Mail Driver') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="mail_mailer" id="mail_mailer"
                                                                placeholder="e.g., smtp" value="{{ config('settings.mail_mailer') }}">
                                                            @error('mail_mailer')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_host" class="form-label fw-medium">
                                                                <i class="mdi mdi-server-network me-1"></i>{{ __('SMTP Host') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="mail_host" id="mail_host"
                                                                placeholder="e.g., smtp.mailtrap.io"
                                                                value="{{ config('settings.mail_host') }}">
                                                            @error('mail_host')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_port" class="form-label fw-medium">
                                                                <i class="mdi mdi-numeric me-1"></i>{{ __('SMTP Port') }}
                                                            </label>
                                                            <input type="number" class="form-control" name="mail_port" id="mail_port"
                                                                placeholder="e.g., 587" value="{{ config('settings.mail_port') }}">
                                                            <small class="text-muted">Common ports: 587 (TLS), 465 (SSL), 25 (Non-encrypted)</small>
                                                            @error('mail_port')
                                                                <span class="text-danger small d-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_encryption" class="form-label fw-medium">
                                                                <i class="mdi mdi-lock-outline me-1"></i>{{ __('Mail Encryption') }}
                                                            </label>
                                                            <select class="form-control" name="mail_encryption" id="mail_encryption">
                                                                <option value="">None</option>
                                                                <option value="tls" {{ config('settings.mail_encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                                                                <option value="ssl" {{ config('settings.mail_encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                                            </select>
                                                            @error('mail_encryption')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Authentication Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-account-key text-warning me-2"></i>{{ __('Authentication') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_username" class="form-label fw-medium">
                                                                <i class="mdi mdi-account-outline me-1"></i>{{ __('Username') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="mail_username"
                                                                id="mail_username" placeholder="Enter SMTP username"
                                                                value="{{ config('settings.mail_username') }}">
                                                            @error('mail_username')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_password" class="form-label fw-medium">
                                                                <i class="mdi mdi-key-variant me-1"></i>{{ __('Password') }}
                                                            </label>
                                                            <input type="password" class="form-control" name="mail_password"
                                                                id="mail_password" placeholder="Enter SMTP password"
                                                                value="{{ config('settings.mail_password') }}">
                                                            @error('mail_password')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sender Information Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-email-edit text-success me-2"></i>{{ __('Sender Information') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_from_address" class="form-label fw-medium">
                                                                <i class="mdi mdi-email-outline me-1"></i>{{ __('From Address') }}
                                                            </label>
                                                            <input type="email" class="form-control" name="mail_from_address"
                                                                id="mail_from_address" placeholder="e.g., noreply@example.com"
                                                                value="{{ config('settings.mail_from_address') }}">
                                                            @error('mail_from_address')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="mail_from_name" class="form-label fw-medium">
                                                                <i class="mdi mdi-format-text me-1"></i>{{ __('From Name') }}
                                                            </label>
                                                            <input type="text" class="form-control" name="mail_from_name"
                                                                id="mail_from_name" placeholder="e.g., Your App Name"
                                                                value="{{ config('settings.mail_from_name') }}">
                                                            @error('mail_from_name')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Info Alert -->
                                            <div class="alert alert-info border-0" role="alert">
                                                <i class="mdi mdi-information-outline me-2"></i>
                                                <strong>Note:</strong> Make sure to test your email configuration after saving to ensure emails are sent successfully.
                                            </div>

                                            <div class="form-group mt-4 pt-3 border-top">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('dashboard') }}" class="btn btn-light">
                                                        <i class="mdi mdi-close me-1"></i>{{ __('Cancel') }}
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="mdi mdi-content-save me-1"></i>{{ __('Save Changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                        <!-- Header -->
                                        <div class="settings-header mb-4">
                                            <h5 class="mb-1 font-weight-bold">
                                                <i class="mdi mdi-share-variant text-primary me-2"></i>{{ __('Social Media Settings') }}
                                            </h5>
                                            <p class="text-muted small">{{ __('Connect your social media accounts to display on your website') }}</p>
                                        </div>

                                        <form action="{{ route('settings.store') }}" method="post" class="custom-validation"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Social Platforms Section -->
                                            <div class="settings-section mb-4">
                                                <h6 class="section-title mb-3 pb-2 border-bottom">
                                                    <i class="mdi mdi-link-variant text-info me-2"></i>{{ __('Social Platform Links') }}
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="facebook_url" class="form-label fw-medium">
                                                                <i class="mdi mdi-facebook text-primary me-1"></i>{{ __('Facebook') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                                                                <input type="url" class="form-control" name="facebook_url" id="facebook_url"
                                                                    placeholder="https://facebook.com/your-page"
                                                                    value="{{ config('settings.facebook_url') }}">
                                                            </div>
                                                            @error('facebook_url')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="twitter_url" class="form-label fw-medium">
                                                                <i class="mdi mdi-twitter text-info me-1"></i>{{ __('Twitter / X') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                                                                <input type="url" class="form-control" name="twitter_url" id="twitter_url"
                                                                    placeholder="https://twitter.com/your-handle"
                                                                    value="{{ config('settings.twitter_url') }}">
                                                            </div>
                                                            @error('twitter_url')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="linkedin_url" class="form-label fw-medium">
                                                                <i class="mdi mdi-linkedin text-primary me-1"></i>{{ __('LinkedIn') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                                                                <input type="url" class="form-control" name="linkedin_url" id="linkedin_url"
                                                                    placeholder="https://linkedin.com/in/your-profile"
                                                                    value="{{ config('settings.linkedin_url') }}">
                                                            </div>
                                                            @error('linkedin_url')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="instagram_url" class="form-label fw-medium">
                                                                <i class="mdi mdi-instagram text-danger me-1"></i>{{ __('Instagram') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>
                                                                <input type="url" class="form-control" name="instagram_url"
                                                                    id="instagram_url" placeholder="https://instagram.com/your-profile"
                                                                    value="{{ config('settings.instagram_url') }}">
                                                            </div>
                                                            @error('instagram_url')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="youtube_url" class="form-label fw-medium">
                                                                <i class="mdi mdi-youtube text-danger me-1"></i>{{ __('YouTube') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-youtube"></i></span>
                                                                <input type="url" class="form-control" name="youtube_url"
                                                                    id="youtube_url" placeholder="https://youtube.com/c/your-channel"
                                                                    value="{{ config('settings.youtube_url') }}">
                                                            </div>
                                                            @error('youtube_url')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="github_url" class="form-label fw-medium">
                                                                <i class="mdi mdi-github text-dark me-1"></i>{{ __('GitHub') }}
                                                            </label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                                                                <input type="url" class="form-control" name="github_url"
                                                                    id="github_url" placeholder="https://github.com/your-profile"
                                                                    value="{{ config('settings.github_url') }}">
                                                            </div>
                                                            @error('github_url')
                                                                <span class="text-danger small">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Info Alert -->
                                            <div class="alert alert-info border-0" role="alert">
                                                <i class="mdi mdi-information-outline me-2"></i>
                                                <strong>Tip:</strong> Add full URLs including https:// to ensure proper linking. Leave blank if you don't want to display a particular social media link.
                                            </div>

                                            <div class="form-group mt-4 pt-3 border-top">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('dashboard') }}" class="btn btn-light">
                                                        <i class="mdi mdi-close me-1"></i>{{ __('Cancel') }}
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="mdi mdi-content-save me-1"></i>{{ __('Save Changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        /* Settings Page Styles */
        .settings-sidebar {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            min-height: 600px;
        }

        .settings-sidebar .nav-link {
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            color: #6c757d;
            font-weight: 500;
        }

        .settings-sidebar .nav-link:hover {
            background-color: #f0f4ff;
            color: rgb(6, 46, 90);
            border-color: #e0e7ff;
            transform: translateX(5px);
        }

        .settings-sidebar .nav-link.active {
            background: linear-gradient(135deg, rgb(6, 46, 90) 0%, rgb(8, 60, 110) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(65, 84, 241, 0.3);
            border-color: rgb(6, 46, 90);
        }

        .settings-sidebar .nav-link i {
            font-size: 20px;
        }

        .settings-header h5 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .settings-header p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            display: flex;
            align-items: center;
        }

        .logo-upload-card {
            background: #ffffff;
            transition: all 0.3s ease;
            border: 2px dashed #dee2e6 !important;
        }

        .logo-upload-card:hover {
            border-color: rgb(6, 46, 90) !important;
            box-shadow: 0 4px 12px rgba(65, 84, 241, 0.1);
            transform: translateY(-2px);
        }

        .logo-preview-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80px;
        }

        .logo-preview-wrapper img {
            transition: all 0.3s ease;
        }

        .logo-upload-card:hover .logo-preview-wrapper img {
            transform: scale(1.05);
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: 0;
            color: #6c757d;
        }

        .input-group .form-control {
            border-left: 0;
        }

        .input-group .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .input-group:focus-within .input-group-text {
            border-color: #86b7fe;
            color: rgb(6, 46, 90);
        }

        .input-group:focus-within .form-control {
            border-color: #86b7fe;
        }

        .form-label.fw-medium {
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .btn-primary {
            background: linear-gradient(135deg, rgb(6, 46, 90) 0%, rgb(8, 60, 110) 100%);
            border: none;
            padding: 10px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3143d8 0%, #4f52d9 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(65, 84, 241, 0.3);
        }

        .btn-light {
            border: 1px solid #dee2e6;
            padding: 10px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
        }

        .alert-info {
            background-color: #e7f3ff;
            color: #004085;
            border-left: 4px solid rgb(6, 46, 90);
        }

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .border-end {
            border-right: 1px solid #e9ecef !important;
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tab-pane.active {
            animation: fadeInUp 0.5s ease;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .settings-sidebar {
                min-height: auto;
                border-bottom: 1px solid #e9ecef;
            }

            .border-end {
                border-right: none !important;
            }
        }
    </style>
@endpush

@push('script')
    <script src="/libs/parsleyjs/parsley.min.js"></script>
    <script src="/js/pages/form-validation.init.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select-two').select2({
                width: '100%',
                placeholder: "{{ __('Select Timezone') }}",
                allowClear: true
            });
            $('.currency').select2({
                placeholder: "Select a currency",
                allowClear: true
            });
        });
        $(function() {
            //image
            $(".image").change(function() {
                var preview = $(this).data('preview');
                readURL(this, preview);
            });
        });

        function readURL(input, preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + preview).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
