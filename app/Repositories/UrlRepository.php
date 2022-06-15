<?php

namespace App\Repositories;

use App\Models\Url;
use App\Repositories\Base\BaseModelRepository;

class UrlRepository extends BaseModelRepository
{
    public function getModel(): string
    {
        return Url::class;
    }

    /**
     * @param string $shortUrl
     * @param array $columns
     * @return Url|null
     */
    public function findByShortUrl(string $shortUrl, array $columns = ['*']): ?Url
    {
        return $this->getModelClone()->newQuery()->where('short_url', $shortUrl)
                                                ->first($columns);
    }

    /**
     * @param string $shortUrl
     * @return Url
     */
    public function findByShortUrlOrFail(string $shortUrl, array $columns = ['*']): Url
    {
        return $this->getModelClone()->newQuery()->where('short_url', $shortUrl)
                                                ->firstOrFail($columns);
    }

    /**
     * @param string $shortUrl
     * @return boolean
     */
    public function shortUrlExists(string $shortUrl): bool
    {
        return $this->getModelClone()->newQuery()->where('short_url', $shortUrl)->exists();
    }
}