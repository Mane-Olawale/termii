<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;

class InsightsTest extends TestCase
{
    /**
     * Test for balance method call
     */
    public function testBalanceCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue($client->insights->balance() == $mockedResponse);
    }

    /**
     * Test for search method call
     */
    public function testSearchCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->insights->search('2348147386362') == $mockedResponse
        );
    }

    /**
     * Test for isDnd method call
     */
    public function testIsDndCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'dnd_active' => true
            ]))
        );

        $this->assertTrue(
            $client->insights->isDnd('2348147386362')
        );
    }

    /**
     * Test for isNotDnd method call
     */
    public function testIsNotDndCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode([
                'dnd_active' => false
            ]))
        );

        $this->assertTrue(
            $client->insights->isNotDnd('2348147386362')
        );
    }

    /**
     * Test for number method call
     */
    public function testNumberCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->insights->number('2348147386362') == $mockedResponse
        );
    }

    /**
     * Test for inbox method call
     */
    public function testInboxCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->insights->inbox() == $mockedResponse
        );
    }

    /**
     * @testdox Test for inbox method call
     */
    public function testInboxCallWithMessageId()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->insights->inbox('2348147386362') == $mockedResponse
        );
    }
}
