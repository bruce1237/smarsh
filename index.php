<?php

use RandomQuotes\RandomQuotes;

require("vendor/autoload.php");

$a = RandomQuotes::generate();

echo $a;