<?php
declare(strict_types=1);

namespace Src\SurchargeMS\Surcharge\Application\Services;

use Src\SurchargeMS\Surcharge\Domain\Contracts\SurchargeRepositoryContract;

final class StandardizeSurchargeNameService
{
    public static function standardize($surchargeName)
    {
        $surchargeName = strtolower(trim($surchargeName));

        // Establecer el valor del standard_name de acuerdo a la lógica existente
        return match ($surchargeName) {
            'winter surcharge', 'winter charge' => 'Winter Surcharge',
            'bl', 'bl fee', 'bill of lading (bl)', 'b/l fee' => 'Bill of Lading',
            'doc fee', 'doc fees', 'documentation fee' => 'Documentation',
            'log fee', 'logistics fee' => 'Logistics',
            'arbitrary charge d','arbitrary charge o','arbitrary charge destination', 'arbitrary charge origin', 'arbitrary charge origin o', 'arbitrary charge origin d' => 'Arbitrary Charge',
            'vgm fee','vgm', 'verified gross mass' => 'Verified Gross Mass',
            'terminal handling', 'terminal fee', 'terminal handling charge', 'terminal handling charge o', 'terminal handling charge origin', 'terminal handling charge destination', 'terminal handling charge (d)', 'terminal fees' => 'Terminal Handling',
            'overweight','overweight surcharge' => 'Overweight',
            'tasa t3', 't-3', 't3', 't3 fee', 't3 origin' => 'Tasa T3',
            'peak season surcharge', 'pss', 'peak season adjustment factor' => 'Peak Season',
            'cesion transporte', 'cesion tte', 'cesion' => 'Cesion',
            'port charges import', 'port charges export', 'port charges destination' => 'Port Charges',
            'booking fee', 'booking service charge', 'booking charge' => 'Booking Service',
            'isps' => 'International Ship and Port Facility Security',
            'bunker adjustment fee', 'bunker adjustment factor', 'bunker adjustment charge', 'baf' => 'Bunker Adjustment',
            'basic freight','basic ocean freight', 'ocean freight charge', 'ocean freight' => 'Ocean Freight',
            default => $surchargeName,
        };

    }
}
