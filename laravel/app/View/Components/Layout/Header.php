<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Header extends Component
{
    public array $menuItems;

    public function __construct(?array $menuItems = null)
    {
        $this->menuItems = $menuItems ?? [
            ['label' => 'Ana Sayfa', 'route' => 'home'],
            ['label' => 'Ürünler', 'route' => 'products.index'],
            ['label' => 'Hakkımızda', 'route' => 'about'],
            ['label' => 'İletişim', 'route' => 'contact'],
        ];
    }

    public function isActive(string $routeName): bool
    {
        return request()->routeIs($routeName);
    }

    public function render()
    {
        return view('components.layout.header');
    }
}
