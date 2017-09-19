<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testAddcategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addCategory');
    }

    public function testShowcategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showCategory');
    }

    public function testShowallcategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showAllCategories');
    }

}
