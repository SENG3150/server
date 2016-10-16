<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class InspectionSubAssemblyControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group inspectionSubAssemblyController
 */
class InspectionSubAssemblyControllerTest extends TestCase
{
    public function testGetList(){
        $this->actingAsAdministrator()
             ->json('GET' , '/inspectionSubAssemblies')
             ->seeJson([
                 'authorType' => 'technician'
                     ]
             );
    }

    public function testGet(){
        $this->actingAsAdministrator()
             ->json('GET' , '/inspectionSubAssemblies/1')
             ->seeJsonStructure(
                 [
                     'comments' => [],
                     'photos'  => [],
                     'machineGeneralTest'

                 ]
             );
    }

    public function testCreate(){
        $inspectionID = 1;
        $majAssemblyID =1;
        $subAssemblyID  =1;
        $this->actingAsAdministrator()
            ->json('POST', '/inspectionSubAssemblies',
                array(
                    'inspection' =>  $inspectionID ,
                    'majorAssembly' => $majAssemblyID,
                    'subAssembly' => $subAssemblyID
                ))
            ->assertResponseStatus(201);
    }

    public function testUpdate(){
        $majAssemblyID = 3;
        $subAssemblyID  = 4;
        $this->actingAsAdministrator()
            ->json('POST', '/inspectionSubAssemblies/1',
                array(
                    'majorAssembly' => $majAssemblyID,
                    'subAssembly' => $subAssemblyID
                ))
            ->assertResponseStatus(202);
    }

    public function testDelete(){
        $this
            ->actingAsAdministrator()
            ->json('DELETE', '/inspectionSubAssemblies/1')
            ->assertResponseStatus(405);
    }


}