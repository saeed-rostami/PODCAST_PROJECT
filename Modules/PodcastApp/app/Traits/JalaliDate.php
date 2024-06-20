<?php

namespace Modules\PodcastApp\Traits;

trait JalaliDate
{
    public function jalaliCreatedAt(): string
    {
        return verta($this->created_at)->formatDifference();
    }


    public function jalaliPublishAt(): string
    {
        return verta($this->publish_at)->formatDifference();
    }

    public function jalaliPublishedAt(): string
    {
        return verta($this->published_at)->formatDifference();
    }
}
