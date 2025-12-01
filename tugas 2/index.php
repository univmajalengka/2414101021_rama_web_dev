<?php

function hitungDiskon(float $totalBelanja): float 
{
    $diskonNominal = 0.0; 
    if ($totalBelanja >= 100000) {
        $diskonPersen = 0.10; 
        $diskonNominal = $totalBelanja * $diskonPersen;
        $keteranganDiskon = "10%";
    
    } elseif ($totalBelanja >= 50000 && $totalBelanja < 100000) {
        $diskonPersen = 0.05; 
        $diskonNominal = $totalBelanja * $diskonPersen;
        $keteranganDiskon = "5%";
        
    } else {
        $diskonNominal = 0.0;
        $keteranganDiskon = "0%";
    }

    return $diskonNominal;
}

$totalBelanja = 120000.00; 

$diskon = hitungDiskon($totalBelanja);

$totalBayar = $totalBelanja - $diskon;

function formatRupiah(float $angka): string {
    return "Rp. " . number_format($angka, 2, ',', '.');
}

// 4. Tampilkan (print) hasil ke layar.
echo "==============================================\n";
echo "         HASIL PERHITUNGAN DISKON\n";
echo "==============================================\n";
echo "Total Belanja Awal  : " . formatRupiah($totalBelanja) . "\n";
echo "----------------------------------------------\n";
echo "Diskon (Nominal)    : " . formatRupiah($diskon) . "\n";
echo "----------------------------------------------\n";
echo "Total Yang Dibayar  : " . formatRupiah($totalBayar) . "\n";
echo "==============================================\n";

?>