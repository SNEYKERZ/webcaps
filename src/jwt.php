<?php
class jwt {
	private $token, $secret = 'change_key_private_';

	public function create() {
		$data = func_get_args()[0]; // Con esto obtenemos los argumentos pasados en la funcion sin tener que definirlos, tanto arrays, como string(solo lo hice para arrays)
		$secret = (!empty($data['secret'])) ? htmlspecialchars($data['secret']) : null;
		// Codificacion de los parametros para asignarlos en el JWT sin problemas
		$header = (!empty($data['header'])) ? json_encode($data['header'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
		$base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
		$payload = (!empty($data['payload'])) ? json_encode($data['payload'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
		$base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

		// Creamos una firma conforme los parametros creados anteriormente para que sea validada al momento de decodificar y saber si no han sido alterados
		$signature = $this->signature([
			'header' => $base64Header,
			'payload' => $base64Payload,
			'secret' => $secret
		]);
		$base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

		// Al final que esten generados los 3 parametros necesarios se "concatenan" mediante (puntos) para la legibilidad y seguir su estandar predeterminado.
		$this->token = "{$base64Header}.{$base64Payload}.{$base64Signature}";
		return $this;
	}

	public function get() {
		// Obtenemos el token privado creado en los metodos ya definidos
		return $this->token;
	}

	public function update() {
		$data = func_get_args()[0];
		$secret = (!empty($data['secret'])) ? htmlspecialchars($data['secret']) : null;
		$dataJWT = array(
			'token' => $data['token'],
			'secret' => $secret
		);
		$token = $this->decode($dataJWT);
		$this->token = null;
		if(!empty($token)): // Validamos si el token se pudo decodificar con éxito y no hubo alguna alteración
			$header = (!empty($token->header)) ? $token->header : null;
			$payload = (!empty($token->header)) ? $token->payload : null;
			$signature = (!empty($token->header)) ? $token->signature : null;

			// Se empiezan a recorrer todos los elementos del token en busca de alguna actualización de datos ya existentes
			if(!empty($header)):
				foreach ($data['data']['header'] as $_header_i => $_header) {
					if($_header !== $header->$_header_i) {
						$header->$_header_i = $_header;
					}
				}
			endif;

			if(!empty($payload)):
				foreach ($data['data']['payload'] as $_payload_i => $_payload) {
					if($_payload !== $payload->$_payload_i) {
						$payload->$_payload_i = $_payload;
					}
				}
			endif;

			$base64Header = (!empty($header)) ? str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($header, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))) : null;
			$base64Payload = (!empty($payload)) ? str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))) : null;

			// Se vuelve a generar la firma conforme los datos actualizados anteriormente
			$signature_create = $this->signature([
				'header' => $base64Header,
				'payload' => $base64Payload,
				'secret' => $secret
			]);
			$signature = $signature_create;
			$base64Signature = (!empty($signature)) ? str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature)) : null;
			if(!empty($token->signature)) $token->signature = $base64Signature;

			$this->token = "{$base64Header}.{$base64Payload}.{$base64Signature}";
		endif;
		return $this;
	}

	public function decode() {
		$data = func_get_args()[0];
		$token = $data['token'];
		$secret = (!empty($data['secret'])) ? htmlspecialchars($data['secret']) : null;
		$token_explode = explode('.', $token);

		// Validamos si se dividió bien el token para posteriormente mostrar los datos internos del token
		if(!empty($token_explode) && is_array($token_explode)) {
			$header = (!empty($token_explode[0])) ? json_decode(base64_decode($token_explode[0])) : null;
			$payload = (!empty($token_explode[1])) ? json_decode(base64_decode($token_explode[1])) : null;
			$signature = (!empty($token_explode[2])) ? bin2hex(base64_decode($token_explode[2])) : null;
			$signature_generate = $this->signature([
				'header' => $token_explode[0],
				'payload' => $token_explode[1],
				'secret' => $secret
			]);
			$signature_generate = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature_generate));
			$signature_generate = bin2hex(base64_decode($signature_generate));

			// Validar la llave secreta antes de mostrar los datos decodificados.
			$hashEquals = hash_equals($signature, $signature_generate);
			if($signature == $signature_generate && $hashEquals == true) {
				// Generamos nuevamente los datos obtenidos del token en un objeto para ser posteriormente mostrados
				$token = json_encode([
					'header' => $header,
					'payload' => $payload,
					'signature' => $signature
				]);
			} else {
				$token = null;
			}
		}

		return json_decode($token);
	}

	protected function signature() {
		$data = func_get_args()[0];
		// Se crea la firma conforme los datos pasados del token JWT con una llave de seguridad que esta asignada en el servidor y "nadie" debe de conocer para no modificar los datos ni la firma
		$secret = (!empty($data['secret'])) ? htmlspecialchars($data['secret']) : null;
		$secret = $this->secret.$secret;
		$signature = hash_hmac('sha256', "{$data['header']}.{$data['payload']}", $secret, true);
		return $signature;
	}
}

// Solo funciona con Encriptacion HS256("sha256") - No le agregue soporte para más algoritmos e igual no tiene validaciones en payload(solo en la llave secreta)
$jwt = new jwt;

// Codigos de ejemplos, por si necesitan ver el codigo puro
// $dataJWT = array(
// 	'header' => [
// 		'alg' => 'HS256',
// 		'typ' => 'JWT'
// 	],
// 	'payload' => [
// 		'UUID' => '385e33f741'
// 	],
// 	'secret' => 'mi_llave_secreta'
// );
// $crear_jwt = $jwt->create($dataJWT)->get();
// print_r($crear_jwt);

// $dataJWT = array(
// 	'token' => $crear_jwt,
// 	'secret' => 'mi_llave_secreta'
// );
// $decodificar_jwt = $jwt->decode($dataJWT);
// print_r($decodificar_jwt);

// $dataJWT = array(
// 	'token' => $crear_jwt,
// 	'secret' => 'mi_llave_secreta',
// 	'data' => [
// 		'header' => [
// 			'alg' => 'HS512',
// 			'typ' => 'JWT'
// 		],
// 		'payload' => [
// 			'UUID' => 'd6199909d0b5fdc22c9db625e4edf0d6da2b113b21878cde19e96f4afe69e714'
// 		]
// 	]
// );
// $actualizar_jwt = $jwt->update($dataJWT)->get();
// print_r($actualizar_jwt);

/*
	Campos estándares para agregar al payload

	Existen varios campos, mas sin embargo los que yo clasificó cómo mas "importantes", serian los siguientes:
		* iss -> Identifica el proveedor de identidad que emitió el JWT (Este es opcional ya que se podria asignar también en el "jti")
		* jti -> Identificador único del token incluso entre diferente proveedores de servicio
		* iat -> Identifica la marca temporal en qué el JWT fue emitido
		* exp -> Identifica la marca temporal luego de la cual el JWT no tiene que ser aceptado

		Leer mas...
		https://es.wikipedia.org/wiki/JSON_Web_Token
*/

/*
	Verificador de JWT en linea

	NOTA:
	La llave secreta, comienza con 'change_key_private_' segun la variable privada '$secret'.
	En este caso, la 'Signing Key' personal del JWT seria 'change_key_private_mi_llave_secreta' para que no tengan problemas con el validador.
*/

# https://www.jsonwebtoken.io/