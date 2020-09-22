<?php
class News_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news($id = false) {
    	if ($id === FALSE)
        {
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    public function set_news()
	{
	    $this->load->helper('url');

	    $slug = url_title($this->input->post('title'), 'dash', TRUE);

	    $data = array(
	        'title' => $this->input->post('title'),
	        'slug' => $slug,
	        'text' => $this->input->post('text')
	    );

	    return $this->db->insert('news', $data);
	}

	public function update_news($id)
	{
	    $this->load->helper('url');

	    $slug = url_title($this->input->post('title'), 'dash', TRUE);
	    $data = array(
	        'title' => $this->input->post('title'),
	        'slug' => $slug,
	        'text' => $this->input->post('text')
	    );
	    $this->db->set($data);
		$this->db->where('id', $id);
		return $this->db->update('news');
	}

	public function update_status($id)
	{
		$status = $this->input->post('status');
	    $this->db->set('status', "'".$status."'", FALSE);
		$this->db->where('id', $id);
		return $this->db->update('news');
	}

	public function delete_news($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('news');
	}
}