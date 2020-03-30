<?php 

namespace src\Structure\Title;

class Title
{
    public static function setTitle(string $title)
    {
        echo '<title>' . TITLE . ' - ' . $title . '</title>';
    }
}