<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Site extends Model implements Sortable, HasMediaConversions
{
    use HasSlug, SortableTrait, HasMediaTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $guarded = [];

    /**
     * A site can have many code samples.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codeSamples()
    {
        return $this->hasMany(CodeSample::class);
    }

    /**
     * A site can have many tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'site_tags');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('browser')
            ->crop(Manipulations::CROP_TOP, 2880, 1800)
            ->optimize();
    }
}
