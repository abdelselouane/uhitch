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

<h3>School Information</h3>
<hr/>
<p>Majors of Study</p>
<span> 
    <div>
        <select name="category" id="category" size="1">
            <option value="">Select Major Category</option>
            <?php
            foreach($category as $value) 
                { echo "<option value='$value'>$value</option>"; }
            ?>
        </select> 
        <select name="major" id="major" size="1">
            <option value="">Select Major</option>
        </select> 
    </div>
</span>