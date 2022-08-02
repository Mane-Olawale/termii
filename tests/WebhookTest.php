<?php

namespace ManeOlawale\Termii\Tests;

use GuzzleHttp\Psr7\Response;
use ManeOlawale\Termii\Client;
use ManeOlawale\Termii\Webhook;
use stdClass;

class WebhookTest extends TestCase
{
    /**
     * Test for out bound webhooks
     */
    public function testOutboundWebhook()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );
        Webhook::loader(function () {
            $this->raw = '{"type":"outbound","message_id":"902022080211300900000078460","message_id_str":"902022080211300900000078460","receiver":"2348147386362","sender":"MAlert","message":"Hi there, testing Gotrade","sent_at":"2022-08-02 11:30:11","cost":"3.9","pages":"1","command":"deliver","status":"DELIVERED | Message delivered to handset","channel":"DND","msgtype":5,"origid":"902022080211300900000078460","messagestate":"Delivered","notify_id":"902022080211300900000078460"}';
            $this->object = @json_decode($this->raw);
            $this->event = $this->object->type;
            $this->data = @json_decode($this->raw, true);
            $this->signature = '579043641c936fc8ce54c0ec4a8f00c09a288334516bbf426757cd19f602eded76bdd5419b63a158b73a1f3409e2a9677a4b0e17cf13d30b4bf8a9d0000c730f';
        });

        $run = 0;

        $webhook = Webhook::create($client);

        $webhook->on(
            'outbound',
            function (Client $termii, string $event, stdClass $object, $array) use (&$run, &$client) {
                $run += 1;
                $this->assertSame($event, 'outbound');
                $this->assertTrue($termii === $client);
                $this->assertSame($object->type, 'outbound');
                $this->assertSame($object->message_id, '902022080211300900000078460');
                $this->assertSame($array['type'], 'outbound');
            }
        );

        $webhook->on(
            'outbound',
            function (Client $termii, string $event, stdClass $object, $array) use (&$run, &$client) {
                $run += 1;
            }
        );

        $webhook->listen();

        $this->assertSame(2, $run);
    }

    /**
     * Test for out bound webhooks
     */
    public function testWrongSignature()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );

        $run = 0;

        $webhook = (new Webhook($client))->load(function () {
            $this->raw = '{"type":"outbound","message_id":"902022080211300900000078460","message_id_str":"902022080211300900000078460","receiver":"2348147386362","sender":"MAlert","message":"Hi there, testing Gotrade","sent_at":"2022-08-02 11:30:11","cost":"3.9","pages":"1","command":"deliver","status":"DELIVERED | Message delivered to handset","channel":"DND","msgtype":5,"origid":"902022080211300900000078460","messagestate":"Delivered","notify_id":"902022080211300900000078460"}';
            $this->object = @json_decode($this->raw);
            $this->event = $this->object->type;
            $this->data = @json_decode($this->raw, true);
            $this->signature = '57903d30b4bf8a9d0000c730f';
        });

        $webhook->on(
            'outbound',
            function () use (&$run) {
                $run += 1;
            }
        );

        $webhook->listen();

        $this->assertSame(0, $run);
    }

    /**
     * Test for out bound webhooks
     */
    public function testDeviceStatusWebhook()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );
        Webhook::loader(function () {
            $this->raw = '{"type":"device_status","status":"disconnected","device_id":"e0c5a9b-0136-4751-9be9-a3c9zzTc0a19","name":"TermiiWh"}';
            $this->object = @json_decode($this->raw);
            $this->event = $this->object->type;
            $this->data = @json_decode($this->raw, true);
            $this->signature = 'd2bfb273337810306a0508e8435fae6aff129869aa995e94a96848b62f547fa20a4ad4d3433e8b7d7322f819b6eb6e5b40fed88df67048aeba0ecfc060c2d3b7';
        });

        $run = 0;

        $webhook = Webhook::create($client);

        $webhook->on(
            'device_status',
            function (Client $termii, string $event, stdClass $object, $array) use (&$run, &$client) {
                $run += 1;
                $this->assertSame($event, 'device_status');
                $this->assertTrue($termii === $client);
                $this->assertSame($object->type, 'device_status');
                $this->assertSame($object->device_id, 'e0c5a9b-0136-4751-9be9-a3c9zzTc0a19');
                $this->assertSame($array['type'], 'device_status');
            }
        );

        $webhook->listen();

        $this->assertSame(1, $run);
    }

    /**
     * Test for out bound webhooks
     */
    public function testInboundWebhook()
    {
        $client = $this->getClientWithMockedResponse(
            new Response(200, ['Content-Type' => 'application/json'], json_encode($mockedResponse = [
                //
            ]))
        );
        Webhook::loader(function () {
            $this->raw = '{"type":"inbound","id":"8248611476370959318","message_id":"3905204342778053556","receiver":"12022214836","sender":"2347069549231","message":"Great ","received_at":"2020-12-16T10:51:03.000000Z","cost":null,"command":"Received","status":"Received","channel":null}';
            $this->object = @json_decode($this->raw);
            $this->event = $this->object->type;
            $this->data = @json_decode($this->raw, true);
            $this->signature = 'c4bcdc81398253529f5b739baf26d90b8bcc93409a5931a77171198a670750426bcf73feb037dfb215fe0cd0f52bca76302fe7ac562b50c9af78571cdaeb9e35';
        });

        $run = 0;

        $webhook = Webhook::create($client);

        $webhook->on(
            'inbound',
            function (Client $termii, string $event, stdClass $object, $array) use (&$run, &$client) {
                $run += 1;
                $this->assertSame($event, 'inbound');
                $this->assertTrue($termii === $client);
                $this->assertSame($object->type, 'inbound');
                $this->assertSame($object->id, '8248611476370959318');
                $this->assertSame($array['type'], 'inbound');
            }
        );

        $webhook->on('outbound', function () use (&$run) {
            $run += 1;
        });

        $webhook->listen();

        $webhook->resetListeners();
        $webhook->listen();
        $webhook->reset();
        Webhook::resetloader();

        $this->assertSame(1, $run);
    }
}
