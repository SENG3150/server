<?php

namespace App\Console\Commands;

use App\API\V1\Entities\Inspection;
use App\API\V1\Entities\InspectionMajorAssembly;
use App\API\V1\Entities\InspectionSubAssembly;
use App\API\V1\Entities\InspectionSchedule;
use App\API\V1\Repositories\InspectionRepository;
use App\API\V1\Repositories\InspectionScheduleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Doctrine\DBAL\Types\Type;

class RecurringInspections extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'recurring-inspections';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Search the Inspection Schedule list for upcoming recurring inspections and creates new inspection items';
	
	/**
	 * @var EntityManagerInterface $em
	 */
	private $em;
	
	/**
	 * @var InspectionScheduleRepository $inspectionScheduleRepository
	 */
	protected $inspectionScheduleRepository;
	
	/**
	 * @var InspectionRepository $inspectionRepository
	 */
	protected $inspectionRepository;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->em                           = app('em');
		$this->inspectionScheduleRepository = app('em')->getRepository('App\API\V1\Entities\InspectionSchedule');
		$this->inspectionRepository         = app('em')->getRepository('App\API\V1\Entities\Inspection');
		
		Type::overrideType('datetime', 'App\API\V1\Providers\DateTimeTypeProvider');
	}
	
	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		/** @var InspectionSchedule[] $inspectionSchedules */
		$inspectionSchedules = $this->inspectionScheduleRepository->findAll();
		
		foreach($inspectionSchedules as $inspectionSchedule)
		{
			$period = $inspectionSchedule->getPeriod();
			$number = $inspectionSchedule->getValue();
			
			$inspections = $inspectionSchedule->getInspections();
			
			if($inspections instanceof Collection)
			{
				$inspections = $inspections->getValues();
			}
			
			if(count($inspections) == 0)
			{
				// Create the first duplicated inspection
				$inspections = array(
					$inspectionSchedule->getInspection()
				);
			}
			
			$count = 0;
			
			foreach($inspections as $inspection)
			{
				if($inspection->getTimeScheduled() > (new \DateTime()))
				{
					$count++;
				}
			}
			
			// Sort the inspections by time scheduled ascending
			usort(
				$inspections,
				function ($a, $b)
				{
					/** @var Inspection $a */
					/** @var Inspection $b */
					
					if($a->getTimeScheduled() != NULL)
					{
						if($b->getTimeScheduled() != NULL)
						{
							return ($a->getTimeScheduled() < $b->getTimeScheduled()) ? (-1) : (1);
						}
						
						else
						{
							return 1;
						}
					}
					
					else
					{
						return -1;
					}
				}
			);
			
			while($count < 2)
			{
				$lastInspection = end($inspections);
				
				// Copy time across from last inspection
				$time = new Carbon($lastInspection->getTimeScheduled()->format(DATE_ISO8601));
				
				switch($period)
				{
					case 'minutes':
					{
						$time->addMinutes($number);
						
						break;
					}
					
					case 'hours':
					{
						$time->addHours($number);
						
						break;
					}
					
					default:
					case 'days':
					{
						$time->addDays($number);
						
						break;
					}
					
					case 'weeks':
					{
						$time->addWeeks($number);
						
						break;
					}
					
					case 'months':
					{
						$time->addMonths($number);
						
						break;
					}
					
					case 'years':
					{
						$time->addYears($number);
						
						break;
					}
				}
				
				$inspections[] = $this->duplicateInspection($inspectionSchedule, $time);
				
				$count++;
			}
		}
		
		return TRUE;
	}
	
	/**
	 * Adds a new inspection similar to the parent inspection.
	 *
	 * @param \App\API\V1\Entities\InspectionSchedule $schedule
	 * @param \DateTime                               $time
	 *
	 * @return \App\API\V1\Entities\Inspection
	 */
	public function duplicateInspection(InspectionSchedule $schedule, \DateTime $time)
	{
		$baseInspection = $schedule->getInspection();
		
		$newInspection = new Inspection();
		
		$newInspection
			->setTimeCreated(new \DateTime())
			->setTimeScheduled($time)
			->setMachine($baseInspection->getMachine())
			->setTechnician($baseInspection->getTechnician())
			->setScheduler($baseInspection->getScheduler())
			->setSchedule($schedule);
		
		$this->em->persist($newInspection);
		$this->em->flush();
		
		foreach($baseInspection->getMajorAssemblies() as $oldMajorAssembly)
		{
			$majorAssembly = new InspectionMajorAssembly();
			
			$majorAssembly
				->setInspection($newInspection)
				->setMajorAssembly($oldMajorAssembly->getMajorAssembly());
			
			$this->em->persist($majorAssembly);
			$this->em->flush();
			
			foreach($oldMajorAssembly->getSubAssemblies() as $oldSubAssembly)
			{
				$subAssembly = new InspectionSubAssembly();
				
				$subAssembly
					->setMajorAssembly($majorAssembly)
					->setInspection($newInspection)
					->setSubAssembly($oldSubAssembly->getSubAssembly());
				
				$this->em->persist($subAssembly);
				$this->em->flush();
			}
		}
		
		return $newInspection;
	}
}
