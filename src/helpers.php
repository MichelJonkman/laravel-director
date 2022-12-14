<?php

/**
 * Converts absolute path to a relative one
 *
 * @link https://stackoverflow.com/questions/2637945/getting-relative-path-from-absolute-path-in-php#answer-2638272
 * @param string $from
 * @param string $to
 * @return string
 */
function absoluteToRelativePath(string $from, string $to): string
{
    // some compatibility fixes for Windows paths
    $from = is_dir($from) ? rtrim($from, '\/').'/' : $from;
    $to = is_dir($to) ? rtrim($to, '\/').'/' : $to;
    $from = str_replace('\\', '/', $from);
    $to = str_replace('\\', '/', $to);

    $from = explode('/', $from);
    $to = explode('/', $to);
    $relPath = $to;

    foreach ($from as $depth => $dir) {
        // find first non-matching dir
        if ($dir === $to[$depth]) {
            // ignore this directory
            array_shift($relPath);
        } else {
            // get number of remaining dirs to $from
            $remaining = count($from) - $depth;
            if ($remaining > 1) {
                // add traversals up to first matching dir
                $padLength = (count($relPath) + $remaining - 1) * -1;
                $relPath = array_pad($relPath, $padLength, '..');
                break;
            } else {
                $relPath[0] = './'.$relPath[0];
            }
        }
    }

    return implode('/', $relPath);
}
