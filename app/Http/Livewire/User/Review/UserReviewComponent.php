<?php

namespace App\Http\Livewire\User\Review;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;
    public function mount($order_item_id)
    {
        $this->order_item_id = $order_item_id;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'rating' => 'required',
            'comment' => 'required'
        ]);
    }
    public function addReview()
    {
        $this->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);
        $review = new Review();
        $review->rating = $this->rating;
        $review->comment = $this->comment;
        $review->order_item_id = $this->order_item_id;
        OrderItem::where('id', $this->order_item_id)->update(['r_status' => true]);
        $review->save();
        session()->flash('success_msg', 'Xin cảm ơn bạn đã đánh giá');
    }
    public function render()
    {
        $orderItem =  OrderItem::find($this->order_item_id);

        return view('livewire.user.review.user-review-component', compact('orderItem'))->layout("layouts.base");
    }
}
