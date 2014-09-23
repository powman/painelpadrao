<?

/**
 * Essa � a pasta onde ficar�o os arquivos que o usu�rio poder� ver e tamb�m onde ser� feito o upload
 * @var string
 */
$folder = '../arquivosckeditor';

/**
 * Recuperamos a a��o desejada pelo usu�rio
 * @var string
 */
$action =& $_GET[ 'action' ];

switch ( $action ){
	/**
	 * Foi solicitado a exibi��o dos arquivos
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
		//Informamos ao usu�rio que a requisi��o � inv�lida
		header( sprintf( '%s 400 Bad Request' , $_SERVER[ 'SERVER_PROTOCOL' ] ) , true , 400 );
		readfile( 'views/errobadrequest.html' );
}

?>