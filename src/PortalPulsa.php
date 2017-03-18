<?php
namespace AzioArv\PortalPulsa;

class PortalPulsa {
	
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

	public function saldo(){
		$data = array( 
			'inquiry' => 'S', // konstan
			);
		$result = $this->run($data);
		return $result;
	}

	public function cekHarga($code){
		$data = array( 
		'inquiry' => 'C', // konstan
		'code' => $code, // kode group produk
		);

		$result = $this->run($data);
		return $result;

	}

	public function status($id){
		$data = array( 
		'inquiry' => 'STATUS', // konstan
		'trxid_api' => $id, // Trxid atau Reffid dari sisi client saat transaksi pengisian
		);

		$result = $this->run($data);

		return $result;
	}

	public function prosesPulsa($code,$nomor,$id){
		$data = array( 
		'inquiry' => 'I', // konstan
		'code' => $code, // kode produk
		'phone' => $nomor, // nohp pembeli
		'trxid_api' => $id, // Trxid / Reffid dari sisi client GENERATE SENDIRI KAMPRET
		);

		$result = $this->run($data);
		return $result;
	}

	public function reqBalance($bank,$value){
		$data = array( 
		'inquiry' => 'D', // konstan
		'bank' => $bank, // bank tersedia: bca, bni, mandiri, bri, muamalat
		'nominal' => $value, // jumlah request
		);

		$result = $this->run($data);
		return $result;
	}

	public function prosesPLN($code,$nomor,$custNomor,$id){
		$data = array( 
		'inquiry' => 'PLN', // konstan
		'code' => $code, // kode produk
		'phone' => $nomor, // nohp pembeli
		'idcust' => $custNomor, // nomor meter atau id pln
		'trxid_api' => $id, // Trxid / Reffid dari sisi client
		);

		$result = $this->run($data);
		return $result;
	}

}