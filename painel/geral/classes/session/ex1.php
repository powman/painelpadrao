<?php
require 'class.eyesecuresession.phps';

// Create a session
$ses = new EyeSecureSession('somepassword');

// Store a value
$ses->set('name', 'Lois');

// Retrieve a value
echo $ses->get('name'); // prints "Lois"