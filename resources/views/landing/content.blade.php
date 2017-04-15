<div class="front-banner">
        <div class="container pt20">
            <div class="row">
                <div class="col-md-6">
                    <div class="" style="color:#3B5998; font-size:28px;">
                        <font face="myFbFont"> Social Network for Tamizhans </font>
                    </div>
                    <div class="mb30">
                        <span>"Ut nonummy habent soluta claritas veniam. Typi nunc soluta hendrerit mutationem sollemnes. Quis lius dolore et insitam vel. Aliquip consequat futurum claram ut mazim. Facilisi accumsan dolore ii imperdiet consequat. Claritatem aliquip quod putamus vulputate iusto. Doming minim typi zzril lius usus. In clari mutationem autem non sit. Qui augue mirum dynamicus gothica ut. Demonstraverunt processus soluta sequitur autem demonstraverunt."</span>
                    </div>
                    <div class=""> <img src="{{asset ('/images/anbendru_bharathiaar.png')}}" width="40%" height="20%" class="pull-left"> 
                    <div class="quote">
                        <div class="example">
                            <blockquote>
                                <p>வேடிக்கை மனிதரை போலே - நான் <br>வீழ்வே னென்று நினைத் தாயோ?<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                - மகாகவி பாரதியார்
                                </p>
                            </blockquote>
                        </div>
                    </div>
                    </div>
                    <div style="font-size:28px;" class="hidden">
                        <font face="myFbFont"> வீழ்வேன் என்று நினைத்தாயோ </font>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="signup-box">
                        <div class="pull-left"><h1>Sign Up / <a href="#" data-toggle="modal" data-target="#login-modal">Login</a></h1></div>
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
                        <input type="submit" id="reg_button" name="reg" class="btn login loginmodal-submit w100per" value="Register">
                    </form>
                    </div>
                </div>
            </div>
        </div>
        </div>