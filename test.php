<?php

echo password_hash('lol', PASSWORD_BCRYPT);

$hash = "$2y$10$L3sSh/XQ.0UMtsQSsvLB.OcUmMP1qrISD3ckcgKUFpj/RDXZbPZn6";
$hash2 = "$2y$10$sbtxfJHsNP1OsqSXVcwJ0eR7avsF5686BHywd7pkY8aJ7WX/oM7t2";

if (password_verify($hash2, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

?>
