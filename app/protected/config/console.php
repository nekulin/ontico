<?php
$backend = dirname(dirname(__FILE__));

return CMap::mergeArray(
    require_once(dirname(__FILE__) . '/main.php'),
    array(
    )
);