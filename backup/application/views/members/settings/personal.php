<h3>Personal Information</h3>
<div class="section">
    <label>First Name</label>
    <input type="text" id="firstname" 
           value="<?php echo $data->fname;?>" 
           placeholder="First Name"/>
</div>
<div class="section">
    <label>Middle Name</label>
    <input type="text" id="middlename" 
           value="<?php echo $data->middleName;?>" 
           placeholder="Optional" />
</div>
<div class="section">
    <label>Last Name</label>
    <input type="text" id="lastname" 
           value="<?php echo $data->lname;?>" 
           placeholder="Last Name"/>
</div>
<div class="section">
    <label>Phone Number</label>
    <input type="text" id="phone" 
           value="<?php echo $data->phone;?>" 
           placeholder="(XXX)-XXX-XXXX"/>
</div>
<div class="section">
    <label>Address</label>
    <div class="duelInput">
        <input type="text" id="address" 
               value="<?php echo $data->address;?>" 
               placeholder="Address"/>
         <input type="text" id="address2" 
                placeholder="Apt/Suite #"/>
    </div>
</div>
<div class="section">
    <label>City & State</label>
    <div class="duelInput">
        <input type="text" id="city" 
               value="<?php echo $data->city;?>" 
               placeholder="City"/>
        <input type="text" id="state" 
               value="<?php echo $data->state;?>" 
               placeholder="State"/>
    </div>
</div>
<div class="section">
    <label>Zip Code</label>
    <input type="text" id="lastname" 
           value="<?php echo $data->zip;?>" 
           placeholder="Zip"/>
</div>
<button class="settings button" 
    value="personal">Update Personal</button>