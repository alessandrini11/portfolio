<?php
namespace App\Services;

use App\Entity\Visitor;
use App\Repository\VisitorRepository;

class VisitorService
{
    private VisitorRepository $visitorRepository;
    public function __construct(VisitorRepository $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }
    private function createVisitor(string $ip): Visitor
    {
        $visitor = new Visitor();
        $visitor->setIp($ip);
        $this->visitorRepository->save($visitor, true);
        return $visitor;
    }

    public function getVisitorByIp(string $ip): Visitor
    {
        $visitor = $this->visitorRepository->findOneBy(["ip" => $ip]);
        if (!$visitor) {
            $visitor = $this->createVisitor($ip);
        }
        return $visitor;
    }
}