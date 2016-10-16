<?php

namespace Tests\Unit\App\API\V1\Controllers;

use App\API\V1\Entities\InspectionMajorAssembly;
use App\API\V1\Entities\MajorAssembly;
use TestCase;

/**
 * Class InspectionMajorAssemblyControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group inspectionMajorAssemblyController
 * @group controller
 */
class InspectionMajorAssemblyControllerTest extends TestCase
{
    public function testGetList()
    {
        $this->actingAsAdministrator()
            ->json('GET', '/inspectionMajorAssemblies')
            ->seeJson(
                [
                    'authorType' => 'technician',
                    'username' => 'technician',
                    'photos' => []
                ]
            );

    }

    public function testGet()
    {
        $this->actingAsAdministrator()
            ->json('GET', '/inspectionMajorAssemblies/1')
            ->seeJsonStructure(
                [
                    'subAssemblies' => [],
                    'comments' => [],
                    'photos' => []
                ]
            );
    }

    public function testCreate()
    {
        $inspectionID = 1;
        $majorAssemblyID = 1;
        $this->actingAsAdministrator()
            ->json('POST',
                '/inspectionMajorAssemblies',
                array(
                    'inspection' => $inspectionID,
                    'majorAssembly' => $majorAssemblyID
                )
            )->assertResponseStatus(201);
    }

    public function testCreateInvalidInspection()
    {
        $inspectionID = 0;
        $majorAssemblyID = 1;
        $this->actingAsAdministrator()
            ->json('POST',
                '/inspectionMajorAssemblies',
                array(
                    'inspection' => $inspectionID,
                    'majorAssembly' => $majorAssemblyID
                )
            )->assertResponseStatus(422);
    }

    public function testCreateDeletedInspection()
    {
        $inspectionID = 3;
        $majorAssemblyID = 1;
        $this->actingAsAdministrator()
            ->json('POST',
                '/inspectionMajorAssemblies',
                array(
                    'inspection' => $inspectionID,
                    'majorAssembly' => $majorAssemblyID
                )
            )->assertResponseStatus(422);
    }

    public function testUpdate()
    {
        $inspectionID = 2;
        $majorAssemblyID = 4;
        $this->actingAsAdministrator()
            ->json('POST',
                '/inspectionMajorAssemblies/1',
                array(
                    'inspection' => $inspectionID,
                    'majorAssembly' => $majorAssemblyID
                )
            )->assertResponseStatus(202);
    }

    public function testDelete()
    {
        $this
            ->actingAsAdministrator()
            ->json('DELETE', '/inspectionMajorAssemblies/1')
            ->assertResponseStatus(405);
    }
}