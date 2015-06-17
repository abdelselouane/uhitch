<section id='signIn'>
    <?php 
        // Form Settings
        $form_attr = array(
            'name'  => 'signform',
            'id'    =>'signup_form'
        );   
        echo form_open('welcome/signUpUser', $form_attr); 
    ?>
    <div>     
        <input placeholder="First Name" 
               type="text" 
               name="firstName" 
               id="fname"
               size="30" 
               class="name" 
               />
        
        <input placeholder="Last Name"  
               type="text"
               name="lastName" 
               size="30"
               id="lname"
               class="name" 
               />

        <span class="error" id="fullName"></span>      

        <input placeholder="Current University/College" 
               type="text" 
               name="schoolName" 
               id="school"
               /> 
        
        <span class="error" id="college">Please Enter School Name</span>

        <input placeholder="School Email Address" 
               type="email" 
               name="emailAdd" 
               id="email"
               />
        <span class="error" id="schoolEmail"></span>
        
        <input placeholder="Choose Password" 
               type="password" 
               name="passWord" 
               aize="50"
               id="pw1"
               />
        
        <span class="error" id="passwordEnter"></span>
        
        <input placeholder="Confirm Password"
               type="password" 
               name="passWordConfirm" 
               size="50"
               id="pw2"
               />    
        
        <span class="error" id="passwordConfirm"></span>

        <div id="birthday_selection" class="side_input">
            <p><span>Birthday</span></p>
            <select name="bMonth" id="month">
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

            <select name="bDay" id="day">
                <option value="">Day</option>
                <?php 
                    // For loop to display days
                    for($i = 1; $i <= 31; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }                
                ?>
            </select>

            <select name="bYear" id="year">
                <option value="">Year</option>
                <?php
                    $date = date("Y");
                    for($j = ($date - 17); $j >= $date - 100; $j--) {
                        echo '<option value="'.$j.'">'.$j.'</option>';
                    }
                ?>
            </select>
        </div>
        
        <span class="error2" id="userBirthdate">Please Select Your Birthday</span>
        
        <br/>

        <div id="gender" class="side_input">
            <label>Male </label><input type="radio" name="sex" value="Male">
            <label>Female </label><input type="radio" name="sex" value="Female">
        </div>
        
        <span class="error2" id="userGender"></span>
        
        <br/>
        
        <div id="vehicle_selection" class="side_input">
            <p><span>Have a Car?</span></p>
            <label>Yes </label><input type="radio" name="car" value="yes">
            <label>No </label><input type="radio" name="car" value="no">
        </div>
        
        <span class="error2" id="userCar"></span>
        
        <div id="sign_n_terms">
            <div>
                <button type="submit" id="signInbtn" class="button">
                    SIGN UP
                </button>
            </div>
            <div>
                <p>
                    By signing up, you agree to our 
                    <a href='<?= site_url('terms') ?>'>Terms of Service</a>
                    and our <a href='<?= site_url('policy') ?>'>Privacy Policy</a>.
                </p>    
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</section>