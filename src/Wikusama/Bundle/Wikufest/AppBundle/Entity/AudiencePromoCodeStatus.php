<?php

/*
 *
 * (c) 2015 Okta Purnama Rahadian <okta.rahadian@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wikusama\Bundle\Wikufest\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AudiencePromoCodeStatus
 *
 * @ORM\Table(name="audience_promocode_statuses")
 * @ORM\Entity(repositoryClass="Wikusama\Bundle\Wikufest\AppBundle\Repository\AudiencePromoCodeStatusRepository")
 */
class AudiencePromoCodeStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return AudiencePromoCodeStatus
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
