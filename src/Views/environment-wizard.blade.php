@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">

        <input id="tab1" type="radio" name="tabs" class="tab-input" checked />
        <label for="tab1" class="tab-label">
            <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.settings') }}
        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input" />
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.database') }}
        </label>

        <input id="tab3" type="radio" name="tabs" class="tab-input" />
        <label for="tab3" class="tab-label">
            <i class="fa fa-cogs fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.application') }}
        </label>

        <input id="tab4" type="radio" name="tabs" class="tab-input" />
        <label for="tab4" class="tab-label">
            <i class="fa fa-cogs fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            Admin Settings
        </label>

        <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="tabs-wrap">
            <div class="tab" id="tab1content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="app_version" value="4.0.13">

                <div class="form-group {{ $errors->has('app_version') ? ' has-error ' : '' }}">
                    <label for="app_version">
                        Code Version
                    </label>
                    <input type="text" name="app_version" id="app_version" value="4.0.13" placeholder="Code Version" disabled/>
                    @if ($errors->has('app_version'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_version') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                    <label for="app_name">
                        Website Name
                    </label>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name') }}" placeholder="Website Name" />
                    @if ($errors->has('app_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('environment') ? ' has-error ' : '' }}">
                    <label for="environment">
                        Choose Development Mod
                    </label>
                    <select name="environment" id="environment" onchange='checkEnvironment(this.value);'>
                        <option value="local" selected>{{ trans('installer_messages.environment.wizard.form.app_environment_label_local') }}</option>
                        <option value="development">{{ trans('installer_messages.environment.wizard.form.app_environment_label_developement') }}</option>
                        <option value="qa">{{ trans('installer_messages.environment.wizard.form.app_environment_label_qa') }}</option>
                        <option value="production">{{ trans('installer_messages.environment.wizard.form.app_environment_label_production') }}</option>
                        <option value="other">{{ trans('installer_messages.environment.wizard.form.app_environment_label_other') }}</option>
                    </select>
                    <div id="environment_text_input" style="display: none;">
                        <input type="text" name="environment_custom" id="environment_custom" placeholder="App Debug"/>
                    </div>
                    @if ($errors->has('app_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
                    <label for="app_debug">
                        {{ trans('installer_messages.environment.wizard.form.app_debug_label') }}
                    </label>
                    <label for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value=true checked />
                        {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                    </label>
                    <label for="app_debug_false">
                        <input type="radio" name="app_debug" id="app_debug_false" value=false />
                        {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                    </label>
                    @if ($errors->has('app_debug'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_debug') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_log_level') ? ' has-error ' : '' }}">
                    <label for="app_log_level">
                        {{ trans('installer_messages.environment.wizard.form.app_log_level_label') }}
                    </label>
                    <select name="app_log_level" id="app_log_level">
                        <option value="debug" selected>{{ trans('installer_messages.environment.wizard.form.app_log_level_label_debug') }}</option>
                        <option value="info">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_info') }}</option>
                        <option value="notice">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_notice') }}</option>
                        <option value="warning">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_warning') }}</option>
                        <option value="error">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_error') }}</option>
                        <option value="critical">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_critical') }}</option>
                        <option value="alert">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_alert') }}</option>
                        <option value="emergency">{{ trans('installer_messages.environment.wizard.form.app_log_level_label_emergency') }}</option>
                    </select>
                    @if ($errors->has('app_log_level'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_log_level') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                    <label for="app_url">
                        {{ trans('installer_messages.environment.wizard.form.app_url_label') }}
                    </label>
                    <input type="url" name="app_url" id="app_url" value="{{ old('app_url') }}" placeholder="Website URL" />
                    @if ($errors->has('app_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_database') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab2content">

                <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                    <label for="database_connection">
                        {{ trans('installer_messages.environment.wizard.form.db_connection_label') }}
                    </label>
                    <select name="database_connection" id="database_connection">
                        <option value="mysql" selected>{{ trans('installer_messages.environment.wizard.form.db_connection_label_mysql') }}</option>
                    </select>
                    @if ($errors->has('database_connection'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_connection') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">
                        {{ trans('installer_messages.environment.wizard.form.db_host_label') }}
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('installer_messages.environment.wizard.form.db_port_label') }}
                    </label>
                    <input type="number" name="database_port" id="database_port" value="3306" placeholder="DataBase Port" />
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                    </label>
                    <input type="text" name="database_name" id="database_name" value="{{ old('database_name') }}" placeholder="Database Name" />
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <input type="hidden" class="hidden" name="table_prefix" id="table_prefix" value="" placeholder="Table Prefix" />

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        User Name
                    </label>
                    <input type="text" name="database_username" id="database_username" value="{{ old('database_username') }}" placeholder="User Name" />
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                    </label>
                    <input type="password" name="database_password" id="database_password" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showApplicationSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_application') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <input  type="hidden" name="redis_hostname" id="redis_hostname" value="127.0.0.1" placeholder="Redis Host" />
            <input  type="hidden" name="redis_password" id="redis_password" value="null" placeholder="Redis Password" />
            <input  type="hidden" name="redis_port" id="redis_port" value="6379" placeholder="Redis Port" />
            <input type="hidden" name="redis_hostname" id="redis_hostname" value="127.0.0.1" placeholder="Redis Host" />
            <input type="hidden" name="redis_password" id="redis_password" value="null" placeholder="Redis Password" />
            <input type="hidden" name="redis_port" id="redis_port" value="6379" placeholder="Redis Port" />
            <input type="hidden" name="pusher_app_id" id="pusher_app_id" value="" placeholder="Broadcast Driver" />
            <input type="hidden" name="pusher_app_key" id="pusher_app_key" value="" placeholder="Pusher App Key" />
            <input type="hidden" name="pusher_app_secret" id="pusher_app_secret" value="" placeholder="Pusher App Secret" />
            <input type="hidden" name="broadcast_driver" id="broadcast_driver" value="log" placeholder="Broadcast Driver" />
            <input type="hidden" name="cache_driver" id="cache_driver" value="file" placeholder="Cache Driver" />
            <input type="hidden" name="session_driver" id="session_driver" value="file" placeholder="Cache Driver" />
            <input type="hidden" name="queue_driver" id="queue_driver" value="sync" placeholder="Queue Driver" />

            <div class="tab" id="tab3content">
                <div class="form-group {{ $errors->has('mail_driver') ? ' has-error ' : '' }}">
                    <label for="mail_driver">
                        {{ trans('installer_messages.environment.wizard.form.app_tabs.mail_label') }}
                        <sup>
                            <a href="https://laravel.com/docs/7.x/mail" target="_blank" title="More Info">
                                <i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>
                                <span class="sr-only">More Info</span>
                            </a>
                        </sup>
                    </label>
                    <input type="text" name="mail_driver" id="mail_driver" value="{{ old('mail_driver') }}" placeholder="Mail Driver e:g. sendmail" />
                    @if ($errors->has('mail_driver'))
                        <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_driver') }}
                                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_host') ? ' has-error ' : '' }}">
                    <label for="mail_host">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_label') }}</label>
                    <input type="text" name="mail_host" id="mail_host" value="smtp.mailtrap.io" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder') }}" />
                    @if ($errors->has('mail_host'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_host') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_port') ? ' has-error ' : '' }}">
                    <label for="mail_port">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_port_label') }}</label>
                    <input type="number" name="mail_port" id="mail_port" value="{{ old('mail_port') }}" placeholder="Mail Port e:g. 587" />
                    @if ($errors->has('mail_port'))
                        <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_port') }}
                                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_username') ? ' has-error ' : '' }}">
                    <label for="mail_username">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_label') }}</label>
                    <input type="text" name="mail_username" id="mail_username" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder') }}" />
                    @if ($errors->has('mail_username'))
                        <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_username') }}
                                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_password') ? ' has-error ' : '' }}">
                    <label for="mail_password">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_label') }}</label>
                    <input type="text" name="mail_password" id="mail_password" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder') }}" />
                    @if ($errors->has('mail_password'))
                        <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('mail_password') }}
                                </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('mail_encryption') ? ' has-error ' : '' }}">
                    <label for="mail_encryption">{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_label') }}</label>
                    <input type="text" name="mail_encryption" id="mail_encryption" value="null" placeholder="{{ trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder') }}" />
                    @if ($errors->has('mail_encryption'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('mail_encryption') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showAdminSettings();return false">
                        Admin Settings
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>

            </div>
            <div class="tab" id="tab4content">
                <div class="form-group {{ $errors->has('purchase_code') ? ' has-error ' : '' }}">
                    <label for="purchase_code">
                        Purchase Code
                    </label>
                    <input type="text" required name="purchase_code" id="purchase_code" value="{{ old('purchase_code') }}" placeholder="Purchase Code" />
                    @if ($errors->has('purchase_code'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('purchase_code') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('user_name') ? ' has-error ' : '' }}">
                    <label for="user_name">
                        User Name
                    </label>
                    <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" placeholder="User Name" />
                    @if ($errors->has('user_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('user_name') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                    <label for="first_name">
                        First Name
                    </label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name" />
                    @if ($errors->has('first_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('first_name') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                    <label for="last_name">
                        Last Name
                    </label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" />
                    @if ($errors->has('last_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('last_name') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
                    <label for="email">
                        Email
                    </label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                    @if ($errors->has('email'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error ' : '' }}">
                    <label for="password">
                        Password
                    </label>
                    <input type="text" name="password" id="password" value="{{ old('password') }}" placeholder="Password" />
                    @if ($errors->has('password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password_confirm') ? ' has-error ' : '' }}">
                    <label for="password_confirm">
                        Password
                    </label>
                    <input type="text" name="password_confirmation" id="password_confirm" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" />
                    @if ($errors->has('password_confirm'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('password_confirm') }}
                        </span>
                    @endif
                </div>
                <div class="buttons">
                    <button class="button" type="submit">
                        Install
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>

            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function checkEnvironment(val) {
            var element=document.getElementById('environment_text_input');
            if(val=='other') {
                element.style.display='block';
            } else {
                element.style.display='none';
            }
        }
        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }
        function showApplicationSettings() {
            document.getElementById('tab3').checked = true;
        }
        function showAdminSettings() {
            document.getElementById('tab4').checked = true;
        }
    </script>
@endsection

