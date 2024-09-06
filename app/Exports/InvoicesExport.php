<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::all();
    //return Invoice::select('invoice_number','section_id', 'product', 'Amount_collection','Amount_Commission', 'Rate_VAT', 'Value_VAT','Total', 'Status', 'Payment_Date','note')->get();

    }
}
