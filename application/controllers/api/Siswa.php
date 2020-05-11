<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Siswa extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->methods['index_put']['limit'] = 50; // 50 requests per hour per user/key
	}

	public function index_get()
	{
		// Users from a data store e.g. database
		$id = $this->get('id_siswa');

		// If the id parameter doesn't exist return all the users

		if ($id === NULL) {
			$this->db->select('*');
			$this->db->from('siswa sis');
			$this->db->join('sekolah s', 'sis.id_sekolah = s.id_sekolah');
			$siswa = $this->db->get()->result_array();
			// Check if the users data store contains users (in case the database result returns NULL)
			if ($siswa) {
				// Set the response and exit
				$this->response($siswa, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			} else {
				// Set the response and exit
				$this->response([
					'status' => FALSE,
					'message' => 'Tidak Ditemukan siswa'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}

		// Find and return a single record for a particular user.
		else {
			$id = (int) $id;

			// Validate the id.
			if ($id <= 0) {
				// Invalid id, set the response and exit.
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
			}
			$this->db->select('*');
			$this->db->from('siswa sis');
			$this->db->join('sekolah s', 'sis.id_sekolah = s.id_sekolah');
			$this->db->where(array("id_siswa" => $id));
			$siswa = $this->db->get()->row_array();

			$this->response($siswa, REST_Controller::HTTP_OK);
		}
	}

	public function index_post()
	{
		// $this->some_model->update_user( ... );
		$data = [
			'id_sekolah' => $this->post('id_sekolah'),
			'nama_siswa' => $this->post('nama_siswa'),
			'alamat_siswa' => $this->post('alamat_siswa'),
			'rata_rata_un' => $this->post('rata_rata_un')
		];

		$this->db->insert("siswa", $data);

		$this->set_response($data, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
	}

	public function index_delete()
	{
		// $this->some_model->delete_something($id);

		$id = $this->delete('id_siswa');
		$this->db->where('id_siswa', $id);
		$this->db->delete('siswa');
		$messages = array('status' => "Data berhasil dihapus");
		$this->set_response($messages, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
	}

	public function index_put()
	{
		$data = array(
			'id_siswa' => $this->put('id_siswa'),
			'id_sekolah' => $this->put('id_sekolah'),
			'nama_siswa' => $this->put('nama_siswa'),
			'alamat_siswa' => $this->put('alamat_siswa'),
			'rata_rata_un' => $this->put('rata_rata_un')
		);

		$this->db->where('id_siswa', $this->put('id_siswa'));
		$this->db->update('siswa', $data);

		$this->set_response($data, REST_Controller::HTTP_CREATED);
	}
}
