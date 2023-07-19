<?php

declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Domain\ValueObjects;

use InvalidArgumentException;

final class CarrierId
{
    /**
     * @param int $id
     */
    public function __construct(private readonly int $id)
    {
        $this->validate($id);

    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function validate(int $id): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', CarrierId::class, $id)
            );
        }
    }

    public function value(): int
    {
        return $this->id;
    }

}
