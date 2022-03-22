
<link rel="stylesheet" href="/catering/request/form.css"/>
<link rel="stylesheet" type="text/css" href="/catering/request/cake/style.css">
<script src="/catering/request/event/form.js"></script>

<div>
    <h2>Event Request Form</h2>

    <form name="eventForm">
        <div class="form-group">
            <h6 class="required-input su-form-label">Contact Information</h6>
            <label>Department/Organization</label>
            <input 
                type="text" 
                class="form-control" 
                name="department-organization" 
                required 
                value=""
            />
            <label>Contact Name</label>
            <input 
                type="text" 
                class="form-control" 
                name="contact-name" 
                required 
                value=""
            />
            <label>Phone Number</label>
            <input 
                type="tel" 
                class="form-control" 
                name="phone" 
                required
                value=""
            />
            <label>Mobile Number</label>
            <input 
                type="tel" 
                class="form-control" 
                name="mobile" 
                required 
                value=""
            />
            <label>Email</label>
            <input 
                type="email" 
                class="form-control" 
                name="email"
                required 
                value=""
            />
        </div>

        <div class="form-group pb-0">
            <h6 class="required-input su-form-label">Event Information</h6>
            <label>Event Name</label>
            <input 
                type="text" 
                class="form-control" 
                name="event-name" 
                required 
                value=""
            />
        </div>

        <div class="form-group pt-0 pb-0">
            <div class="row">

                <div class="col-md-4">
                    <label>Event Date</label>
                    <input 
                        type="date" 
                        class="form-control" 
                        name="event-date" 
                        required 
                        value=""
                    />
                </div>

                <div class="col-md-4">
                    <label>Event Start Time</label>
                    <div>

                        <select id="es-hour" class="form-control su-timepicker">
                            <?php
                                for ($i=1; $i < 13; $i++) { 
                                    $tmp_hour = $i;
                                    if ($i < 10){
                                        $tmp_hour = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_hour.'">'.$tmp_hour.'</option>';
                                }
                            ?>
                        </select>

                        <select id="es-min" class="form-control su-timepicker">
                            <?php
                                for ($i=0; $i < 61; $i++) { 
                                    $tmp_min = $i;
                                    if ($i < 10){
                                        $tmp_min = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_min.'">'.$tmp_min.'</option>';
                                }
                            ?>
                        </select>

                        <!-- Mnemonic -->

                        <select id="es-mnemonic" class="form-control su-timepicker">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>

                    </div>
                    <input 
                        type="hidden" 
                        class="form-control" 
                        name="event-start-time" 
                        id="event-start-time"
                        required 
                        value=""
                    />
                </div>

                <div class="col-md-4">
                    <label>Event End Time</label>
                    <div>

                        <select id="ee-hour" class="form-control su-timepicker">
                            <?php
                                for ($i=1; $i < 13; $i++) { 
                                    $tmp_hour = $i;
                                    if ($i < 10){
                                        $tmp_hour = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_hour.'">'.$tmp_hour.'</option>';
                                }
                            ?>
                        </select>

                        <select id="ee-min" class="form-control su-timepicker">
                            <?php
                                for ($i=0; $i < 61; $i++) { 
                                    $tmp_min = $i;
                                    if ($i < 10){
                                        $tmp_min = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_min.'">'.$tmp_min.'</option>';
                                }
                            ?>
                        </select>

                        <!-- Mnemonic -->

                        <select id="ee-mnemonic" class="form-control su-timepicker">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>

                    </div>
                    <input 
                        type="hidden" 
                        class="form-control" 
                        name="event-end-time" 
                        id="event-end-time" 
                        requried
                        value="" 
                    />
                </div>

            </div>
        </div>
        <div class="form-group pt-0">
            <label>Number of Attendees</label>
            <input 
                type="number" 
                class="form-control" 
                name="number-of-attendees" 
                required 
                value=""
            />
            <label>Type of Service</label>
            <select class="form-control" id="typeOfServiceSelect" name="type-of-service" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option value="Catering & Meeting Space" default>Catering &amp; Meeting Space</option>
                <option value="Catering Only">Catering Only</option>
                <option value="Meeting Space Only">Meeting Space Only</option>
            </select>
        </div>

        <span id="catering-information">
        <div class="form-group">
            <h6 class=" su-form-label">Catering Information</h6>
            <p>If you selected Catering, please provide details about the Food & Beverage you would like at the event.</p>
            <br/>
            <input id="checkbox-validation" name="catering-type"/>
            <label class="required-input">Catering Type</label>
            <div class="checkbox" id="checkbox">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Breakfast" id="checkbox1"/>
                    <label class="form-check-label" for="checkbox1">Breakfast</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Lunch" id="checkbox2"/>
                    <label class="form-check-label" for="checkbox2">Lunch</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Dinner" id="checkbox3"/>
                    <label class="form-check-label" for="checkbox3">Dinner</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Reception" id="checkbox4"/>
                    <label class="form-check-label" for="checkbox4">Reception</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Beverage" id="checkbox5"/>
                    <label class="form-check-label" for="checkbox5">Beverage</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Beverage & Snacks" id="checkbox6"/>
                    <label class="form-check-label" for="checkbox6">Breaks &amp; Snacks</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="check_list[]" value="Pick Up or Delivery Only" id="checkbox7"/>
                    <label class="form-check-label" for="checkbox7">Pick Up or Delivery Only</label>
                </div>    
            </div>

        </div>

        <div class="form-group pt-0 pb-0">
            <div class="row">
                <div class="col-md-4">
                    <label class="required-input">Catering Start Time</label>
                    <div>

                        <select id="cs-hour" class="form-control su-timepicker">
                            <?php
                                for ($i=1; $i < 13; $i++) { 
                                    $tmp_hour = $i;
                                    if ($i < 10){
                                        $tmp_hour = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_hour.'">'.$tmp_hour.'</option>';
                                }
                            ?>
                        </select>

                        <select id="cs-min" class="form-control su-timepicker">
                            <?php
                                for ($i=0; $i < 61; $i++) { 
                                    $tmp_min = $i;
                                    if ($i < 10){
                                        $tmp_min = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_min.'">'.$tmp_min.'</option>';
                                }
                            ?>
                        </select>

                        <!-- Mnemonic -->

                        <select id="cs-mnemonic" class="form-control su-timepicker">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>

                    </div>
                    <input 
                        type="hidden" 
                        class="form-control" 
                        name="catering-start-time"
                        id="catering-start-time"
                        value=""
                    />
                </div>

                <div class="col-md-4">
                    <label class="required-input">Catering End Time</label>
                    <div>

                        <select id="ce-hour" class="form-control su-timepicker">
                            <?php
                                for ($i=1; $i < 13; $i++) { 
                                    $tmp_hour = $i;
                                    if ($i < 10){
                                        $tmp_hour = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_hour.'">'.$tmp_hour.'</option>';
                                }
                            ?>
                        </select>

                        <select id="ce-min" class="form-control su-timepicker">
                            <?php
                                for ($i=0; $i < 61; $i++) { 
                                    $tmp_min = $i;
                                    if ($i < 10){
                                        $tmp_min = '0' . $i;
                                    }
                                    echo '<option value="'.$tmp_min.'">'.$tmp_min.'</option>';
                                }
                            ?>
                        </select>

                        <!-- Mnemonic -->

                        <select id="ce-mnemonic" class="form-control su-timepicker">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>

                    </div>
                    <input 
                        type="hidden" 
                        class="form-control" 
                        name="catering-end-time" 
                        id="catering-end-time"
                        value=""
                    />
                </div>
            </div>
        </div>

        <div class="form-group pt-0">
            <label class="required-input">Serviceware Selection</label>
            <div class="radio">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Plastic" id="servicewareRadio1" name="servicewareRadio" default/>
                    <label class="form-check-label" for="servicewareRadio1">Plastic</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Upgraded Plastic" id="servicewareRadio2" name="servicewareRadio"/>
                    <label class="form-check-label" for="servicewareRadio2">Upgraded Plastic ($2 per person)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="China" id="servicewareRadio3" name="servicewareRadio"/>
                    <label class="form-check-label" for="servicewareRadio3">China ($3 per person)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Compostable" id="servicewareRadio4" name="servicewareRadio"/>
                    <label class="form-check-label" for="servicewareRadio4">Compostable ($2 per person)</label>
                </div>
            </div>
            <label>Please provide any additional information regarding catering, menu selection, special dietary needs, etc.</label>
            <textarea class="form-control" id="cateringTextArea" name="catering-comments" rows="4"></textarea>
        </div>
        </span>

        <span id="room-info">
        <div class="form-group">
            <h6 class="su-form-label">Room Information</h6>
            <label class="required-input">Setup Style</label>
            <select class="form-control" name="setup-style" id="setup-style">
                <option value="" selected disabled hidden>Choose here</option>
                <option value="Conference/Boardroom" default>Conference/Boardroom</option>
                <option value="Theater/Auditorium Style">Theater/Auditorium Style</option>
                <option value="Classroom">Classroom</option>
                <option value="Rounds">Rounds</option>
                <option value="U-Shape">U-Shape</option>
                <option value="Hollow Square">Hollow Square</option>
                <option value="Reception">Reception</option>
            </select>
            <label>Setup Style Comments</label>
            <textarea class="form-control" id="cateringTextArea" name="setup-comments" rows="4"></textarea>
            <label class="required-input">Audiovisual</label>
            <div class="radio">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="Yes" id="audiovisualRadio1" name="audiovisualRadio" default/>
                    <label class="form-check-label" for="audiovisualRadio1">Yes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="No" id="audiovisualRadio2" name="audiovisualRadio"/>
                    <label class="form-check-label" for="audiovisualRadio2">No</label>
                </div>
            </div>
            <div id="audiovisualDiv">
                <label class="required-input">Please provide details about the audiovisual you would like at the event</label>
                <textarea class="form-control" id="audiovisualTextArea" rows="4" name="audiovisual-comments"></textarea>
            </div>
            <label>Please provide any additional comments or questions regarding your event</label>
            <textarea class="form-control" id="addionalComments" name="additional-comments" rows="4"></textarea>
        </div>
        </span>

        <span id="location" style="display:none;">
        <div class="form-group">
            <h6 class="su-form-label">Location</h6>
            <label class="required-input">Building</label>
            <textarea class="form-control" id="cateringTextArea" name="building" rows="1"></textarea>
            <label class="required-input">Address</label>
            <textarea class="form-control" id="cateringTextArea" name="address" rows="2"></textarea>
            <label class="required-input">Room Number/Name</label>
            <textarea class="form-control" id="cateringTextArea" name="room-number" rows="1"></textarea>
            <label>Setup Style Notes</label>
            <textarea class="form-control" id="cateringTextArea" name="setup-notes" rows="4"></textarea>
        </div>
        </span>

        <div class="form-group">
            <h6 class="required-input su-form-label">Recurring</h6>
            <div class="row">
                <div class="col-sm-4">
                Is this a recurring event?
                </div>
                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" value="Yes" id="recur" name="recurringRadio" required/>
                    <label class="form-check-label" for="recur">Yes</label>
                </div>
                <div class="form-check col-sm-2">
                    <input class="form-check-input" type="radio" value="No" id="nonrecur" name="recurringRadio" default/>
                    <label class="form-check-label" for="nonrecur">No</label>
                </div>
            </div>
            <br>
            <div id="recurringDiv" style="display:none;">
                <label class="required-input">Please select recurring dates</label>
                <textarea class="form-control" id="recurringTextArea" name="recurring-comments" rows="2"></textarea>
            </div>
            
        </div>

        <div class="form-group">
            <h6 class="required-input su-form-label">Payment Information</h6>
            <div class="radio" id="payment">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="account" id="paymentRadio1" name="paymentRadio" required/>
                    <label class="form-check-label" for="paymentRadio1">UA IDB Account Number</label>
                </div>

                <div id="account-number-div">
                    <div class="form-group" id="account-number-div-2">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="account-number" id="account-number"/>
                    </div>
                    <div class="form-group" id="sub-account-number-div">
                        <label>Other Payment Information</label>
                        <input type="text" class="form-control" name="sub-account-number" id="sub-account-number"/>
                    </div>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" value="credit" id="paymentRadio2" name="paymentRadio" default/>
                    <label class="form-check-label" for="paymentRadio2">Credit Card</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="check" id="paymentRadio3" name="paymentRadio"/>
                    <label class="form-check-label" for="paymentRadio3">Check</label>
                </div>
            </div>
        </div>

        <div class="alert alert-success mt-3 mb-3" role="alert" id="thanks-msg" style="visibility:hidden">
            <b>Form submitted successfully! Thank you for ordering!</b>
        </div>

        <input type="submit" class="btn" id="submit" name="submit">

        <button class="btn" id="loading-btn" type="button" style="display: none;" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only">Loading...</span>
        </button>
    </form>

</div>

