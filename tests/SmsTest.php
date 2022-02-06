<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;

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

        $this->assertTrue($client->sms->number('2347041945964', 'Lotus give me my phone') == $mockedResponse);
    }

    /**
     * Test for send method call
     */
    public function testCallSend()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->sms->send('2347041945964', 'Lotus give me my phone', 'Olawale', 'generic') ==
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
            $client->sms->template('2347041945964', '1493-csdn3-ns34w-sd3434-dfdf', [], 'Olawale') ==
            $mockedResponse
        );
    }
}
