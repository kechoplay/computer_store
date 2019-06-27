<?php
namespace App\Exports;

use App\HoaDon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class doanhthuExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct($TuNgay=null, $DenNgay=null)
    {
        $this->TuNgay = Carbon::now()->startOfMonth();
        if ($TuNgay!=null)
        $this->TuNgay = $TuNgay;
        $this->DenNgay = Carbon::now()->endOfMonth();
        if ($DenNgay!=null)
        $this->DenNgay = $DenNgay;
    }
    public function headings(): array
    {
        return [
            'Mã HĐ',
            'Ngày',
            'Địa chỉ',
            'Khách hàng',
            'Số điện thoại',
            'Tổng tiền'
        ];
    }
    public function collection()
    {
        $danhsachhoadon = HoaDon::where('status', 3)
        // ->where('ThoiGian', '>=', $this->TuNgay)->where('ThoiGian', '<=', $this->DenNgay)
        ->get()->map(function($item) {
            $result = [
                'MaHD' => $item->id,
                'ThoiGian' => $item->time_buy,
                'DiaChi' => $item->address,
                'TenKH' => $item->customer_name,
                'SDT' => $item->phone,
                'tongtien' => $item->tongtien()
            ];
            return $result;
        });
        return $danhsachhoadon;
    }
}
