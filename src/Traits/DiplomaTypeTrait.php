<?php
namespace App\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use const App\Traits\FORMATION_TYPE_SEPARATOR as SEPARATOR;

trait DiplomaTypeTrait{
    #[ORM\Column(type: Types::TEXT)]
    protected string $diplomaRequired = '';

    #[ORM\Column(type: Types::TEXT)]
    protected string $diplomaDelivered = '';

    public static $diplomaRequiredLists = [
        0 => 'A',
        1 => 'C',
        2 => 'D',
        3 => 'L',
        4 => 'OSE',
        5 => 'S',
        6 => 'TECHNIQUE'
    ];

    public static $diplomaDeliveredLists = [
        0 => 'DTS',
        1 => 'LICENCES',
        2 => 'MASTER',
        3 => 'DOCTORAT'
    ];

    public function getDiplomaRequired() : array
    {
        $values = explode(SEPARATOR , $this->diplomaRequired);
        return $values;
    }

    public function setDiplomaRequired(string $diplomaRequired):self
    {
        $this->diplomaRequired = $diplomaRequired;
        return $this;
    }

    public function getDiplomaDelivered(): array
    {
        $values = explode(SEPARATOR , $this->diplomaDelivered);
        return $values;
    }

    public function setDiplomaDelivered(string $diplomaDelivered):self
    {
        $this->diplomaDelivered = $diplomaDelivered;
        return $this;
    }

    public function getDiplomaRequiredLists(): array
    {
        return self::$diplomaRequiredLists;
    }

    public function getDiplomaDeliveredLists(): array
    {
        return self::$diplomaDeliveredLists;
    }

}