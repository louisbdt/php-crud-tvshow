<?php

namespace Entity\Exception;

/**
* Classe exception, permet de lancer une EntityNotFoundException quand un Id n'est pas trouvé
 * Hérite de la classe OutOfBoundsException
 */
class EntityNotFoundException extends \OutOfBoundsException
{
}