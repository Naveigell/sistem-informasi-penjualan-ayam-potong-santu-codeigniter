<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Expenditure;
use App\Models\Shipping;
use App\Models\User;
use DateTime;

class DashboardController extends BaseController
{
    public function index()
    {
        $members      = (new User())->where('role', User::ROLE_USER)->countAllResults();
        $shippings    = (new Shipping())->where('finished', 0)->countAllResults();
        $incomes      = (new Shipping())->where('finished', 1)->selectSum('total')->first();
        $expenditures = (new Expenditure())->selectSum('total')->first();

        $incomesPerMonths      = $this->calculateIncomesPerMonth();
        $expendituresPerMonths = $this->calculateExpendituresPerMonth();

        return view('admin/pages/dashboard/index', compact('members', 'shippings', 'incomes', 'expenditures', 'incomesPerMonths', 'expendituresPerMonths'));
    }

    private function calculateExpendituresPerMonth()
    {
        $expendituresPerMonths = [];

        foreach ((new Expenditure())->get()->getResultArray() as $expenditure) {

            $month = date('F', strtotime($expenditure['publish_date']));

            if (!array_key_exists($month, $expendituresPerMonths)) {
                $expendituresPerMonths[$month] = $expenditure['total'];
            } else {
                $expendituresPerMonths[$month] += $expenditure['total'];
            }
        }

        $monthWithZeroExpenditures = [];

        foreach (range(0, 5) as $month) {

            $key = date('F', strtotime("-{$month} months"));

            $monthWithZeroExpenditures[$key] = 0;
        }

        $expenditurePerMonthsTemporary = array_map(function ($item) use ($expendituresPerMonths, $monthWithZeroExpenditures) {

            if (array_key_exists($item, $expendituresPerMonths)) {
                return [$item => $expendituresPerMonths[$item]];
            }

            return [$item => $monthWithZeroExpenditures[$item]];

        }, array_keys($monthWithZeroExpenditures));

        $expendituresPerMonths = [];

        foreach ($expenditurePerMonthsTemporary as $month => $expenditure) {

            $tempExpenditureValue = array_values($expenditure);
            $tempExpenditureKey   = array_keys($expenditure);

            $expendituresPerMonths[reset($tempExpenditureKey)] = reset($tempExpenditureValue);
        }

        return array_reverse($expendituresPerMonths);
    }

    private function calculateIncomesPerMonth()
    {
        $incomesPerMonths = [];

        foreach ((new Shipping())->where('finished_date IS NOT NULL')->get()->getResultArray() as $income) {

            $month = date('F', strtotime($income['finished_date']));

            if (!array_key_exists($month, $incomesPerMonths)) {
                $incomesPerMonths[$month] = $income['total'];
            } else {
                $incomesPerMonths[$month] += $income['total'];
            }
        }

        $monthWithZeroIncomes = [];

        foreach (range(0, 5) as $month) {

            $key = date('F', strtotime("-{$month} months"));

            $monthWithZeroIncomes[$key] = 0;
        }

        $incomesPerMonthsTemporary = array_map(function ($item) use ($incomesPerMonths, $monthWithZeroIncomes) {

            if (array_key_exists($item, $incomesPerMonths)) {
                return [$item => $incomesPerMonths[$item]];
            }

            return [$item => $monthWithZeroIncomes[$item]];

        }, array_keys($monthWithZeroIncomes));

        $incomesPerMonths = [];

        foreach ($incomesPerMonthsTemporary as $month => $income) {

            $tempIncomeValue = array_values($income);
            $tempIncomeKey   = array_keys($income);

            $incomesPerMonths[reset($tempIncomeKey)] = reset($tempIncomeValue);
        }

        return array_reverse($incomesPerMonths);
    }
}
