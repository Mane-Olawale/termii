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
                'data' => [
                    [
                        'sender_id' => 'Dummy inc',
                        'status' => 'unblock',
                        'company' => 'Dummy inc',
                        'usecase' => null,
                        'country' => null,
                        'created_at' => '2021-03-29 16:51:53'
                    ],
                    [
                        'sender_id' => 'ACME Key',
                        'status' => 'unblock',
                        'company' => 'ACME',
                        'usecase' => null,
                        'country' => null,
                        'created_at' => '2021-03-29 16:51:53'
                    ]
                ]
            ]))
        );

        $this->assertTrue($client->sender->list()->toArray() == $mockedResponse);
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
            $client->sender->request('Olawale', 'Friendship based notification', 'Olawale INC')->toArray() ==
            $mockedResponse
        );
    }
}
