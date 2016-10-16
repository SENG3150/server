<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class MachineControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group machineController
 * @group controller
 */
class MachineControllerTest extends TestCase
{
    public function testGetList(){
        $this->actingAsAdministrator()
            ->json('GET' , 'machines')
            ->seeJson(
                [
                    'name' => 'Machine 1'
                ]
            );
    }

    public function testGet(){
        $this->actingAsAdministrator()
             ->json('GET' , 'machines/1')
             ->seeJson(
                 [
                  'name' => 'Machine 1'
                 ]
             );
    }

    public function testCreate(){
        $name = str_random(10);
        $model = 1;

        $this->actingAsAdministrator()
             ->json('POST',
                 'machines',
                 array(
                     'name' => $name,
                     'model' =>$model
                 )
             )->assertResponseStatus(201);
    }

    public function testUpdate(){
        $name = str_random(10);

        $this->actingAsAdministrator()
            ->json('POST',
                'machines/1',
                array(
                    'name' => $name,
                )
            )->assertResponseStatus(202);
        $this ->actingAsAdministrator()
            ->json('GET', 'machines/1')
            ->seeJson([
                'name' => $name
            ]);
    }


    public function testDelete()
    {
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'machines/1')
            ->assertResponseStatus(202);
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'machines/1')
            ->json('GET', 'machines/1')
            ->assertResponseStatus(404);
    }
}