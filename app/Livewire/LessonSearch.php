<?php

namespace App\Livewire;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithPagination;

class LessonSearch extends Component
{
    use WithPagination;

    public $search = '';

    public $module;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $lessons = Lesson::query()
            ->where('module_id', $this->module->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('order')
            ->paginate(10);

        return view('livewire.lesson-search', [
            'lessons' => $lessons,
        ]);
    }
}