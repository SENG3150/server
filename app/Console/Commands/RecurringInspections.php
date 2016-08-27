<?php

namespace App\Console\Commands;

use App\API\V1\Entities\Inspection;
use App\API\V1\Entities\InspectionMajorAssembly;
use App\API\V1\Entities\InspectionSubAssembly;
use App\API\V1\Entities\InspectionSchedule;
use App\API\V1\Repositories\InspectionRepository;
use App\API\V1\Repositories\InspectionScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Provider\zh_TW\DateTime;
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
	 *
	 *
	 * @var InspectionScheduleRepository $inspectionScheduleRepository
	 */
	protected $inspectionScheduleRepository;
	
	/**
	 *
	 *
	 * @var InspectionRepository $inspectionRepository
	 */
	protected $inspectionRepository;
	
	/**
	 * Create a new command instance.
	 *
	 * @var InspectionScheduleRepository $inspectionScheduleRepository
	 */
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
			$stamp = new Carbon();
			
			if($inspectionSchedule->getPeriod() == 'minutes')
			{
				$stamp->addMinutes(2 * $inspectionSchedule->getValue());
			}
			
			if($inspectionSchedule->getPeriod() == 'hours')
			{
				$stamp->addHours(2 * $inspectionSchedule->getValue());
			}
			
			if($inspectionSchedule->getPeriod() == 'days')
			{
				$stamp->addDays(2 * $inspectionSchedule->getValue());
			}
			
			if($inspectionSchedule->getPeriod() == 'weeks')
			{
				$stamp->addWeeks(2 * $inspectionSchedule->getValue());
			}
			
			if($inspectionSchedule->getPeriod() == 'months')
			{
				$stamp->addMonths(2 * $inspectionSchedule->getValue());
			}
			
			if($inspectionSchedule->getPeriod() == 'years')
			{
				$stamp->addYears(2 * $inspectionSchedule->getValue());
			}
			
			$needNewInspection = TRUE;
			
			foreach($inspectionSchedule->getInspections() as $inspection)
			{
				if((new \DateTime()) <=$inspection->getTimeScheduled() && $inspection->getTimeScheduled() <= ($stamp))
				{
					$needNewInspection = FALSE;
				}
			}
			
			if($needNewInspection == TRUE)
			{
				$this->addNewInspection($inspectionSchedule, $this->em);
			}
		}
	}
	
	/**
	 * Adds a new inspection similar to the parent inspection.
	 *
	 *
	 * @param \App\API\V1\Entities\InspectionSchedule $schedule
	 * @param \Doctrine\ORM\EntityManagerInterface    $em
	 *
	 * @internal param \App\API\V1\Entities\InspectionSchedule $
	 */
	public function addNewInspection(InspectionSchedule $schedule, EntityManagerInterface $em)
	{
		$stamp         = new Carbon();
		$oldInspection = $schedule->getInspection();
		$newInspection = new Inspection();
		
		$newInspection->setTimeCreated($stamp);
		$newInspection->setTimeScheduled($stamp);
		$newInspection->setMachine($oldInspection->getMachine());
		$newInspection->setTechnician($oldInspection->getTechnician());
		$newInspection->setScheduler($oldInspection->getScheduler());
		$newInspection->setSchedule($schedule);
		$em->persist($newInspection);
		$em->flush();
		foreach($oldInspection->getMajorAssemblies() as $oldMajorAssembly) {
			$majorAssembly = new InspectionMajorAssembly();
			$majorAssembly->setInspection($newInspection);
			$majorAssembly->setMajorAssembly($oldMajorAssembly->getMajorAssembly());
			$em->persist($majorAssembly);
			$em->flush();

			foreach($oldMajorAssembly->getSubAssemblies() as $oldSubAssembly) {
				$subAssembly = new InspectionSubAssembly();
				$subAssembly->setMajorAssembly($majorAssembly);
				$subAssembly->setInspection($newInspection);
				$subAssembly->setSubAssembly($oldSubAssembly->getSubAssembly());
				$em->persist($subAssembly);
				$em->flush();
			}
		}
	}
}
