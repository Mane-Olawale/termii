<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;
use Exception;

class TokenTest extends TestCase
{
    /**
     * Test for list method call
     */
    public function testSendTokenCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue($client->token->sendToken('2348147386362', '{token} if your verification token', [
            "attempts" => 10,
            "time_to_live" => 30,
            "length" => 6,
            "placeholder" => '{token}',
            'type' => 'ALPHANUMERIC',
        ], 'Olawale', 'generic')->toArray() == $mockedResponse);
    }

    /**
     * Test for list method call
     */
    public function testSendTokenCallWithNoSender()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Termii client doesn`t have a default Sender ID');

        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $client->token->sendToken('2348147386362', '{token} if your verification token', [
            "attempts" => 10,
            "time_to_live" => 30,
            "length" => 6,
            "placeholder" => '{token}',
            'type' => 'ALPHANUMERIC',
        ], null, 'generic');
    }

    /**
     * Test for list method call
     */
    public function testSendTokenCallWithNoChannel()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Termii client doesn`t have a default message channel');

        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $client->token->sendToken('2348147386362', '{token} if your verification token', [
            "attempts" => 10,
            "time_to_live" => 30,
            "length" => 6,
            "placeholder" => '{token}',
            'type' => 'ALPHANUMERIC',
        ], 'Olawale');
    }

    /**
     * Test for request method call
     */
    public function testVerifyCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                'verified' => true
            ]))
        );

        $this->assertTrue(
            ($res = $client->token->verify('bvkjbjbtrhvjtrhvkjrhtjvhbrsjhvfsrgfv', '123456'))->toArray() ==
            $mockedResponse
        );

        $verified = false;
        $res->onVerified(function ($res) use (&$verified) {
            $verified = true;
        });
        $this->assertTrue($verified);
    }

    /**
     * Test for request method call
     */
    public function testVerifyFailed()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                'verified' => false
            ]))
        );

        $this->assertTrue(
            ($res = $client->token->verify('bvkjbjbtrhvjtrhvkjrhtjvhbrsjhvfsrgfv', '123456'))->toArray() ==
            $mockedResponse
        );

        $verified = false;
        $res->onFailed(function ($res) use (&$verified) {
            $verified = true;
        });
        $this->assertTrue($verified);
    }

    /**
     * Test for request method call
     */
    public function testVerifyExpired()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(400, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                'verified' => 'Expired'
            ]))
        );

        $this->assertTrue(
            ($res = $client->token->verify('bvkjbjbtrhvjtrhvkjrhtjvhbrsjhvfsrgfv', '123456'))->toArray() ==
            $mockedResponse
        );

        $verified = false;
        $res->onExpired(function ($res) use (&$verified) {
            $verified = true;
        });
        $this->assertTrue($verified);
    }

    /**
     * Test for request method call
     */
    public function testVerifyNotFound()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(422, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                'errors' => []
            ]))
        );

        $this->assertTrue(
            ($res = $client->token->verify('bvkjbjbtrhvjtrhvkjrhtjvhbrsjhvfsrgfv', '123456'))->toArray() ==
            $mockedResponse
        );

        $this->assertTrue($res->notFound());
    }

    /**
     * Test for request method call
     */
    public function testSendInAppTokenCall()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $this->assertTrue(
            $client->token->sendInAppToken('2348147386362', [
                "attempts" => 10,
                "time_to_live" => 30,
                "length" => 6,
            ])->toArray() == $mockedResponse
        );
    }
}
