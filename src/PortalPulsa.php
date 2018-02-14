<?php
namespace AzioArv\PortalPulsa;

class PortalPulsa {
	
	/**
	 * Send request to PortalPulsa Server
	 * @param  Array $data Request Data
	 * @return Array
	 */
	protected function run($data){	
		$url = 'http://portalpulsa.com/api/connect/';

		$header = array(
		'portal-userid:'.config('config.userid'),
		'portal-key:'.config('config.key'), // lihat hasil autogenerate di member area
		'portal-secret:'.config('config.secret'), // lihat hasil autogenerate di member area
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		return json_decode($result);
	}

	/**
	 * Check Balance / Saldo
	 * @return Array
	 */
	public function saldo(){
		$data = array( 
			'inquiry' => 'S',
			);
		$result = $this->run($data);
		return $result;
	}

	/**
	 * Checking Price
	 * @param  String $code product code (https://portalpulsa.com/pulsa-murah-all-operator/)
	 * @return Array
	 */
	public function cekHarga($code){
		$data = array( 
		'inquiry' => 'C',
		'code' => $code, // kode group produk
		);

		$result = $this->run($data);
		return $result;

	}

	/**
	 * Check Transaction Status
	 * @param  String $id transaction id from client
	 * @return Array
	 */
	public function status($id){
		$data = array( 
		'inquiry' => 'STATUS',
		'trxid_api' => $id,
		);

		$result = $this->run($data);

		return $result;
	}

	/**
	 * Transaction Process
	 * @param  String $code  Product Code (https://portalpulsa.com/pulsa-murah-all-operator/)	
	 * @param  String $nomor Customer Phone Number
	 * @param  String $id    Transaction Id (like bill number)
	 * @return Array
	 */
	public function prosesPulsa($code,$nomor,$id){
		$data = array( 
		'inquiry' => 'I',
		'code' => $code,
		'phone' => $nomor,
		'trxid_api' => $id,
		);

		$result = $this->run($data);
		return $result;
	}

	/**
	 * Request To Top Up Balance
	 * @param  String $bank  Bank Name
	 * @param  Integer $value Topup Amount
	 * @return Array
	 */
	public function reqBalance($bank,$value){
		$data = array( 
		'inquiry' => 'D',
		'bank' => $bank, // bank : bca, bni, mandiri, bri, muamalat
		'nominal' => $value,
		);

		$result = $this->run($data);
		return $result;
	}

	/**
	 * Transaction Process For PLN Token
	 * @param  String $code      Product Code (https://portalpulsa.com/token-pulsa-pln-prabayar-murah/)
	 * @param  String $nomor     Customer Phone Number
	 * @param  String $custNomor Customer PLN Number
	 * @param  String $id        Transaction id (like bill number)
	 * @return Array
	 */
	public function prosesPLN($code,$nomor,$custNomor,$id){
		$data = array( 
		'inquiry' => 'PLN',
		'code' => $code, // kode produk
		'phone' => $nomor, // nohp pembeli
		'idcust' => $custNomor, // nomor meter atau id pln
		'trxid_api' => $id, // Trxid / Reffid dari sisi client
		);

		$result = $this->run($data);
		return $result;
	}

}