<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommercialActivityComments extends Component
{
  public $commercialActivityId;
  public $comments;
  public $replyBody = [];
  public $parentId = null;

  protected $rules = [
      'replyBody.*' => 'required|string',
  ];

  public function mount($commercialActivityId)
  {
      $this->commercialActivityId = $commercialActivityId;
      $this->loadComments();
  }

  public function loadComments()
  {
      $this->comments = Comment::where('commercial_activity_id', $this->commercialActivityId)
          ->where('parent_id',0)
          ->with('replies')
          ->get();
  }

  public function addComment($parentId = 0)
  {
      $this->validate();
    Comment::create([
          'body' => $this->replyBody['activeCommentId'] ?? '',
          'user_id' => auth()->id(),
          'commercial_activity_id' => $this->commercialActivityId,
          'parent_id' => $parentId,
      ]);
      
      $this->replyBody = '';
      $this->loadComments(); // Ricarica i commenti
  }


    public function render()
    {

        return view('livewire.commercial-activity-comments');
    }

    public function openLoginModal()
{
    // Questo metodo non deve fare nulla in termini di logica, ma può essere utilizzato per notificare Alpine.js
    $this->dispatchBrowserEvent('open-login-modal');
}

}
