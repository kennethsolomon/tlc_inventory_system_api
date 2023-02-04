<?php

namespace Database\Seeders;

use App\Models\Consumable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsumableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Consumable = [
            [
                'property_code' => 'PO-2022-001',
                'property_name' => 'Bond Paper',
                'description' => 'Hard Copy Long Size',
                'cost' => '₱166.84',
                'quantity' => '20',
                'unit_of_measure' => 'ream'
            ],
            [
                'property_code' => 'PO-2022-002',
                'property_name' => 'Printer ink',
                'description' => 'Brother BT5000',
                'cost' => '₱390.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-003',
                'property_name' => 'Binder clip',
                'description' => 'Joy 3/4inch or 19mm',
                'cost' => '₱65.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-004',
                'property_name' => 'Paper clips',
                'description' => 'Vinyl clip assorted',
                'cost' => '₱75.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-005',
                'property_name' => 'Push pins',
                'description' => 'HBWOffice',
                'cost' => '₱145.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-006',
                'property_name' => 'Staples',
                'description' => 'HBW 1/2',
                'cost' => '₱38.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-007',
                'property_name' => 'Envelope',
                'description' => 'Elephant 425F Long Size',
                'cost' => '₱15.00',
                'quantity' => '10',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-008',
                'property_name' => 'Tape',
                'description' => 'Transparent scotch tape',
                'cost' => '55',
                'quantity' => '100',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-009',
                'property_name' => 'Pens',
                'description' => 'WISDOM HBW Matrix retractable OG-5 ballpen',
                'cost' => '₱199',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-011',
                'property_name' => 'Markers',
                'description' => ' Whiteboard Refillable Marker',
                'cost' => '₱240',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-012',
                'property_name' => 'Highlighters',
                'description' => 'TOUCHCOOL',
                'cost' => '₱299.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-013',
                'property_name' => 'Box cutter',
                'description' => 'utility knife paper',
                'cost' => '39',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-015',
                'property_name' => 'Sticky notes',
                'description' => '200pcs Colorful Sticky Note',
                'cost' => '₱27',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-016',
                'property_name' => 'White glue',
                'description' => 'HBW GLUE',
                'cost' => '₱30.00',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-017',
                'property_name' => 'Pencil sharpener',
                'description' => 'Assorted Pencil Sharpeners',
                'cost' => '₱38.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-018',
                'property_name' => 'Eraser',
                'description' => 'PILOT PLASTIC ERASER EE102 WHITE BIG ',
                'cost' => '₱6',
                'quantity' => '40',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-019',
                'property_name' => 'Puncher',
                'description' => 'small puncher ps-1120',
                'cost' => '₱45',
                'quantity' => '40',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-020',
                'property_name' => 'Carbon paper',
                'description' => 'Club Carbon Paper Short or Long',
                'cost' => '₱210.00',
                'quantity' => '20',
                'unit_of_measure' => 'ream'
            ],
            [
                'property_code' => 'PO-2022-021',
                'property_name' => 'Permanent marker',
                'description' => 'Pilot Permanent Marker',
                'cost' => '₱270.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-022',
                'property_name' => 'fastener',
                'description' => 'Joy Fastener Plastic 5507 Assorted',
                'cost' => '₱47.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-023',
                'property_name' => 'Printer paper',
                'description' => 'HARDCOPY COPY PAPER A4 80GSM',
                'cost' => '₱301.00',
                'quantity' => '20',
                'unit_of_measure' => 'ream'
            ],
            [
                'property_code' => 'PO-2022-024',
                'property_name' => 'Binder clip',
                'description' => 'Deli E38565 Economical Long Tail Ticket Clip 19mm',
                'cost' => '₱50.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-025',
                'property_name' => 'correction tape',
                'description' => 'HBW correction tape',
                'cost' => '₱30.00',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-026',
                'property_name' => 'Folder',
                'description' => 'FILE FOLDER WHITE Long',
                'cost' => '₱10.00',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-027',
                'property_name' => 'cutting mat',
                'description' => 'HBW Cutting Mat Small Green HB-316 11.75x8.5 inches',
                'cost' => '₱135.00',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-028',
                'property_name' => 'laminating sheet',
                'description' => 'Rainbow Laminating Sheets A3 250mic 100\'s',
                'cost' => '₱1.135.00',
                'quantity' => '20',
                'unit_of_measure' => 'box'
            ],
            [
                'property_code' => 'PO-2022-029',
                'property_name' => 'correction pen',
                'description' => 'DONG-A CORRECTION PEN METAL TIP 119001 12ML 16MM FINE TIP',
                'cost' => '₱63.00',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
            [
                'property_code' => 'PO-2022-030',
                'property_name' => 'ink',
                'description' => 'ink for Pilot whiteboard markers',
                'cost' => '₱151.00',
                'quantity' => '20',
                'unit_of_measure' => 'pcs'
            ],
        ];
        Consumable::upsert($Consumable, []);
    }
}
