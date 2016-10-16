<?php

namespace Tests\Unit\App\API\V1\Controllers;

use App\API\V1\Entities\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TestCase;

/**
 * Class ActionItemControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group actionItemController
 */
class ActionItemControllerTest extends TestCase
{
    public function testGetList()
    {
        $this
            ->actingAsDomainExpert()
            ->json('GET', '/actionItems')
            ->seeJson(
                array(
                    'action' => 'Action'
                )
            );
    }

    public function testGet()
    {
        $this
            ->actingAsDomainExpert()
            ->json('GET', '/actionItems/1')
            ->seeJson(
                array(
                    'action' => 'Action'
                )
            );
    }

    public function testGetNotFound(){
        $this
            ->actingAsDomainExpert()
            ->json('GET', '/actionItems/0')
        ->assertResponseStatus(404);
    }

    //TODO : Figure out why create gives following 500 error:
    // Integrity constraint violation: 1062 Duplicate entry '1' for key 'UNIQ_6D025F123774302'
    public function testCreateWithWearTest()
    {
        $status = str_random(10);
        $issue = str_random(10);
        $action = str_random(10);
       
        $timeActioned = Carbon::now()->format(DATE_ISO8601);
        $technician  = 1;


        $this->actingAsDomainExpert()
            ->json(
                "POST",
                "/actionItems",
                [
                    "status" => $status,
                    "issue" => $issue,
                    "action" => $action,
                    "timeActioned" => $timeActioned,
                    "technician" => $technician,
                    "wearTest" => 1
                ])
            ->assertResponseStatus(201);
    }

    public function testCreateWithMachineGenTest()
    {
        $status = str_random(10);
        $issue = str_random(10);
        $action = str_random(10);

        $timeActioned = Carbon::now()->format(DATE_ISO8601);
        $technician  = 1;


        $this->actingAsDomainExpert()
            ->json(
                "POST",
                "/actionItems",
                [
                    "status" => $status,
                    "issue" => $issue,
                    "action" => $action,
                    "timeActioned" => $timeActioned,
                    "technician" => $technician,
                    "machineGeneralTest" => 1
                ])
            ->assertResponseStatus(201);
    }

    public function testCreateWithOilTest()
    {
        $status = str_random(10);
        $issue = str_random(10);
        $action = str_random(10);

        $timeActioned = Carbon::now()->format(DATE_ISO8601);
        $technician  = 1;


        $this->actingAsDomainExpert()
            ->json(
                "POST",
                "/actionItems",
                [
                    "status" => $status,
                    "issue" => $issue,
                    "action" => $action,
                    "timeActioned" => $timeActioned,
                    "technician" => $technician,
                    "oilTest" => 1
                ])
            ->assertResponseStatus(201);
    }

    public function testUpdate()
    {
        $status = str_random(10);
        $issue = str_random(10);
        $this
            ->actingAsTechnician()
            ->json(
                'POST',
                '/actionItems/1',
                [
                    'status' => $status,
                    'issue'  => $issue,
                ]
            )
            ->assertResponseStatus(202);

        $this
            ->actingAsTechnician()
            ->json(
                'GET',
                '/actionItems/1'
            )
            ->seeJson(
                array(
                    'status' => $status,
                    'issue'  => $issue,
                )
            );
        
    }
    public function testDelete()
    {
       $this
           ->actingAsAdministrator()
           ->json('DELETE','/actionItems/1')
           ->assertResponseStatus(405);
    }

}