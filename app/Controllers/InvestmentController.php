<?php

namespace App\Controllers;

use App\Models\Teams_model;
use App\Models\InvestmentModel;
use App\Models\ReturnModel;

class InvestmentController extends BaseController
{
    public function investment()
    {
        $data = ['title' => 'Investment'];
        return view('investment', $data);
    }

    public function invester()
    {
        $investmentModel = new InvestmentModel();
        $teams_model = new Teams_model();
        $returnModel = new ReturnModel(); // अगर आप returns भी दिखा रहे हैं

        $data = ['title' => 'Investment Details'];

        if ($this->request->getMethod() === 'get') {
            $data['teams'] = $teams_model->findAll();

            // JOIN करके टीम का नाम भी ले रहे हैं
            $data['investments'] = $investmentModel
                ->select('investments.*, teams.name as team_name')
                ->join('teams', 'teams.id = investments.team_id')
                ->findAll();

            // अगर नीचे वाला सेक्शन view में है तो ही returnModel को call करें
            $data['returns'] = $returnModel
                ->select('returns.*, investments.investor_name, investments.amount, investments.unique_investment_id, returns.created_at, returns.sent_to_bank')
                ->join('investments', 'investments.id = returns.investment_id')
                ->findAll();

            return view('admin/invester', $data);
        }

        if ($this->request->getMethod() === 'post') {
            $amount = $this->request->getPost('amount');
            if ($amount < 100) {
                return redirect()->back()->with('status', '<div class="alert alert-danger">Minimum investment amount is ₹100</div>');
            }

            $saveData = [
                'team_id' => $this->request->getPost('team_id'),
                'investor_name' => $this->request->getPost('investor_name'),
                'amount' => $amount,
                'unique_investment_id' => uniqid('INV'),
                'receipt_number' => 'RCPT' . time(),
            ];

            if ($investmentModel->save($saveData)) {
                return redirect()->to(base_url('admin/invester'))->with('status', '<div class="alert alert-success" role="alert">Investment added successfully!</div>');
            } else {
                return redirect()->to(base_url('admin/invester'))->with('status', '<div class="alert alert-danger" role="alert">Failed to save investment.</div>');
            }
        }
    }
}
