<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="loginmodal-container">
                    <span class="pointer pull-right" onclick="jQuery('#login-modal').modal('toggle');"><i class="fa fa-close"></i></span>
                    <h1>Login to Your Account</h1><br>
                    <form role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                             @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" name="password" placeholder="Password" required="required">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 500;">
                                <input type="checkbox" name="remember">&nbsp;&nbsp;Remember Me
                            </label>
                        </div>
                        <input type="submit" class="login loginmodal-submit" value="Login">
                    </form>
                    <div class="login-help">
                        <a href="#" data-toggle="modal" data-target="#register-modal">Register</a> - <a href="{{ url('/password/reset') }}">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="loginmodal-container">
                    <span class="pointer pull-right" onclick="jQuery('#register-modal').modal('toggle');"><i class="fa fa-close"></i></span>
                    <h1>Sign Up</h1><br>
                    <form role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" class="inputbox" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="First Name" />
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" name="email" class="inputbox" value="{{ old('email') }}" required placeholder="Email" />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" name="password" class="inputbox" placeholder="Password" required/>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="inputbox" name="password_confirmation" placeholder="Re-Enter Password" required>
                        </div>
                        <div class="reg-select flex">
                            <div class="pull-left mt10 w25per">
                                <div class="mt10"><label for="sex">I am : </label></div>
                                <div class="mt30"><label for="month">Birthday</label></div>
                            </div>
                            <div class="pull-left mt10">
                                <div class="select-style mt5 w100per {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <select name="gender" id="gender"> 
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="mt10 pull-left">
                                    <input type="text" id="popdob" name="date" size="25" class="date inputbox" placeholder="Date of Birth" />
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="reg_button" name="reg" class="login loginmodal-submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
<script>
jQuery( "#popdob,#dob" ).datepicker({
    changeMonth: true,
    changeYear: true,
    showOtherMonths: true,
});
</script>