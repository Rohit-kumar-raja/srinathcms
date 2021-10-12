
            <section class="achievement">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="sec-title aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                                <h2><i class="fa fa-mortar-board"></i> <?php echo $row['sub_title']; ?></h2>
                                <div class="divider">
                                    <i class="fa fa-dot-circle-o"></i><i class="fa fa-dot-circle-o"></i><i class="fa fa-dot-circle-o"></i>
                                </div>
                                <div class="p-17 text-justify" data-aos="zoom-in" data-aos-duration="1000">
                                    <?php echo $full_description; ?>
                                    <br/><br/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="search-student border px-4 py-3" data-aos="zoom-in" data-aos-duration="1000" style="border-top:3px solid #c70013 !important; border-bottom:3px solid #c70013 !important;">
                                <br />
                                <h4 class="font-weight-bold color-orange" align="center"><i class="fa fa-mortar-board"></i> ALL COURSES</h4>
                                <hr />
                                <ul style="list-style:none;">
                                    <a class="font-weight-bold color-orange"> - CENTRE OF RESEARCH - </a>
                                    <li <?php if($apply_online_url == "course_phd") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_phd"><i class="fa fa-angle-double-right mr-2"></i> PH.D</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF COMMERCE &amp; MANAGEMENT - </a>
                                    <li <?php if($apply_online_url == "course_bba") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bba"><i class="fa fa-angle-double-right mr-2"></i> BBA</a></li>
                                    <li <?php if($apply_online_url == "course_mba") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_mba"><i class="fa fa-angle-double-right mr-2"></i> MBA</a></li>
                                    <li <?php if($apply_online_url == "course_bcom") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bcom"><i class="fa fa-angle-double-right mr-2"></i> B.COM</a></li>
                                    <li <?php if($apply_online_url == "course_mcom") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_mcom"><i class="fa fa-angle-double-right mr-2"></i> M.COM</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF PHARMACY - </a>
                                    <li <?php if($apply_online_url == "course_bpharm") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bpharm"><i class="fa fa-angle-double-right mr-2"></i> B.PHARM</a></li>
                                    <li <?php if($apply_online_url == "course_dpharm") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_dpharm"><i class="fa fa-angle-double-right mr-2"></i> D.PHARM</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF HOSPITALITY - </a>
                                    <li <?php if($apply_online_url == "course_hotel") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_hotel"><i class="fa fa-angle-double-right mr-2"></i> B.SC IN HOTEL MANAGEMENT</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF IT - </a>
                                    <li <?php if($apply_online_url == "course_bca") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bca"><i class="fa fa-angle-double-right mr-2"></i> BCA</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF EDUCATION - </a>
                                    <li <?php if($apply_online_url == "course_bed") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bed"><i class="fa fa-angle-double-right mr-2"></i> B.ED</a></li>
                                    <br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF LAW - </a>
                                    <li <?php if($apply_online_url == "course_llb") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_llb"><i class="fa fa-angle-double-right mr-2"></i> LLB</a></li>
                                    <li <?php if($apply_online_url == "course_bba_llb") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bba_llb"><i class="fa fa-angle-double-right mr-2"></i> BBA LLB (HONS.)</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF ALLIED SCIENCE B.SC - </a>
                                    <li <?php if($apply_online_url == "course_bsc_botany") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bsc_botany"><i class="fa fa-angle-double-right mr-2"></i> B.SC (BOTANY)</a></li>
                                    <li <?php if($apply_online_url == "course_bsc_zoology") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bsc_zoology"><i class="fa fa-angle-double-right mr-2"></i> B.SC (ZOOLOGY)</a></li>
                                    <li <?php if($apply_online_url == "course_bsc_mathematics") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bsc_mathematics"><i class="fa fa-angle-double-right mr-2"></i> B.SC (MATHEMATICS)</a></li>
                                    <li <?php if($apply_online_url == "course_bsc_physics") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bsc_physics"><i class="fa fa-angle-double-right mr-2"></i> B.SC (PHYSICS)</a></li>
                                    <li <?php if($apply_online_url == "course_bsc_chemistry") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_bsc_chemistry"><i class="fa fa-angle-double-right mr-2"></i> B.SC (CHEMISTRY)</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF ALLIED SCIENCE M.SC - </a>
                                    <li <?php if($apply_online_url == "course_msc_botany") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_msc_botany"><i class="fa fa-angle-double-right mr-2"></i> M.SC (BOTANY)</a></li>
                                    <li <?php if($apply_online_url == "course_msc_zoology") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_msc_zoology"><i class="fa fa-angle-double-right mr-2"></i> M.SC (ZOOLOGY)</a></li>
                                    <li <?php if($apply_online_url == "course_msc_mathematics") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_msc_mathematics"><i class="fa fa-angle-double-right mr-2"></i> M.SC (MATHEMATICS)</a></li>
                                    <li <?php if($apply_online_url == "course_msc_physics") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_msc_physics"><i class="fa fa-angle-double-right mr-2"></i> M.SC (PHYSICS)</a></li>
                                    <li <?php if($apply_online_url == "course_msc_chemistry") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_msc_chemistry"><i class="fa fa-angle-double-right mr-2"></i> M.SC (CHEMISTRY)</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF ENGINEERING &amp; TECHNOLOGY - </a>
                                    <li <?php if($apply_online_url == "course_polytechnic") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_polytechnic"><i class="fa fa-angle-double-right mr-2"></i> POLYTECHNIC</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF ARTS - </a>
                                    <li <?php if($apply_online_url == "course_ba") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_ba"><i class="fa fa-angle-double-right mr-2"></i> B.A</a></li>
                                    <li <?php if($apply_online_url == "course_ma") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_ma"><i class="fa fa-angle-double-right mr-2"></i> M.A</a></li><br />
                                    <a class="font-weight-bold color-orange"> - SCHOOL OF MASS COMM. &amp; DESIGN - </a>
                                    <li <?php if($apply_online_url == "course_BA_masscomm") echo 'class="font-weight-bold color-orange"'; ?>><a href="apply-online?online-admission?course_BA_masscomm"><i class="fa fa-angle-double-right mr-2"></i> B.A IN JOURNALISM &amp; MASS COMM</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div id="prospectus_popup_modal" class="w3-modal" style="z-index:999999999;">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; margin-bottom:50px;">
                    <div class="w3-center w3-container w3-padding-16" style="background-color:#1b4169;"><br>
                        <span onclick="document.getElementById('prospectus_popup_modal').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal" style="color:white;">&times;</span>
                        <img src="assets/images/logo.png" alt="NSU" class="w3-circle w3-margin-bottom" style="width:150px">
                    </div>
                    <!-- start contact -->
                    <section class="contact-section" style="padding-top:30px; padding-bottom:30px;">
                        <div class="container">
                            <div class="sec-title text-center mb-1" data-aos="zoom-in" data-aos-duration="1000">
                                <h2>Prospectus Form</h2>
                                <div class="divider">
                                    <span class="fa fa-mortar-board"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="career-form p-4 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="border-line"></div>
                                    <h4 class="font-weight-bold color-orange" id="response_admission"></h4>
                                    <form id="prospectus_form">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="">Select Course</label>
                                                <select id="prospectus_course" name="prospectus_course" class="form-control">
                                                    <option value=""> Select Course </option>
                                                    <option value="PH.D" <?php if($apply_online_url == "course_phd") echo 'selected'; ?>> PH.D </option>
                                                    <option value="BBA" <?php if($apply_online_url == "course_bba") echo 'selected'; ?>> BBA </option>
                                                    <option value="MBA" <?php if($apply_online_url == "course_mba") echo 'selected'; ?>> MBA </option>
                                                    <option value="B.COM" <?php if($apply_online_url == "course_bcom") echo 'selected'; ?>> B.COM </option>
                                                    <option value="M.COM" <?php if($apply_online_url == "course_mcom") echo 'selected'; ?>> M.COM </option>
                                                    <option value="B.PHARM" <?php if($apply_online_url == "course_bpharm") echo 'selected'; ?>> B.PHARM </option>
                                                    <option value="D.PHARM" <?php if($apply_online_url == "course_dpharm") echo 'selected'; ?>> D.PHARM </option>
                                                    <option value="B.SC IN HOTEL MANAGEMENT" <?php if($apply_online_url == "course_hotel") echo 'selected'; ?>> B.SC IN HOTEL MANAGEMENT </option>
                                                    <option value="BCA" <?php if($apply_online_url == "course_bca") echo 'selected'; ?>> BCA </option>
                                                    <option value="B.ED" <?php if($apply_online_url == "course_bed") echo 'selected'; ?>> B.ED </option>
                                                    <option value="M.A IN EDUCATION" <?php if($apply_online_url == "course_med") echo 'selected'; ?>> M.A IN EDUCATION </option>
                                                    <option value="LLB" <?php if($apply_online_url == "course_llb") echo 'selected'; ?>> LLB </option>
                                                    <option value="BBA LLB (HONS.)" <?php if($apply_online_url == "course_bba_llb") echo 'selected'; ?>> BBA LLB (HONS.) </option>
                                                    <option value="B.SC (BOTANY)" <?php if($apply_online_url == "course_bsc_botany") echo 'selected'; ?>> B.SC (BOTANY) </option>
                                                    <option value="B.SC (ZOOLOGY)" <?php if($apply_online_url == "course_bsc_zoology") echo 'selected'; ?>> B.SC (ZOOLOGY) </option>
                                                    <option value="B.SC (MATHEMATICS)" <?php if($apply_online_url == "course_bsc_mathematics") echo 'selected'; ?>> B.SC (MATHEMATICS) </option>
                                                    <option value="B.SC (PHYSICS)" <?php if($apply_online_url == "course_bsc_physics") echo 'selected'; ?>> B.SC (PHYSICS) </option>
                                                    <option value="B.SC (CHEMISTRY)" <?php if($apply_online_url == "course_bsc_chemistry") echo 'selected'; ?>> B.SC (CHEMISTRY) </option>
                                                    <option value="M.SC (BOTANY)" <?php if($apply_online_url == "course_msc_botany") echo 'selected'; ?>> M.SC (BOTANY) </option>
                                                    <option value="M.SC (ZOOLOGY)" <?php if($apply_online_url == "course_msc_zoology") echo 'selected'; ?>> M.SC (ZOOLOGY) </option>
                                                    <option value="M.SC (MATHEMATICS)" <?php if($apply_online_url == "course_msc_mathematics") echo 'selected'; ?>> M.SC (MATHEMATICS) </option>
                                                    <option value="M.SC (PHYSICS)" <?php if($apply_online_url == "course_msc_physics") echo 'selected'; ?>> M.SC (PHYSICS) </option>
                                                    <option value="M.SC (CHEMISTRY)" <?php if($apply_online_url == "course_msc_chemistry") echo 'selected'; ?>> M.SC (CHEMISTRY) </option>
                                                    <option value="POLYTECHNIC" <?php if($apply_online_url == "course_polytechnic") echo 'selected'; ?>> POLYTECHNIC </option>
                                                    <option value="B.A" <?php if($apply_online_url == "course_ba") echo 'selected'; ?>> B.A </option>
                                                    <option value="M.A" <?php if($apply_online_url == "course_ma") echo 'selected'; ?>> M.A </option>
                                                    <option value="B.A IN JOURNALISM And MASS COMM" <?php if($apply_online_url == "course_BA_masscomm") echo 'selected'; ?>> B.A IN JOURNALISM And MASS COMM </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="">Applicant Name</label>
                                                <input id="prospectus_applicant_name" name="prospectus_applicant_name" class="form-control" placeholder="Enter Name" type="text">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Father's Name</label>
                                                <input id="prospectus_father_name" name="prospectus_father_name" class="form-control" placeholder="Father's Name" type="text">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Select Gender</label>
                                                <select id="prospectus_gender" name="prospectus_gender" class="form-control">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Date Of Birth</label>
                                                <input id="prospectus_dob" name="prospectus_dob" class="form-control" placeholder="Enter DOB" type="date">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                           <div class="form-group col-md-12">
                                                <label for="">Email Address</label>
                                                <input id="prospectus_emailid" name="prospectus_emailid" class="form-control" placeholder="Enter Email" type="email">
                                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Address</label>
                                                <textarea id="prospectus_address" name="prospectus_address" class="form-control" placeholder="Enter Your Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                           <div class="form-group col-md-6">
                                                <label for="">Country</label>
                                                <input id="prospectus_country" name="prospectus_country" class="form-control" placeholder="Enter Country" type="text">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">State</label>
                                                <input id="prospectus_state" name="prospectus_state" class="form-control" placeholder="Enter State" type="text">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">City</label>
                                                 <input id="prospectus_city" name="prospectus_city" class="form-control" placeholder="Enter City" type="text">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Postal Code</label>
                                                 <input id="prospectus_postal_code" name="prospectus_postal_code" class="form-control" placeholder="Enter Postal Code" type="text">
                                            </div>
                                        </div>
                                        <!-- OTP Section Starts -->
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="">Phone Number</label>
                                                <input id="mobile" name="mobile" class="form-control" placeholder="Enter Phone Number" type="text" maxlength="10" minlength="10">
                                                <small id="prospectus_phone_err" class="form-text text-muted">Send OTP to your Phone Number and then Verify You Number.</small>
                                            </div>
                                        </div>
                                        <div id="prospectus_otp_section" class="form-row">
                                            <div class="form-group col-md-12">
                                                <input type="hidden" name="action_otp" value="prospectus_otp" />
                                                <button id="prospectus_otp_button" class="btn theme-orange border-0 pull-right" type="button"> <span id="otp_loader_section"></span> <span id="otp_text_section">Send OTP <i class="fa fa-send-o"></i></span></button>
                                            </div>
                                        </div>
                                        <!-- OTP Section Ends -->
                                        <!-- Submit And Payment Section Starts -->
                                        <div id="prospectus_submit_section" class="form-row" style="display:none;">
                                            <div class="form-group col-md-12">
                                                <label for="">OTP</label>
                                                <input id="prospectus_otp" name="prospectus_otp" class="form-control" placeholder="Enter 6 Digit OTP" type="text" maxlength="6" minlength="6">
                                                <small id="prospectus_otp_err" class="form-text text-muted color-orange">Please Enter Your OTP.</small>
                                            </div>
                                            <div class="form-group col-md-4 mt-4">
                                                <input type="hidden" name="action" value="prospectus" />
                                                <button id="prospectus_button" class="btn theme-orange border-0 btn-block" type="submit"> <span id="send_loader_section"></span> <span id="send_text_section"><i class="fa fa-paper-plane"></i> Verify </span></button>
                                            </div>
                                        </div>
                                        <!-- Submit And Payment Section Ends -->
                                    </form>
                                    <?php
									$len = 10;   // total number of numbers
									$min = 100;  // minimum
									$max = 999;  // maximum
									$range = []; // initialize array
									foreach (range(0, $len - 1) as $i) {
										while(in_array($num = mt_rand($min, $max), $range));
										$range[] = $num;
									}

									?>
                                    <form id="payment_form" style="display:none;" method="post"  action="easebuzz/easebuzz.php?api_name=initiate_payment">
                                        <input type="hidden" name="paymode" value="9" />
										<div class="form-row">
										    <div class="form-group col-md-6">
                                                <label for="">Transaction ID</label>
                                                <input id="txnid" class="form-control" name="txnid" value="<?php echo $num; ?>" placeholder="">
                                            </div>
                                           <div class="form-group col-md-6">
                                                <label for="">Prospectus Amount</label>
                                                <input class="form-control" id="amount"  name="amount"  value="<?php echo $prospectus_rate; ?>.0" readonly>
                                                <small class="form-text color-orange">Please Pay this amount For submit this Form.</small>
                                            </div>
											<div class="form-group col-md-6">
                                                <label for="">Name</label>
                                                <input id="firstname" class="form-control" name="firstname" value="<?php echo $_SESSION["prospectus_applicant_name"] ?>" placeholder="">
                                            </div>
											<div class="form-group col-md-6">
                                                <label for="">Email ID</label>
                                                <input id="email" class="form-control" name="email" value="<?php echo $_SESSION["prospectus_emailid"] ?>" placeholder="">
                                            </div>
											<div class="form-group col-md-6">
                                                <label for="">Phone No</label>
                                                <input id="phone" class="form-control" name="phone" value="<?php echo $_SESSION["mobile"] ?>" placeholder="">
                                            </div>
											<div class="form-group col-md-6">
                                                <label for="">Status</label>
                                                <input id="productinfo"  class="form-control" name="productinfo" value="<?php echo "Prospectus"; ?>" placeholder="">
                                            </div>
											<input type="hidden" id="surl" class="surl" name="surl" value="http://nsuniv.ac.in/demo/success" placeholder="">
											<input type="hidden" id="furl" class="furl" name="furl" value="http://nsuniv.ac.in/demo/success" placeholder="">
                                            <div class="form-group col-md-4 mt-2">
                                                <button class="btn theme-orange border-0 btn-block" type="submit" name="button"><i class="fa fa-paper-plane"></i> Pay </button>
                                            </div>
                                        </div>
                                        <!-- Submit And Payment Section Ends -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end contact -->
                    <div class="w3-container w3-border-top w3-padding-16" style="background-color:#1b4169;">
                        <button onclick="location.replace('?online-admission?<?php echo $apply_online_url; ?>?admission_form');" type="button" class="w3-left w3-button theme-orange"><i class="fa fa-angle-double-right"></i> Already Applied</button>
                        <button onclick="document.getElementById('prospectus_popup_modal').style.display='none';" type="button" class="w3-right w3-button theme-orange">Close</button>
                    </div>

                </div>
            </div>
            <div id="complete_admission_modal" class="w3-modal" style="z-index:999999999;">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; margin-bottom:50px;">
                    <div class="w3-center w3-container w3-padding-16" style="background-color:#1b4169;"><br>
                        <span onclick="location.replace('apply-online?online-admission?<?php echo $apply_online_url; ?>');" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal" style="color:white;">&times;</span>
                        <img src="assets/images/logo.png" alt="NSU" class="w3-circle w3-margin-bottom" style="width:150px">
                    </div>
                    <!-- start contact -->
                    <section class="contact-section" style="padding-top:30px; padding-bottom:30px;">
                        <div class="container">
                            <div class="sec-title text-center mb-1" data-aos="zoom-in" data-aos-duration="1000">
                                <h2>Admission Form</h2>
                                <div class="divider">
                                    <span class="fa fa-mortar-board"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="career-form p-4 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="border-line"></div>
                                    <h4 class="font-weight-bold color-orange" id="complete_response_admission"></h4>
                                    <form id="complete_admission_form">
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end contact -->
                    <div class="w3-container w3-border-top w3-padding-16" style="background-color:#1b4169;">
                        <button onclick="location.replace('apply-online?online-admission?<?php echo $apply_online_url; ?>');" type="button" class="w3-right w3-button theme-orange">Close</button>
                    </div>

                </div>
            </div>
            <div id="success_modal" class="w3-modal" style="z-index:999999999;">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; margin-bottom:50px;">
                    <div class="w3-center w3-container w3-padding-16" style="background-color:#1b4169;"><br>
                        <span onclick="location.replace('apply-online?online-admission?<?php echo $apply_online_url; ?>');" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal" style="color:white;">&times;</span>
                        <img src="assets/images/logo.png" alt="NSU" class="w3-circle w3-margin-bottom" style="width:150px">
                    </div>
                    <!-- start contact -->
                    <section class="contact-section" style="padding-top:30px; padding-bottom:30px;">
                        <div class="container">
                            <div class="sec-title text-center mb-1" data-aos="zoom-in" data-aos-duration="1000">
                                <h2>Success Message</h2>
                                <div class="divider">
                                    <span class="fa fa-mortar-board"></span>
								    
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="career-form p-4 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="border-line"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end contact -->
                    <div class="w3-container w3-border-top w3-padding-16" style="background-color:#1b4169;">
                        <button onclick="location.replace('apply-online?online-admission?<?php echo $apply_online_url; ?>');" type="button" class="w3-right w3-button theme-orange">Close</button>
                    </div>
                </div>
            </div>
            <div id="failed_modal" class="w3-modal" style="z-index:999999999;">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px; margin-bottom:50px;">
                    <div class="w3-center w3-container w3-padding-16" style="background-color:#1b4169;"><br>
                        <span onclick="location.replace('apply-online?online-admission?<?php echo $apply_online_url; ?>');" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal" style="color:white;">&times;</span>
                        <img src="assets/images/logo.png" alt="NSU" class="w3-circle w3-margin-bottom" style="width:150px">
                    </div>
                    <!-- start contact -->
                    <section class="contact-section" style="padding-top:30px; padding-bottom:30px;">
                        <div class="container">
                            <div class="sec-title text-center mb-1" data-aos="zoom-in" data-aos-duration="1000">
                                <h2>Failure Message</h2>
                                <div class="divider">
                                    <span class="fa fa-mortar-board"></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="career-form p-4 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="border-line"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end contact -->
                    <div class="w3-container w3-border-top w3-padding-16" style="background-color:#1b4169;">
                        <button onclick="location.replace('apply-online?online-admission?<?php echo $apply_online_url; ?>');" type="button" class="w3-right w3-button theme-orange">Close</button>
                    </div>
                </div>
            </div>
         
