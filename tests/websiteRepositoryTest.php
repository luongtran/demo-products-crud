<?php

use App\Models\website;
use App\Repositories\websiteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class websiteRepositoryTest extends TestCase
{
    use MakewebsiteTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var websiteRepository
     */
    protected $websiteRepo;

    public function setUp()
    {
        parent::setUp();
        $this->websiteRepo = App::make(websiteRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatewebsite()
    {
        $website = $this->fakewebsiteData();
        $createdwebsite = $this->websiteRepo->create($website);
        $createdwebsite = $createdwebsite->toArray();
        $this->assertArrayHasKey('id', $createdwebsite);
        $this->assertNotNull($createdwebsite['id'], 'Created website must have id specified');
        $this->assertNotNull(website::find($createdwebsite['id']), 'website with given id must be in DB');
        $this->assertModelData($website, $createdwebsite);
    }

    /**
     * @test read
     */
    public function testReadwebsite()
    {
        $website = $this->makewebsite();
        $dbwebsite = $this->websiteRepo->find($website->id);
        $dbwebsite = $dbwebsite->toArray();
        $this->assertModelData($website->toArray(), $dbwebsite);
    }

    /**
     * @test update
     */
    public function testUpdatewebsite()
    {
        $website = $this->makewebsite();
        $fakewebsite = $this->fakewebsiteData();
        $updatedwebsite = $this->websiteRepo->update($fakewebsite, $website->id);
        $this->assertModelData($fakewebsite, $updatedwebsite->toArray());
        $dbwebsite = $this->websiteRepo->find($website->id);
        $this->assertModelData($fakewebsite, $dbwebsite->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletewebsite()
    {
        $website = $this->makewebsite();
        $resp = $this->websiteRepo->delete($website->id);
        $this->assertTrue($resp);
        $this->assertNull(website::find($website->id), 'website should not exist in DB');
    }
}
