<?php

namespace Html;

/**
 * Trait qui permet d'échapper des chaines de caractères
 */
trait StringEscaper
{
    /**
     * Echappe une chaine de caractère mise en paramêtre
     * @param string|null $string
     * @return string|null
     */
    public function escapeString(string $string = null): ?string
    {
        if ($string == null) {
            return "";
        }
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, null, true);
    }

    /**
     * Renvoie une chaine avec les balises html et php supprimées ainsi que les espaces ou autres caractères en début et fin de chaine
     * @param string|null $string
     * @return string|null
     */
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
