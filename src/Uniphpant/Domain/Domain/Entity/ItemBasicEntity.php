<?php
declare(strict_types=1);

namespace App\Shrt\Domain\Entity;

use App\Uniphant\Domain\Entity\BasicEntity;

/**
 * Class ItemBasicEntity
 * @package App\Shrt\Domain\Entity
 */
class ItemBasicEntity extends BasicEntity
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $status;

    /**
     * @var string|null
     */
    private $date_created;

    /**
     * @var string|null
     */
    private $date_updated;

    /**
     * @param int|null      $id
     * @param int|null      $status
     * @param string|null   $date_created
     * @param string|null   $date_updated
     */
    public function __construct(?int $id, ?int $status, ?string $date_created, ?string $date_updated)
    {
        $this->id = $id;
        $this->status = $status;
        $this->date_created = $date_created;
        $this->date_updated = $date_updated;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return BasicEntity
     */
    public function setId(?int $id): BasicEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     * @return BasicEntity
     */
    public function setStatus(?int $status): BasicEntity
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->date_created;
    }

    /**
     * @param string|null $date_created
     * @return BasicEntity
     */
    public function setDateCreated(?string $date_created): BasicEntity
    {
        $this->date_created = $date_created;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->date_updated;
    }

    /**
     * @param string|null $date_updated
     * @return BasicEntity
     */
    public function setDateUpdated(?string $date_updated): BasicEntity
    {
        $this->date_updated = $date_updated;
        return $this;
    }

}
