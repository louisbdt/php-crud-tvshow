<?php

declare(strict_types=1);

namespace Html;

/**
 *
 */
class WebPage
{
    use StringEscaper;

    /**
     * @var string
     */
    private string $head = "";
    /**
     * @var string|mixed
     */
    private string $title;
    /**
     * @var string
     */
    private string $body = "";

    /**
     * @param $title
     */
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
     * Modificateur de l'attribut Title
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * Permet d'ajouter du contenu à l'header
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content)
    {
        $this->head .= $content;
    }

    /**
     * Permet d'ajouter du css
     * @param string $css
     * @return void
     */
    public function appendCss(string $css)
    {
        $this->head .= "<style>$css</style>";

    }

    /**
     * Permet d'ajouter un url vers la feuille de style css
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url)
    {
        $this->head .= <<<HTML
        <link href="$url" rel="stylesheet" type="text/css"/>
        HTML;
    }

    /**
     * Permet d'ajouter du javascript
     * @param string $js
     * @return void
     */
    public function appendJs(string $js)
    {
        $this->head .= "<script>$js</script>";

    }

    /**
     * Permet d'ajouter un url vers un script javascript
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url)
    {
        $this->head .= <<<JS
        <script src="$url"></script>
        JS;

    }

    /**
     * Permet d'ajouter du contenu au body
     * @param string $content
     * @return void
     */
    public function appendContent(string $content)
    {
        $this->body .= $content;
    }

    /**
     * Renvoie tout le contenu sous forme html
     * @return string
     */
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

    /**
     * Permet d'échapper une chaîne de caractère
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, null, true);
    }

    /**
     * Permet de renvoyer la date de dernière modification de la page web
     * @return string
     */
    public function getLastModification(): string
    {
        return "Dernière modification :  " . date("F d Y H:i:s.", getlastmod());
    }



}
