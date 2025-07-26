<?php

namespace App\Livewire;

use App\Models\Deal;
use Livewire\Component;

class DealsPipeline extends Component
{
    public $stages;
    public $selectedDealId = null;
    public ?Deal $notesModalDeal = null;
    public string $newNoteBody = '';

    public function mount()
    {
        $this->stages = ['Lead', 'Contacted', 'Demo Scheduled', 'Proposal Sent'];
    }

    public function selectDeal($dealId)
    {
        $this->selectedDealId = $dealId;
    }

    public function updateStage($newStage)
    {
        if ($this->selectedDealId) {
            Deal::find($this->selectedDealId)->update(['stage' => $newStage]);
            $this->selectedDealId = null;
        }
    }

    public function openNotesModal($dealId)
    {
        // Only query the database if a new deal is hovered
        if ($this->notesModalDeal?->id !== $dealId) {
            $this->notesModalDeal = Deal::with('notes.user')->find($dealId);
        }
    }

    public function addNote()
    {
        $this->validate(['newNoteBody' => 'required|string']);

        if ($this->notesModalDeal) {
            $this->notesModalDeal->notes()->create([
                'body' => $this->newNoteBody,
                'user_id' => auth()->id(),
            ]);
            $this->newNoteBody = '';
            // Refresh the notes data in the popover
            $this->notesModalDeal->load('notes.user');
        }
    }

    public function render()
    {
        $deals = Deal::whereIn('stage', $this->stages)
                     ->with('customer')
                     ->get()
                     ->groupBy('stage');

        return view('livewire.deals-pipeline', [
            'deals' => $deals,
        ]);
    }
}