<?php
declare(strict_types=1);

namespace App\Shrt\Domain;

use JsonSerializable;

class ShrtItem implements JsonSerializable
{
    private $uid;
    private $url;
    private $status;
    private $created;
    private $updated;

    public function __construct(?string $uid, string $url, int $status, string $created, string $updated)
    {
        $this->uid = $uid;
        $this->url = $url;
        $this->status = $status;
        $this->created = $created;
        $this->updated = $updated;
    }

    /**
     * @return string|null
     */
    public function getUid(): ?string
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
