<?php
	class realty_model extends Main_Model {

		public function getRealties(){
			
			//excutes the query and loops the result
			foreach($this->db->query('SELECT realty.id as id, realty.city as city, realty_type.title as title, A.img_file as img_file
										FROM realty
										INNER JOIN 
										realty_type on realty_type.id = realty.type
										LEFT JOIN
										(
											SELECT * FROM realty_gallery
										    GROUP by realty_id
										) A on realty.id = A.realty_id') as $row) {
			    $realties[] = $row;
			}

			return $realties;
		}


		public function getRealty($id){

			//excutes the query and loops the result, get the realty by the id
			foreach($this->db->query('SELECT * from realty
										inner join realty_type on realty.type= realty_type.id
										where realty.id = '.$id) as $row) {
			    $realty[] = $row;
			}

			//excutes the query and loops the result, get the images of the realty
			foreach($this->db->query('SELECT img_file from realty_gallery
										where realty_id = '.$id) as $row) {
			    $realty[0]['gallery'][] = $row;
			}

			//excutes the query and loops the result, get the realty contacts
			foreach($this->db->query('SELECT contact.name as name, contact.id as id FROM realty_contact
										INNER JOIN
										contact on realty_contact.realty_contact = contact.id
										where realty_id = '.$id) as $row) {
			    $realty[0]['contacts'][] = $row;
			}

			//excutes the query and loops the result, get contacts emails
			foreach ($realty[0]['contacts'] as $key => $contact) {
				foreach($this->db->query('SELECT email FROM contact_email
										where contact_id = '.$contact['id']) as $row) {
			    $realty[0]['contacts'][$key]['emails'][] = $row;
				}
			}
			//excutes the query and loops the result, get contacts phones
			foreach ($realty[0]['contacts'] as $key => $contact) {
				foreach($this->db->query('SELECT phone FROM contact_phone
										where contact_id = '.$contact['id']) as $row) {
			    $realty[0]['contacts'][$key]['phones'][] = $row;
				}
			}

			return $realty;
		}

		public function getSimilar($city){

			//excutes the query and loops the result, get similar realties by the city emails, also get the contact data and one image
			foreach($this->db->query('SELECT realty.id as id, realty.city as city, realty_type.title as title, 
										A.img_file as img_file, B.phone as phone, B.name as name
										from realty
										inner join realty_type 
										on realty.type= realty_type.id
										left join 
										( 
											SELECT B.img_file as img_file, B.realty_id as realty_id
											FROM
											(select realty.id from realty where realty.city like "%'.$city.'%") A
											LEFT JOIN
											(select img_file, realty_id from realty_gallery) B 
											on A.id = B.realty_id
											GROUP BY realty_id
										) A on A.realty_id = realty.id
										LEFT join
										(
											SELECT A.realty_id as realty_id, A.name as name,contact_phone.phone as phone FROM
										    (
											SELECT * FROM realty_contact
										    inner join contact on contact.id = realty_contact.realty_contact
										    GROUP BY realty_contact.realty_id
										    ) A
										    INNER JOIN
										    contact_phone on A.realty_contact = contact_phone.contact_id
										    GROUP BY A.realty_contact
										)B on B.realty_id = realty.id
										where realty.city like "%'.$city.'%"') as $row) {
			    $realty[] = $row;
			}
			return $realty;
		}
	}
?>