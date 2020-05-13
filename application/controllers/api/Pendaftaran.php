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
class Pendaftaran extends REST_Controller
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
        $id = $this->get('id');
        $nisn = $this->get('nisn');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL && $nisn === NULL) {

            $this->db->select('*');
            $this->db->from('pendaftaran p');
            $this->db->join('siswa sis', 'p.id_siswa = sis.id_siswa');
            $pendaftaran = $this->db->get()->result_array();
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($pendaftaran) {
                // Set the response and exit
                $this->response($pendaftaran, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Tidak Ditemukan Pendaftaran'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        elseif ($id !== NULL) {
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            $this->db->select('*');
            $this->db->from('pendaftaran p');
            $this->db->join('siswa sis', 'p.id_siswa = sis.id_siswa');
            $this->db->where(array("id_daftar" => $id));
            $pendaftaran = $this->db->get()->row_array();

            $this->response($pendaftaran, REST_Controller::HTTP_OK);
        } elseif ($nisn !== NULL) {
            $nisn = (int) $nisn;
            $this->db->select('*');
            $this->db->from('pendaftaran p');
            $this->db->join('siswa sis', 'p.id_siswa = sis.id_siswa');
            $this->db->where(array("nisn" => $nisn));
            $pendaftaran = $this->db->get()->row_array();

            $this->response($pendaftaran, REST_Controller::HTTP_OK);
        }
    }

    public function index_post()
    {
        // $this->some_model->update_user( ... );
        $data = [
            'id_daftar' => $this->post('id_daftar'),
            'id_siswa' => $this->post('id_siswa'),
            'perguruan_tinggi' => $this->post('perguruan_tinggi'),
            'jurusansatu' => $this->post('jurusansatu'),
            'jurusandua' => $this->post('jurusandua')
        ];

        $this->db->insert("pendaftaran", $data);

        $this->set_response($data, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function index_delete()
    {
        // $this->some_model->delete_something($id);

        $id = $this->delete('id_daftar');
        $this->db->where('id_daftar', $id);
        $this->db->delete('pendaftaran');
        $messages = array('status' => "Data berhasil dihapus");
        $this->set_response($messages, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function index_put()
    {
        $data = array(
            'id_daftar' => $this->post('id_daftar'),
            'id_siswa' => $this->post('id_siswa'),
            'perguruan_tinggi' => $this->post('perguruan_tinggi'),
            'jurusansatu' => $this->post('jurusansatu'),
            'jurusandua' => $this->post('jurusandua')
        );

        $this->db->where('id_daftar', $this->put('id_daftar'));
        $this->db->update('pendaftaran', $data);

        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
}
