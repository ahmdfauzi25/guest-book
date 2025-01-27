<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Floor_model extends CI_Model
{
	public function getFloor()
	{
		$query = "SELECT `guestbook`.*, `floor`.`floor`
				  FROM `guestbook` JOIN `floor` 
				  ON `guestbook`.`floor_id` = `floor`.`id`
				  ";
		return $this->db->query($query)->result_array();
	}

}
