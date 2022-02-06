<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;

class SenderTest extends TestCase
{
    /**
     * Test for list method call
     */
    public function testCallList()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue($client->sender->list() == $mockedResponse);
    }

    /**
     * Test for request method call
     */
    public function testCallRequest()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->sender->request('Olawale', 'Friendship based notification', 'Olawale INC') ==
            $mockedResponse
        );
    }
}
