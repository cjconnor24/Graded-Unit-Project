<?php

/**
 * Helper function to mark a link as active
 * @param string $path Path to check
 * @return string
 */
function setActive($path)
{
    return Request::is($path . '*') ? ' class=active' :  '';
}