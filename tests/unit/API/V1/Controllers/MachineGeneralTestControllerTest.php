<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class MachineGeneralTestControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group machineGeneralTestController
 */
class MachineGeneralTestControllerTest extends TestCase
{
    public function testGetList(){
        $this->actingAsAdministrator()
            ->json('GET', '/machineGeneralTests')
            ->seeJson(
                array(
                    'authorType' => 'domainExpert',
                    'status' => 'OK',
                )
            );
    }
    
    public function testGet(){
        $this->actingAsAdministrator()
            ->json('GET', '/machineGeneralTests/1')
            ->seeJson(
                array(
                    'authorType' => 'domainExpert',
                    'status' => 'OK',
                )
            );
    }
    //TODO figure out 500 duplicate error
    public function testCreate(){
        $inspection = 1;
        $subAssembly = 1;
        
        $this->actingAsAdministrator()
            ->json(
                'POST',
                '/machineGeneralTests/',
                [
                    'inspection' => $inspection,
                    'subAssembly' => $subAssembly
                ]
            )
            ->assertResponseStatus(201);
    }
    //TODO testUpdate -fix
    public function testUpdate(){
        $subAssembly = 2;

        $this->actingAsAdministrator()
            ->json(
                'POST',
                '/machineGeneralTests/1',
                [
                    'subAssembly' => $subAssembly
                ]
            )
            ->assertResponseStatus(202);
        $this->actingAsAdministrator()
            ->json('GET', '/machineGeneralTests/1')
            ->seeJson(
                [
                    'subAssembly' => $subAssembly
                ]
            );
    }
    
    public function testDelete(){

        $this
            ->actingAsAdministrator()
            ->json('DELETE','/machineGeneralTests/1')
            ->assertResponseStatus(405);
    }
}