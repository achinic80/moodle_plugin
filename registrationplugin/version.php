<?php
defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_registrationplugin';  // Must match folder name.
$plugin->version   = 2025091200;                  // YYYYMMDDXX (date + counter).
$plugin->requires  = 2022041900;                  // Minimum Moodle version (e.g. Moodle 4.0 = 2022041900).
$plugin->maturity  = MATURITY_ALPHA;              // Or MATURITY_BETA, MATURITY_STABLE.
$plugin->release   = '0.1';                       // Human-readable version.
