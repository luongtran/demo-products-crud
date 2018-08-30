<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class websiteApiTest extends TestCase
{
    use MakewebsiteTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatewebsite()
    {
        $website = $this->fakewebsiteData();
        $this->json('POST', '/api/v1/websites', $website);

        $this->assertApiResponse($website);
    }

    /**
     * @test
     */
    public function testReadwebsite()
    {
        $website = $this->makewebsite();
        $this->json('GET', '/api/v1/websites/'.$website->id);

        $this->assertApiResponse($website->toArray());
    }

    /**
     * @test
     */
    public function testUpdatewebsite()
    {
        $website = $this->makewebsite();
        $editedwebsite = $this->fakewebsiteData();

        $this->json('PUT', '/api/v1/websites/'.$website->id, $editedwebsite);

        $this->assertApiResponse($editedwebsite);
    }

    /**
     * @test
     */
    public function testDeletewebsite()
    {
        $website = $this->makewebsite();
        $this->json('DELETE', '/api/v1/websites/'.$website->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/websites/'.$website->id);

        $this->assertResponseStatus(404);
    }
}
