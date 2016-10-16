<?php

namespace Tests\Unit\App\API\V1\Controllers;

use TestCase;

/**
 * Class DomainExpertControllerTest
 * @package Tests\Unit\App\API\V1\Controllers
 * @group domainExpertController
 */
class DomainExpertControllerTest extends TestCase
{
    public function testGetList(){
        $this
            ->actingAsAdministrator()
            ->json('GET', '/domainExperts')
            ->seeJson(
                array(
                    'name' => 'Domain Expert'
                )
            );
    }

    public function testGet(){
        $this
        ->actingAsAdministrator()
            ->json('GET', '/domainExperts/1')
            ->seeJson(
                array(
                    'name' => 'Domain Expert'
                )
            );
    }



    public function testCreate(){
        $username  = str_random();
        $firstName = str_random();
        $lastName  = str_random();
        $email     = str_random() . '@' . str_random() . '.com';
        $password  = str_random();

        $this
            ->actingAsAdministrator()
            ->json(
                'POST',
                '/domainExperts',
                [
                    'username'  => $username,
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                    'email'     => $email,
                    'password'  => $password,
                ]
            )
            ->assertResponseStatus(201);
    }

    public function testUpdate(){
        $firstName = str_random(10);
        $lastName  = str_random(10);

        $this
            ->actingAsAdministrator()
            ->json(
                'POST',
                '/domainExperts/1',
                [
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                ]
            )
            ->assertResponseStatus(202);

        $this
            ->actingAsAdministrator()
            ->json(
                'GET',
                '/domainExperts/1'
            )
            ->seeJson(
                array(
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                )
            );
    }

    public function testDuplicateUsername()
    {
        $username  = str_random();
        $firstName = str_random();
        $lastName  = str_random();
        $email     = str_random() . '@' . str_random() . '.com';
        $password  = str_random();

        $this
            ->actingAsAdministrator()
            ->json(
                'POST',
                '/domainExperts',
                [
                    'username'  => $username,
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                    'email'     => $email,
                    'password'  => $password,
                ]
            )
            ->assertResponseStatus(201);

        $this
            ->actingAsAdministrator()
            ->json(
                'POST',
                '/domainExperts',
                [
                    'username'  => $username,
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                    'email'     => $email,
                    'password'  => $password,
                ]
            )
            ->assertResponseStatus(422)
            ->seeJson(
                array(
                    'errors' => array(
                        'username' => array(
                            'This username is already registered.'
                        )
                    )
                )
            );
    }
    
    public function testGetNotFound(){
        $this
            ->actingAsDomainExpert()
            ->json('GET', '/domainExperts/0')
            ->assertResponseStatus(404);
    }
    
    public function testDelete(){
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'domainExperts/1')
            ->assertResponseStatus(202);
        
        
        $this
            ->actingAsAdministrator()
            ->json('DELETE', 'domainExperts/1')
            ->json('GET', 'domainExperts/1')
            ->assertResponseStatus(404);
        
    }


}