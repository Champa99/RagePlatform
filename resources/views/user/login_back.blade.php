@extends ('user.login_layout')

@section ('scripts')
	<script src="{{ getTheme() }}/js/login/index.js"></script>
@endsection

@section ('content')
	<div class="login-page">
		<div class="user_login_bg">
			<div class="user_login_section welcome-back">
				<div class="container">
					<div class="row">
						<div class="col-12 text-left">
							<div class="col-11 mx-auto">
								<div class="col-12 mt-5 p-0">
									<div class="login-header">
										<div class="user-section">
											<div class="avatar">
												<img src="{{ $user_info->avatar }}">
											</div>

											<p class="welcome-back">@lang('login.welcome_back'), {{ $user_info->username }}!</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-10 mx-auto text-center">
							<form class="user_login" id="user_login">

								@csrf

								<input hidden="hidden" style="display: none;" name="login_logon" value="{{ $user_info->username }}">

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
									<p><a href="/login/reset">@lang('login.not_your_account')</a></p>
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