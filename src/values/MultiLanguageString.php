<?php declare(strict_types=1);

namespace ddd\i18n\values;

use ddd\domain\values\AbstractDomainValue;

class MultiLanguageString extends AbstractDomainValue
{
    private const DEFAULT_LANGUAGE_KEY = 'en';
    /** @var string[] */
    private array $value = [];
    private ?string $default = null;

    /**
     * MultiLanguageString constructor.
     * @param array|string[] $values
     * @param string|null $default
     */
    public function __construct(array $values, ?string $default = null)
    {
        $this->value = $values;
        $this->default = $default;
    }

    public function getStringForLanguage(string $language): ?string
    {
        if (array_key_exists($language, $this->value))
            return $this->value[$language];

        return $this->value[static::DEFAULT_LANGUAGE_KEY] ?? $this->default;
    }

    public function setForLanguage(string $language, ?string $value): self
    {
        $this->value[$language] = $value;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getDefault(): ?string
    {
        return $this->default;
    }
}