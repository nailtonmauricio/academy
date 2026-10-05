<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use Livewire\WithPagination;

class ModuleSearch extends Component
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
        $courses = Course::query()
            ->with('subcategory.category')
            ->orderBy('name')
            ->get();

        $modules = Module::query()
            ->with('course')
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('course', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('order')
            ->paginate(10);

        return view('livewire.module-search', [
            'courses' => $courses,
            'modules' => $modules,
        ]);
    }
}
