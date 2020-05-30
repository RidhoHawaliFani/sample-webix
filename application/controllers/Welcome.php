<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;

class Welcome extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index()
    {
        $this->load->view('index.php'); 
        
    }
    public function findData(){


        $sentItem = md5($this->uri->segment(3));

        $data['allItemQuery'] = $this->Home_model->getSelectData("*","akun", "WHERE password='$sentItem'");




        $output2 = "";
        if (!$data['allItemQuery']->result()) {
            $hasil2['hasil2'] = 'false';
        }else{
            $hasil2['hasil2'] = 'true';
        }
        echo json_encode($hasil2);

        

    }

    public function getHistory(){


        $sentItem = md5($this->uri->segment(3));

        $data['allItemQuery'] = $this->Home_model->getSelectData("*,DATE_FORMAT(tglUpdate, '%b %d, %Y %H:%i:%s WIB') date,TIMESTAMPDIFF(day,history_passwd_change.tglUpdate,NOW()) jarakhari","history_passwd_change", "ORDER BY id_history DESC LIMIT 1");

        $dateGet = "";
        $jarakGet = "";
        foreach ($data['allItemQuery']->result() as $row) {
            $dateGet = $row->date;
            $jarakGet = $row->jarakhari;
        }

        if ($jarakGet=='0') {
            $jarakGet = 'today';
        }elseif ($jarakGet=='1') {
            $jarakGet = 'yesterday';
        }else {
            $jarakGet = $jarakGet." days ago";
        }


        $output2 = "";
        if (!$data['allItemQuery']->result()) {
            $hasil2['hasil2'] = 'false';
            
        }else{
            $hasil2['hasil2'] = 'true';
            $hasil2['date'] = $dateGet;
            $hasil2['jarakhari'] = $jarakGet;
        }
        echo json_encode($hasil2);

        

    }

    public function updateThisData(){


        $sentItem = $this->uri->segment(3);
        // $keyUpdate = $this->input->post('stringSent');

        $data = array(
            'password' => md5($sentItem)
        );

        $xxx =$this->Home_model->updateData('akun' , $data, "id_akun=1");
        
        $dataInput = array(
                   'status' => 'aktif'

                    
                );

            


            $simpan = $this->Home_model->insertData('history_passwd_change' , $dataInput);


        if ($xxx) {
            $hasil2['hasil2'] = 'true';
        }else{
            $hasil2['hasil2'] = 'false';
        }
        echo json_encode($hasil2);



        

    }

    public function APIGetHistory()
    {
        $result= array();

       
        $no = 1;
        $selectAllShop = $this->Home_model->getSelectData("*,DATE_FORMAT(tglUpdate, '%b %d, %Y %H:%i:%s WIB') date","history_passwd_change", "ORDER BY id_history ASC");
        foreach ($selectAllShop->result() as $row) {
                //Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat 
           
            
            array_push($result,array(
                "rank"=>  $no++,
                "title"=>  $row->date
                
            ));
        }
            //Menampilkan Array dalam Format JSON
        echo json_encode($result);


    }
    
}
