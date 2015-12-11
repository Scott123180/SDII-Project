<?php
#Password validation tools
#Authors: Scott Hansen and Nicholas Burd
require ( 'hash.php' ) ;
require ( 'form_validation.php ' ) ;
require ( '../../connect_db.php' ) ;

function validatePassword($input) {
    #1. sterilize input
    #2. run input through hash
    #3. compare hash to password
    #4. return true or false
    #5. close sql connection
}
?>