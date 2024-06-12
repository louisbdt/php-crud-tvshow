<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Exception\EntityNotFoundException;

/**
 *  Classe de l'entité TvShow
 */

class TvShow
{

    /**
     * @var int|null
     */
    private ?int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $originalName;

    /**
     * @var string
     */
    private string $homepage;

    /**
     * @var string
     */
    private string $overview;

    /**
     * @var int|null
     */
    private ?int $posterId;

    /**
     * Getter de id
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter de name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Getter de originalName
     * @return string
     */
    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    /**
     * Getter de homepage
     * @return string
     */
    public function getHomepage(): string
    {
        return $this->homepage;
    }

    /**
     * Getter de overview
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Getter de posterId
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Permet de trouver une série à partir de son Id, si la série est absente, alors on lance une EntityNotFoundException
     * @param int|null $id
     * @return TvShow
     */
    public static function findById(?int $id): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name, originalName, homepage, overview, posterId
                FROM tvshow
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $showId = $stmt->fetchObject(TvShow::class);
        if ($showId === false) {
            throw new EntityNotFoundException("Série introuvable");
        }
        return $showId;

    }

    /**
     * Getter de saison
     * @return array
     */
    public function getSeason(): array
    {
        return SeasonCollection::findByTvshowId($this->id);
    }

    /**
     * Setter de l'id
     * @param int|null $id
     * @return void
     */
    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Setter de name
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Setter de l'originalName
     * @param string $originalName
     * @return void
     */
    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    /**
     * Setter d'homepage
     * @param string $homepage
     * @return void
     */
    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    /**
     * Setter de overview
     * @param string $overview
     * @return void
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    /**
     * Setter de posterId
     * @param int $posterId
     * @return void
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * Permet de modifier les caractéristiques d'une série
     * @return $this
     */
    protected function update(): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<< 'SQL'
            UPDATE tvshow
            SET name = :name,
                originalName = :originalName,
                homepage = :homepage,
                overview = :overview
            WHERE id = :id
            SQL
        );
        $stmt->execute(
            [':id' => $this->getId(),
                ':name' => $this->getName(),
                ':originalName' => $this->getOriginalName(),
                ':homepage' => $this->getHomepage(),
                ':overview' => $this->getOverview()
            ]
        );
        return $this;
    }

    /**
     * Permet de supprimer une série de la base de données en mettant l'id à null
     * @return $this
     */
    public function delete(): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<< 'SQL'
            DELETE 
            FROM tvshow
            WHERE id = :id
            SQL
        );
        $stmt->execute([':id' => $this->getId()]);
        $this->setId(null);
        return $this;
    }

    /**
     * Permet de créer une série avec ses caractéristiques
     * @param string $name
     * @param int|null $id
     * @param string $originalName
     * @param string $homepage
     * @param string $overview
     * @param int|null $posterId
     * @return TvShow
     */
    public static function create(string $name, ?int $id = null, string $originalName, string $homepage, string $overview, ?int $posterId = null): TvShow
    {
        $tvshow = new TvShow();
        $tvshow->setId($id);
        $tvshow->setName($name);
        $tvshow->setOriginalName($originalName);
        $tvshow->setHomepage($homepage);
        $tvshow->setOverview($overview);
        return $tvshow;
    }

    /**
     * Permet d'insérer une série dans la base de données avec ses caractéristiques. L'identifiant est le dernier identifiant créé par la base de données
     * @return $this
     */
    protected function insert(): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            INSERT INTO tvshow (name, originalName, homepage, overview)
            VALUES (:name, :originalName, :homepage, :overview)
            SQL
        );
        $stmt->execute([
            ':name' => $this->getName(),
            ':originalName' => $this->getOriginalName(),
            ':homepage' => $this->getHomepage(),
            ':overview' => $this->getOverview()
        ]);
        $this->setId((int)MyPdo::getInstance()->lastInsertId());
        return $this;
    }

    /**
     * Déclenche insert() ou update() selon que la valeur de id est respectivement null ou non
     * @return $this
     */
    public function save(): TvShow
    {
        if ($this->getId() == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }


}
