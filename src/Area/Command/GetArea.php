<?php namespace ConductLab\StructDataModule\Area\Command;

use ConductLab\StructDataModule\Area\Contract\AreaInterface;
use ConductLab\StructDataModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class GetArea
 *
 * @link   https://ConductLab.site/
 * @author Behavior CPH, ApS <support@ConductLab.site>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author Claus Hjort Bube <chb@b-cph.com>
 */
class GetArea
{

    /**
     * The structured_datum identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetArea instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param AreaRepositoryInterface $groups
     * @return AreaInterface|EloquentModel|null
     */
    public function handle(AreaRepositoryInterface $groups)
    {
        if (is_numeric($this->identifier)) {
            return $groups->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $groups->findBySlug($this->identifier);
        }

        if ($this->identifier instanceof EntryInterface) {
            return $this->identifier;
        }

        if ($this->identifier instanceof EntryPresenter) {
            return $this->identifier->getObject();
        }

        return null;
    }
}
