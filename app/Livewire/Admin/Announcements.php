<?php

namespace App\Livewire\Admin;

use App\Models\Announcement;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Announcements extends Component
{
    public bool $showFormModal = false;

    public bool $isEditing = false;

    public ?int $selectedAnnouncementId = null;

    public string $title = '';

    public string $body = '';

    protected array $rules = [
        'title' => 'required|string|min:5|max:150',
        'body' => 'required|string|min:10|max:2000',
    ];

    protected array $messages = [
        'title.required' => 'Please enter a title for the announcement.',
        'title.min' => 'The title must be at least 5 characters.',
        'body.required' => 'Please enter the body content.',
        'body.min' => 'The announcement content must be at least 10 characters.',
    ];

    /**
     * Open modal for creating a new announcement
     */
    public function openCreateModal(): void
    {
        $this->reset(['title', 'body', 'selectedAnnouncementId', 'isEditing']);
        $this->showFormModal = true;
    }

    /**
     * Open modal for editing an existing announcement
     */
    public function openEditModal(int $id): void
    {
        $announcement = Announcement::findOrFail($id);
        $this->selectedAnnouncementId = $id;
        $this->title = $announcement->title;
        $this->body = $announcement->body;
        $this->isEditing = true;
        $this->showFormModal = true;
    }

    /**
     * Close the creation/editing modal
     */
    public function closeModal(): void
    {
        $this->showFormModal = false;
        $this->reset(['title', 'body', 'selectedAnnouncementId', 'isEditing']);
    }

    /**
     * Save the announcement (create or update)
     */
    public function save(): void
    {
        $this->validate();

        if ($this->isEditing) {
            $announcement = Announcement::findOrFail($this->selectedAnnouncementId);
            $announcement->update([
                'title' => $this->title,
                'body' => $this->body,
            ]);
            session()->flash('success', 'Announcement updated successfully.');
        } else {
            Announcement::create([
                'title' => $this->title,
                'body' => $this->body,
                'created_by' => auth()->id(),
            ]);
            session()->flash('success', 'Announcement posted successfully.');
        }

        $this->closeModal();
    }

    /**
     * Delete an announcement
     */
    public function delete(int $id): void
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        session()->flash('info', 'Announcement has been deleted.');
    }

    public function render(): View
    {
        $announcements = Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.announcements', [
            'announcements' => $announcements,
        ]);
    }
}
