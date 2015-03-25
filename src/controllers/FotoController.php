<?php
/**
 * Foto controller
 */

class FotoController extends Controller
{
    public static function index()
    {
        $skip = 5;
        if (isset($_GET['skip'])) {
            $skip = $_GET['skip'];
        }
        $limitm = 0;
        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
        }
        Controller::response(Foto::find($skip, $limit));
    }

    public static function show($id)
    {
        Controller::response(Foto::find(array('_id' => $id)));
    }
    
    public static function create()
    {
        $cartellaUpload ="img/";
        $filename = basename($_FILES['foto']['name']);
        $filePath = $cartellaUpload . $filename;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $filePath)) {
            return Controller::response(false);
        }
        
        $nome = $_POST['nome'];
        $exif_data = exif_read_data($filePath, 'IFD0');
        
        // estraggo i dati di geolocalizzazione
        $exif_lat = Controller::getField($exif_data, 'GPSLatitude');
        $exif_lng = Controller::getField($exif_data, 'GPSLongitude');
        $exif_lat_ref = Controller::getField($exif_data, 'GPSLatitudeRef');
        $exif_lng_ref = Controller::getField($exif_data, 'GPSLongitudeRef');
            
        // trasformo in valori decimali 
        $lat = 0; $lng = 0;
        if(is_array($exif_lat) && count($exif_lat)>0) {
            $lat = Controller::gpsDecimal($exif_lat[0], $exif_lat[1], $exif_lat[2], $exif_lat_ref);
            $lng = Controller::gpsDecimal($exif_lng[0], $exif_lng[1], $exif_lng[2], $exif_lng_ref);      
        }

        Controller::response(Foto::create(array(
            'nome' => $nome,
            'link' => $filePath,
            'lat' => $lat,
            'lng' => $lng,
            'data' => new MongoDate()
        )));
    }
}
