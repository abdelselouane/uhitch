<h3>Campus & Housing</h3>
    <hr />

    <p>Classification</p>
    <span>
        <div>
            <input type="radio" name="classification" value="Freshman">Freshman <br/>
            <input type="radio" name="classification" value="Sophomore">Sophomore 
        </div>  
        <div>  
            <input type="radio" name="classification" value="Junior">Junior <br/> 
            <input type="radio" name="classification" value="Senior">Senior                               
        </div>  
        <div>
            <input type="radio" name="classification" value="Graduate">Graduate  
        </div>
    </span>

    <hr />
    <p>
        Resident <br/>
        or <br/>
        Commuter 
    </p>
    <span>
        <div>
            <img src=<?php echo base_url('assets/imgs/icons/bed.png');?> >  
            <input type="radio" name="living" value="Resident">Resident
        </div>
        <div>
            <img src=<?php echo base_url('assets/imgs/icons/car.png');?> >  
            <input type="radio" name="living" value="Commuter">Commuter 
        </div> 
    </span>