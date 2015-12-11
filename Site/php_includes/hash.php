<?php
#file with functions that deal with hashing
#Authors: Scott Hansen and Nicholas Burd

#Plain sha256 hash
function sha256($plaintext) {
    #perform the hash
    $hashedText = hash('sha256', $plaintext, $raw_output = false) ;
    return $hashedText ;
}

#password hashing/salting function
function hashPassword($password, $salt) {
    #combine salt and password
    $combined = $password . $salt ;
    #perform hash on the combined pass and hash
    $hashedPassword = sha256($combined);
    return $hashedPassword ;
}

?>