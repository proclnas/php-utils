<?php

namespace Util;

Class File {
    /**
     * Read a file using generator
     * 
     * @param  string $file File to read
     * @return \Generator
     */
    public static function readFile($file) {
        $fp = fopen($file, 'r');
        while (!feof($fp)) {
            yield trim(fgets($fp));
        }

        fclose($fp);
    }

    /**
     * Save to file 
     * @param  string $file    File to save into
     * @param  string $content Content to write to file
     * @param  bool $append    Append content
     * @return void
     */
    public static function saveFile($file, $content, $append) {
        $flags = $append ? LOCK_EX | FILE_APPEND : LOCK_EX;
        file_put_contents(
            $file,
            $content,
            $flags
        );
    }
}