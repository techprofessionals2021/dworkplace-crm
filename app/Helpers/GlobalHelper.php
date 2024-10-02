<?php


if (!function_exists('format_status_name')) {
    /**
     * Format status name by removing 'status_' and capitalizing the first letter.
     *
     * @param string $name
     * @return string
     */
    function format_status_name(string $name): string
    {
        
        return ucfirst(str_replace('status_', '', $name));
    }
}
