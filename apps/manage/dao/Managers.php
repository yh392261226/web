<?php
namespace MDAO;

class Managers extends \MDAOBASE\DaoBase
{
    public function __construct()
    {
        parent::__construct(array('table' => 'Managers'));
    }
}