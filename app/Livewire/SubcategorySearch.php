<?php

namespace App\Livewire;

use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategorySearch extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }


    public function confirmDelete(int $id): void
    {
        $this->dispatch('show-delete-confirmation', id: $id);
    }

    public function render()
    {
        $subcategories = Subcategory::query()
            ->with('category')
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('category', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.subcategory-search', [
            'subcategories' => $subcategories,
        ]);
    }
}