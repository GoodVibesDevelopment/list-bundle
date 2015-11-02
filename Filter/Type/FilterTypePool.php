<?php
/**
 * This file is part of the vardius/list-bundle package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\ListBundle\Filter\Type;

use Doctrine\Common\Collections\ArrayCollection;

class FilterTypePool
{
    /** @var ArrayCollection */
    protected $types;

    /**
     * {@inheritdoc}
     */
    function __construct()
    {
        $this->types = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param FilterType $type
     */
    public function addType(Action $type)
    {
        $this->types->set($type->getName(), $type);
    }

    /**
     * @param string $id
     * @return FilterType
     */
    public function getType($id)
    {
        return $this->types->get($id);
    }

}
