<?php
$no_subscription = (object) [
    'connections' => 0,
    'users' => 0,
];

$essentials_info = (object) [
    'connections' => 1,
    'users' => 5,
];

$plus_info = (object) [
    'connections' => 5,
    'users' => 100,
];

$enterprise_info = (object) [
    'connections' => 20,
    'users' => 100,
];

return [
'no_subscription' => $no_subscription,
'essentials_info' => $essentials_info,
'plus_info' => $plus_info,
'enterprise_info' => $enterprise_info
];
 