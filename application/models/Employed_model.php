<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employed_model extends CI_Model
{
	public function getJobtitle()
	{
		$query = "SELECT `employed`.*, `jobtitle`.`jobtitle`
				  FROM `employed` JOIN `jobtitle` 
				  ON `employed`.`jobtitle_id` = `jobtitle`.`id`
				  ";
		return $this->db->query($query)->result_array();
	}

	public function getDepartement()
	{
		$query = "SELECT `employed`.*, `departement`.`departement`
				  FROM `employed` JOIN `departement` 
				  ON `employed`.`departement_id` = `departement`.`id`
				  ";
		return $this->db->query($query)->result_array();
	}
}
