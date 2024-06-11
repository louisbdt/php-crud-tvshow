<?php

namespace Html\Form;

use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\StringEscaper;

class TvShowForm
{
    use StringEscaper;
    private ?TvShow $tvshow;
    public function __construct(TvShow $tvShow = null )
    {
        $this->tvShow = $tvShow;
    }
    public  function getTvshow(): ?TvShow
    {
        return $this->tvshow;
    }
    public function getHtmlForm(string $action) : string
    {
        return <<<HTML
        <h1>{$this->tvShow->getName()}</h1>
        <form method="post" action="{$action}">
            <input name="id" type="hidden" value="{$this->tvShow?->getId()}">
                <div class="form_name">
                    <label for="nom">Nom Série</label>
                    <input name="name" type="text" value="{$this->escapeString($this->tvShow?->getName())}" required>
                </div>
                <div class="form_originalname">
                    <label for="originalnom">Nom Original</label>
                    <input name="originalName" type="text" value="{$this->escapeString($this->tvShow?->getOriginalName())}" required>
                </div>
                <div class="form_homepage">
                    <label for="accueilpage">HomePage</label>
                    <input name="homepage" type="text" value="{$this->escapeString($this->tvShow?->getHomepage())}" required>
                </div>
                <div class="form_overview">
                    <label for="description">Résumé</label>
                    <input name="overview" type="text" value="{$this->escapeString($this->tvShow?->getOverview())}" required>
                </div>
                <div class="form_poster">
                    <input name="posterId" type="hidden" value="{$this->tvShow?->getPosterId()}" >
                </div>
            <button type="submit">Enregistrer</button>
        </form>
HTML;

    }

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString() : void
    {
        if (isset($_POST['id']) && ctype_digit($_POST["id"])) {
            $id = $_POST['id'] ;
        } else {
            $id = null ;
        }
        if (!empty($_POST['name'])) {
            $name = $this->escapeString($this->stripTagsAndTrim($_POST['name']));
        } else {
            throw new ParameterException("Série non présente");
        }
        if (!empty($_POST['originalName'])) {
            $originalName = $this->escapeString($this->stripTagsAndTrim($_POST['originalName']));
        } else {
            throw new ParameterException("Nom original absent");
        }
        if (!empty($_POST['homepage'])) {
            $homepage = $this->escapeString($this->stripTagsAndTrim($_POST['homepage']));
        } else {
            throw new ParameterException("Site Accueil absent");
        }
        if (!empty($_POST['overview'])) {
            $overview = $this->escapeString($this->stripTagsAndTrim($_POST['overview']));
        } else {
            throw new ParameterException("Résumé absent");
        }
        if (isset($_POST['posterId']) && ctype_digit($_POST["posterId"])) {
            $posterId = $_POST['id'] ;
        } else {
            $posterId = null ;
        }

        $this->tvShow = TvShow::create($id,$name,$originalName,$homepage, $overview, $posterId);

    }
}