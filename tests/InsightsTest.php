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

        $this->assertTrue($client->insights->balance()->toArray() == $mockedResponse);
    }

    /**
     * Test for search method call
     */
    public function testSearchCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                'dnd_active' => true
            ]))
        );

        $this->assertTrue(
            ($res = $client->insights->search('2348147386362'))->toArray() == $mockedResponse
        );
        $this->assertTrue($res->dnd());
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
            $client->insights->number('2348147386362')->toArray() == $mockedResponse
        );
    }

    /**
     * Test for inbox method call
     */
    public function testInboxCall()
    {
        $mockedResponse = json_decode($json = '{
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "sender": "MAlert",
                        "receiver": "2348164015051",
                        "country_code": 234,
                        "message": "0945 is your phone number Authentication code.",
                        "amount": 1,
                        "reroute": 0,
                        "api_key": "TLkoqbdD2OvAZ2FuOSTFMMuF1KeBh7mDQuUp8BmDB8bcrPqEyDTCpg22tuZANK",
                        "status": "Delivered",
                        "sms_type": "plain",
                        "send_by": "api",
                        "media_url": null,
                        "message_id": "5863062722362787045",
                        "notify_url": "https:\/\/11b1ebadd77a.ngrok.io\/termii\/webhook",
                        "notify_id": null,
                        "created_at": "2022-02-22 15:13:44"
                    },
                    {
                        "sender": "MAlert",
                        "receiver": "2348164015051",
                        "country_code": 234,
                        "message": "0945 is your phone number Authentication code.",
                        "amount": 1,
                        "reroute": 0,
                        "api_key": "TLkoqbdD2OvAZ2FuOSTFMMuF1KeBh7mDQuUp8BmDB8bcrPqEyDTCpg22tuZANK",
                        "status": "Delivered",
                        "sms_type": "plain",
                        "send_by": "api",
                        "media_url": null,
                        "message_id": "5863062722362787048",
                        "notify_url": "https:\/\/11b1ebadd77a.ngrok.io\/termii\/webhook",
                        "notify_id": null,
                        "created_at": "2022-02-22 15:13:44"
                    }
                ],
                "first_page_url": "http:\/\/api.ng.termii.com\/api\/sms\/inbox?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http:\/\/api.ng.termii.com\/api\/sms\/inbox?page=1",
                "next_page_url": null,
                "path": "http:\/\/api.ng.termii.com\/api\/sms\/inbox",
                "per_page": 15,
                "prev_page_url": null,
                "to": 1,
                "total": 1
            }
        }', true);

        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], $json)
        );

        $this->assertTrue(
            ($res = $client->insights->inbox())->toArray() == $mockedResponse
        );
        $this->assertSame(2, count($res));
    }

    /**
     * @testdox Test for inbox method call
     */
    public function testInboxCallWithMessageId()
    {
        $mockedResponse = json_decode($json = '{
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "sender": "MAlert",
                        "receiver": "2348164015051",
                        "country_code": 234,
                        "message": "0945 is your phone number Authentication code.",
                        "amount": 1,
                        "reroute": 0,
                        "api_key": "TLkoqbdD2OvAZ2FuOSTFMMuF1KeBh7mDQuUp8BmDB8bcrPqEyDTCpg22tuZANK",
                        "status": "Delivered",
                        "sms_type": "plain",
                        "send_by": "api",
                        "media_url": null,
                        "message_id": "5863062722362787048",
                        "notify_url": "https:\/\/11b1ebadd77a.ngrok.io\/termii\/webhook",
                        "notify_id": null,
                        "created_at": "2022-02-22 15:13:44"
                    }
                ],
                "first_page_url": "http:\/\/api.ng.termii.com\/api\/sms\/inbox?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http:\/\/api.ng.termii.com\/api\/sms\/inbox?page=1",
                "next_page_url": null,
                "path": "http:\/\/api.ng.termii.com\/api\/sms\/inbox",
                "per_page": 15,
                "prev_page_url": null,
                "to": 1,
                "total": 1
            }
        }', true);

        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], $json)
        );

        $this->assertTrue(
            ($res =  $client->insights->inbox('5863062722362787048'))->toArray() == $mockedResponse
        );
        $this->assertSame(1, count($res));
    }
}
