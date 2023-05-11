<?php
namespace App\Services;

use App\Entity\Visitor;
use App\Repository\VisitorRepository;
use GeoIp2\Database\Reader;

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

    public function getVisitorGroupedByCountry(VisitorRepository $visitorRepository): array
    {
        $reader = new Reader('../src/geoip2db/GeoLite2-City.mmdb');
        $array = [];
        foreach ($visitorRepository->findAll() as $visitor){
            if ($visitor->getIp() === '127.0.0.1') continue;
            $country = $reader->city($visitor->getIp())->country->names['fr'];
            $array[$country][] = $visitor->getIp();
        }
        return $this->getLabelAndDataArray($array);
    }

    private function getLabelAndDataArray(array $data): array
    {
        $array = [];
        foreach ($data as $key => $value){
            $array['labels'][] = $key;
            $count = 0;
            foreach ($value as $subItem){
                $count = $count + 1;
            }
            $array['data'][] = $count;
        }
        return $array;
    }
}