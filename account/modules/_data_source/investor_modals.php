<!-- Static Backdrop Modal -->
<div class="modal fade" id="accountInformation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="accountInformationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="accountInformationLabel">Update Account Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" method="post" novalidate action="./" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="username" class="form-label">Username<sup class="text-danger fw-bold">*</sup></label>
                            <input type="text" class="form-control" readonly id="username" placeholder="e.g. John_Doe" name="username" value="<?php echo $account_data["username"] ?>" required>
                            <div class="invalid-feedback">
                                Please Enter Username
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="full_names" class="form-label">Full Names<sup class="text-danger fw-bold">*</sup></label>
                            <input type="text" class="form-control" id="full_names" value="<?php echo $account_data["full_names"] ?>" placeholder="e.g. John Doe" name="full_names" required>
                            <div class="invalid-feedback">
                                Please Enter Full Names
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="reg_email_address" class="form-label">Email Address<sup class="text-danger fw-bold">*</sup></label>
                            <input type="email" class="form-control" id="reg_email_address" readonly value="<?php echo $account_data["email_address"] ?>" placeholder="e.g. johndoe@gmail.com" name="email_address" required>
                            <div class="invalid-feedback">
                                Please Enter Email Address
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="phone_number" class="form-label">Phone Number<sup class="text-danger fw-bold">*</sup></label>
                            <input type="tel" class="form-control" id="phone_number" value="<?php echo $account_data["phone_number"] ?>" placeholder="e.g. +44 012 345 6789" name="phone_number" required>
                            <div class="invalid-feedback">
                                Please Enter Phone Number
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="d-flex">
                                <label for="country" class="form-label">Country<sup class="text-danger fw-bold">*</sup></label>
                                <span class="ms-auto fw-bold"><?php echo $account_data["country"] ?></span>
                            </div>
                            <select name="country" id="country" class="form-control" name="country" required>
                                <option value="<?php echo $account_data["country"] ?>" selected>-- Select Option --</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Åland Islands">Åland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                            <div class="invalid-feedback">
                                Please Select Country
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 col-md-6">
                            <label for="profile_image" class="form-label">Profile Image<sup class="text-danger fw-bold">*</sup></label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                            <div class="invalid-feedback">
                                Please Select profile image
                            </div>
                        </div>
                        <span class="text-muted small">Kindly contact our technical support team if you wish to update either your email address or username.</span>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Cancel <i class='bx bx-reset'></i></button>
                    <button type="submit" class="ms-auto btn btn-primary" name="update_account_information">Save Changes <i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="accountSecurity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="accountSecurityLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="accountSecurityLabel">Update Account Security</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" method="post" novalidate action="./">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="up_current_password" class="form-label">Current Password<sup class="text-danger fw-bold">*</sup></label>
                            <input type="password" class="form-control" id="up_current_password" name="current_password" minlength="8" placeholder="8+ characteres required" required>
                            <div class="invalid-feedback">
                                Please Enter Current Password
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="up_new_password" class="form-label">New Password<sup class="text-danger fw-bold">*</sup></label>
                            <input type="password" class="form-control" id="up_new_password" name="new_password" minlength="8" placeholder="8+ characteres required" required>
                            <div class="invalid-feedback">
                                Please Enter New Password
                            </div>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="up_confirm_new_password" class="form-label">Confirm New Password<sup class="text-danger fw-bold">*</sup></label>
                            <input type="password" class="form-control" id="up_confirm_new_password" name="confirm_password" minlength="8" placeholder="8+ characteres required" required>
                            <div class="invalid-feedback">
                                Please Confirm New Password
                            </div>
                        </div>

                        <span class="text-muted small">Kindly contact our technical support team if you're experiencing any technical difficulties.</span>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Cancel <i class='bx bx-reset'></i></button>
                    <button type="submit" class="ms-auto btn btn-primary" name="update_account_security">Save Changes <i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="eWallets" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="eWalletsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="eWalletsLabel">Update Wallet Addresses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="./">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="bitcoin_wallet_address" class="form-label">Bitcoin Wallet Address</label>
                            <input type="text" class="form-control" value="<?php echo $account_data["bitcoin_wallet_address"] ?>" id="bitcoin_wallet_address" placeholder="Enter BTC wallet address here..." name="bitcoin_wallet_address">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="ethereum_wallet_address" class="form-label">Ethereum Wallet Address</label>
                            <input type="text" class="form-control" value="<?php echo $account_data["ethereum_wallet_address"] ?>" id="ethereum_wallet_address" placeholder="Enter ETH wallet address here..." name="ethereum_wallet_address">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="tether_wallet_address" class="form-label">Tether Wallet Address</label>
                            <input type="text" class="form-control" value="<?php echo $account_data["tether_wallet_address"] ?>" id="tether_wallet_address" placeholder="Enter USDT wallet address here..." name="tether_wallet_address">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="dogecoin_wallet_address" class="form-label">Dogecoin Wallet Address</label>
                            <input type="text" class="form-control" value="<?php echo $account_data["dogecoin_wallet_address"] ?>" id="dogecoin_wallet_address" placeholder="Enter DOGE wallet address here..." name="dogecoin_wallet_address">
                        </div>

                        <span class="text-muted small">Kindly contact our technical support team if you're experiencing any technical difficulties.</span>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Cancel <i class='bx bx-reset'></i></button>
                    <button type="submit" class="ms-auto btn btn-primary" name="update_wallet_addresses">Save Changes <i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="activeToken" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="activeTokenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="activeTokenLabel">Active Transaction Token</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="bitcoin_wallet_address" class="form-label">Available Transaction Token</label>
                        <div class="input-group">
                            <input type="text" class="form-control border-light-primary" value="<?php echo $account_data["transaction_token"] ?>" readonly placeholder="Apply for a new transaction token..." id="obtained_transaction_token">
                            <button class="btn btn-outline-primary border-light-primary copy-button" data-copytarget="obtained_transaction_token" type="button" id="button-addon2">Copy <i class='bx bx-copy'></i></button>
                        </div>
                    </div>

                    <span class="text-muted small"> <b class="initialism">Please Note:</b> To acquire a one-time unique transaction token, you simply need to contact our technical team via email or live chat. They are available to assist you with any questions. Once obtained, simply copy and use to process transaction. Thank you for choosing our trading platform!</span>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="accessAccountFunds" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="accessAccountFundsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="accessAccountFundsLabel">Process Funds Withdrawal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="./">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="desired_amount" class="form-label">Desired Amount</label>
                            <input type="number" class="form-control text-light border-light-primary" required name="amount" placeholder="e.g. $500.00" id="desired_amount">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="obtained_transaction_token" class="form-label"> Preferred Wallet</label>
                            <select class="form-select border-light-primary" required name="ewallet">
                                <option selected value="">-- Select Wallet --</option>
                                <option value="<?php echo $account_data["bitcoin_wallet_address"] ?>">Bitcoin [BTC] </option>
                                <option value="<?php echo $account_data["ethereum_wallet_address"] ?>">Ethereum [ETH] </option>
                                <option value="<?php echo $account_data["tether_wallet_address"] ?>">Tether [USDT]</option>
                                <option value="<?php echo $account_data["dogecoin_wallet_address"] ?>">Dogecoin [DOGE]</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="obtained_transaction_token" class="form-label">Transaction Token</label>
                            <input type="text" class="form-control text-light border-light-primary" required name="transaction_token" placeholder="e.g. TXN--0123456789" id="obtained_transaction_token">
                        </div>

                        <span class="text-muted small"> <b class="initialism">Please Note:</b> To process your withdrawal request, all you need to do is acquire a unique one-time transaction token simply by contacting our technical team via email or live chat. They are available to assist you with any questions. Thank you for choosing our trading platform!</span>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Cancel <i class='bx bx-reset'></i></button>
                    <button type="submit" class="ms-auto btn btn-primary" name="initialize_withdrawal">Withdraw Funds <i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="fundAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="fundAccountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="fundAccountLabel">Process Account Funding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="./" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="desired_amount" class="form-label">Desired Amount</label>
                            <input type="number" class="form-control text-light border-light-primary" required name="amount" placeholder="e.g. $500.00" id="desired_amount">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="obtained_transaction_token" class="form-label"> Payment Medium</label>
                            <select id="walletSelect" class="form-select border-light-primary" required name="ewallet">
                                <option selected value="">-- Select Wallet --</option>
                                <option value="Bitcoin [BTC]">Bitcoin [BTC] </option>
                                <option value="Ethereum [ETH]">Ethereum [ETH] </option>
                                <option value="Tether [USDT]">Tether [USDT]</option>
                                <option value="Dogecoin [DOGE]">Dogecoin [DOGE]</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="payment_proof" class="form-label">Payment Proof</label>
                            <input type="file" class="form-control border-light-primary" required name="payment_proof" id="payment_proof">
                        </div>

                        <div class="mb-0 col-md-12">
                            <div data-wallet="Bitcoin [BTC]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Bitcoin To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["bitcoin_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_bitcoin_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_bitcoin_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                            <div data-wallet="Ethereum [ETH]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Ethereum To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["ethereum_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_ethereum_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_ethereum_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                            <div data-wallet="Tether [USDT]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Tether To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["tether_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_tether_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_tether_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                            <div data-wallet="Dogecoin [DOGE]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Dogecoin To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["dogecoin_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_dogecoin_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_dogecoin_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <input type="hidden" name="category" value="Credit TXN">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Cancel <i class='bx bx-reset'></i></button>
                    <button type="submit" class="ms-auto btn btn-primary" name="initialize_deposit">Fund Account <i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="fundCard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="fundAccountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="fundAccountLabel">Process Card Funding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="./" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="desired_amount" class="form-label">Desired Amount</label>
                            <input type="number" class="form-control text-light border-light-primary" required name="amount" placeholder="e.g. $500.00" id="desired_amount">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="obtained_transaction_token" class="form-label"> Payment Medium</label>
                            <select id="walletSelectCard" class="form-select border-light-primary" required name="ewallet">
                                <option selected value="">-- Select Wallet --</option>
                                <option value="Bitcoin [BTC]">Bitcoin [BTC] </option>
                                <option value="Ethereum [ETH]">Ethereum [ETH] </option>
                                <option value="Tether [USDT]">Tether [USDT]</option>
                                <option value="Dogecoin [DOGE]">Dogecoin [DOGE]</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="payment_proof" class="form-label">Payment Proof</label>
                            <input type="file" class="form-control border-light-primary" required name="payment_proof" id="payment_proof">
                        </div>

                        <div class="mb-0 col-md-12">
                            <div data-wallet="Bitcoin [BTC]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Bitcoin To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["bitcoin_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_bitcoin_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_bitcoin_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                            <div data-wallet="Ethereum [ETH]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Ethereum To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["ethereum_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_ethereum_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_ethereum_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                            <div data-wallet="Tether [USDT]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Tether To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["tether_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_tether_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_tether_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                            <div data-wallet="Dogecoin [DOGE]" class="d-none">
                                <label for="exampleFormControlInput1" class="form-label"> Send Dogecoin To The Address Below</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-muted border-light-primary" readonly value="<?php echo $manager_data["dogecoin_wallet_address"] ?>" placeholder="This wallet currently unavailable..." id="admin_dogecoin_wallet_address">
                                    <button class="btn border-light-primary copy-button" data-copytarget="admin_dogecoin_wallet_address" type="button"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <input type="hidden" name="category" value="Card Credit TXN">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Cancel <i class='bx bx-reset'></i></button>
                    <button type="submit" class="ms-auto btn btn-primary" name="initialize_deposit">Fund Card <i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="KycVerification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="KycVerificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="KycVerificationLabel">Process KYC Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $db_conn = connect_to_database();

            $stmt = $db_conn->prepare("SELECT * FROM `kyc` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
            $stmt->bind_param("s", $account_data["account_id"]);
            $stmt->execute();
            $result = $stmt->get_result();


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $datasource = json_decode($row['datasource'], true);
            } else {
                $datasource['kyc_status'] = "unverified";
            }


            ?>
            <form method="post" action="./" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="obtained_transaction_token" class="form-label">Choose Preferred Document</label>
                            <select id="walletSelect" class="form-select border-light-primary" required name="document">
                                <option selected value="">-- Select Document --</option>
                                <option value="Driver's license">Driver's license</option>
                                <option value="Passport ID">Passport ID</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="payment_proof" class="form-label">Front Page of document</label>
                            <input type="file" class="form-control border-light-primary" required name="front_of_document">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="payment_proof" class="form-label">Back Page of document</label>
                            <input type="file" class="form-control border-light-primary" required name="back_of_document">
                        </div>
                    </div>

                </div>
                <div class="modal-footer py-2 d-flex">
                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                    <button type="reset" class="btn" data-bs-dismiss="modal" style="border: 1px dashed #343a40;">Reset <i class='bx bx-reset'></i></button>
                    <?php if ($datasource['kyc_status'] == "Pending") { ?>
                        <button class="btn btn-warning" disabled>
                            Pending <i class='bx bx-save'></i>
                        </button>
                    <?php } elseif ($datasource['kyc_status'] == "Completed") { ?>
                        <button class="btn btn-success" disabled>
                            verified <i class='bx bx-save'></i>
                        </button>
                    <?php } else { ?>
                        <button type="submit" class="ms-auto btn btn-primary" name="initialize_kyc">
                            Submit <i class='bx bx-save'></i>
                        </button>
                    <?php } ?>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- card -->
<div class="modal fade" id="orderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="orderModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <!-- Modal Header with Navigation -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="pic-tab" data-toggle="tab" href="#pic">Card</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="details-tab" data-toggle="tab" href="#details">Card Details</a>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $db_conn = connect_to_database();

            $stmt = $db_conn->prepare("SELECT * FROM `card_purchase` WHERE account_id = ? order by element_id DESC LIMIT 1");
            $stmt->bind_param("s", $account_data["account_id"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $card_data = $result->fetch_assoc();

            $card_progress = (empty($card_data["purchase_progress"])) ? 1 : $card_data["purchase_progress"];

            ?>
            <div class="modal-body">
                <div class="tab-content">
                    <!-- Tab Pane for Card Picture -->
                    <div class="tab-pane fade show active" id="pic">
                        <div class="row">
                            <div class="col col-md-6 col-lg-6 col-sm-12 col-xs-12 col-xl-6 mb-3">
                                <div class="debit_card">
                                    <div class="chip">
                                    </div>
                                    <div class="logocard">
                                        <img src="https://remoratradinghubs.com/account/modules/_data_source/images/logo.png">
                                    </div>
                                    <div class="number">**** **** **** 5647 </div>
                                    <div class="info">
                                        <div class="card-holder">
                                            <label>Card Holder</label>
                                            <div class="holder-name"><?php echo $account_data["full_names"] ?></div>
                                        </div>
                                        <div class="expires">
                                            <label>Expires</label>
                                            <div class="expires-date">12/26</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6 col-lg-6 col-sm-12 col-xs-12 col-xl-6">
                                <div class="w-100 p-2 justify-content-between my-2 alert alert-info">
                                    <h4 class="mb-1">
                                        <i class="bx bx-lock"></i>
                                        Fast & Secure
                                    </h4>
                                    <p>Make payment instantly and securely</p>
                                </div>
                                <div class="w-100 p-2 justify-content-between my-2 alert alert-info">
                                    <h4 class="mb-1">
                                        <i class="fa fa-credit-card"></i>
                                        Free Usage
                                    </h4>
                                    <p>No Fees on ATM and Online transactions</p>
                                </div>
                                <div class="w-100 p-2 justify-content-between my-2 alert alert-info">
                                    <h4 class="mb-1">
                                        <i class="bx bx-world"></i>
                                        Spend in over 150+ currencies
                                    </h4>
                                    <p>Pay abroad easily with Remoratradinghubs Card</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer py-2 d-flex">
                            <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                            <button type="button" class="btn btn-primary" onclick="$('#pic-tab').removeClass('active'); $('#details-tab').addClass('active'); $('#pic').removeClass('show active'); $('#details').addClass('show active');">Proceed ...</button>
                        </div>
                    </div>

                    <!-- Tab Pane for Card Details -->
                    <div class="tab-pane fade" id="details">
                        <div class="row">
                            <div class="col col-12 alert alert-info">
                                <h3>Your Card order progress is <?= $card_progress ?>%</h3>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $card_progress ?>%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col col-12 p-3  ">
                                <form class="row g-3" action="./" method="post">
                                    <div class="col-12">
                                        <label for="inputNanme4" class="form-label">Full Name</label>
                                        <input type="text" value="<?php echo $account_data["full_names"] ?>" name="full_names" class="form-control" id="inputNanme4" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="DeliveryAddress" class="form-label">Delivery Address</label>
                                        <div class="form-floating">
                                            <textarea class="form-control" name="delivery_address" placeholder="Address" id="floatingTextarea" style="height: 100px;" required></textarea>
                                            <label for="floatingTextarea">Enter Delivery Address</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="card_pin" class="form-label">4 Digit Pin</label>
                                        <input type="number" name="pin" class="form-control" id="card_pin" required>
                                        <span class="text-danger" id="card_pin_error"></span>
                                    </div>
                                    <div class="col-6">
                                        <label for="purchaseMethod" class="form-label">Purchase Method</label>
                                        <input type="text" value="Bitcoin BTC" name="purchase_method" class="form-control" id="purchaseMethod" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="purchaseAddress" class="form-label">Purchase Wallet Address</label>
                                        <input type="text" value="<?php echo $manager_data["bitcoin_wallet_address"] ?>" name="purchase_address" class="form-control" id="purchaseAddress" readonly>
                                        <button class="btn border-light-primary copy-button float-end" data-copytarget="purchaseAddress" type="button">copy <i class='bx bx-copy-alt'></i></button>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAmount" class="form-label">Purchase Cost in USD $</label>
                                        <input type="number" name="purchase_cost" value="800" class="form-control" id="inputAmount" readonly>
                                    </div>

                                    <div class="modal-footer py-2 d-flex">
                                        <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <?php if (empty($card_data["purchase_status"])) { ?>
                                            <button type="submit" class="btn btn-success" name="purchase_card">Purchase Card</button>
                                        <?php } elseif ($card_data["purchase_status"] == "Pending") { ?>
                                            <button type="submit" class="btn btn-warning" disabled>Not Approved Yet</button>
                                        <?php } elseif ($card_data["purchase_status"] == "Approved") { ?>
                                            <button type="submit" class="btn btn-success" disabled>On progress</button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-success" name="purchase_card">Purchase Card</button>
                                        <?php } ?>

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



<!-- Static Backdrop Modal -->
<div class="modal fade" id="viewAccountActivities" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="viewAccountActivitiesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="viewAccountActivitiesLabel">View Account Activities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-overflow-x">
                <table class="table datatable table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr class="text-uppercase">
                            <th>Category</th>
                            <th>Amount</th>
                            <th>E-Wallet</th>
                            <th>Created On</th>
                            <th>TXN Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $db_conn = connect_to_database();

                        $stmt = $db_conn->prepare("SELECT * FROM `activities` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
                        $stmt->bind_param("s", $account_data["account_id"]);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = mysqli_fetch_assoc($result)) {
                            $transaction_data = json_decode($row['datasource'], true);
                        ?>
                            <tr>
                                <td class="fw-bold">
                                    <?php
                                    if ($transaction_data["category"] == "Credit TXN") {
                                    ?>
                                        <span class="text-success">
                                            <?php echo $transaction_data["category"] ?>
                                        </span>
                                    <?php
                                    } else if ($transaction_data["category"] == "Debit TXN") {
                                    ?>
                                        <span class="text-danger">
                                            <?php echo $transaction_data["category"] ?>
                                        </span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-dark">
                                            -- / --
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>$<?php echo number_format($transaction_data["amount"], 2) ?></td>
                                <td><?php echo $transaction_data["ewallet"] ?></td>
                                <td><?php echo $transaction_data["transaction_date"] ?></td>
                                <td class="fw-bold">
                                    <?php

                                    if ($transaction_data["transaction_status"] == "Completed") {
                                    ?>
                                        <button class="btn btn-soft-success border-0 btn-sm" style="padding: 3px 7px;" type="button">
                                            <?php echo $transaction_data["transaction_status"] ?>
                                        </button>
                                    <?php
                                    } else if ($transaction_data["transaction_status"] == "Pending") {
                                    ?>
                                        <button class="btn btn-soft-warning border-0 btn-sm" style="padding: 3px 16px;" type="button">
                                            <?php echo $transaction_data["transaction_status"] ?>
                                        </button>
                                    <?php
                                    } else if ($transaction_data["transaction_status"] == "Cancelled") {
                                    ?>
                                        <button class="btn btn-soft-danger border-0 btn-sm" style="padding: 3px 11px;" type="button">
                                            <?php echo $transaction_data["transaction_status"] ?>
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-soft-primary border-0 btn-sm" style="padding: 3px 11px;" type="button">-- / --</button>
                                    <?php
                                    }

                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Static Backdrop Modal -->
<div class="modal fade" id="investmentPlans" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="investmentPlansLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="investmentPlansLabel">Our Available Plans</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-rounded-13 mb-3 mb-sm-0 plan-box border-light-primary">
                            <form action="" method="post">
                                <div class="card-body px-4 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5>
                                                Starter Plan</h5>
                                            <p class="text-muted">ROI = 280%</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <i class="bx bx-trophy h2 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <h2><sup><small>$</small></sup> 500/ <span class="font-size-13">Per week</span></h2>
                                    </div>

                                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                    <input type="hidden" name="investment_plan" value="
Starter">
                                    <input type="hidden" name="plan_roi" value="280">
                                    <input type="hidden" name="duration" value="1 Week">

                                    <div class="text-center plan-btn">
                                        <input type="number" placeholder="Amount" class="waves-effect waves-light my-1 form-control" style="color: #343a40 !important;" name="amount" value="" required>
                                        <button type="submit" name="initialize_subscription" class="btn btn-primary btn-sm waves-effect waves-light">Purchase</button>
                                    </div>

                                    <div class="plan-features mt-4 ">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Min. Deposit: $500.00</p>
                                        <input type="hidden" name="min" value="500">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Max. Deposit: $5,000.00</p>
                                        <input type="hidden" name="max" value="5000">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-rounded-13 mb-3 mb-sm-0 plan-box border-light-primary">
                            <form action="" method="post">
                                <div class="card-body px-4 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5>Classic Plan</h5>
                                            <p class="text-muted">ROI = 400%</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <i class="bx bx-trophy h2 " style="color:#D9A618"></i>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <h2><sup><small>$</small></sup> 5,000/ <span class="font-size-13">Per week</span></h2>
                                    </div>

                                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                    <input type="hidden" name="investment_plan" value="Classic">

                                    <input type="hidden" name="plan_roi" value="400">
                                    <input type="hidden" name="duration" value="1 Week">

                                    <div class="text-center plan-btn">
                                        <input type="number" placeholder="Amount" class="waves-effect waves-light my-1 form-control" style="color: #343a40 !important;" name="amount" value="" required>
                                        <button type="submit" name="initialize_subscription" class="btn btn-primary btn-sm waves-effect waves-light">Purchase</button>
                                    </div>

                                    <div class="plan-features mt-4 ">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Min. Deposit: $5,000.00</p>
                                        <input type="hidden" name="min" value="5000">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Max. Deposit: $20,000.00</p>
                                        <input type="hidden" name="max" value="20000">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-rounded-13 mb-3 mb-sm-0 plan-box border-light-primary">
                            <form action="" method="post">
                                <div class="card-body px-4 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5>
                                                Premium Plan</h5>
                                            <p class="text-muted">ROI = 800%</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <i class="bx bx-trophy h2 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <h2><sup><small>$</small></sup> 20,000/ <span class="font-size-13">Per week</span></h2>
                                    </div>

                                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                    <input type="hidden" name="investment_plan" value="Premium">
                                    <input type="hidden" name="plan_roi" value="800">
                                    <input type="hidden" name="duration" value="1 Week">

                                    <div class="text-center plan-btn">
                                        <input type="number" placeholder="Amount" class="waves-effect waves-light my-1 form-control" style="color: #343a40 !important;" name="amount" value="" required>
                                        <button type="submit" name="initialize_subscription" class="btn btn-primary btn-sm waves-effect waves-light">Purchase</button>
                                    </div>

                                    <div class="plan-features mt-4 ">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Min. Deposit: $20,000.00</p>
                                        <input type="hidden" name="min" value="20000">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Max. Deposit: $150,000.00</p>
                                        <input type="hidden" name="max" value="150000">
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

<!-- Static Backdrop Modal -->
<div class="modal fade" id="viewAllInvestments" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="viewAllInvestmentsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="viewAllInvestmentsLabel">View All Investments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-overflow-x">
                <table class="table datatable table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr class="text-uppercase">
                            <th>Subscription</th>
                            <th>Amount</th>
                            <th>Plan ROI</th>
                            <th>Created On</th>
                            <th>Duration</th>
                            <th>Plan Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $db_conn = connect_to_database();

                        $stmt = $db_conn->prepare("SELECT * FROM `contracts` WHERE JSON_EXTRACT(`datasource`, '$.account_id') = ?");
                        $stmt->bind_param("s", $account_data["account_id"]);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = mysqli_fetch_assoc($result)) {
                            $investment_data = json_decode($row['datasource'], true);
                        ?>
                            <tr>
                                <form action="./authu?investor_id=<?php echo $investor_id ?>" method="post">
                                    <td class="fw-bold"><?php echo $investment_data["investment_plan"] ?></td>
                                    <td>$<?php echo number_format($investment_data["amount"], 2) ?></td>
                                    <td class="fw-bold">%<?php echo  number_format($investment_data["plan_roi"], 2) ?></td>
                                    <td><?php echo $investment_data["investment_date"] ?></td>
                                    <td><?php echo $investment_data["duration"] ?></td>
                                    <td class="fw-bold">
                                        <?php

                                        if ($investment_data["investment_status"] == "Completed") {
                                        ?>
                                            <button class="btn btn-soft-success border-0 btn-sm" style="padding: 3px 7px;" type="button">
                                                <?php echo $investment_data["investment_status"] ?>
                                            </button>
                                        <?php
                                        } else if ($investment_data["investment_status"] == "Pending") {
                                        ?>
                                            <button class="btn btn-soft-warning border-0 btn-sm" style="padding: 3px 16px;" type="button">
                                                <?php echo $investment_data["investment_status"] ?>
                                            </button>
                                        <?php
                                        } else if ($investment_data["investment_status"] == "Cancelled") {
                                        ?>
                                            <button class="btn btn-soft-danger border-0 btn-sm" style="padding: 3px 11px;" type="button">
                                                <?php echo $investment_data["investment_status"] ?>
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-soft-primary border-0 btn-sm" style="padding: 3px 11px;" type="button">-- / --</button>
                                        <?php
                                        }

                                        ?>
                                    </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================================ -->

<!-- Static Backdrop Modal -->
<div class="modal fade" id="aiPlans" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="investmentPlansLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="investmentPlansLabel">Our Available Ai - Plans</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-rounded-13 mb-3 mb-sm-0 plan-box border-light-primary">
                            <form action="" method="post">
                                <div class="card-body px-4 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5>
                                                Black Box
                                            </h5>
                                            <p class="text-muted">Win Rate = 30 / 100</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <i class="bx bx-trophy h2 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <h2><sup><small>$</small></sup> 200/ <span class="font-size-13">4 days</span></h2>
                                    </div>

                                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                    <input type="hidden" name="ai_plan" value="Black Box">
                                    <input type="hidden" name="winRate" value="30">
                                    <input type="hidden" name="duration" value="4 days">

                                    <div class="text-center plan-btn">
                                        <input type="number" placeholder="Amount" class="waves-effect waves-light my-1 form-control" style="color: #343a40 !important;" name="amount" value="" required>
                                        <button type="submit" name="ai_subscription" class="btn btn-primary btn-sm waves-effect waves-light">Purchase</button>
                                    </div>

                                    <div class="plan-features mt-4 ">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Min. Deposit: $200.00</p>
                                        <input type="hidden" name="min" value="200">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Max. Deposit: $1,000.00</p>
                                        <input type="hidden" name="max" value="1000">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-rounded-13 mb-3 mb-sm-0 plan-box border-light-primary">
                            <form action="" method="post">
                                <div class="card-body px-4 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5>Trend Spider
                                            </h5>
                                            <p class="text-muted">Win Rate = 60 / 100</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <i class="bx bx-trophy h2 text-primary"></i>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <h2><sup><small>$</small></sup> 1,000/ <span class="font-size-13">Per week</span></h2>
                                    </div>

                                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                    <input type="hidden" name="ai_plan" value="Trend Spider">

                                    <input type="hidden" name="winRate" value="60">
                                    <input type="hidden" name="duration" value="1 Week">

                                    <div class="text-center plan-btn">
                                        <input type="number" placeholder="Amount" class="waves-effect waves-light my-1 form-control" style="color: #343a40 !important;" name="amount" value="" required>
                                        <button type="submit" name="ai_subscription" class="btn btn-primary btn-sm waves-effect waves-light">Purchase</button>
                                    </div>

                                    <div class="plan-features mt-4 ">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Min. Deposit: $1,000.00</p>
                                        <input type="hidden" name="min" value="1000">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Max. Deposit: $5,000.00</p>
                                        <input type="hidden" name="max" value="5000">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-rounded-13 mb-3 mb-sm-0 plan-box border-light-primary">
                            <form action="" method="post">
                                <div class="card-body px-4 pb-0">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5>
                                                Manara </h5>
                                            <p class="text-muted">Win Rate = 88 / 100</p>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <i class="bx bx-trophy h2" style="color:#D9A618"></i>
                                        </div>
                                    </div>

                                    <div class="py-2">
                                        <h2><sup><small>$</small></sup> 5,000/ <span class="font-size-13">Per week</span></h2>
                                    </div>

                                    <input type="hidden" name="account_id" value="<?php echo $account_data["account_id"] ?>">
                                    <input type="hidden" name="ai_plan" value="Manara">
                                    <input type="hidden" name="winRate" value="88">
                                    <input type="hidden" name="duration" value="1 Week">

                                    <div class="text-center plan-btn">
                                        <input type="number" placeholder="Amount" class="waves-effect waves-light my-1 form-control" style="color: #343a40 !important;" name="amount" value="" required>
                                        <button type="submit" name="ai_subscription" class="btn btn-primary btn-sm waves-effect waves-light">Purchase</button>
                                    </div>

                                    <div class="plan-features mt-4 ">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Min. Deposit: $5,000.00</p>
                                        <input type="hidden" name="min" value="5000">
                                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Max. Deposit: $15,000.00</p>
                                        <input type="hidden" name="max" value="15000">
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

<!-- Static Backdrop Modal -->
<div class="modal fade" id="viewAllai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="viewAllInvestmentsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="mb-n1 initialism fw-light" style="font-size: 15px;" id="viewAllInvestmentsLabel">View Active AI - Investments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-overflow-x">
                <table class="table datatable table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr class="text-uppercase">
                            <th>AI Plan</th>
                            <th>Amount</th>
                            <th>Win Rate</th>
                            <th>Created On</th>
                            <th>Duration</th>
                            <th>Plan Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $db_conn = connect_to_database();

                        $stmt = $db_conn->prepare("SELECT * FROM `ai_investments` WHERE account_id = ? order by id desc ");
                        $stmt->bind_param("s", $account_data["account_id"]);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($rows = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $rows['ai_plan'] ?></td>
                                <td>$<?php echo number_format($rows["amount"], 2) ?></td>
                                <td><?php echo $rows['winRate'] ?> / 100 </td>
                                <td><?php echo date("Y/M/d h:i a", strtotime($rows['created_at'])) ?></td>
                                <td><?php echo $rows['duration'] ?></td>
                                <td class="fw-bold">
                                    <?php

                                    if ($rows["status"] == 2) {
                                    ?>
                                        <button class="btn btn-soft-success border-0 btn-sm" style="padding: 3px 7px;" type="button">
                                            Completed
                                        </button>
                                    <?php
                                    } else if ($rows["status"] == 1) {
                                    ?>
                                        <button class="btn btn-soft-warning border-0 btn-sm" style="padding: 3px 16px;" type="button">
                                            Active
                                        </button>
                                    <?php
                                    } else if ($rows["status"] == 3) {
                                    ?>
                                        <button class="btn btn-soft-danger border-0 btn-sm" style="padding: 3px 11px;" type="button">
                                            Cancelled
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn btn-soft-primary border-0 btn-sm" style="padding: 3px 11px;" type="button">-- / --</button>
                                    <?php
                                    }

                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>