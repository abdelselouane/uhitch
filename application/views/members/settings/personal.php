<!--?php echo '<pre>'; print_r($data); echo '</pre>';?-->

<h3 class="title title-box"><i class="fa fa-user"></i>&nbsp;Personal Information</h3>
<div class="form-group section">
    <label class="form-label">First Name:</label>
    <input type="text" class="form-control" id="firstname" 
           value="<?php echo $data->fname;?>" 
           placeholder="First Name"/>
</div>
<div class="form-group section">
    <label class="form-label">Middle Name:</label>
    <input type="text" class="form-control" id="middlename" 
           value="<?php echo $data->middleName;?>" 
           placeholder="Optional" />
</div>
<div class="form-group section">
    <label class="form-label">Last Name:</label>
    <input type="text" class="form-control" id="lastname" 
           value="<?php echo $data->lname;?>" 
           placeholder="Last Name"/>
</div>
<div class="form-group section">
    <label class="form-label">Gender:</label>
    <select id="gender" name="gender" class="form-control">
        <option value="">Select Gender</option>
        <option value="Male" <?= (isset($data->gender) && ($data->gender == 'Male') ? 'selected' : '' )?>>Male</option>
        <option value="Female" <?= (isset($data->gender) && ($data->gender == 'Female') ? 'selected' : '' )?>>Female</option>
    </select>
</div>
<div class="form-group section">
    <label class="form-label">Phone Number:</label>
    <input type="text" id="phone" class="form-control"
           value="<?php echo $data->phone;?>" 
           placeholder="(XXX)-XXX-XXXX"/>
</div>
<div class="form-group section">
    <label class="form-label">Address:</label>
    <div class="duelInput">
        <input type="text" id="address" class="form-control"
               value="<?php echo $data->address;?>" 
               placeholder="Address"/>
         <input type="text" id="address2" class="form-control"
                placeholder="Apt/Suite #"/>
    </div>
</div>
<div class="form-group section">
    <label class="form-label">City & State:</label>
    <div class="duelInput">
        <input type="text" id="city" class="form-control"
               value="<?php echo $data->city;?>" 
               placeholder="City"/>
        <input type="text" id="state" class="form-control"
               value="<?php echo $data->state;?>" 
               placeholder="State"/>
    </div>
</div>
<div class="form-group section">
    <label class="form-label">Zip Code:</label>
    <input type="text" id="zipcode" class="form-control"
           value="<?php echo $data->zip;?>" 
           placeholder="Zip"/>
</div>
<button class="settings btn btn-primary btn-center" value="personal">Update Personal</button>