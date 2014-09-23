<?

/**
 * Essa щ a pasta onde ficarуo os arquivos que o usuсrio poderс ver e tambщm onde serс feito o upload
 * @var string
 */
$folder = '../arquivosckeditor';

/**
 * Recuperamos a aчуo desejada pelo usuсrio
 * @var string
 */
$action =& $_GET[ 'action' ];

switch ( $action ){
	/**
	 * Foi solicitado a exibiчуo dos arquivos
	 */
	case 'browse':
		require '../php/browse.php';
		break;
	case 'upload':
		if ( isset( $_FILES[ 'upload' ] ) ){
			$nome = preg_replace( '/[^\w\d\.]/' , '' , $_FILES[ 'upload' ][ 'name' ] );

			move_uploaded_file( $_FILES[ 'upload' ][ 'tmp_name' ] , sprintf( '%s/%s' , $folder , $nome ) );

			break;
		}
	default:
		//Informamos ao usuсrio que a requisiчуo щ invсlida
		header( sprintf( '%s 400 Bad Request' , $_SERVER[ 'SERVER_PROTOCOL' ] ) , true , 400 );
		readfile( 'views/errobadrequest.html' );
}

?>