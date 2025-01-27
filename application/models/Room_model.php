<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_model extends CI_Model
{
	public function getRoom()
	{
		$query = "SELECT `guestbook`.*, `room`.`room`
				  FROM `guestbook` JOIN `room` 
				  ON `guestbook`.`room_id` = `room`.`id`
				  ";
		return $this->db->query($query)->result_array();
	}

}
