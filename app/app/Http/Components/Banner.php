<?php

namespace App\Http\Components;

use App\Models\Banner as BannerModel;
use Livewire\Component;

class Banner extends Component
{
    public $location;
    public $banners = [];
    public $hasBanners = false;

    public function mount($location)
    {
        $this->location = $location;
    }

    public function render()
    {
        $banners = BannerModel::where('location', $this->location)->get();

        foreach ($banners as $key => $banner) {
            switch ($banner['type']) {
                case 'info':
                    $banners[$key]['style'] = [
                        'title' => 'text-white',
                        'desc' => 'text-blue-300',
                        'bg' => 'bg-blue-600 border-blue-600',
                        'icon' => 'text-blue-300',
                        'close' => 'text-blue-300',
                    ];

                    break;

                case 'warning':
                    $banners[$key]['style'] = [
                        'title' => 'text-amber-900',
                        'desc' => 'text-amber-700',
                        'bg' => 'bg-amber-100 border-amber-300',
                        'icon' => 'text-amber-400',
                        'close' => 'text-amber-400',
                    ];

                    break;

                case 'error':
                    $banners[$key]['style'] = [
                        'title' => 'text-white',
                        'desc' => 'text-red-300',
                        'bg' => 'bg-red-500 border-red-600',
                        'icon' => 'text-red-300',
                        'close' => 'text-red-300',
                    ];

                    break;
            }
        }

        $this->banners = $banners->toArray();

        return view('components.banner');
    }

    public function deleteBanner($id): void
    {
        BannerModel::find($id)->delete();
        $this->load();
    }
}
