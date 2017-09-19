<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testAddpost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addPost');
    }

    public function testShowpost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showPost');
    }

    public function testShowallposts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showAllPosts');
    }

    public function testEditpost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editPost');
    }

    public function testDeletepost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deletePost');
    }

}
