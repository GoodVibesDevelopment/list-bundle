<?php
/**
 * This file is part of the vardius/list-bundle package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\ListBundle\Column\Types;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * AbstractType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
abstract class AbstractType implements ColumnTypeInterface
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver, $property, $templatePath)
    {
        $class = get_class($this);
        $resolver->setDefaults([
            'property' => $property,
            'label' => $property,
            'sort' => false,
            'ui' => false,
            'attr' => [],
            'row_action' => [],
            'view' => $templatePath . strtolower(str_replace('Type', '', substr($class, strrpos($class, '\\') + 1))) . '.html.twig'
        ]);

        $resolver->setAllowedTypes('label', 'string');
        $resolver->setAllowedTypes('property', 'string');
        $resolver->setAllowedTypes('view', 'string');
        $resolver->setAllowedTypes('sort', 'bool');
        $resolver->setAllowedTypes('ui', 'bool');
        $resolver->setAllowedTypes('attr', 'array');
        $resolver->setAllowedTypes('row_action', 'array');
    }
}
