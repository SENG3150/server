<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class ModelControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group modelController
 */
class ModelControllerTest extends TestCase
{
    public function testGetList(){
        $this->actingAsAdministrator()
            ->json('GET', '/models')
            ->seeJson(
                [
                'name' => '4100 XPC-AC Shovel'
                ]
            );
    }

    public function testGet(){
        $this->actingAsAdministrator()
            ->json('GET', '/models/1')
            ->seeJson(
                [
                    'name' => '4100 XPC-AC Shovel'
                ]
            );
    }

    public function testCreate(){
        $name =  str_random();
        $this->actingAsAdministrator()->json(
            'POST',
            '/models',
            [
                'name' => $name
            ]
        )->assertResponseStatus(201);
    }
    public function testUpdate(){
        $name =  str_random();
        $this->actingAsAdministrator()->json(
            'POST',
            '/models/1',
            [
                'name' => $name
            ]
        )->assertResponseStatus(202);
        $this->actingAsAdministrator()
            ->json('GET', '/models/1')
            ->seeJson(
                [
                    'name' => $name
                ]
            );
    }

    public function testDelete()
    {
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'models/1')
            ->assertResponseStatus(202);
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'models/1')
            ->json('GET', 'models/1')
            ->assertResponseStatus(404);
    }
}