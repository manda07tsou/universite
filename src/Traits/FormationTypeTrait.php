<?php
namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

const FORMATION_TYPE_SEPARATOR = '/';

trait FormationTypeTrait{

    #[ORM\Column(length: 255)]
    protected string $formationTypes = '';

    protected static array $formationTypeLists = [
        0 => 'Présentiel',
        1 => 'En ligne',
        2 => 'En alternance'
    ];

    protected static array $formationTypeColor = [
        0 => 'primary',
        1 => 'secondary',
        2 => 'tierciary'
    ];

    public function getFormation_types() : array
    {
        $values = explode(FORMATION_TYPE_SEPARATOR , $this->formationTypes);
        $formations = [];

        foreach($values as $key){
            $formations[$key] = self::$formationTypeLists[$key];
        }

        return $formations;
    }

    public function setFormation_types(string $formationType) :self
    {
        $this->formationTypes = $formationType;
        return $this;
    }

    public function getFormationTypeColor($formationType) :string
    {
        return self::$formationTypeColor[$formationType];
    }
}