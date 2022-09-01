<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Restaurant
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $restaurantId;

    /**
     * @ORM\Column(type="string")
     */
    public $nome;

    /**
     * @ORM\Column(type="string", length=14)
     */
    public $cnpj;

    /**
     * @ORM\Column(type="string")
     */
    public $bairro;

    /**
     * @ORM\Column(type="string")
     */
    public $rua;

    /**
     * @ORM\Column(type="string")
     */
    public $numero;

    /**
     * @ORM\Column(type="string")
     */
    public $tipo;

}