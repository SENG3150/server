<?php

namespace Tests\Endpoint\App\API\V1;

use Carbon\Carbon;
use TestCase;

class InspectionEndpointTest extends TestCase
{

    public function testBulkCreate()
    {
        $machineID = 1;
        $time = Carbon::now()->format(DATE_ISO8601);
        $this
            ->actingAsTechnician()
            ->json(
                'POST',
                '/inspections/bulk',
                [
                    'machine' => $machineID,
                    'timeScheduled' => $time
                ]
            )
            ->assertResponseStatus(200);
        
        $this->actingAsAdministrator()
            ->json('GET',
                '/inspections/3')
            ->seeJson(
                array(
                    'timeCreated' => Carbon::now()->format(DATE_ISO8601),
                    'timeScheduled' => $time,
                )
            );
    }

    public function testBulkUpdate()
    {
        $time = Carbon::now()->format(DATE_ISO8601);
        $this
            ->actingAsTechnician()
            ->json(
                'POST',
                '/inspections/bulk',
                [
                    'id' => 1,
                    'timeCompleted' => $time
                ]
            )
            ->assertResponseStatus(200);

        $this
            ->actingAsAdministrator()
            ->json('GET',
                '/inspections/1')
            ->seeJson(
                array(
                    'timeCompleted' => $time
                )
            );
    }
}