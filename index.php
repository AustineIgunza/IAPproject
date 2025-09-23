<?php
require 'LoadingClass.php';

// Create instances (adjust class names if yours differ)
$layout = new Layouts();
$form   = new FormsLayout();

// If you have a Hello class in Global/Hello.php, instantiate it; otherwise skip.
$hello = null;
if (class_exists('Hello')) {
    $hello = new Hello();
}

// Output the page
echo $layout->header($conf);

if ($hello) {
    // If Hello::today() returns a string:
    echo $hello->today();
    // If it echoes directly, call: $hello->today();
}

//
// Use signup() depending on how your Forms class is implemented:
//
// - If signup() RETURNS HTML (string): use echo $form->signup();
// - If signup() ECHOES the HTML directly: use $form->signup();
//
echo $form->signup();

echo $layout->footer($conf);
