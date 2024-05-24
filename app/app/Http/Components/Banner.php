<?php

namespace App\Http\Components;

use App\Models\Banner as BannerModel;
use Livewire\Component;

class Banner extends Component
{
    public $hasBanners = false;
    public $banners = [];

    public function render()
    {
        $this->load();

        return view('components.banner');
    }

    public function load(): void
    {
        $this->banners = BannerModel::all();
        $this->hasBanners = !$this->banners->isEmpty();
    }

    public function deleteBanner($id): void
    {
        BannerModel::destroy($id);
        $this->load();
    }
}
