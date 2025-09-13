<?php
require 'ClassAutoLoad.php';

// Create instances
$layout = new Layouts();
$form   = new Forms();

// Output the page
print $layout->header($conf);
print $form->signin();
print $layout->footer($conf);
