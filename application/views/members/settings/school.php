<hr/>
<h3>School Information</h3>
<div class="section">
    <label>College Name</label>
    <input type="text" id="school" 
           value="<?php echo $data->school;?>" 
           placeholder="College or University"/>
</div>
<div id='selectInline' >
    <?php 
        $category = array();
        array_push($category, "Undeclared");
        array_push($category, "Agriculture & Environmental Science");
        array_push($category, "Architecthure & Planning");
        array_push($category, "Art & Humanities");
        array_push($category, "Business");
        array_push($category, "Biological and Biomedical Sciences");
        array_push($category, "Communication Arts & Journalism");
        array_push($category, "Education");
        array_push($category, "Engineering");
        array_push($category, "Health and Medicine");
        array_push($category, "History");
        array_push($category, "Mathematics & Computer Science");
        array_push($category, "Modern and Classical Languages");
        array_push($category, "Multi-/Interdisciplinary Studies");
        array_push($category, "Music");
        array_push($category, "Physical Sciences");
        array_push($category, "Public and Social Services");
        array_push($category, "Social Sciences");
    ?>
    
    <select id="classification" size="1">
        <option value="">Select Classification</option>
        <option value="Freshman">Freshman</option>
        <option value="Sophomore">Sophomore</option>
        <option value="Junior">Junior</option>
        <option value="Senior">Senior</option>
        <option value="Graduate">Graduate</option>
    </select>
    
    <select id="category" size="1">
        <option value="">Select Major Category</option>
        <?php foreach($category as $value) : ?>
             <option value='<?php echo $value;?>'><?php echo $value; ?></option>
        <?php endforeach; ?>
    </select> 
    
    <select id="major" size="1">
        <option value="">Select Major</option>
    </select>
    
    <select id="greek" size="1">
        <option value="">Greek Life</option>
        <option value="None">None</option>
        <option value="Alpha Epsilon Pi">Alpha Epsilon Pi</option>
        <option value="Alpha Gamma Rho">Alpha Gamma Rho</option>
        <option value="Alpha Kappa Alpha">Alpha Kappa Alpha</option>
        <option value="Alpha Phi Alpha">Alpha Phi Alpha</option> 
        <option value="Alpha Tau Omega">Alpha Tau Omega</option>
        <option value="Beta Theta Pi">Beta Theta Pi</option>
        <option value="Chi Phi">Chi Phi</option>
        <option value="Chi Psi">Chi Psi</option>
        <option value="Delta Gamma">Delta Gamma</option>
        <option value="Delta Sigma Theta">Delta Sigma Theta</option>
        <option value="Delta Zeta">Delta Zeta</option>
        <option value="Kappa Alpha Psi">Kappa Alpha Psi</option> 
        <option value="Kappa Alpha Theta">Kappa Alpha Theta</option> 
        <option value="Kappa Delta">Kappa Delta</option>
        <option value="Kappa Kappa Gamma">Kappa Kappa Gamma</option>
        <option value="Lambda Chi Alpha">Lambda Chi Alpha</option> 
        <option value="Omega Psi Phi">Omega Psi Phi</option> 
        <option value="Phi Beta Sigma">Phi Beta Sigma   </option> 
        <option value="Phi Mu">Phi Mu</option>
        <option value="Pi Beta Phi">Pi Beta Phi</option>
        <option value="Sigma Alpha Epsilon">Sigma Alpha Epsilon</option>
        <option value="Sigma Chi">Sigma Chi</option>
        <option value="Sigma Delta Tau">Sigma Delta Tau</option>
        <option value="Sigma Gamma Rho">Sigma Gamma Rho</option>
        <option value="Sigma Nu">Sigma Nu</option>  
        <option value="Sigma Phi Epsilon">Sigma Phi Epsilon</option>  
        <option value="Sigma Pi">Sigma Pi</option>  
        <option value="Zeta Phi Beta">Zeta Phi Beta</option>  
        <option value="Zeta Tau Alpha">Zeta Tau Alpha</option> 
    </select>
    
    <button class="settings button" 
        value="school">Update School</button>
</div>
