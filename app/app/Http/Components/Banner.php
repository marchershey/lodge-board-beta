<?php

namespace App\Http\Components;

use App\Models\Banner as BannerModel;
use Livewire\Component;

class Banner extends Component
{
    public $location;
    public $hasBanners = false;
    public $banners = [];

    public function mount($location)
    {
        $this->location = $location;
    }

    public function render()
    {
        $this->load();

        return view('components.banner');
    }

    public function load(): void
    {
        $this->banners = BannerModel::where('location', $this->location)->get();
        $this->hasBanners = !$this->banners->isEmpty();
    }

    public function deleteBanner($id): void
    {
        BannerModel::find($id)->delete();
        $this->load();
    }
}
