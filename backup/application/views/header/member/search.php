<div id="searchbar">
    <?php
        // Search Settings
        $search_attr = array(
            'name' => 'searchform',
            'id' => 'search_form',
            'novalidate' => '',
            'method' => 'GET'
        );
        echo form_open('main/search', $search_attr);
    ?>
        <div id="search_container">
            <div id="search-feat">
                <input type="text" id="place" name="destination" 
                   value="" placeholder="Find Users, Rides & Events"/>
                <button type="submit">Search</button>
            </div>
            <div id="search-radio">
                <input type="radio" name="searchBy" 
                       id="radioRides" checked="checked" value="ride"/>
                <label for="radioRides">Rides</label>
                <input type="radio" name="searchBy" 
                       id="radioUser" value="user"/>
                <label for="radioUser">User</label>
                <input type="radio" name="searchBy" 
                       id="radioEvents" value="events"/>
                <label for="radioEvents">Events</label>
            </div>
        </div>
<?php 
    echo form_close();    
    $this->load->view('header/member/menu');
?> 
</div>