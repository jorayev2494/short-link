<?php

namespace App\Services;

use App\Jobs\IncrementUrlVisitJob;
use App\Models\Url;
use App\Repositories\UrlRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ShortService
{

    public function __construct(
        private UrlRepository $urlRepository
    )
    {

    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->urlRepository->get(['client_url', 'short_url', 'visited_count']);
    }

    /**
     * @param array $data
     * @return Url
     */
    public function store(array $data): Url
    {
        $data = $this->makeUniqueShortUrl($data);

        return $this->urlRepository->create($data);
    }

    /**
     * @param string $shortUrl
     * @return Url
     */
    public function visit(string $shortUrl): Url
    {
        /** @var Url $foundVisitUrl */
        $foundVisitUrl = Cache::remember($shortUrl, now()->addHour(), function () use($shortUrl): Url {
            $foundVisitUrl = $this->urlRepository->findByShortUrlOrFail($shortUrl, ['client_url', 'short_url', 'visited_count']);

            return $foundVisitUrl;
        });

        IncrementUrlVisitJob::dispatch($shortUrl, $this->urlRepository)->onQueue('links');

        return $foundVisitUrl;
    }

    /**
     * @param array $data
     * @return array
     */
    private function makeUniqueShortUrl(array $data): array
    {
        $slug = \Str::random(5);
        $shortUrlExists = $this->urlRepository->shortUrlExists($slug);

        if (!$shortUrlExists) {
            return array_merge($data, ['short_url' => $slug]);
        } else {
            return $this->makeUniqueShortUrl($data);
        }
    }
}