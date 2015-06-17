<h2>Personal Data</h2>
<p class="info">Enter Personal Information Below for our Records</p>
<br/>

<div id="register_form">
    <input placeholder="Address" 
           type="text"
           name="address" 
           size="30" 
           maxlength="50" 
           id="address"/>
    <input placeholder="Apt/Suite #" 
           type="text"
           name="apt" 
           size="30" 
           maxlength="50"
           id="address2"/>
    <input placeholder="City" 
           type="text" 
           class="inline city"
           name="city" 
           size="30" 
           maxlength="40"
           id="city"/>
    <input placeholder="State" 
           type="text" 
           class="inline state"
           name="state" 
           size="2"
           maxlength="2"
           id="state"/>
    <br/>
    <input placeholder="Zip Code" 
           type="text"
           name="zip" 
           size="5" 
           maxlength="5" 
           class="inline zip"
           id="zip"/>
    <input placeholder="Telephone #" 
           type="text"
           name="phone" 
           size="16" 
           maxlength="16" 
           class="inline phone"
           id="phone"/>
<!--    <span id="errormsg">jdjddj</span>-->
</div>
<input id="base" hidden value="<?=base_url();?>"/>