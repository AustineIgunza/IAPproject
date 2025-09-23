<?php
require 'LoadingClass.php';

// Create instances
$layout = new Layouts();
$form   = new FormsLayout();

// Output the page
print $layout->header($conf);
print $form->signin();
print $layout->footer($conf);
