<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function testAddcomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addComment');
    }

    public function testShowcomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showComment');
    }

    public function testShowallcomments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showAllComments');
    }

    public function testEditcomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editComment');
    }

    public function testDeletecomment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteComment');
    }

}
