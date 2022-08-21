<?php

namespace App\Components\Novaposhta\Request;

class NovaposhtaRequest
{
    /**
     * api methods
     */
    const SETTLEMENTS_METHOD = 'getSettlements';
    const AREAS_METHOD = 'getAreas';
    const CITIES_METHOD = 'getCities';
    const STREET_METHOD = 'getStreet';
    const WAREHOUSE_METHOD = 'getWarehouses';
    const DOCUMENT_PRICE = 'getDocumentPrice';

    /**
     * Model names
     */
    const ADDRESS_GENERAL_MODEL = 'AddressGeneral';
    const ADDRESS_MODEL = 'Address';
    const INTERNET_DOCUMENT = 'InternetDocument';

    /**
     * @var string
     */
    private $modelName;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $properties;

    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->modelName;
    }

    /**
     * @param string $modelName
     * @return $this
     */
    public function setModelName(string $modelName): self
    {
        $this->modelName = $modelName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return array
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     * @return $this
     */
    public function setProperties(array $properties = []): self
    {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setPage($page = 1): self
    {
        $this->properties['Page'] = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->properties['Page'] ?? 1;
    }
}
