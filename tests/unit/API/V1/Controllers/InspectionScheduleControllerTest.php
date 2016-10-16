<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class InspectionScheduleControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group inspectionScheduleController
 * @group controller
 */
class InspectionScheduleControllerTest extends TestCase
{
    public function testGetList(){
        $this->actingAsAdministrator()
             ->json('GET', '/inspectionSchedules')
             ->seeJson([
                 'value' => 1,
                 'period' => 'years'
                ]
             );
    }

    public function testGet(){
        $this->actingAsAdministrator()
            ->json('GET', '/inspectionSchedules/1')
            ->seeJson([
                    'value' => 1,
                    'period' => 'years'
                ]
            );
    }

    public function testCreate(){
        $inspectionID = 1;
        $value = random_int(1,50);
        $period = "months";
        $this->actingAsAdministrator()
             ->json('POST',
                 '/inspectionSchedules',
                 array(
                     'inspection' =>  $inspectionID,
                     'value' => $value,
                     'period' => $period
                 )
             )
             ->assertResponseStatus(201);
    }

    public function testUpdate(){
        $inspectionID = 1;
        $value = random_int(1,50);
        $period = "months";
        $this->actingAsAdministrator()
            ->json('POST',
                '/inspectionSchedules/1',
                array(
                    'inspection' =>  $inspectionID,
                    'value' => $value,
                    'period' => $period
                )
            )
            ->assertResponseStatus(202);
    }

    public function testDelete()
    {
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'technicians/1')
            ->assertResponseStatus(202);
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'technicians/1')
            ->json('GET', 'technicians/1')
            ->assertResponseStatus(404);
    }

}