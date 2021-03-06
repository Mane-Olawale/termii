<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;
use Exception;
use ManeOlawale\Termii\Api\Response\Insights\InboxResponse;

class SmsTest extends TestCase
{
    /**
     * Test for number method call
     */
    public function testCallNumber()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->sms->number('2347041945964', 'Lotus give me my phone')->toArray() ==
            $mockedResponse
        );
    }

    /**
     * Test for send method call
     */
    public function testCallSend()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                'message_id' => '597363836283389234'
            ]))
        );

        $this->assertTrue(
            ($res = $client->sms->send('2347041945964', 'Lotus give me my phone', 'Olawale', 'generic'))->toArray() ==
            $mockedResponse
        );

        $this->assertInstanceOf(InboxResponse::class, $res->message());
    }

    /**
     * Test for send method call
     */
    public function testCallSendWithNoSender()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Termii client doesn`t have a default Sender ID');

        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->sms->send('2347041945964', 'Lotus give me my phone', null, 'generic') ==
            $mockedResponse
        );
    }

    /**
     * Test for send method call
     */
    public function testCallSendWithNoChannel()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Termii client doesn`t have a default message channel');

        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->sms->send('2347041945964', 'Lotus give me my phone', 'Olawale') ==
            $mockedResponse
        );
    }

    /**
     * Test for template method call
     */
    public function testCallTemplate()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->sms->template('2347041945964', '1493-csdn3-ns34w-sd3434-dfdf', [], 'Olawale')->toArray() ==
            $mockedResponse
        );
    }
}
