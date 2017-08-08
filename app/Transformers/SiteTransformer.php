<?php

namespace App\Transformers;

use App\Site;
use League\Fractal\TransformerAbstract;

class SiteTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Site $site
     *
     * @return array
     */
    public function transform(Site $site)
    {
        return [
            'id' => $site->id,
            'name' => $site->name,
            'description' => $site->description,
            'url' => $site->url,
            'media' => [
                'featured' => $site->getFirstMediaUrl('featured', 'browser')
            ],
            'tags' => $site->tags,
        ];
    }
}
