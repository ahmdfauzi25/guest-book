<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicetype_model extends CI_Model
{
	public function getServicetype()
	{
		$query = "SELECT `guestbook`.*, `servicetype`.`service_type`
				  FROM `guestbook` JOIN `servicetype` 
				  ON `guestbook`.`servicetype_id` = `servicetype`.`id`
				  ";
		return $this->db->query($query)->result_array();
	}

}
