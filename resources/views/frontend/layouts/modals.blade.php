

<!-- Cart modal -->
<div class="modal fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="myCart" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <div class="popup-form c-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="c-white">
                            Your order
                        </h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <div class="cart-icon"><i class="icon_cart_alt"></i></div>
                    </div>
                </div>

                <hr>
                <div id="modal-cart-items-autoload">
                    <div id="modal-cart-items">
                        @foreach(Cart::content() as $row)
                            <div class="row">
                                <div class="col-2" style="top:7px;">
                                    <a class="item_remove_from_cart c-icon" data-item-id="{{$row->id}}" class="remove_item">
                                        <i class="icon_minus_alt"></i>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <h6 class="c-white">
                                        <strong>{{$row->qty}}x</strong> {{$row->name}}
                                        @if($row->options->has('custimization'))
                                            </br>
                                            <a href="javascript: void(0)">
                                                (Customizable)
                                            </a>
                                        @endif
                                    </h6>
                                </div>
                                <div class="col-4">
                                    <h6 class="c-white">
                                        <strong>{{$row->price}} {{ App\Models\GeneralSetting::first()->currency }}</strong>
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @isset($page)
                    @if($page == 1)
                        <hr>
                        <div class="row" id="options_2">
                            <div class="col-6">
                                <label class="c-label">

                                    @if(session()->has('delivery_type') && session()->get('delivery_type') == 'HOME')
                                        <input type="checkbox" name="delivery_type_home" value="HOME" checked class="icheck update_delivery_type"/>
                                    @else
                                        <input type="checkbox" name="delivery_type_home" value="HOME" class="icheck update_delivery_type"/>
                                    @endif

                                    Delivery
                                </label>
                            </div>
                            <div class="col-6">
                                <label class="c-label">

                                    @if(session()->has('delivery_type') && session()->get('delivery_type') == 'SHOP')
                                        <input type="checkbox" name="delivery_type_shop" value="SHOP" checked class="icheck update_delivery_type"/>
                                    @else
                                        <input type="checkbox" name="delivery_type_shop" value="SHOP" class="icheck update_delivery_type"/>
                                    @endif

                                    Take Away
                                </label>
                            </div>
                        </div><!-- Edn options 2 -->
                    @endif
                @endisset

                <hr>
                <div id="modal-cart-receipt-autoload">
                    <div id="modal-cart-receipt">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="c-white">
                                    Subtotal
                                </h5>
                            </div>
                            <div class="col-4">
                                <h5 class="c-white">
                                    {{Cart::subtotal()}} {{ App\Models\GeneralSetting::first()->currency }}
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h5 class="c-white">
                                    Delivery Charges
                                </h5>
                            </div>
                            <div class="col-4">
                                <h5 class="c-white">
                                    {{session()->get('cart_delivery_charges')}} {{ App\Models\GeneralSetting::first()->currency }}
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h5 class="c-white">
                                    Tax
                                </h5>
                            </div>
                            <div class="col-4">
                                <h5 class="c-white">
                                    {{Cart::tax()}} {{ App\Models\GeneralSetting::first()->currency }}
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h6 class="c-white">
                                    <b>Total</b>
                                </h6>
                            </div>
                            <div class="col-4">
                                <h6 class="c-white">
                                    <b>{{Cart::total()+session()->get('cart_delivery_charges')}} {{ App\Models\GeneralSetting::first()->currency }}</b>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>



                <hr>

                @if(Auth::user() && Auth::user()->load('roles')->roles->contains('title', 'user'))
                    @isset($page)
                        @if($page == 3)
                            <a class="btn_full" id="submit_final_order">Order now</a>
                        @else
                            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                <a class="btn_full" href="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/{{ $page }}">Order now</a>
                            @else
                                @if($page == 1)
                                    <a class="btn_full" href="{{ route('customer.restaurant.order.first.index', request()->route('id')) }}">Order now</a>
                                @elseif($page == 2)
                                    <a class="btn_full" href="{{ route('customer.restaurant.order.second.index', request()->route('id')) }}">Order now</a>
                                @endif
                            @endif
                        @endif
                    @endisset
                @else
                    <a class="btn_full" href="#0" data-toggle="modal" data-target="#login_2">Login</a>
                @endif
            </div>
        </div>
    </div>
</div><!-- End modal -->


<!-- Login modal -->
<div class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>

                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    <form method="post" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/login" class="popup-form" id="myLogin">
                @else
                    <form method="post" action="{{route('customer.confirm_login')}}" class="popup-form" id="myLogin">
                @endif

                @csrf <!-- {{ csrf_field() }} -->
                <div class="login_icon"><i class="icon_lock_alt"></i></div>
                <input type="email" name="email_id" class="form-control form-white" placeholder="Email" required>
                <input type="password" name="password" class="form-control form-white" placeholder="Password" required>
                <div class="text-left">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="text-left">
                    <a href="#0" data-toggle="modal" data-target="#register">Register</a>
                </div>
                <button type="submit" class="btn btn-submit">Submit</button>
            </form>
        </div>
    </div>
</div><!-- End modal -->


<style type="text/css">
    .phone_code option {
        color: #000;
    }
</style>


<!-- Register modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>

            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                <form method="post" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/register" class="popup-form" id="myRegister">
            @else
                <form method="post" action="{{route('customer.confirm_register')}}" class="popup-form" id="myRegister">
            @endif

                <div class="login_icon"><i class="icon_lock_alt"></i></div>
                <input type="text" name="name" class="form-control form-white" placeholder="Name" required>
                <input type="email" name="email_id" class="form-control form-white" placeholder="Email" required>
                <input type="text" name="password" class="form-control form-white" placeholder="Password" required>

                <select name="phone_code" class="form-control form-white phone_code" >
                  <!-- Countries often selected by users can be moved to the top of the list. -->
                  <!-- Countries known to be subject to general US embargo are commented out by default. -->
                  <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->

                  <option data-countryCode="MY" value="60" selected>Malaysia (+60)</option>
                  <option data-countryCode="PK" value="92">Pakistan (+92)</option>

                  <option disabled="disabled">Other Countries</option>
                  <option data-countryCode="US" value="1">USA (+1)</option>
                  <option data-countryCode="GB" value="44">UK (+44)</option>
                  <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                  <option data-countryCode="AD" value="376">Andorra (+376)</option>
                  <option data-countryCode="AO" value="244">Angola (+244)</option>
                  <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                  <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                  <option data-countryCode="AR" value="54">Argentina (+54)</option>
                  <option data-countryCode="AM" value="374">Armenia (+374)</option>
                  <option data-countryCode="AW" value="297">Aruba (+297)</option>
                  <option data-countryCode="AU" value="61">Australia (+61)</option>
                  <option data-countryCode="AT" value="43">Austria (+43)</option>
                  <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                  <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                  <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                  <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                  <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                  <option data-countryCode="BY" value="375">Belarus (+375)</option>
                  <option data-countryCode="BE" value="32">Belgium (+32)</option>
                  <option data-countryCode="BZ" value="501">Belize (+501)</option>
                  <option data-countryCode="BJ" value="229">Benin (+229)</option>
                  <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                  <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                  <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                  <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                  <option data-countryCode="BW" value="267">Botswana (+267)</option>
                  <option data-countryCode="BR" value="55">Brazil (+55)</option>
                  <option data-countryCode="BN" value="673">Brunei (+673)</option>
                  <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                  <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                  <option data-countryCode="BI" value="257">Burundi (+257)</option>
                  <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                  <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                  <option data-countryCode="CA" value="1">Canada (+1)</option>
                  <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                  <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                  <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                  <option data-countryCode="CL" value="56">Chile (+56)</option>
                  <option data-countryCode="CN" value="86">China (+86)</option>
                  <option data-countryCode="CO" value="57">Colombia (+57)</option>
                  <option data-countryCode="KM" value="269">Comoros (+269)</option>
                  <option data-countryCode="CG" value="242">Congo (+242)</option>
                  <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                  <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                  <option data-countryCode="HR" value="385">Croatia (+385)</option>
                  <!-- <option data-countryCode="CU" value="53">Cuba (+53)</option> -->
                  <option data-countryCode="CY" value="90">Cyprus - North (+90)</option>
                  <option data-countryCode="CY" value="357">Cyprus - South (+357)</option>
                  <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
                  <option data-countryCode="DK" value="45">Denmark (+45)</option>
                  <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                  <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                  <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                  <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                  <option data-countryCode="EG" value="20">Egypt (+20)</option>
                  <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                  <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                  <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                  <option data-countryCode="EE" value="372">Estonia (+372)</option>
                  <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                  <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                  <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                  <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                  <option data-countryCode="FI" value="358">Finland (+358)</option>
                  <option data-countryCode="FR" value="33">France (+33)</option>
                  <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                  <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                  <option data-countryCode="GA" value="241">Gabon (+241)</option>
                  <option data-countryCode="GM" value="220">Gambia (+220)</option>
                  <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                  <option data-countryCode="DE" value="49">Germany (+49)</option>
                  <option data-countryCode="GH" value="233">Ghana (+233)</option>
                  <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                  <option data-countryCode="GR" value="30">Greece (+30)</option>
                  <option data-countryCode="GL" value="299">Greenland (+299)</option>
                  <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                  <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                  <option data-countryCode="GU" value="671">Guam (+671)</option>
                  <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                  <option data-countryCode="GN" value="224">Guinea (+224)</option>
                  <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                  <option data-countryCode="GY" value="592">Guyana (+592)</option>
                  <option data-countryCode="HT" value="509">Haiti (+509)</option>
                  <option data-countryCode="HN" value="504">Honduras (+504)</option>
                  <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                  <option data-countryCode="HU" value="36">Hungary (+36)</option>
                  <option data-countryCode="IS" value="354">Iceland (+354)</option>
                  <option data-countryCode="IN" value="91">India (+91)</option>
                  <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                  <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                  <!-- <option data-countryCode="IR" value="98">Iran (+98)</option> -->
                  <option data-countryCode="IE" value="353">Ireland (+353)</option>
                  <option data-countryCode="IL" value="972">Israel (+972)</option>
                  <option data-countryCode="IT" value="39">Italy (+39)</option>
                  <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                  <option data-countryCode="JP" value="81">Japan (+81)</option>
                  <option data-countryCode="JO" value="962">Jordan (+962)</option>
                  <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                  <option data-countryCode="KE" value="254">Kenya (+254)</option>
                  <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                  <!-- <option data-countryCode="KP" value="850">Korea - North (+850)</option> -->
                  <option data-countryCode="KR" value="82">Korea - South (+82)</option>
                  <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                  <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                  <option data-countryCode="LA" value="856">Laos (+856)</option>
                  <option data-countryCode="LV" value="371">Latvia (+371)</option>
                  <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                  <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                  <option data-countryCode="LR" value="231">Liberia (+231)</option>
                  <option data-countryCode="LY" value="218">Libya (+218)</option>
                  <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                  <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                  <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                  <option data-countryCode="MO" value="853">Macao (+853)</option>
                  <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                  <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                  <option data-countryCode="MW" value="265">Malawi (+265)</option>
                  <!-- <option data-countryCode="MY" value="60">Malaysia (+60)</option> -->
                  <option data-countryCode="MV" value="960">Maldives (+960)</option>
                  <option data-countryCode="ML" value="223">Mali (+223)</option>
                  <option data-countryCode="MT" value="356">Malta (+356)</option>
                  <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                  <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                  <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                  <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                  <option data-countryCode="MX" value="52">Mexico (+52)</option>
                  <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                  <option data-countryCode="MD" value="373">Moldova (+373)</option>
                  <option data-countryCode="MC" value="377">Monaco (+377)</option>
                  <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                  <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                  <option data-countryCode="MA" value="212">Morocco (+212)</option>
                  <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                  <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                  <option data-countryCode="NA" value="264">Namibia (+264)</option>
                  <option data-countryCode="NR" value="674">Nauru (+674)</option>
                  <option data-countryCode="NP" value="977">Nepal (+977)</option>
                  <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                  <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                  <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                  <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                  <option data-countryCode="NE" value="227">Niger (+227)</option>
                  <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                  <option data-countryCode="NU" value="683">Niue (+683)</option>
                  <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                  <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                  <option data-countryCode="NO" value="47">Norway (+47)</option>
                  <option data-countryCode="OM" value="968">Oman (+968)</option>
                  <!-- <option data-countryCode="PK" value="92">Pakistan (+92)</option> -->
                  <option data-countryCode="PW" value="680">Palau (+680)</option>
                  <option data-countryCode="PA" value="507">Panama (+507)</option>
                  <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                  <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                  <option data-countryCode="PE" value="51">Peru (+51)</option>
                  <option data-countryCode="PH" value="63">Philippines (+63)</option>
                  <option data-countryCode="PL" value="48">Poland (+48)</option>
                  <option data-countryCode="PT" value="351">Portugal (+351)</option>
                  <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                  <option data-countryCode="QA" value="974">Qatar (+974)</option>
                  <option data-countryCode="RE" value="262">Reunion (+262)</option>
                  <option data-countryCode="RO" value="40">Romania (+40)</option>
                  <option data-countryCode="RU" value="7">Russia (+7)</option>
                  <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                  <option data-countryCode="SM" value="378">San Marino (+378)</option>
                  <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                  <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                  <option data-countryCode="SN" value="221">Senegal (+221)</option>
                  <option data-countryCode="CS" value="381">Serbia (+381)</option>
                  <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                  <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                  <option data-countryCode="SG" value="65">Singapore (+65)</option>
                  <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                  <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                  <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                  <option data-countryCode="SO" value="252">Somalia (+252)</option>
                  <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                  <option data-countryCode="ES" value="34">Spain (+34)</option>
                  <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                  <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                  <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                  <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                  <option data-countryCode="SR" value="597">Suriname (+597)</option>
                  <option data-countryCode="SD" value="249">Sudan (+249)</option>
                  <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                  <option data-countryCode="SE" value="46">Sweden (+46)</option>
                  <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                  <!-- <option data-countryCode="SY" value="963">Syria (+963)</option> -->
                  <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                  <option data-countryCode="TJ" value="992">Tajikistan (+992)</option>
                  <option data-countryCode="TH" value="66">Thailand (+66)</option>
                  <option data-countryCode="TG" value="228">Togo (+228)</option>
                  <option data-countryCode="TO" value="676">Tonga (+676)</option>
                  <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                  <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                  <option data-countryCode="TR" value="90">Turkey (+90)</option>
                  <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                  <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                  <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                  <option data-countryCode="UG" value="256">Uganda (+256)</option>
                  <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                  <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                  <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                  <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option>
                  <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                  <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                  <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                  <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                  <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option>
                  <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option>
                  <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                  <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                  <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                  <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                  <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                </select>

                <input type="tel" name="phone" class="form-control form-white" placeholder="Phone" pattern="[0-9]{10}" required>
                <div id="pass-info" class="clearfix"></div>
                <div class="checkbox-holder text-left">
                    <div class="checkbox">
                        <input type="checkbox" value="accept_2" id="check_2" name="check_2"/>
                        <label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                    </div>
                </div>
                <button type="submit" class="btn btn-submit">Register</button>
            </form>
        </div>
    </div>
</div><!-- End Register modal -->


<!-- Delivery Type modal -->
<div class="modal fade" id="delivery_type_modal" tabindex="-1" role="dialog" aria-labelledby="myDeliveryType" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    <form method="post" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/setting/delivery_type/guest" class="popup-form" id="myDeliveryType">
                @else
                    <form method="post" action="{{route('customer.setting.delivery_type.guest')}}" class="popup-form" id="myDeliveryType">
                @endif

                @csrf <!-- {{ csrf_field() }} -->
                <div class="login_icon"><i class="icon-bicycle"></i></div>
                <div class="row" id="options_2">
                    <div class="col-6">
                        <label class="c-label">
                            <input type="radio" name="delivery_type" value="HOME" checked class="icheck"/>
                            Delivery
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="c-label">
                            <input type="radio" name="delivery_type" value="SHOP" class="icheck"/>
                            Take Away
                        </label>
                    </div>
                </div><!-- Edn options 2 -->
                <button type="submit" class="btn btn-submit">Submit</button>
            </form>
        </div>
    </div>
</div><!-- End modal -->


<!-- Delivery Location modal -->
<div class="modal fade" id="delivery_location_modal" tabindex="-1" role="dialog" aria-labelledby="myDeliveryLocation" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content modal-popup" style="margin-top: 30px;margin-bottom: 30px;padding: unset;">



            <div>
                <input type="text" id="pac-input" class="col-11 form-control" placeholder="Enter your location or drag marker" style="margin: 10px 4%;" />
                <div id="map" class="map"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                <form method="post" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/setting/delivery_location/guest" class="popup-form" id="myDeliveryLocation">
                            @else
                                <form method="post" action="{{route('customer.setting.delivery_location.guest')}}" class="popup-form" id="myDeliveryLocation">
                            @endif

                                @csrf <!-- {{ csrf_field() }} -->
                                <input type="hidden" id="lang" name="lang" readonly="readonly">
                                <input type="hidden" id="lat" name="lat" readonly="readonly">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-white" id="address" name="address" placeholder="Selected address" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="hidden" id="type" name="type" class="form-control form-white" placeholder="Add Label For Selected Location">
                                        </div>
                                    </div>
                                </div>
                                <div id="pass-info" class="clearfix"></div>
                                <div class="row">
                                    <div class="col-12">
                                        <label><input name="mobile" type="checkbox" value="" class="icheck" checked>Accept <a href="#0">terms and conditions</a>.</label>
                                    </div>
                                </div><!-- End row  -->
                                <hr style="border-color:#ddd;">
                                <button type="submit" class="btn btn-submit">Submit</button>
                            </form>
                        </div><!-- End col  -->
                    </div><!-- End row  -->
                </div><!-- End container  -->
                <!-- End Content =============================================== -->
            </div><!-- End Map -->
        </div>
    </div>
</div><!-- End modal -->
