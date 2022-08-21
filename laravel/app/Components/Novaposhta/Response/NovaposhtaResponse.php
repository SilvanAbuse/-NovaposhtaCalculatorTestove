<?php
namespace App\Components\Novaposhta\Response;

class NovaposhtaResponse
{
    private $items;
    private $errors;
    private $info;
    private $currentPage = 1;
    private $perPage = 150;

    /**
     * NovaposhtaResponse constructor.
     * @param $items
     * @param $errors
     * @param $info
     */
    public function __construct($items, $errors, $info)
    {
        $this->items = $items;
        $this->errors = $errors;
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return mixed
     */
    public function getFirstItem()
    {
        return $this->items[0];
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return bool
     */
    public function hasItems(): bool
    {
        return !empty($this->items);
    }

    /**
     * @return int
     */
    public function getItemsCount(): int
    {
        return count($this->items);
    }

    /**
     * @return int
     */
    public function getTotalResultsCount(): int
    {
        return $this->info['totalCount'] ?? 0;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        $totalResults = $this->getTotalResultsCount();

        if ($totalResults !== 0) {
            return ceil($totalResults / $this->perPage);
        }

        return 0;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setCurrentPage(int $page = 1): self
    {
        $this->currentPage = $page;
        return $this;
    }
}
