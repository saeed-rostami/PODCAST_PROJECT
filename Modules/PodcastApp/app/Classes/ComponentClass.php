<?php

namespace Modules\PodcastApp\Classes;

use Modules\PodcastApp\Abstracts\BaseComponentAbstract;

class ComponentClass extends BaseComponentAbstract
{

    public function view(): object
    {
        return $this->getQuery();
    }
}
