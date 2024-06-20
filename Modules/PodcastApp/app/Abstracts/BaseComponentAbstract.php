<?php

namespace Modules\PodcastApp\Abstracts;

use Modules\PodcastApp\Interfaces\ComponentInterface;

abstract class BaseComponentAbstract implements ComponentInterface
{

    private object $query;
    private string $key;
    private string $class;
    private string $url;
    private string $display_key;
    private int $sort_order;
    private bool $is_active;


    public function __construct($query)
    {
        $this->query = $query;
    }

    public function render()
    {
        $data = [
            "key" => $this->key,
            "display_key" => $this->display_key,
            "url" => $this->url,
            "class" => $this->class,
            "is_active" => $this->is_active,
            "sort_order" => $this->sort_order,
            "items" => $this->getQuery()
        ];

        return $data;
    }

    public function getQuery()
    {

        return $this->query;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;
        return $this;
    }

    public function setSortOrder(int $sort_order): static
    {
        $this->sort_order = $sort_order;
        return $this;

    }

    public function setDisplayKey(string $display_key): static
    {
        $this->display_key = $display_key;
        return $this;

    }

    public function setUrl(string $url): static
    {
        $this->url = $url;
        return $this;

    }

    public function setClass(string $class): static
    {
        $this->class = $class;
        return $this;
    }

    public function setKey(string $key)
    {
        $this->key = $key;
        return $this;
    }
}
