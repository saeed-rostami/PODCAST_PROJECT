<?php

namespace Modules\PodcastApp\Traits;

trait JalaliDate
{
    public function jalaliCreatedAt(): string
    {
        return verta($this->created_at)->formatDifference();
    }
}
