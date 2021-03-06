<?php
/**
 * This file is part of the tipper package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vardius\Bundle\ListBundle\Filter\Types\Type;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vardius\Bundle\ListBundle\Event\FilterEvent;
use Vardius\Bundle\ListBundle\Filter\Types\AbstractType;

/**
 * NumericType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class NumericType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('condition', 'eq');
        $resolver->addAllowedTypes('condition', 'string');
        $resolver->addAllowedValues('condition', ['eq', 'neq', 'lt', 'lte', 'gt', 'gte']);
    }

    /**
     * @inheritDoc
     */
    public function apply(FilterEvent $event, array $options)
    {
        $queryBuilder = $event->getQuery();
        if (!$queryBuilder instanceof QueryBuilder) {
            throw new \Exception('Vardius\Bundle\ListBundle\Filter\Types\NumericType supports only doctrine filters for now. To filter Propel or ElasticSearch Queries use callbacks or create your own FilterType classes');
        }

        $value = $event->getValue();
        if ($value) {
            $field = empty($options['field']) ? $event->getField() : $options['field'];

            $expression = $queryBuilder->expr();

            $queryBuilder
                ->andWhere($expression->{$options['condition']}($event->getAlias() . '.' . $field, ':vardius_numeric_' . $event->getField()))
                ->setParameter('vardius_numeric_' . $event->getField(), $value);
        }

        return $queryBuilder;
    }
}
