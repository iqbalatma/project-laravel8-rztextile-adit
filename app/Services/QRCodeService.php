<?php 
namespace App\Services;

use App\AppData;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeService{
  private const QR_CODE_SIZE = 200;
  private const QR_CODE_FORMAT = "png";

  /**
   * Description : use to store new qrcode 
   * 
   * @param string $code of barcode
   * @return string
   */
  public function storeNewQRCode(string $code = "code"):string
  {
    $qrcode = QrCode::format(self::QR_CODE_FORMAT)
              ->size(self::QR_CODE_SIZE)
              ->errorCorrection('H')
              ->generate($code);

    $path = '/images/qrcode/' . randomString(16) . '.png';
    Storage::disk('public')->put($path, $qrcode); 
    
    return basename($path);
  }

  /**
   * Description : use to get generated barcode code
   * 
   * @return string of generated barcode
   */
  public function getGeneratedQrCode():string
  {
    return randomString(AppData::BARCODE_LENGTH);
  }
}

?>