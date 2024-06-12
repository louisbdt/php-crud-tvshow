<?php

use Entity\Exception\ParameterException;
use Html\Form\TvShowForm;

try {
    $form = new TvShowForm();
    $form->setEntityFromQueryString();
    $form->getTvshow()->save();
    header('Location: /index.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}