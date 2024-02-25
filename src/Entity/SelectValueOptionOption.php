<?php

namespace Macareux\AttributeValueUtilities\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mdSelectValueOptionOptions")
 */
class SelectValueOptionOption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
     * @ORM\OneToOne(targetEntity="\Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption")
     * @ORM\JoinColumn(name="avSelectOptionID", referencedColumnName="avSelectOptionID", onDelete="CASCADE")
     */
    protected $avSelectOptionID;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $textColor;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $backgroundColor;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $cssClass;

    /**
     * @param \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption $avSelectOptionID
     */
    public function __construct(\Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption $avSelectOptionID)
    {
        $this->avSelectOptionID = $avSelectOptionID;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
     */
    public function getAvSelectOptionID()
    {
        return $this->avSelectOptionID;
    }

    /**
     * @param \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption $avSelectOptionID
     *
     * @return SelectValueOptionOption
     */
    public function setAvSelectOptionID($avSelectOptionID)
    {
        $this->avSelectOptionID = $avSelectOptionID;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param string $textColor
     *
     * @return SelectValueOptionOption
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     *
     * @return SelectValueOptionOption
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        $style = '';
        if ($this->getBackgroundColor()) {
            $style .= 'background-color: ' . $this->getBackgroundColor() . ';';
        }
        if ($this->getTextColor()) {
            $style .= 'color: ' . $this->getTextColor() . ';';
        }

        return $style;
    }

    /**
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * @param string $cssClass
     *
     * @return SelectValueOptionOption
     */
    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;

        return $this;
    }
}
