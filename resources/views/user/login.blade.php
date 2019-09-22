@extends ('user.login_layout')

@section ('scripts')
	<script src="{{ getTheme() }}/js/login/index.js"></script>
@endsection

@section ('content')
	<div class="login-page">
		<div class="user_login_bg">
			<div class="user_login_section">
				<div class="container">
					<div class="row">
						<div class="col-12 text-left">
							<div class="col-11 mx-auto">
								<div class="col-12 mt-5 p-0">
									<div class="login-header">
										<h4 class="mt-5 login-page-name">{{ rageConfig('site_name') }}</h4>
										@if ($state != 'success') <p class="login-title">@lang('login.login')</p>
										@else <p class="login-title success"><i class="fas fa-thumbs-up"></i> @lang('login.success_registration')</p>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="col-10 mx-auto text-center">
							<form class="user_login" id="user_login">

								@csrf

								<div class="col-12 mt-5 p-0">
									<div class="input-holder">
										<div class="icon">

											<span class="fa-stack fa-2x">
												<i class="fas fa-circle fa-stack-2x"></i>
												<i class="fas fa-user fa-stack-1x fa-inverse"></i>
											</span>
										</div>
										<input type="text" name="login_logon" class="form-control" placeholder="@lang('login.logon')">
									</div>
								</div>
								<div class="col-12 mt-5 p-0">
									<div class="input-holder">
										<div class="icon">
										
											<span class="fa-stack fa-2x">
												<i class="fas fa-circle fa-stack-2x"></i>
												<i class="fas fa-key fa-stack-1x fa-inverse"></i>
											</span>
										</div>
										<input type="password" name="login_password" class="form-control" placeholder="@lang('login.password')">
									</div>
								</div>

								<button type="submit" id="login_button" data-button-name="login_button" class="btn btn_login btn-primary mt-5 px-5 py-2 text-center">@lang('login.login')</button>
							
								<div class="register-or-forgot">
									<p><a href="/register">@lang('login.register')</a></p>
									<p><a href="#">@lang('login.forgot')</a></p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection