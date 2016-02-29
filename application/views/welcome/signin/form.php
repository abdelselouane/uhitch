<section id='signIn' style="margin-top: 220px; min-height: 400px;">
    <div id="content">
    <?php 
        // Form Settings
        $form_attr = array(
            'name'  => 'signform',
            'id'    =>'signup_form'
        );   
        echo form_open('welcome/signUpUser', $form_attr); 
    ?>
    <h1>Sign Up</h1>      
    <hr/>
    <div class="form-group">
       <input placeholder="First Name" type="text" name="firstName" id="fname" class="form-control" /> 
    </div>
    <div class="form-group">
        <input placeholder="Last Name" type="text" name="lastName" id="lname" class="form-control" />
    </div>
    <span class="error" id="fullName"></span>
    <div class="form-group">
        <input placeholder="Current University/College" type="text" name="schoolName" id="school" class="form-control"/> 
    </div>
    <span class="error" id="college">Please Enter School Name</span>
    <div class="form-group">
        <input placeholder="School Email Address" type="email" name="emailAdd" id="email" class="form-control"/>
    </div>
    <span class="error" id="schoolEmail"></span>
    <div class="form-group">
        <input placeholder="Choose Password" type="password" name="passWord" id="pw1" class="form-control"/>
    </div>
    <span class="error" id="passwordEnter"></span>
    <div class="form-group">
       <input placeholder="Confirm Password" type="password" name="passWordConfirm" id="pw2" class="form-control"/>  
    </div>  
    <span class="error" id="passwordConfirm"></span>
    <div class="form-group">
        <label>Birthday</label>
        <div id="birthday_selection" class="form-inline">
            
            <select name="bMonth" id="month" class="form-control" style="width: 44%;">
                <option value="">Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <select name="bDay" id="day" class="form-control" style="width: 22%;">
                <option value="">Day</option>
                <?php 
                    // For loop to display days
                    for($i = 1; $i <= 31; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }                
                ?>
            </select>

            <select name="bYear" id="year" class="form-control" style="width: 30%;">
                <option value="">Year</option>
                <?php
                    $date = date("Y");
                    for($j = ($date - 17); $j >= $date - 100; $j--) {
                        echo '<option value="'.$j.'">'.$j.'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <span class="error2" id="userBirthdate">Please Select Your Birthday</span>
    <div class="radio">
        <label class="radio-inline">
          <input type="radio" name="sex" value="Male">&nbsp;Male
        </label>
        <label class="radio-inline">
          <input type="radio" name="sex" value="Female">&nbsp;Female
        </label>
    </div>    
    <span class="error2" id="userGender"></span>
        <p><strong>Have a Car?</strong></p>
    <div class="radio">
        <label class="radio-inline">
          <input type="radio" name="car" value="yes">&nbsp;Yes
        </label>
        <label class="radio-inline">
          <input type="radio" name="car" value="no">&nbsp;No
        </label>
    </div>
    <span class="error2" id="userCar"></span>
    <div class="form-group">
        <p>
            By signing up, you agree to our 
            <a href='<?= site_url('terms') ?>' class="green2">Terms of Service</a>
            and our <a href='<?= site_url('policy') ?>' class="green2">Privacy Policy</a>.
        </p>    
    </div>
    <button type="submit" id="signInbtn" class="btn btn-primary" style="width:100%">SIGN UP</button>
    <?php echo form_close(); ?>
  </div>
</section>