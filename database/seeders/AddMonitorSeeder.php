<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AddMonitorSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // 1) MSI MPG 321URXW QD-OLED 31.5" 4K 240Hz
            [
                'name'     => 'MONITOR MSI MPG 321URXW QD-OLED - 31.5 QD-OLED 4K 240Hz (3Y)',
                'sku'      => 'SKU-250431914',
                'category' => ['slug' => 'monitor', 'name' => 'MONITOR'],
                'brand'    => 'MSI',
                'price'    => 40900,
                // ใส่ 'image' ได้ ถ้าต้องการบังคับ path เอง (จะถูกใช้เฉพาะกรณีไฟล์มีจริง)
                'image'    => 'images/Product/Monitor/MSI MPG 321URXW QD-OLED - 31.5 QD-OLED 4K 240Hz (3Y).png',
                'attributes' => [
                    ['name' => 'Brands', 'value' => 'MSI'],
                    ['name' => 'Display Size (in.)', 'value' => '32"'],
                    ['name' => 'Panel Size (in.)', 'value' => '31.5" QD-OLED'],
                    ['name' => 'Resolution', 'value' => '3840 x 2160'],
                    ['name' => 'Resolution Type', 'value' => '4K UHD'],
                    ['name' => 'Display color', 'value' => '1.07 Billion (10 bits)'],
                    ['name' => 'Display Viewing Area', 'value' => '699.48 x 394.73 mm'],
                    ['name' => 'Brightness', 'value' => "1000 nits (Typ.) (Peak 1000 with 3% APL)\n450 nits (Typ.) (HDR TrueBlack 400) (10% APL)\n250 nits (SDR)"],
                    ['name' => 'Contrast ratio', 'value' => '1500000:1 (Typ.)'],
                    ['name' => 'Response Time', 'value' => '0.03ms (GtG)'],
                    ['name' => 'Aspect Ratio', 'value' => '16 : 9'],
                    ['name' => 'Refresh Rate', 'value' => '240Hz'],
                    ['name' => 'Screen Curvature', 'value' => 'Flat screen'],
                    ['name' => 'Pixel Pitch (H x V)', 'value' => '0.1814 x 0.1814 mm'],
                    ['name' => 'Viewing Angle (CR≧10)', 'value' => '178° (H) / 178° (V)'],
                    ['name' => 'Color Gamut', 'value' => "Adobe RGB : 97%\nDCI-P3 : 99%\nsRGB : 138%"],
                    ['name' => 'Color Accuracy', 'value' => 'Delta E< 2'],
                    ['name' => 'HDR Support', 'value' => 'VESA DisplayHDR™ 400 True Black'],
                    ['name' => 'Adaptive Sync', 'value' => 'NVIDIA® G-SYNC® Compatible'],
                    ['name' => 'Display Surface', 'value' => 'Anti-Reflection'],
                    ['name' => 'Low Blue Light', 'value' => 'Yes'],
                    ['name' => 'Connectivity', 'value' => "2 x HDMI 2.1\n1 x DisplayPort 1.4a\n1 x USB Type-C (DP alt.) 90W PD\n2 x USB 2.0 Type-A\n1 x USB 2.0 Type-B\n1 x Audio Out"],
                    ['name' => 'Optimum Resolution', 'value' => "HDMI : 3840x2160 @240Hz\nDisplayPort : 3840x2160 @240Hz\nType-C : 3840x2160 @240Hz"],
                    ['name' => 'Built-in Speaker', 'value' => 'No'],
                    ['name' => 'Power', 'value' => '100-240 V 50/60Hz'],
                    ['name' => 'Mechanical', 'value' => "Kensington Lock : Yes\nVESA : 100x100mm\nHeight : 0~110mm\nTilt : -5° ~ +15°\nSwivel : -30° ~ +30°\nPivot : -10° ~ +10°"],
                    ['name' => 'Dimension (W x H x D)', 'value' => '718.3 x 613.6 x 158.6 mm'],
                    ['name' => 'Weight', 'value' => '9.6 kg (NW) / 12.3 kg (GW)'],
                    ['name' => 'Accessory in box', 'value' => "HDMI Cable, DP Cable, Power cord, 4x VESA Screw, USB-B to A, QSG"],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],

            // 2) SAMSUNG Odyssey G6 27" QD-OLED 2K 500Hz
            [
                'name'     => 'MONITOR SAMSUNG ODYSSEY G6 LS27FG602SEXXT - 27 QD-OLED 2K 500Hz (3Y)',
                'sku'      => 'SKU-250634900',
                'category' => ['slug' => 'monitor', 'name' => 'MONITOR'],
                'brand'    => 'SAMSUNG',
                'price'    => 29900,
                'image'    => 'images/Product/Monitor/SAMSUNG ODYSSEY G6 LS27FG602SEXXT - 27 QD-OLED 2K 500Hz (3Y).png',
                'attributes' => [
                    ['name' => 'Brands', 'value' => 'SAMSUNG'],
                    ['name' => 'Display Size (in.)', 'value' => '27"'],
                    ['name' => 'Panel Size (in.)', 'value' => '27" QD-OLED'],
                    ['name' => 'Resolution', 'value' => '2560 x 1440'],
                    ['name' => 'Resolution Type', 'value' => '2K QHD'],
                    ['name' => 'Display color', 'value' => 'Max 1 Billion'],
                    ['name' => 'Display Viewing Area', 'value' => '590.42 x 333.72 mm'],
                    ['name' => 'Brightness', 'value' => "200 cd/m² (Min)\n300 cd/m² (Typ.)"],
                    ['name' => 'Contrast ratio', 'value' => '1 Million : 1'],
                    ['name' => 'Response Time', 'value' => '0.03ms (GtG)'],
                    ['name' => 'Aspect Ratio', 'value' => '16 : 9'],
                    ['name' => 'Refresh Rate', 'value' => '500Hz'],
                    ['name' => 'Screen Curvature', 'value' => 'Flat screen'],
                    ['name' => 'Viewing Angle (CR≧10)', 'value' => '178° (H) / 178° (V)'],
                    ['name' => 'Color Gamut', 'value' => 'DCI Coverage : 99% (CIE1976)'],
                    ['name' => 'HDR Support', 'value' => "VESA DisplayHDR™ 500 True Black\nHDR10+ Gaming"],
                    ['name' => 'Adaptive Sync', 'value' => "NVIDIA® G-SYNC® Compatible\nAMD FreeSync™ Premium Pro"],
                    ['name' => 'Display Surface', 'value' => 'Glare Free'],
                    ['name' => 'Flicker free', 'value' => 'Yes'],
                    ['name' => 'Low Blue Light', 'value' => 'Yes'],
                    ['name' => 'Connectivity', 'value' => "2 x HDMI 2.1 (HDCP 2.2)\n1 x DisplayPort 1.4 (HDCP 2.2)\n2 x USB-A Downstream\n1 x USB-B Upstream\n1 x Headphone jack"],
                    ['name' => 'Built-in Speaker', 'value' => 'No'],
                    ['name' => 'Power', 'value' => "Consumption (max) : 140 W\nAC 100-240V\nExternal Adaptor"],
                    ['name' => 'Mechanical', 'value' => "VESA : 100x100mm\nHeight : 120mm\nTilt : -2˚ ~ +25˚\nSwivel : -30° ~ +30°\nPivot : -92° ~ +92°"],
                    ['name' => 'Dimension (W x H x D)', 'value' => '611.7 x 554.2 x 263.5 mm'],
                    ['name' => 'Weight', 'value' => "3.8 kg (no stand)\n6.9 kg (with stand)\n10.6 kg (pack)"],
                    ['name' => 'Color', 'value' => 'SILVER'],
                    ['name' => 'Accessory in box', 'value' => "HDMI, DP, Power, USB 3.0"],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],

            // 3) ASUS ROG STRIX XG248QSG ACE 24.1" Super TN 610Hz (OC)
            [
                'name'     => 'MONITOR ASUS ROG STRIX XG248QSG ACE - 24.1 SUPER TN 610Hz (OC) (3Y)',
                'sku'      => 'SKU-250837409',
                'category' => ['slug' => 'monitor', 'name' => 'MONITOR'],
                'brand'    => 'ASUS',
                'price'    => 28380,
                'image'    => 'images/Product/Monitor/ASUS ROG STRIX XG248QSG ACE - 24.1 SUPER TN 610Hz (OC) (3Y).png',
                'attributes' => [
                    ['name' => 'Brands', 'value' => 'ASUS'],
                    ['name' => 'Display Size (in.)', 'value' => '24"'],
                    ['name' => 'Panel Size (in.)', 'value' => '24.1" Super TN'],
                    ['name' => 'Resolution', 'value' => '1920 x 1080'],
                    ['name' => 'Resolution Type', 'value' => 'FHD'],
                    ['name' => 'Display color', 'value' => '16.7 Million'],
                    ['name' => 'Display Viewing Area', 'value' => '535.68 x 298.08 mm'],
                    ['name' => 'Brightness', 'value' => "350 cd/m² (Typ)\n400 cd/m² (HDR Peak)"],
                    ['name' => 'Contrast ratio', 'value' => '1000 : 1 (Typ.)'],
                    ['name' => 'Response Time', 'value' => "0.1ms (GtG min)\n0.7ms (GtG)"],
                    ['name' => 'Aspect Ratio', 'value' => '16 : 9'],
                    ['name' => 'Refresh Rate', 'value' => '610Hz (OC)'],
                    ['name' => 'Screen Curvature', 'value' => 'Flat screen'],
                    ['name' => 'Pixel Pitch (H x V)', 'value' => '0.279 mm'],
                    ['name' => 'Viewing Angle (CR≧10)', 'value' => '170° (H) / 160° (V)'],
                    ['name' => 'Color Gamut', 'value' => "DCI-P3 : 90%\nsRGB : 125%"],
                    ['name' => 'Color Accuracy', 'value' => 'Delta E< 2'],
                    ['name' => 'HDR Support', 'value' => "HDR10\nVESA DisplayHDR™ 400"],
                    ['name' => 'Adaptive Sync', 'value' => "AMD FreeSync™ Premium\nNVIDIA® G-SYNC® Compatible"],
                    ['name' => 'Display Surface', 'value' => 'Anti-Glare'],
                    ['name' => 'Flicker free', 'value' => 'Yes'],
                    ['name' => 'Low Blue Light', 'value' => 'Yes'],
                    ['name' => 'Connectivity', 'value' => "1 x DisplayPort 1.4 (DSC)\n2 x HDMI 2.1\n1 x Earphone Jack"],
                    ['name' => 'Signal Frequency', 'value' => "HDMI : 27~851KHz / 24~610Hz\nDP : 27~851KHz / 24~610Hz"],
                    ['name' => 'Power', 'value' => "Use : 24 W\nSaving : <0.5 W\nOff : <0.3 W\n100-240 V 50/60Hz"],
                    ['name' => 'Mechanical', 'value' => "Tripod : Yes\nKensington : Yes\nAura Sync : Yes\nVESA : 100x100mm\nHeight : 0~160mm\nTilt : -5 ~ +35°\nSwivel : -45° ~ +45°"],
                    ['name' => 'Dimension (W x H x D)', 'value' => '557 x 514 x 188 mm'],
                    ['name' => 'Weight', 'value' => "3.3 kg (no stand)\n5.6 kg (with stand)\n8.2 kg (gross)"],
                    ['name' => 'Accessory in box', 'value' => "QSG, DP Cable, Warranty Card, Power adapter, Power cord, ROG pouch & sticker"],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],

            // 4) DELL ALIENWARE AW2725Q 27" QD-OLED 4K 240Hz
            [
                'name'     => 'MONITOR DELL ALIENWARE AW2725Q - 27 QD-OLED 4K 240Hz (3Y)',
                'sku'      => 'SKU-250532846',
                'category' => ['slug' => 'monitor', 'name' => 'MONITOR'],
                'brand'    => 'DELL',
                'price'    => 31900,
                'image'    => 'images/Product/Monitor/DELL ALIENWARE AW2725Q - 27 QD-OLED 4K 240Hz (3Y).png',
                'attributes' => [
                    ['name' => 'Brands', 'value' => 'DELL'],
                    ['name' => 'Display Size (in.)', 'value' => '27"'],
                    ['name' => 'Panel Size (in.)', 'value' => '26.7" QD-OLED'],
                    ['name' => 'Resolution', 'value' => '3840 x 2160'],
                    ['name' => 'Resolution Type', 'value' => '4K UHD'],
                    ['name' => 'Display color', 'value' => '1.07 Billion'],
                    ['name' => 'Brightness', 'value' => "1000 cd/m² (HDR Peak)\n250 cd/m² (Typical)"],
                    ['name' => 'Contrast ratio', 'value' => '1500000:1'],
                    ['name' => 'Response Time', 'value' => '0.03ms (GtG)'],
                    ['name' => 'Aspect Ratio', 'value' => '16 : 9'],
                    ['name' => 'Refresh Rate', 'value' => '240Hz'],
                    ['name' => 'Screen Curvature', 'value' => 'Flat screen'],
                    ['name' => 'Pixel Pitch (H x V)', 'value' => '0.153 x 0.153 mm'],
                    ['name' => 'PPI', 'value' => '166'],
                    ['name' => 'Viewing Angle (CR≧10)', 'value' => '178° (H) / 178° (V)'],
                    ['name' => 'Color Gamut', 'value' => 'DCI-P3 : 99% (CIE1976)'],
                    ['name' => 'HDR Support', 'value' => "VESA DisplayHDR™ 400 True Black\nDolby Vision"],
                    ['name' => 'Adaptive Sync', 'value' => "NVIDIA® G-SYNC® Compatible\nAMD FreeSync™ Premium Pro\nVESA AdaptiveSync"],
                    ['name' => 'Display Surface', 'value' => 'Anti-reflective'],
                    ['name' => 'Flicker free', 'value' => 'Yes'],
                    ['name' => 'Low Blue Light', 'value' => 'Yes'],
                    ['name' => 'Connectivity', 'value' => "2 x HDMI 2.1\n1 x DisplayPort 1.4\n3 x USB-A 5Gbps\n1 x USB-B Up 5Gbps\n1 x USB-C Down 5Gbps PD 15W"],
                    ['name' => 'Optimum Resolution', 'value' => "HDMI : 3840x2160 @240Hz\nDisplayPort : 3840x2160 @240Hz"],
                    ['name' => 'Built-in Speaker', 'value' => 'No'],
                    ['name' => 'Power', 'value' => "Typ : 39.4 W\nMax : 190 W\nStandby : 0.5 W\nOff : 0.3 W"],
                    ['name' => 'Mechanical', 'value' => "VESA : 100x100mm\nHeight : 110mm\nTilt : -5° ~ +21°\nSwivel : -20° ~ +20°\nPivot : -90° ~ +90°"],
                    ['name' => 'Dimension (W x H x D)', 'value' => '609.6 x 516.1 x 210 mm'],
                    ['name' => 'Weight', 'value' => "4.30 kg (no stand)\n6.8 kg (with stand)"],
                    ['name' => 'Accessory in box', 'value' => "Monitor, Stand, HDMI, DP, Power, Microfiber cloth, USB-B to A, Sticker, QR Card"],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],

            // 5) VIEWSONIC VP2756 27" IPS 4K 60Hz
            [
                'name'     => 'MONITOR VIEWSONIC VP2756 27 IPS 4K UHD 60Hz (3Y)',
                'sku'      => 'SKU-250939431',
                'category' => ['slug' => 'monitor', 'name' => 'MONITOR'],
                'brand'    => 'VIEWSONIC',
                'price'    => 9900,
                'image'    => 'images/Product/Monitor/VIEWSONIC VP2756 27 IPS 4K UHD 60Hz (3Y).png',
                'attributes' => [
                    ['name' => 'Brands', 'value' => 'VIEWSONIC'],
                    ['name' => 'Display Size (in.)', 'value' => '27"'],
                    ['name' => 'Panel Size (in.)', 'value' => '27" IPS'],
                    ['name' => 'Resolution', 'value' => '3840 x 2160'],
                    ['name' => 'Resolution Type', 'value' => '4K UHD'],
                    ['name' => 'Display color', 'value' => '1.07 Billion 10 bits (8bits+FRC)'],
                    ['name' => 'Brightness', 'value' => '350 cd/m² (Typ.)'],
                    ['name' => 'Contrast ratio', 'value' => "1000 : 1 (Typ.)\n20M : 1 (DCR)"],
                    ['name' => 'Response Time', 'value' => '5ms (GtG)'],
                    ['name' => 'Aspect Ratio', 'value' => '16 : 9'],
                    ['name' => 'Refresh Rate', 'value' => '60Hz'],
                    ['name' => 'Screen Curvature', 'value' => 'Flat screen'],
                    ['name' => 'Pixel Pitch (H x V)', 'value' => '0.155 x 0.155 mm'],
                    ['name' => 'Viewing Angle (CR≧10)', 'value' => '178° (H) / 178° (V)'],
                    ['name' => 'Color Gamut', 'value' => "Adobe RGB : 81/78% (size/coverage)\nDCI-P3 : 80%\nNTSC : 77%\nsRGB : 109/100%\nEBU : 108/98%\nREC709 : 109/100%\nSMPTE-C : 108/100%"],
                    ['name' => 'Color Accuracy', 'value' => 'Delta E< 2'],
                    ['name' => 'Display Surface', 'value' => "Anti-Glare\n3H Hard Coating"],
                    ['name' => 'Flicker free', 'value' => 'Yes'],
                    ['name' => 'Low Blue Light', 'value' => 'Yes'],
                    ['name' => 'Connectivity', 'value' => "2 x HDMI 2.0\n1 x DisplayPort\n2 x USB-A 3.2 Down\n1 x USB-B 3.2 Up\n1 x USB-C 3.2 Up (DP Alt + PD 60W)\n3-pin Socket"],
                    ['name' => 'Signal Frequency', 'value' => "H : 15~136KHz\nV : 24~75Hz"],
                    ['name' => 'Built-in Speaker', 'value' => '2 x 2 W'],
                    ['name' => 'Power', 'value' => "Eco Conserve : 19.3 W\nEco Opt : 21.5 W\nTyp : 24 W\nMax : 28 W\nStand-by : 0.3 W\nInternal PSU"],
                    ['name' => 'Mechanical', 'value' => "Kensington : Yes\nVESA : 100x100mm\nHeight : 130mm\nTilt : -5° ~ +21°\nSwivel : 120°\nPivot : -90° ~ +90°"],
                    ['name' => 'Dimension (W x H x D)', 'value' => '613 x 410~540 x 215 mm'],
                    ['name' => 'Weight', 'value' => "5.1 kg (no stand)\n7.5 kg (with stand)\n10.2 kg (gross)"],
                    ['name' => 'Color', 'value' => 'BLACK'],
                    ['name' => 'Accessory in box', 'value' => "HDMI, QSG, 3-pin Plug, USB-C, USB A/B"],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],

            // 6) SAMSUNG Odyssey G5 G50D 27" IPS 2K 180Hz
            [
                'name'     => 'MONITOR SAMSUNG ODYSSEY G5 G50D LS27DG502EEXXT - 27 IPS 2K 180Hz (3Y)',
                'sku'      => 'SKU-240922689',
                'category' => ['slug' => 'monitor', 'name' => 'MONITOR'],
                'brand'    => 'SAMSUNG',
                'price'    => 6990,
                'image'    => 'images/Product/Monitor/SAMSUNG ODYSSEY G5 G50D LS27DG502EEXXT - 27 IPS 2K 180Hz (3Y).png',
                'attributes' => [
                    ['name' => 'Brands', 'value' => 'SAMSUNG'],
                    ['name' => 'Display Size (in.)', 'value' => '27"'],
                    ['name' => 'Panel Size (in.)', 'value' => '27" IPS'],
                    ['name' => 'Resolution', 'value' => '2560 x 1440'],
                    ['name' => 'Resolution Type', 'value' => '2K QHD'],
                    ['name' => 'Display color', 'value' => '16.7 Million'],
                    ['name' => 'Display Viewing Area', 'value' => '596.736 x 335.664 mm'],
                    ['name' => 'Brightness', 'value' => '350 cd/m² (Typical)'],
                    ['name' => 'Contrast ratio', 'value' => '1000 : 1 (Typ.)'],
                    ['name' => 'Response Time', 'value' => '1ms (GtG)'],
                    ['name' => 'Aspect Ratio', 'value' => '16 : 9'],
                    ['name' => 'Refresh Rate', 'value' => '180Hz'],
                    ['name' => 'Screen Curvature', 'value' => 'Flat screen'],
                    ['name' => 'Viewing Angle (CR≧10)', 'value' => '178° (H) / 178° (V)'],
                    ['name' => 'Color Gamut', 'value' => 'sRGB : 99%'],
                    ['name' => 'HDR Support', 'value' => 'VESA DisplayHDR™ 400'],
                    ['name' => 'Adaptive Sync', 'value' => 'AMD FreeSync™'],
                    ['name' => 'Display Surface', 'value' => 'Anti-Glare'],
                    ['name' => 'Flicker free', 'value' => 'Yes'],
                    ['name' => 'Low Blue Light', 'value' => 'Yes'],
                    ['name' => 'Connectivity', 'value' => "1 x HDMI 2.0\n1 x DisplayPort 1.2"],
                    ['name' => 'Built-in Speaker', 'value' => 'No'],
                    ['name' => 'Power', 'value' => "AC 100-240V\nExternal Adaptor\nMax : 48 W"],
                    ['name' => 'Mechanical', 'value' => "VESA : 100x100mm\nHeight : 0~120mm\nTilt : -2˚ ~ +25˚\nSwivel : -30° ~ +30°\nPivot : -92° ~ +92°"],
                    ['name' => 'Dimension (W x H x D)', 'value' => '613 x 552 x 263.5 mm'],
                    ['name' => 'Weight', 'value' => "3.4 kg (no stand)\n6.4 kg (with stand)\n8.3 kg (pack)"],
                    ['name' => 'Color', 'value' => 'BLACK'],
                    ['name' => 'Warranty', 'value' => '3 Years'],
                ],
            ],
        ];

        // ===== รูป: ใช้ชื่อไฟล์ = SKU (เช่น SKU-250431914.png) =====
        $imageBaseDir = public_path('images/Product/Monitor');
        $imageRelDir  = 'images/Product/Monitor';
        // ใส่ลงทุกคอลัมน์รูปที่มีจริงในตาราง (รวม cover_image)
        $imgCols = ['image', 'thumbnail', 'image_path', 'thumb', 'cover', 'photo', 'cover_image'];

        // หาไฟล์ด้วย SKU ก่อน → ถ้าไม่เจอค่อย fallback ไป field 'image' → สุดท้ายเดาจากชื่อสินค้า
        $resolveImage = function (array $item) use ($imageBaseDir, $imageRelDir): ?string {
            $exts = ['png','jpg','jpeg','webp','jfif'];
            $sku  = $item['sku'] ?? '';

            // 1) SKU.ext ตรงตัว
            if ($sku && is_dir($imageBaseDir)) {
                foreach ($exts as $e) {
                    $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $sku . '.' . $e;
                    if (file_exists($abs)) {
                        return $imageRelDir . '/' . $sku . '.' . $e;
                    }
                }
                // 1.1) เผื่อมี prefix/suffix รอบ SKU
                foreach (scandir($imageBaseDir) ?: [] as $f) {
                    if ($f === '.' || $f === '..') continue;
                    $p   = $imageBaseDir . DIRECTORY_SEPARATOR . $f;
                    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                    if (is_file($p) && in_array($ext, $exts, true) && stripos($f, $sku) !== false) {
                        return $imageRelDir . '/' . $f;
                    }
                }
            }

            // 2) ใช้ path จาก field 'image' ถ้าให้มาและมีจริง
            if (!empty($item['image'])) {
                $abs = public_path($item['image']);
                if (file_exists($abs)) {
                    return $item['image'];
                }
            }

            // 3) เดาจากชื่อสินค้า (สำหรับไฟล์เก่าที่ยังไม่ได้เปลี่ยนชื่อเป็น SKU)
            $raw  = trim($item['name'] ?? '');
            $raw  = str_replace(['/', '\\'], '_', $raw);
            $base = preg_replace('/\s+/', ' ', $raw);

            foreach ($exts as $e) {
                $abs = $imageBaseDir . DIRECTORY_SEPARATOR . $base . '.' . $e;
                if (file_exists($abs)) {
                    return $imageRelDir . '/' . $base . '.' . $e;
                }
            }
            return null;
        };

        foreach ($items as $item) {
            // Category & Brand
            $category = Category::updateOrCreate(
                ['slug' => $item['category']['slug']],
                ['name' => $item['category']['name'], 'sort_order' => 0]
            );
            $brand = Brand::updateOrCreate(
                ['slug' => Str::slug($item['brand'])],
                ['name' => $item['brand']]
            );

            // Product payload
            $payload = [
                'name'        => $item['name'],
                'category_id' => $category->id,
                'brand_id'    => $brand->id,
                'price'       => $item['price'],
            ];
            if (Schema::hasColumn('products', 'status')) {
                $payload['status'] = 'active';
            }

            // ใส่รูปลงทุกคอลัมน์รูปที่มีจริง
            $imgRel = $resolveImage($item);
            if ($imgRel) {
                foreach ($imgCols as $col) {
                    if (Schema::hasColumn('products', $col)) {
                        $payload[$col] = $imgRel;
                    }
                }
            }

            /** @var \App\Models\Product $product */
            $product = Product::updateOrCreate(['sku' => $item['sku']], $payload);

            // เตือนช่วย debug ถ้าไม่พบไฟล์รูป
            if (isset($this->command)) {
                if ($imgRel) {
                    $full = public_path($imgRel);
                    if (!file_exists($full)) {
                        $this->command->warn("Image not found for SKU {$item['sku']}: {$full}");
                    }
                } else {
                    $this->command->warn("No image matched for SKU {$item['sku']} in {$imageBaseDir}");
                }
            }

            // STOCK เริ่มต้น
            if (Schema::hasTable('stocks')) {
                \App\Models\Stock::updateOrCreate(
                    ['product_id' => $product->id],
                    ['qty' => 100]
                );
            }

            // attributes relation
            if (method_exists($product, 'attributes')) {
                $product->attributes()->delete();
                $attrs = array_map(function ($a, $i) {
                    $a['sort_order'] = $a['sort_order'] ?? ($i + 1);
                    return $a;
                }, $item['attributes'], array_keys($item['attributes']));
                $product->attributes()->createMany($attrs);
            }

            // images relation (ถ้ามีในโมเดล)
            if (method_exists($product, 'images') && $imgRel) {
                $product->images()->delete();
                $product->images()->createMany([
                    ['path' => $imgRel, 'sort_order' => 1],
                ]);
            }
        }
    }
}
