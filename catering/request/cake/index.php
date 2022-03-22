<?php
 header("Location: /index.php");
 die();

require_once($_SERVER['DOCUMENT_ROOT'] . '/catering/template/catering.inc.php');
$page_options['title'] = 'Catering';
$page_options['page'] = 'Catering';
$page_options['header_image'] = '/catering/template/Banner_Cake_Catering_Form.png';
catering_start($page_options);
?>








<link rel="stylesheet" type="text/css" href="/catering/request/cake/style.css">

<h2>U of A CAKE ORDER FORM</h2>

<p> <hr> </p>

<div class="col-md-12 p-0 mb-3" style="height: 50px;">
    <a class="btn su-btn" href="/catering/resources/AZ_Catering_Landing_Page_Cake_Catalog.pdf" target="_blank" style="float: right; font-size: 16px; font-weight: 600; padding: 7px 15px;">Check Our Cake Catalog!</a>
</div>

<form name="cakeForm">

  <div class="form-group">
    <label for="inputEventName">Event Name <span>&starf;</span></label>
    <input type="text" name="eventName" class="form-control" placeholder="Type in here" required>
  </div>

  <div class="form-group">
    <label for="inputContactName">Contact Name <span>&starf;</span></label>
    <input type="text" name="contactName" class="form-control" placeholder="Type in here" required>  
  </div>

  <div class="form-group">
    <label for="inputEventLocation">Event Location <span>&starf;</span></label>
    <input type="text" name="eventLocation" class="form-control" placeholder="Type in here">  
  </div>

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="inputEventDate">Event Date <span>&nbsp;&starf;</span></label>
                <input type="date" class="form-control col-sm-8" name="eventDate" id="inputEventDate">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="inputEventTime">Event Time <span>&nbsp;&starf;</span></label>
                <div>

                    <select id="et-hour" class="form-control su-timepicker">
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

                    <select id="et-min" class="form-control su-timepicker">
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

                    <select id="et-mnemonic" class="form-control su-timepicker">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>

                </div>
                <input type="hidden" class="form-control col-sm-12" name="eventTime" id="inputEventTime">
            </div>
        </div>
    </div>

  <!-- <div class="form-inline">
    <label for="inputEventDate">Event Date <span>&nbsp;&starf;</span></label>
    <label for="inputEventTime" style="margin-left: 28em;">Event Time <span>&nbsp;&starf;</span></label>
  </div>

  <div class="form-inline" style="margin-top: 0.5em;">
    <input type="date" class="form-control col-sm-4" name="eventDate" id="inputEventDate">
    <input type="time" class="form-control col-sm-2" name="eventTime" id="inputEventTime" value="12:00" style="margin-left:14.5em;">
  </div> -->

  <div class="form-group">
    <label for="inputEmail">Email <span>&starf;</span></label>
    <input type="text" name="email" class="form-control" placeholder="Type in here">
  </div>

  <div class="form-group">
    <label for="inputPhoneNumber">Phone number <span>&starf;</span></label>
    <input type="text" name="phoneNumber" class="form-control" placeholder="Type in here">
  </div>

  <div class="form-group">
    <label for="inputGuestCount">Guest Count <span>&starf;</span></label>
    <input type="text" name="guestCount" class="form-control" placeholder="Type in here">
  </div>

  <h4 style="margin-top: 2em;">
    <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
    &nbsp;Occasion <span>&starf;</span>
  </h4>

  <div class="form-group">

    <label><input type="radio" name="occasion" value="Wedding"> Wedding</label><br>
    <label><input type="radio" name="occasion" value="Birthday"> Birthday</label><br>
    <label><input type="radio" name="occasion" value="Anniversary"> Anniversary</label><br>
    <label><input type="radio" name="occasion" value="Other"> Other</label><br>  
    <input style="visibility:hidden" id="ifOtherOccasion" name="otherOccasion" class="form-control" type="other" placeholder="Type in here"> 

    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Type of Cake <span>&starf;</span>
    </h4>

    <div class="form-group">

        <label><input type="radio" name="cake-type" value="White"> White</label><br>
        <label><input type="radio" name="cake-type" value="Chocolate"> Chocolate</label><br>
        <label><input type="radio" name="cake-type" value="Carrot (additional 20%)"> Carrot (additional 20%)</label><br>
        <label><input type="radio" name="cake-type" value="Alternate layered"> Alternate layered</label><br>
        <label><input type="radio" name="cake-type" value="Custom"> Custom</label><br>  
        <input style="visibility:hidden" id= "ifCustomType" name="typeCustom" class="form-control" type="custom" placeholder="Type in here"> 

    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Cake Filling <span>&starf;</span>
    </h4>

    <div class="form-group">

        <select class="form-control" style="margin-bottom: 3em;" name="cakeFilling" id="cakeFilling" onchange="showfield(this.options[this.selectedIndex].value)">
            <option disabled selected>Select your cake filling</option>
            <option>Bavarian Cream</option>
            <option>Dark Chololate Mouse</option>
            <option>Chocolate Cream</option>
            <option>Lemon Cream</option>
            <option>Strawberry</option>
            <option>Raspberry</option>
            <option>Mixed Berries</option>
            <option>Other</option>
        </select>
    <div id="div1" style="margin-bottom: 3em;"></div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Icing <span>&starf;</span>
    </h4>

    <div class="form-group">
    </div>
        <select class="form-control" style="margin-bottom: 3em;" name="icing">
            <option disabled selected>Select your icing</option>
            <option>Butter Cream</option>
            <option>Chocolate Butter Cream</option>
            <option>Whipped Topping</option>
            <option>Cream Cheese Icing</option>
            <option>Dark Choc Ganache</option>
            <option>White Ganache</option>
        </select>
    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Price <span>&starf;</span>
    </h4>

    <div class="form-group">
        <table class="table" style="margin-bottom: 3em;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" style="background-color:#00275b">Type</th>
                    <th scope="col" colspan="2" style="background-color:#00275b">Price</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td>Standard</td>
                    <td>Specialty</td>
                </tr>
                <tr>
                    <td style="background-color:#CCD1D1">6" serves (6)</td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='6" serves (6) - $28.00'> $28.00</label></td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='6" serves (6) - $38.00'> $38.00</label></td>
                </tr>
                <tr>
                    <td>9" serves (9)</td>
                    <td><label><input type="radio" name="price" value='9" serves (9) - $45.00'> $45.00</label></td>
                    <td><label><input type="radio" name="price" value='9" serves (9) - $54.00'> $54.00</label></td>
                </tr>
                <tr>
                    <td style="background-color:#CCD1D1">9" with cupcakes serves (18)</td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='9" with cupcakes serves (18)'> 48.00</label></td>
                    <td style="background-color:#CCD1D1"></td>
                </tr>
                <tr>
                    <td>10" high serves (24)</td>
                    <td><label><input type="radio" name="price" value='10" serves (24) - $72.00'> $72.00</label></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="background-color:#CCD1D1">10" serves (16)</td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='10" serves (16) - $62.00'> $62.00</label></td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='10" serves (16) - $85.00'> $85.00</label></td>
                </tr>
                <tr>
                    <td>2 round 9" serves (48)</td>
                    <td><label><input type="radio" name="price" value='2 round 9" serves (48) - $130.00'> $130.00</label></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="background-color:#CCD1D1">1/4 sheet serves (24)</td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value= '1/4 sheet serves (24) - $60.00'> $60.00<label></td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='1/4 sheet serves (24) - $72.00'> $72.00</label></td>
                </tr>
                <tr>
                    <td>1/2 sheet serves (48)</td>
                    <td><label><input type="radio" name="price" value='1/2 sheet serves (24) - $72.00'> $72.00</label></td>
                    <td><label><input type="radio" name="price" value='1/2 sheet serves (24) - $102.00'> $102.00</label></td>
                </tr>
                <tr>
                    <td style="background-color:#CCD1D1">Full sheet serves (96)</td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='Full sheet serves (96) - $120.00'> $120.00</label></td>
                    <td style="background-color:#CCD1D1"><label><input type="radio" name="price" value='Full sheet serves (96) - $160.00'> $160.00</label></td>
                </tr>
            </tbody>

        </table>
    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Show stopper cakes themes <span>&starf;</span>
    </h4>

    <div class="form-group">

        <label><input type="radio" name="theme" value="Beardown"> Beardown</label><br>
        <label><input type="radio" name="theme" value="Flowers"> Flowers</label><br>
        <label><input type="radio" name="theme" value="Cactus"> Cactus</label><br>
        <label><input type="radio" name="theme" value="Custom"> Custom</label><br>  
        <input style="visibility:hidden" id= "ifCustomTheme" name="themeCustom" class="form-control" type="custom" placeholder="Type in here"> 

    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Specialty cake designs <span>&starf;</span>
    </h4>

    <div class="form-group" style="margin-bottom: 3em;">
        <label style="width: 300px;"><input type="radio" name="specialty" value="sugar"> Sugar Flowers <span style="float: right; color: #333; font-size: 14px;">Market Price</span></label><br>
        <label style="width: 300px;"><input type="radio" name="specialty" value="fresh"> Edible Fresh Flowers <span style="float: right; color: #333; font-size: 14px;">Market Price</span></label><br>
    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Décor Reading <span>&starf;</span>
    </h4>

    <div class="form-group">
        <textarea name="decor" class="form-control" style="margin-bottom: 3em;" rows="5" placeholder="Type in here"></textarea>
    </div>

    <h4>
        <img src="https://i.ibb.co/JH05MR9/small.png" alt="small">
        &nbsp;Special Instructions <span>&starf;</span>
    </h4>

    <div class="form-group">
        <textarea name="instruction" class="form-control" rows="10" placeholder="Type in here"></textarea>
    </div>

    <h3> 48 hours minumum for any cake order </h3>

    <div class="col-md-12 p-0 mt-3 mb-3" id="thanks-msg" style="visibility:hidden">
        <div class="alert alert-success" role="alert">
        <b>Form submitted successfully! Thank you for ordering!</b>
        </div>
    </div>                        

    <input class="submit" type="submit" name="submit" id="submit" value="Submit">

    <button class="btn" id="loading-btn" type="button" style="display: none;" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="sr-only">Loading...</span>
    </button>

</form>

<script type="text/javascript" src="/catering/request/cake/cake.js"></script>

<?php 
catering_finish()
?>