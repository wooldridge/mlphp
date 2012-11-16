<?php
/*
Copyright 2002-2012 MarkLogic Corporation.  All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

require_once ('../setup.php');

// Project values (these override and supplement global values in ../setup.php)
$mlphp = array_merge($mlphp, array(
    'api_path'		=>		'../api/',
    'port'			=>		8078,
    'maps_key'		=>		'AIzaSyDUsZCP04vN4oxSQBcHmz1YGbTq8RTMEvw',
    'uploads_dir'	=>		__DIR__ . '/uploads' // Make accessible to PHP, e.g. chmod 700, chown www
));

// Check uploads folder permissions
try {
    if (!is_readable($mlphp['uploads_dir']) || !is_writable($mlphp['uploads_dir']) || !is_executable($mlphp['uploads_dir'])) {
        throw new Exception('Error: Photo uploads directory not readable, writable, and executable.');
    }
} catch (Exception $e) {
    echo $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine() . PHP_EOL;
}
