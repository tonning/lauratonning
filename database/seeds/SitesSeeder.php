<?php

use App\CodeSample;
use App\Site;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addSite('Audition Hero', 'https://auditionherohq.com', [
            'Laravel', 'Vue.js', 'MySQL', 'Nginx', 'Redis', 'Beanstalk', 'Stylus',
        ],
            'Tasked with the challenge to create a booking platform to connect freelancers with performers, I created a comprehensive booking solution featuring a SPA booking scheduler that includes time slot selection, file uploads, secure payment, and more.'
        );

        $this->addSite('Sonotes', 'https://sonotes.com', [
            'Laravel', 'Vue.js', 'MySQL', 'TDD', 'Nginx', 'Redis', 'Beanstalk', 'S3', 'Bulma', 'Sass',
        ], 'Designing and building the sonotes.com platform from the ground up gave me the freedom and opportunity to dive deep into some of the newest technologies and frameworks available, and utilize test-driven development.');

        $this->addSite('ActorDash', 'https://actordash.com', [
            'Laravel', 'Vue.js', 'MySQL', 'Nginx', 'Scss'
        ], 'Initially build as a WordPress application, but I quickly migrated it over to Laravel as soon as we wanted to expanded on the feature set.');

        $this->addSite('Clubhouse', 'http://clubhouse.team', [
            'Laravel', 'Vue.js', 'Sass',
        ], 'A personal side project of mine. A SASS for soccer team management. I play in various soccer leagues and we tried a bunch of the existing solutions out there and they are either terrible or bare okay, so I thought this would be a great way to learn more about Laravel Spark and leverage that.');

        $this->addSite('I\'ve Got Diamonds', '#', [
            'Laravel', 'jQuery', 'MySQL', 'Beanstalk', 'Scss', 'External API integration'
        ], 'A completely build custom webshop for a very specific checkout flow.');

        $this->addSite('Boligcon', 'http://boligcon.dk', [
            'Laravel', 'Vue.js', 'MySQL', 'Scss'
        ], 'Client needed a better CMS than their current WordPress installation, so rebuild the site up from the ground in Laravel.');

        $this->addSite('Cratebuddy', 'http://cratebuddy.dk', [
            'Laravel', 'Vanila JavaScript', 'MySQL', 'Nginx', 'Redis', 'Beanstalk',
        ], 'A Danish box subscription like Lootcrate.com. Integrates with Stripe\'s API to leverage plans, customers, subscriptions, and coupons.');

        $this->addSite('Free Spins Top 10', 'http://freespinstop10.com', [
            'Laravel', 'MySQL', 'jQuery', 'Custom Ubuntu server',
        ]);

        $this->addSite('Mourning Light Concierce', 'https://mourninglightconcierge.com', [
            'Laravel', 'Vanilla JavaScript'
        ]);

        $this->addSite('Trap Danmark', 'https://trap.dk', [
            'WordPress',
        ]);

    }

    /**
     * Add a new site and attach any available media to it.
     *
     * @param $name
     * @param null $url
     * @param array|null $tags
     * @param null $description
     *
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function addSite($name, $url = null, array $tags = null, $description = null)
    {
        $site = Site::create([
            'name' => $name,
            'url' => $url,
            'description' => $description,
        ]);

        $this->addMedia($site);

        $this->addTags($site, $tags);

        $this->addCodeSamples($site);

        return $site;
    }

    /**
     * Find and attach media for site.
     *
     * @param $site
     */
    protected function addMedia(Site $site)
    {
        foreach (Storage::disk('portfolio')->files("{$site->slug}/media") as $file) {
            if (str_contains($file, '.DS_Store')) {
                continue;
            }

            $collection = str_contains($file, '00') ? 'featured' : 'default';

            $caption = Caption::forMedia($file, $site->slug, $titleCase = $collection == 'featured');

            $site->addMedia(storage_path("portfolio/{$file}"))
                ->preservingOriginal()
                ->withCustomProperties(['caption' => $caption])
                ->toMediaCollection($collection);
        }
    }

    /**
     * Add tags to site.
     *
     * @param Site $site
     * @param array|null $tags
     */
    protected function addTags(Site $site, array $tags = null)
    {
        $tags = collect($tags)->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $site->tags()->sync($tags);
    }

    /**
     * Add code samples to site.
     *
     * @param $site
     */
    protected function addCodeSamples($site)
    {
        foreach (Storage::disk('portfolio')->files("{$site->slug}/code-samples") as $file) {
            if (str_contains($file, '.DS_Store')) {
                continue;
            }

            $filename = str_replace("{$site->slug}/code-samples/", "", $file);

            preg_match_all("/[0-9]{2}-([a-zA-Z]+)-([a-zA-Z_-]+(\.[a-zA-Z]+)?).txt/", $filename, $filenameArray);

            $language = $filenameArray[1][0];
            $filename = $filenameArray[2][0];

            $sample = new CodeSample([
                'snippet' => $snippet = Storage::disk('portfolio')->get($file),
                'language' => $language,
                'caption' => Caption::forCodeSample($snippet, $filename),
            ]);

            $site->codeSamples()->save($sample);
        }
    }
}

class Caption
{
    protected $caption;

    /**
     * Convert a filepath to a caption.
     *
     * @param $filepath
     * @param $site
     * @param bool $titleCase
     *
     * @return mixed
     */
    public static function forMedia($filepath, $site, $titleCase = false)
    {
        $model = new self();

        $model->caption = $filepath;

        $model->removePath($site, 'media')
            ->removeNumbering()
            ->removeExtenstion()
            ->unsluggify()
            ->capitalize($titleCase);

        return $model->caption;
    }

    /**
     * Find the PHP DocBlock description and use that as the caption.
     *
     * @param $snippet
     * @param $filename
     *
     * @return null
     */
    public static function forCodeSample($snippet, $filename)
    {
        $caption = new self();

        if ($caption->isClassSnippet($snippet)) {
            $surfix = $caption->isModelClass($snippet) ? ' model': '';

            return "{$caption->getClassName($snippet)}{$surfix}";
        }

        return (new self())->findInPhpDocBlock($snippet) ?: $filename;
    }

    /**
     * Remove the path.
     *
     * @param $site
     * @param $type
     *
     * @return $this
     */
    protected function removePath($site, $type)
    {
        $this->caption = str_replace("{$site}/{$type}/", '', $this->caption);

        return $this;
    }

    /**
     * Remove numbering.
     *
     * @return $this
     */
    protected function removeNumbering()
    {
        $this->caption = substr($this->caption, 3);

        return $this;
    }

    /**
     * Remove file extension.
     *
     * @return $this
     */
    protected function removeExtenstion()
    {
        $this->caption = preg_replace("/\.(?:jpe?g|png|gif|txt)$/", "", $this->caption);

        return $this;
    }

    /**
     * Unsluggify the caption.
     *
     * @return $this
     */
    protected function unsluggify()
    {
        $this->caption = str_replace('-', ' ', $this->caption);

        return $this;
    }

    /**
     * Capitalize the caption.
     *
     * @param $titleCase
     *
     * @return $this
     */
    protected function capitalize($titleCase)
    {
        if ($titleCase) {
            $this->caption = ucwords($this->caption);
        } else {
            $this->caption = ucfirst($this->caption);
        }

        return $this;
    }

    /**
     * Find method description in PHP DocBlock.
     *
     * @param $snippet
     *
     * @return null
     */
    protected function findInPhpDocBlock($snippet)
    {
        preg_match_all("/\/\*\*\n\s+\*\s([[:alnum:]\s\.?]+)\n/", $snippet, $phpBlockCommentArray);

        return $phpBlockCommentArray[1][0] ?? null;
    }

    /**
     * Get the snippet's class name.
     *
     * @param $snippet
     *
     * @return mixed
     * @throws Exception
     */
    protected function getClassName($snippet)
    {
        preg_match("/class\s([a-zA-Z]+)/", $snippet, $output_array);

        if (!isset($output_array[1])) {
            throw new Exception('Class name not found.');
        }

        return $output_array[1];
    }

    /**
     * Check it's a class snippet.
     *
     * @param $snippet
     *
     * @return array
     */
    protected function isClassSnippet($snippet)
    {
        return preg_grep("/class\s([a-zA-Z]+)/", explode("\n", $snippet));
    }

    /**
     * Check it's a model class snippet.
     *
     * @param $snippet
     *
     * @return array
     */
    protected function isModelClass($snippet)
    {
        return preg_grep("/class\s([a-zA-Z]+)\sextends\sModel/", explode("\n", $snippet));
    }
}
