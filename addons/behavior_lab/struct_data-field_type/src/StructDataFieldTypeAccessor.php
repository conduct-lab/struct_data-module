<?php namespace BehaviorLab\StructDataFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class StructDataFieldTypeAccessor
 *
 * @link   https://behaviorlab.site/
 * @author Behavior CPH, ApS <support@behaviorlab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class StructDataFieldTypeAccessor extends FieldTypeAccessor
{

    /**
     * The field type object.
     * This is for IDE support.
     *
     * @var StructDataFieldType
     */
    protected $fieldType;

    /**
     * Set the value.
     *
     * @param $value
     */
    public function set($value)
    {
        if ($value instanceof MultipleFormBuilder) {
            return;
        }

        if (is_string($value)) {
            $value = $this->organizeSyncValue(explode(',', $value));
        } elseif (is_array($value)) {
            $value = $this->organizeSyncValue($value);
        } elseif ($value instanceof Collection) {
            $value = $this->organizeSyncValue($value->filter()->all());
        } elseif ($value instanceof EntryInterface) {
            $value = $this->organizeSyncValue([$value->getId()]);
        }

        $this->fieldType
            ->getRelation()
            ->getBaseQuery()
            ->delete();

        if (!$value) {
            return;
        }

        array_walk(
            $value,
            function ($insert) {
                $this->fieldType->getRelatedModel()->newQuery()->insert($insert);
            }
        );
    }

    /**
     * Organize the value for sync.
     *
     * @param  array $value
     * @return array
     */
    protected function organizeSyncValue(array $value)
    {
        $value = array_filter(array_values($value));

        array_walk(
            $value,
            function (&$data, $key) {
                $data['sort_order'] = $key;
            }
        );

        return $value;
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function get()
    {
        /* @var EloquentModel $entry */
        $entry = $this->fieldType->getEntry();

        $relation = camel_case($this->fieldType->getFieldName());

        /**
         * If the relation is already
         * loaded then don't load again!
         */
        if ($entry->relationLoaded($relation)) {
            return $entry->getRelation($relation);
        }

        return $this->fieldType->getRelation();
    }
}