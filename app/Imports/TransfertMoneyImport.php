<?php

namespace App\Imports;

use App\Models\TransfertMoney;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class TransfertMoneyImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $datePayment = $this->excelDateToDateTime($row['date_paiement']);

        return new TransfertMoney([
            'ref_payment' => $row['reference_paiement'],
            'mode_payment' => $row['mode_paiement'],
            'date_payment' => $datePayment,
            'amount' => $row['montant_paiement'],
        ]);
    }

    private function excelDateToDateTime($excelDate)
    {
        return Carbon::createFromDate(1900, 1, 1)->addDays($excelDate - 2);
    }
}

