<?php

namespace Html;

trait StringEscaper
{
    public function escapeString(string $string = null): ?string
    {
        if ($string == null) {
            return "";
        }
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, null, true);
    }
    public function stripTagsAndTrim(string $string = null): ?string
    {
        if ($string == null) {
            return "";
        } else {
            $res = strip_tags($string);
            return trim($res);
        }

    }

}
