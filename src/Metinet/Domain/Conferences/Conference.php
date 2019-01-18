<?php

namespace Metinet\Domain;

class Conference
{
    private $title;
    private $description;
    private $date;
    private $place;
    private $duration;
    private $keywords;

    public function __construct(string $title, string $description, \DateTimeImmutable $date, float $duration, Place $place, array $keywords)
    {
        $this->title = strlen($title) <= 200 ? $title : substr($title, 0, 200);
        $this->description = strlen($description) <= 1000 ? $description : substr($description, 0, 1000);
        if ($date > new \DateTime()){
            $this->date = $date;
        } else {
            Throw new \Exception("Date doesn't make sense.");
        }
        $this->duration = $duration >= 0 ? $duration : 0;
        $this->place = $place;
        $this->keywords = $keywords;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return int|float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return Place
     */
    public function getPlace(): string
    {
        return $this->place->getName().'<br />'.$this->place->getNumber().', '.$this->place->getStreet().'<br />'.$this->place->getPostCode().' '.$this->place->getCity().'<br />'.$this->place->getCountry();
    }
}
