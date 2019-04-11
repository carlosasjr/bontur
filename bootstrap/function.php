<?php

function compile($filename, $data)
{
    if (file_exists($filename)) {
        ob_start();
        extract($data);

        /** @noinspection PhpIncludeInspection */
        require $filename;

        $contents = ob_get_contents();

        if ($contents) {
            ob_end_clean();
        }

        return $contents;
    }
    return '';
}
