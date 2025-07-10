<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'investment_id',
        'return_amount',
        'bonus_amount',
        'sent_to_bank',
        'created_at'
    ];

    protected $useTimestamps = false;

    // Optional: join with investment
    public function withInvestment()
    {
        return $this->select('returns.*, investments.investor_name, investments.amount, investments.unique_investment_id')
            ->join('investments', 'investments.id = returns.investment_id')
            ->orderBy('returns.created_at', 'DESC')
            ->findAll();
    }
}
