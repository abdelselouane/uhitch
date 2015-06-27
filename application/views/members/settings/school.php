<!--?php echo '<pre>'; print_r($data); echo '</pre>';?-->
<hr/>
<h3>School Information</h3>
<div class="section">
    <label>College Name</label>
    <input type="text" id="school" class="school"
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
    
    <select id="classification" class="school" size="1">
        <option value="">Select Classification</option>
        <option value="Freshman" <?= ($data->class == 'Freshman') ? 'selected': '';?>>Freshman</option>
        <option value="Sophomore" <?= ($data->class == 'Sophomore') ? 'selected': '';?>>Sophomore</option>
        <option value="Junior" <?= ($data->class == 'Junior') ? 'selected': '';?>>Junior</option>
        <option value="Senior" <?= ($data->class == 'Senior') ? 'selected': '';?>>Senior</option>
        <option value="Graduate" <?= ($data->class == 'Graduate') ? 'selected': '';?>>Graduate</option>
    </select>
    
    <select id="category" class="school" size="1">
        <option value="">Select Major Category</option>
        <?php foreach($category as $value) : ?>
             <option value='<?php echo $value;?>'><?php echo $value; ?></option>
        <?php endforeach; ?>
    </select>
    
    <select id="major" class="school" size="1">
        <option value="">Select Major</option>
        <?= ($data->major) ? '<option value="'.$data->major.'" selected>'.$data->major.'</option>': '';?>
    </select>
    
    <select id="greek" class="school" size="1">
        <option value="">Greek Life</option>
        <option value="None" <?= ($data->greek == '') ? 'selected': '';?>>None</option>
        <option value="Alpha Epsilon Pi" <?= ($data->greek == 'Alpha Epsilon Pi') ? 'selected': '';?>>Alpha Epsilon Pi</option>
        <option value="Alpha Gamma Rho" <?= ($data->greek == 'Alpha Gamma Rho') ? 'selected': '';?>>Alpha Gamma Rho</option>
        <option value="Alpha Kappa Alpha" <?= ($data->greek == 'Alpha Kappa Alpha') ? 'selected': '';?>>Alpha Kappa Alpha</option>
        <option value="Alpha Phi Alpha" <?= ($data->greek == 'Alpha Phi Alpha"') ? 'selected': '';?>>Alpha Phi Alpha</option> 
        <option value="Alpha Tau Omega" <?= ($data->greek == 'Alpha Tau Omega') ? 'selected': '';?>>Alpha Tau Omega</option>
        <option value="Beta Theta Pi" <?= ($data->greek == 'Beta Theta Pi') ? 'selected': '';?>>Beta Theta Pi</option>
        <option value="Chi Phi" <?= ($data->greek == 'Chi Phi') ? 'selected': '';?>>Chi Phi</option>
        <option value="Chi Psi" <?= ($data->greek == 'Chi Psi') ? 'selected': '';?>>Chi Psi</option>
        <option value="Delta Gamma" <?= ($data->greek == 'Delta Gamma') ? 'selected': '';?>>Delta Gamma</option>
        <option value="Delta Sigma Theta" <?= ($data->greek == 'Delta Sigma Theta') ? 'selected': '';?>>Delta Sigma Theta</option>
        <option value="Delta Zeta" <?= ($data->greek == 'Delta Zeta') ? 'selected': '';?>>Delta Zeta</option>
        <option value="Kappa Alpha Psi" <?= ($data->greek == 'Kappa Alpha Psi') ? 'selected': '';?>>Kappa Alpha Psi</option> 
        <option value="Kappa Alpha Theta" <?= ($data->greek == 'Kappa Alpha Theta') ? 'selected': '';?>>Kappa Alpha Theta</option> 
        <option value="Kappa Delta" <?= ($data->greek == 'Kappa Delta') ? 'selected': '';?>>Kappa Delta</option>
        <option value="Kappa Kappa Gamma" <?= ($data->greek == 'Kappa Kappa Gamma') ? 'selected': '';?>>Kappa Kappa Gamma</option>
        <option value="Lambda Chi Alpha" <?= ($data->greek == 'Lambda Chi Alpha') ? 'selected': '';?>>Lambda Chi Alpha</option> 
        <option value="Omega Psi Phi" <?= ($data->greek == 'Omega Psi Phi') ? 'selected': '';?>>Omega Psi Phi</option> 
        <option value="Phi Beta Sigma" <?= ($data->greek == 'Phi Beta Sigma') ? 'selected': '';?>>Phi Beta Sigma   </option> 
        <option value="Phi Mu" <?= ($data->greek == 'Phi Mu') ? 'selected': '';?>>Phi Mu</option>
        <option value="Pi Beta Phi" <?= ($data->greek == 'Pi Beta Phi') ? 'selected': '';?>>Pi Beta Phi</option>
        <option value="Sigma Alpha Epsilon" <?= ($data->greek == 'Sigma Alpha Epsilon') ? 'selected': '';?>>Sigma Alpha Epsilon</option>
        <option value="Sigma Chi" <?= ($data->greek == 'Sigma Chi') ? 'selected': '';?>>Sigma Chi</option>
        <option value="Sigma Delta Tau" <?= ($data->greek == 'Sigma Delta Tau') ? 'selected': '';?>>Sigma Delta Tau</option>
        <option value="Sigma Gamma Rho" <?= ($data->greek == 'Sigma Gamma Rho') ? 'selected': '';?>>Sigma Gamma Rho</option>
        <option value="Sigma Nu" <?= ($data->greek == 'Sigma Nu') ? 'selected': '';?>>Sigma Nu</option>  
        <option value="Sigma Phi Epsilon" <?= ($data->greek == 'Sigma Phi Epsilon') ? 'selected': '';?>>Sigma Phi Epsilon</option>  
        <option value="Sigma Pi" <?= ($data->greek == 'Sigma Pi') ? 'selected': '';?>>Sigma Pi</option>  
        <option value="Zeta Phi Beta" <?= ($data->greek == 'Zeta Phi Beta') ? 'selected': '';?>>Zeta Phi Beta</option>  
        <option value="Zeta Tau Alpha" <?= ($data->greek == 'Zeta Tau Alpha') ? 'selected': '';?>>Zeta Tau Alpha</option> 
    </select>
    
    <button class="settings button" 
        value="school">Update School</button>
</div>
