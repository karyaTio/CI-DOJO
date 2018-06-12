<?php 

class Games extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('game_model');
        $this->load->library('My_Encryption');
    }

    public function index(){
        $data['games'] = $this->game_model->get_all();
        $this->load->view('games/index', $data);
    }

    public function show($id){
        $decodedId = $this->my_encryption->decode($id);
        $data['game'] = $this->game_model->get_by_id($decodedId);
        
        $this->load->view('games/show', $data);
    }

    public function game_add(){
        $data = array(
            'title' => $this->input->post('title'),
            'releaseDate' => $this->input->post('releaseDate'),
            'rating' => $this->input->post('rating')
        );

        $insert = $this->game_model->insert($data);
        echo json_encode(array('status' => true));
    }

    public function game_edit($id){
        $data = $this->game_model->get_by_id($id);
        echo json_encode($data);
    }

    public function game_update(){
        $data = array(
            'title' => $this->input->post('title'),
            'releaseDate' => $this->input->post('releaseDate'),
            'rating' => $this->input->post('rating')
        );

        $this->game_model->update(array(
            'id' => $this->input->post('id'),
            $data
        ));

        echo json_encode(array('status' => TRUE));
    }

    public function game_delete($id){
        $this->game_model->delete_by_id($id);
        echo json_encode(array('status' => TRUE));
    }

    public function secretdata(){
        $tes = $this->my_encryption->decode('Your encrypted data');
        echo $tes;
    }
}