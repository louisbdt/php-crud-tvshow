<?php

use Entity\Exception\ParameterException;

try {
    $form = new \Html\Form\TvShowForm();
    $form->setEntityFromQueryString();
    $form->getTvshow()->save();
    header('Location: /index.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}