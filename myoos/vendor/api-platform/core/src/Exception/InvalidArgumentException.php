<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Exception;

/**
 * Invalid argument exception.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
}

if (!class_exists(\ApiPlatform\Core\Exception\InvalidArgumentException::class)) {
    class_alias(InvalidArgumentException::class, \ApiPlatform\Core\Exception\InvalidArgumentException::class);
}
