<?php

namespace Html;

use Html\WebPage;

class AppWebPage extends WebPage
{
    public function __construct($title = "")
    {
        parent::__construct($title);
        parent::appendCssUrl("/css/style.css");
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
            <title>{$this->getTitle()}</title>
            {$this->getHead()}
        </head>
        <body>
            <div class="header"><h1>{$this->getTitle()}</h1></div>
            <div class="content">{$this->getBody()}</div>
            <div class="footer" style = "font-style:italic">{$this->getLastModification()}</div>
        </body>
            
            
        </Html>
        HTML;
        return $html;
    }

}
