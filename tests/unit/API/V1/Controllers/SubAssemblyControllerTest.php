<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * @group subAssemblyController
 * @group controller
 */
class SubAssemblyControllerTest extends TestCase
{
    public function testGetList()
    {

        $this->actingAsAdministrator()
            ->json('GET', '/subAssemblies')
            ->seeJson([
                'name' => 'Hoist Ropes - House',
                'machineGeneral' => true

            ]);
    }

    public function testGet()
    {
        $this->actingAsAdministrator()
            ->json('GET', '/subAssemblies/1')
            ->seeJson([
                'name' => 'Hoist Ropes - House',
                'machineGeneral' => true

            ]);
    }

    public function testCreateWithoutUniqueDetails()
    {
        $name = str_random();
        $majAssemblyNo = 1;
        $hasTest = true;


        $this->actingAsDomainExpert()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'machineGeneral' => $hasTest,
                'wear' => $hasTest,
                'oil' => $hasTest,
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(201);

        $this->actingAsDomainExpert()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'machineGeneral' => $hasTest,
                'wear' => $hasTest,
                'oil' => $hasTest,
                'uniqueDetails' => [],
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(201);
    }

    public function testCreateWithUniqueDetails()
    {
        $name = str_random();
        $majAssemblyNo = 1;
        $hasTest = true;
        $uniqueDetail = str_random();

        $this->actingAsAdministrator()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'machineGeneral' => $hasTest,
                'wear' => $hasTest,
                'oil' => $hasTest,
                'uniqueDetails' => [
                    $uniqueDetail
                ],
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(201);
    }

    public function testCreateWithMissingTestType()
    {
        $name = str_random();
        $majAssemblyNo = 1;
        $hasTest = true;

        $this->actingAsAdministrator()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'machineGeneral' => $hasTest,
                'oil' => $hasTest,
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(422);

        $this->actingAsAdministrator()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'wear' => $hasTest,
                'oil' => $hasTest,
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(422);

        $this->actingAsAdministrator()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'machineGeneral' => $hasTest,
                'wear' => $hasTest,
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(422);
    }

    public function testCreateMajorAssemblyNotFound()
    {
        $name = str_random();
        $majAssemblyNo = 0;
        $hasTest = true;


        $this->actingAsAdministrator()->json(
            'POST',
            '/subAssemblies',
            [
                'name' => $name,
                'machineGeneral' => $hasTest,
                'wear' => $hasTest,
                'oil' => $hasTest,
                'majorAssembly' => $majAssemblyNo
            ]
        )->assertResponseStatus(422);
    }

    public function testUpdate()
    {
        $name = str_random(10);
        $this->actingAsAdministrator()->json(
            'POST',
            '/subAssemblies/1',
            [
                'name' => $name
            ])->assertResponseStatus(202);

        $this->actingAsAdministrator()
            ->json('GET', '/subAssemblies/1')
            ->seeJson([
                'name' => $name
            ]);

    }

    public function testDelete()
    {
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'subAssemblies/1')
            ->assertResponseStatus(202);
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'subAssemblies/1')
            ->json('GET', 'subAssemblies/1')
            ->assertResponseStatus(404);
    }
}