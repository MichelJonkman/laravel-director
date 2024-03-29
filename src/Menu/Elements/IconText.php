<?php

namespace MichelJonkman\Director\Menu\Elements;


use Vite;

class IconText extends Text implements IconTextInterface
{
    protected string $typeName = 'IconTextElement';
    protected ?string $iconUrl = null;

    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    public function setIconUrl(string $iconUrl): static
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * Sets the icon using the Vite::asset() method, uses hot file 'dummy' as the dev server doesn't compile icons correctly
     */
    public function setIconAsset(string $iconPath, string $buildDirectory): static
    {
        $hotfile = Vite::hotFile();
        $this->setIconUrl(Vite::useHotFile('dummy')->asset($iconPath, $buildDirectory));
        Vite::useHotFile($hotfile);

        return $this;
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'iconUrl' => $this->getIconUrl()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'iconUrl' => 'nullable'
        ]);
    }
}
