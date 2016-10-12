<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\RollbackDatabase;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
	use RollbackDatabase;
	
	/**
	 * @var string $token
	 */
	private $token = NULL;
	
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://localhost';
	
	/**
	 * @var \Doctrine\ORM\EntityManagerInterface $em
	 */
	protected $em;
	
	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__ . '/../bootstrap/app.php';
		
		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
		
		return $app;
	}
	
	/**
	 * Called before each test runs
	 */
	protected function setUp()
	{
		parent::setUp();
		
		$this->baseUrl = env('APP_URL');
		
		$this->em = $this->app->make(\Doctrine\ORM\EntityManagerInterface::class);
		
		App::register('App\API\V1\Providers\APIServiceProvider');
		
		$uses = array_flip(class_uses_recursive(static::class));
		
		if(isset($uses[RollbackDatabase::class]))
		{
			$this->rollback();
		}
	}
	
	/**
	 * @param \App\API\V1\Entities\Administrator $administrator
	 *
	 * @return $this
	 */
	public function actingAsAdministrator($administrator = NULL)
	{
		$user = new \App\Entities\User();
		
		$user
			->setType($user::TYPE_ADMINISTRATOR);
		
		if($administrator == NULL)
		{
			$administrator = app('AdministratorRepository')->find(1);
		}
		
		$user
			->setAdministrator($administrator);
		
		$this->setToken(JWTAuth::fromUser($user));
		
		return $this;
	}
	
	/**
	 * @param \App\API\V1\Entities\DomainExpert $domainExpert
	 *
	 * @return $this
	 */
	public function actingAsDomainExpert($domainExpert = NULL)
	{
		$user = new \App\Entities\User();
		
		$user
			->setType($user::TYPE_DOMAIN_EXPERT);
		
		if($domainExpert == NULL)
		{
			$domainExpert = app('DomainExpertRepository')->find(1);
		}
		
		$user
			->setDomainExpert($domainExpert);
		
		$this->setToken(JWTAuth::fromUser($user));
		
		return $this;
	}
	
	/**
	 * @param \App\API\V1\Entities\Technician $technician
	 *
	 * @return $this
	 */
	public function actingAsTechnician($technician = NULL)
	{
		$user = new \App\Entities\User();
		
		$user
			->setType($user::TYPE_TECHNICIAN);
		
		if($technician == NULL)
		{
			$technician = app('TechnicianRepository')->find(1);
		}
		
		$user
			->setTechnician($technician);
		
		$this->setToken(JWTAuth::fromUser($user));
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getToken()
	{
		return $this->token;
	}
	
	/**
	 * @param string $token
	 *
	 * @return $this
	 */
	public function setToken($token)
	{
		$this->token = $token;
		
		return $this;
	}
	
	/**
	 * @param string $method
	 * @param string $uri
	 * @param array  $data
	 * @param array  $headers
	 *
	 * @return \Illuminate\Foundation\Testing\Concerns\MakesHttpRequests
	 */
	public function json($method, $uri, array $data = [], array $headers = [])
	{
		if($this->getToken() != NULL)
		{
			$headers['Authorization'] = 'Bearer ' . $this->getToken();
		}
		
		return parent::json($method, $uri, $data, $headers);
	}
}
