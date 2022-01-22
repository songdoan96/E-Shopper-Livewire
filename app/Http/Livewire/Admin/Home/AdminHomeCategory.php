<?php

namespace App\Http\Livewire\Admin\Home;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategory extends Component
{

    public $sel_categories = [];
    // protected $listeners = ['postAdded' => '$refresh'];


    public function mount()
    {
        $category = HomeCategory::find(1);
        if ($category) {
            $this->sel_categories = explode(',', $category->sel_categories);
        }
    }
    public function updateHomeCategory()
    {
        $category = HomeCategory::find(1);
        if (!$category) {
            $category = new HomeCategory();
        }
        $category->sel_categories = implode(",", $this->sel_categories);
        $category->save();


        session()->flash('success_msg', 'Thêm thành công!');
        // $this->dispatchBrowserEvent('updateHomeCategory');
        // $this->emitTo('admin.home.admin-home-category', 'updateHomeCategory');
        $this->emit('updateHomeCategory');
    }
    public function render()
    {

        $categories = Category::where('status', '1')->get();
        return view('livewire.admin.home.admin-home-category', compact('categories'))->layout('layouts.admin');
    }
}
