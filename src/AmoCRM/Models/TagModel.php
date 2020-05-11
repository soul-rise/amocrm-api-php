<?php

namespace AmoCRM\Models;

use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\RequestIdTrait;
use Illuminate\Contracts\Support\Arrayable;

class TagModel extends BaseApiModel implements Arrayable, HasIdInterface
{
    use RequestIdTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param array $tag
     *
     * @return self
     */
    public static function fromArray(array $tag): self
    {
        $model = new self();

        $model->setId($tag['id']);
        $model->setName($tag['name']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi(?string $requestId = null): array
    {
        $result = [];

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }
}