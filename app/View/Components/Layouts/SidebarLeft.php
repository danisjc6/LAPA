<?php

namespace App\View\Components\Layouts;

use App\Services\AtlasSidebarService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SidebarLeft extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected AtlasSidebarService $sidebarService,
        public string $title = 'Atlas Interativo',
        public string $searchPlaceholder = 'Pesquisar...',
        public ?string $currentAnimalSlug = null,
        public ?string $currentAreaSlug = null,
        public ?string $currentSistemaSlug = null,
        public ?string $currentEstruturaSlug = null,
        public ?string $currentConteudoSlug = null,
        public bool $open = true,
    )
    {}

    public function menuLateral(): Collection
    {
        return $this->sidebarService->montarNavegacaoLateral();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.sidebar-left');
    }
}
