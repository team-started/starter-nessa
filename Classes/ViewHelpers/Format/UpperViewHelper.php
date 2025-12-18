<?php

declare(strict_types=1);

namespace StarterTeam\StarterNessa\ViewHelpers\Format;

use InvalidArgumentException;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to format a string in upper letter with PHP `strtoupper()` function.
 * For more details have a look into PHP documentation on https://www.php.net/manual/function.strtoupper.php
 *
 * # Example: Basic example
 * <code>
 * <starterteam:format.upper>Some Text</starterteam:format.upper>
 * </code>
 * <output>
 * SOME TEXT
 * </output>
 *
 * # Example: Inline notation
 * <code>
 * {text -> starterteam:format.upper()}
 * </code>
 * <output>
 * SOME TEXT
 * </output>
 */
class UpperViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    protected $escapeChildren = false;

    #[\Override]
    public function initializeArguments(): void
    {
        $this->registerArgument('value', 'string', 'String to format');
    }

    #[\Override]
    public function render(): string
    {
        $value = $this->renderChildren();
        if (is_array($value)) {
            throw new InvalidArgumentException('Specified array cannot be converted to string.', 1752329208);
        }
        if (is_object($value)) {
            throw new InvalidArgumentException('Specified object cannot be converted to string.', 1752329228);
        }

        $value = StringUtility::cast($value);
        if (is_null($value)) {
            throw new InvalidArgumentException('Specified value cannot be converted to string.', 1752329547);
        }

        return strtoupper($value);
    }

    /**
     * Explicitly set argument name to be used as content.
     */
    #[\Override]
    public function getContentArgumentName(): string
    {
        return 'value';
    }
}
