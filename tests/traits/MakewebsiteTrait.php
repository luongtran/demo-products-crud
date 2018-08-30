<?php

use Faker\Factory as Faker;
use App\Models\website;
use App\Repositories\websiteRepository;

trait MakewebsiteTrait
{
    /**
     * Create fake instance of website and save it in database
     *
     * @param array $websiteFields
     * @return website
     */
    public function makewebsite($websiteFields = [])
    {
        /** @var websiteRepository $websiteRepo */
        $websiteRepo = App::make(websiteRepository::class);
        $theme = $this->fakewebsiteData($websiteFields);
        return $websiteRepo->create($theme);
    }

    /**
     * Get fake instance of website
     *
     * @param array $websiteFields
     * @return website
     */
    public function fakewebsite($websiteFields = [])
    {
        return new website($this->fakewebsiteData($websiteFields));
    }

    /**
     * Get fake data of website
     *
     * @param array $postFields
     * @return array
     */
    public function fakewebsiteData($websiteFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $websiteFields);
    }
}
