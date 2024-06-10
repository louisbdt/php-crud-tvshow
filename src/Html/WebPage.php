<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head = "";
    private string $title;
    private string $body = "";

    public function __construct($title = "")
    {
        $this->title = $title;
    }

    /**
     * Accesseur de l'attribut HEAD
     * @return string attibut head
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Accesseur de l'attribut Title
     * @return string attribut title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Accesseur de l'attribut Body
     * @return string attribut body
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function appendToHead(string $content)
    {
        $this->head .= $content;
    }
    public function appendCss(string $css)
    {
        $this->head .= "<style>$css</style>";

    }

    public function appendCssUrl(string $url)
    {
        $this->head .= <<<HTML
        <link href="$url" rel="stylesheet" type="text/css"/>
        HTML;
    }
    public function appendJs(string $js)
    {
        $this->head .= "<script>$js</script>";

    }

    public function appendJsUrl(string $url)
    {
        $this->head .= <<<JS
        <script src="$url"></script>
        JS;

    }

    public function appendContent(string $content)
    {
        $this->body .= $content;
    }

    public function toHTML(): string
    {
        $html = <<<HTML
        <!doctype Html>
        <Html lang="fr">
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
            <meta http-equiv= x-ua-compatible content= ie=edge>
            <title>{$this->title}</title>
            {$this->head}
        </head>
        <body>
            {$this->body}
            <div style= "text-align:right ;font-style :italic">{$this->getLastModification()}</div>
        </body>
            
            
        </Html>
        HTML;
        return $html;
    }

    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, null, true);
    }
    public function getLastModification(): string
    {
        return "Dernière modification :  " . date("F d Y H:i:s.", getlastmod());
    }



}
