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

class RecurringInspections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspections:recurring';

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
    
        $this->em                     = app('em');
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
        /** @var $InspectionSchedule[] $inspectionSchedules */
        $inspectionSchedules = $this->inspectionScheduleRepository->findByVisible();
        foreach($inspectionSchedules as $inspectionSchedule)
        {
            $stamp = new Carbon();

            if($this->$inspectionSchedule->getPeriod()=='Minutes')
            {
                $stamp->subMinutes($this->$inspectionSchedule->getValue());
            }

            if($this->$inspectionSchedule->getPeriod()=='Hours')
            {
                $stamp->subHours($this->$inspectionSchedule->getValue());
            }

            if($this->$inspectionSchedule->getPeriod()=='Days')
            {
                $stamp->subDays($this->$inspectionSchedule->getValue());
            }

            if($this->$inspectionSchedule->getPeriod()=='Weeks')
            {
                $stamp->subWeeks($this->$inspectionSchedule->getValue());
            }

            if($this->$inspectionSchedule->getPeriod()=='Months')
            {
                $stamp->subMonths($this->$inspectionSchedule->getValue());
            }

            if($this->$inspectionSchedule->getPeriod()=='Years')
            {
                $stamp->subYears($this->$inspectionSchedule->getValue());
            }

            $needNewInspection = TRUE;
            $inspections = $this->inspectionRepository->findBySchedule($inspectionSchedule);
            foreach($inspections as $inspection)
            {
                if($this->$inspection->getTimeScheduled()->lt($stamp))
                {
                    $needNewInspection = FALSE;
                }
            }

            if($needNewInspection == TRUE)
            {
                $this->addNewInspection($this->$inspectionSchedule,$this->em);
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
        $stamp = new Carbon();
        $oldInspection = $schedule->getInspection();
        $newInspection = new Inspection();
        $em->persist($newInspection);
        $em->flush();

        $newInspection->setTimeCreated($stamp);
        $newInspection->setTimeScheduled($stamp);
        $newInspection->setMachine($oldInspection->getMachine());
        $newInspection->setTechnician($oldInspection->getTechnician());
        $newInspection->setScheduler($oldInspection->getScheduler());
        $newInspection->setSchedule($schedule);
        $newInspection->setMajorAssemblies($oldInspection->getMajorAssemblies());

        foreach($oldInspection->getMajorAssemblies() as $oldMajorAssembly) {
            $majorAssembly = new InspectionMajorAssembly();
            $majorAssembly->setInspection($newInspection);
            $majorAssembly->setMajorAssembly($oldMajorAssembly);
            $em->persist($majorAssembly);
            $em->flush();

            foreach($oldMajorAssembly->getSubAssemblies() as $oldSubAssembly) {
                $subAssembly = new InspectionSubAssembly();
                $subAssembly->setMajorAssembly($majorAssembly);
                $subAssembly->setInspection($newInspection);
                $subAssembly->setSubAssembly($oldSubAssembly);
                $subAssembly->setMachineGeneralTest($oldSubAssembly->getMachineGeneralTest());
                $subAssembly->setOilTest($oldSubAssembly->getOilTest());
                $subAssembly->setWearTest($oldSubAssembly->getWearTest());
                $em->persist($subAssembly);
                $em->flush();
            }
        }
    }
}
