<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestmentModel extends Model
{
    protected $table = 'investments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'team_id',
        'investor_name',
        'amount',
        'unique_investment_id',
        'receipt_number',
        'created_at'
    ];

    protected $useTimestamps = false;

    // Optional: join with team table
    public function withTeam()
    {
        return $this->select('investments.*, teams.name as team_name')
            ->join('teams', 'teams.id = investments.team_id')
            ->orderBy('investments.created_at', 'DESC')
            ->findAll();
    }
}
