<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientSelectionHd extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'recipient_selection_hd_id';
    protected $table = 'recipient_selection_hds';
    protected $guarded = ['recipient_selection_hd_id'];
    public function subdetails()
    {
        return $this->hasMany(RecipientSelectionSub::class, 'recipient_selection_hd_id', 'recipient_selection_hd_id');
    }
}
