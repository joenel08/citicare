<?php
session_start();
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Manila");
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
class Action
{
	private $db;
	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		extract($_POST);


		// Only allow admin users to log in
		$login = 1;

		// Query to fetch user details
		$qry = $this->db->query("SELECT *, concat(firstname, ' ', lastname) as name FROM admin_users 
                     WHERE email = '" . $email . "' AND password = '" . md5($password) . "'");

		if ($qry->num_rows > 0) {
			$row = $qry->fetch_assoc();

			// Check if the user is verified
			if ($row['isVerified'] == 1) {
				// Store user details in session, excluding sensitive fields like 'password'
				foreach ($row as $key => $value) {
					if ($key != 'password' && !is_numeric($key)) {
						$_SESSION['login_' . $key] = $value;
					}
				}
				$_SESSION['login_type'] = $login;
				$_SESSION['login_view_folder'] = 'admin/';

				return 1;
			} else {
				return 3; // Account not verified
			}
		} else {
			return 2; // Invalid credentials
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:signin.php");
	}
	function login2()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM students where student_code = '" . $student_code . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['rs_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function save_user()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!empty($password)) {
			$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";

		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");
		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function signup()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass')) && !is_numeric($k)) {
				if ($k == 'password') {
					if (empty($v))
						continue;
					$v = md5($v);

				}
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";

		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set $data");

		} else {
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if ($save) {
			if (empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if (!in_array($key, array('id', 'cpass', 'password')) && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			$_SESSION['login_id'] = $id;
			if (isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
				$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}

	function update_user()
	{
		extract($_POST);
		$data = "";
		$type = array("", "users", "faculty_list", "student_list");
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'table', 'password')) && !is_numeric($k)) {

				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM {$type[$_SESSION['login_type']]} where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";

		}
		if (!empty($password))
			$data .= " ,password=md5('$password') ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO {$type[$_SESSION['login_type']]} set $data");
		} else {
			echo "UPDATE {$type[$_SESSION['login_type']]} set $data where id = $id";
			$save = $this->db->query("UPDATE {$type[$_SESSION['login_type']]} set $data where id = $id");
		}

		if ($save) {
			foreach ($_POST as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			if (isset($_FILES['img']) && !empty($_FILES['img']['tmp_name']))
				$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_system_settings()
	{
		extract($_POST);
		$data = '';
		foreach ($_POST as $k => $v) {
			if (!is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if ($_FILES['cover']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'], '../assets/uploads/' . $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE system_settings set $data where id =" . $chk->fetch_array()['id']);
		} else {
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if ($save) {
			foreach ($_POST as $k => $v) {
				if (!is_numeric($k)) {
					$_SESSION['system'][$k] = $v;
				}
			}
			if ($_FILES['cover']['tmp_name'] != '') {
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image()
	{
		extract($_FILES['file']);
		if (!empty($tmp_name)) {
			$fname = strtotime(date("Y-m-d H:i")) . "_" . (str_replace(" ", "-", $name));
			$move = move_uploaded_file($tmp_name, 'assets/uploads/' . $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path = explode('/', $_SERVER['PHP_SELF']);
			$currentPath = '/' . $path[1];
			if ($move) {
				return $protocol . '://' . $hostName . $currentPath . '/assets/uploads/' . $fname;
			}
		}
	}


	function save_student()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'cpass', 'password')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		if (!empty($password)) {
			$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM student_list where email ='$email' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", avatar = '$fname' ";

		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO student_list set $data");
		} else {
			$save = $this->db->query("UPDATE student_list set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}
	function delete_student()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM student_list where id = " . $id);
		if ($delete)
			return 1;
	}



	function approve_user()
	{
		$id = $_POST['id'];

		// Fetch user data
		$res = $this->db->query("SELECT first_name, middle_name, last_name, age FROM senior_citizens WHERE sc_id = $id");
		$row = $res->fetch_assoc();

		$fullName = strtoupper($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
		$age = $row['age'];
		$year = date("Y");

		// Count verified users
		$result = $this->db->query("SELECT COUNT(*) as total FROM senior_citizens WHERE is_verified = 1");
		$verifiedCount = $result->fetch_assoc()['total'] + 1;

		// Format ID number
		$idCardNo = $year . '-' . str_pad($verifiedCount, 2, '0', STR_PAD_LEFT);

		// Build QR code content
		$qrContent = "$fullName - $idCardNo - $age";

		// Define directory and filename
		$qrDir = 'assets/uploads/qrcodes';
		if (!file_exists($qrDir)) {
			mkdir($qrDir, 0755, true);
		}

		// Create a safe filename without the full path
		$safeFileName = preg_replace('/[^a-zA-Z0-9-.]/', '_', $qrContent);
		$qrFileName = "$safeFileName.png";

		// Define the full path for saving the file
		$fullPath = $qrDir . '/' . $qrFileName;

		// Generate QR code
		$qr = Builder::create()
			->writer(new PngWriter())
			->data($qrContent)
			->encoding(new Encoding('UTF-8'))
			->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
			->size(300)
			->margin(10)
			->build();

		// Save to file using the full path
		$qr->saveToFile($fullPath);

		// Update database with the filename only
		$stmt = $this->db->prepare("UPDATE senior_citizens SET is_verified = 1, idCard_no = ?, qr_code = ? WHERE sc_id = ?");
		$stmt->bind_param("ssi", $idCardNo, $qrFileName, $id);

		if ($stmt->execute()) {
			return 1;
		} else {
			echo "error";
		}
	}


	function approve_user_solo()
	{
		$id = $_POST['id'];

		// Fetch user data
		$res = $this->db->query("SELECT first_name, middle_name, last_name, age FROM solo_parent_applications WHERE spa_id = $id");
		$row = $res->fetch_assoc();

		$fullName = strtoupper($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
		$age = $row['age'];
		$year = date("Y");

		// Count verified users
		$result = $this->db->query("SELECT COUNT(*) as total FROM solo_parent_applications WHERE is_verified = 1");
		$verifiedCount = $result->fetch_assoc()['total'] + 1;

		// Format ID number
		$idCardNo = $year . '-' . str_pad($verifiedCount, 2, '0', STR_PAD_LEFT);

		// Build QR code content
		$qrContent = "$fullName - $idCardNo - $age";

		// Define directory and filename
		$qrDir = 'assets/uploads/qrcodes';
		if (!file_exists($qrDir)) {
			mkdir($qrDir, 0755, true);
		}

		// Create a safe filename without the full path
		$safeFileName = preg_replace('/[^a-zA-Z0-9-.]/', '_', $qrContent);
		$qrFileName = "$safeFileName.png";

		// Define the full path for saving the file
		$fullPath = $qrDir . '/' . $qrFileName;

		// Generate QR code
		$qr = Builder::create()
			->writer(new PngWriter())
			->data($qrContent)
			->encoding(new Encoding('UTF-8'))
			->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
			->size(300)
			->margin(10)
			->build();

		// Save to file using the full path
		$qr->saveToFile($fullPath);

		$datetimenow = date('Y-m-d H:i:s');
		// Update database with the filename only
		$stmt = $this->db->prepare("UPDATE solo_parent_applications SET is_verified = 1, idCard_no = ?, qr_code = ?, date_verified =? WHERE spa_id = ?");
		$stmt->bind_param("sssi", $idCardNo, $qrFileName, $datetimenow, $id);

		if ($stmt->execute()) {
			return 1;
		} else {
			echo "error";
		}
	}
	function save_news()
	{
		$n_id = $_POST['n_id'];
		$posted_by = $_SESSION['login_id'];
		$title = $_POST['title'];
		$pub_date = $_POST['pub_date'];
		$category = $_POST['category'];
		$content = $_POST['content'];
		$status = $_POST['status'];

		$uploadDir = 'assets/uploads/news_uploads/';
		$attachment = ''; // Will contain the new file path if uploaded

		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}

		// Handle file upload
		if (!empty($_FILES['attachment']['name'])) {
			$fileName = basename($_FILES['attachment']['name']);
			$attachment = $uploadDir . time() . "_" . $fileName;

			if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment)) {
				http_response_code(500);
				echo "File upload failed.";
				exit;
			}
		}

		if (empty($n_id)) {
			// INSERT mode
			$stmt = $this->db->prepare("INSERT INTO news_publications (added_by, news_title, pub_date, category, content, attachment, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("issssss", $posted_by, $title, $pub_date, $category, $content, $attachment, $status);
		} else {
			// UPDATE mode
			if (!empty($attachment)) {
				// Optionally delete old file
				$get_old = $this->db->query("SELECT attachment FROM news_publications WHERE n_id = $n_id");
				if ($get_old->num_rows > 0) {
					$old = $get_old->fetch_assoc();
					if (!empty($old['attachment']) && file_exists($old['attachment'])) {
						unlink($old['attachment']);
					}
				}

				// Update including new attachment
				$stmt = $this->db->prepare("UPDATE news_publications SET news_title=?, pub_date=?, category=?, content=?, attachment=?, status=? WHERE n_id=?");
				$stmt->bind_param("ssssssi", $title, $pub_date, $category, $content, $attachment, $status, $n_id);
			} else {
				// Update without changing the attachment
				$stmt = $this->db->prepare("UPDATE news_publications SET news_title=?, pub_date=?, category=?, content=?, status=? WHERE n_id=?");
				$stmt->bind_param("sssssi", $title, $pub_date, $category, $content, $status, $n_id);
			}
		}

		if ($stmt->execute()) {
			// echo "Success";
		} else {
			http_response_code(500);
			echo "Database operation failed: " . $stmt->error;
		}

		$stmt->close();
	}
	function delete_news()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM news_list where n_id = " . $id);
		if ($delete)
			return 1;
	}

	function delete_senior_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM senior_citizens where sc_id = " . $id);
		if ($delete)
			return 1;
	}

	

	function delete_soloparent_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM solo_parent_applications where spa_id = " . $id);
		if ($delete)
			return 1;
	}

	function save_announcement()
	{
		$a_id = $_POST['a_id'];
		$posted_by = $_SESSION['login_id'];
		$title = $_POST['title'];
		$pub_date = $_POST['pub_date'];
		$category = $_POST['category'];
		$content = $_POST['content'];
		$status = $_POST['status'];

		$uploadDir = 'assets/uploads/news_uploads/';
		$attachment = ''; // Will contain the new file path if uploaded

		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}

		// Handle file upload
		if (!empty($_FILES['attachment']['name'])) {
			$fileName = basename($_FILES['attachment']['name']);
			$attachment = $uploadDir . time() . "_" . $fileName;

			if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment)) {
				http_response_code(500);
				echo "File upload failed.";
				exit;
			}
		}

		if (empty($a_id)) {
			// INSERT mode
			$stmt = $this->db->prepare("INSERT INTO announcement_publications (added_by, announcement_title, pub_date, category, content, attachment, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("issssss", $posted_by, $title, $pub_date, $category, $content, $attachment, $status);
		} else {
			// UPDATE mode
			if (!empty($attachment)) {
				// Optionally delete old file
				$get_old = $this->db->query("SELECT attachment FROM announcement_publications WHERE a_id = $a_id");
				if ($get_old->num_rows > 0) {
					$old = $get_old->fetch_assoc();
					if (!empty($old['attachment']) && file_exists($old['attachment'])) {
						unlink($old['attachment']);
					}
				}

				// Update including new attachment
				$stmt = $this->db->prepare("UPDATE announcement_publications SET announcement_title=?, pub_date=?, category=?, content=?, attachment=?, status=? WHERE a_id=?");
				$stmt->bind_param("ssssssi", $title, $pub_date, $category, $content, $attachment, $status, $a_id);
			} else {
				// Update without changing the attachment
				$stmt = $this->db->prepare("UPDATE announcement_publications SET announcement_title=?, pub_date=?, category=?, content=?, status=? WHERE a_id=?");
				$stmt->bind_param("sssssi", $title, $pub_date, $category, $content, $status, $a_id);
			}
		}

		if ($stmt->execute()) {
			// echo "Success";
		} else {
			http_response_code(500);
			echo "Database operation failed: " . $stmt->error;
		}

		$stmt->close();
	}
	function delete_announcement()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM announcement_list where a_id = " . $id);
		if ($delete)
			return 1;
	}
	function save_assistance()
	{
		$assistance_id = $_POST['assistance_id'] ?? null;
		$category = $_POST['category'];
		$type = $_POST['assistance_type'];
		$date = $_POST['date'];
		$assistance_description = $_POST['assistance_description'];

		if (empty($assistance_id)) {
			// INSERT
			$stmt = $this->db->prepare("INSERT INTO assistance (category, assistance_type, assistance_description, date_given) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $category, $type, $assistance_description, $date);
		} else {
			// UPDATE
			$stmt = $this->db->prepare("UPDATE assistance SET category = ?, assistance_type = ?, assistance_description = ?, date_given = ? WHERE assistance_id = ?");
			$stmt->bind_param("ssssi", $category, $type, $assistance_description, $date, $assistance_id);
		}

		if ($stmt && $stmt->execute()) {
			echo "success";
		} else {
			echo "Error saving data.";
		}
	}
	function save_attendance()
	{
		$qr_data = $_POST['qr_data']; // Example: JDHHD JDJDU JDJDH - 2025-02 - 65
		$assistance_id = $_POST['assistance_id'];

		// Build full QR code path with .png
		$qr_full_path = 'assets/uploads/qrcodes/' . $qr_data . '.png';

		// Check if QR code exists
		$stmt = $this->db->prepare("SELECT user_id FROM senior_citizens WHERE qr_code = ?");
		$stmt->bind_param("s", $qr_full_path);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows === 0) {
			echo "not_found";
			return;
		}

		$row = $result->fetch_assoc();
		$user_id = $row['user_id'];
		$today = date('Y-m-d');

		// Check if already marked
		$check = $this->db->prepare("SELECT attendance_id FROM attendance WHERE user_id = ? AND assistance_id = ? AND date_marked = ?");
		$check->bind_param("iis", $user_id, $assistance_id, $today);
		$check->execute();
		$checkResult = $check->get_result();

		if ($checkResult->num_rows > 0) {
			echo "already_marked";
			return;
		}

		// Insert attendance
		$insert = $this->db->prepare("INSERT INTO attendance (user_id, assistance_id, date_marked) VALUES (?, ?, ?)");
		$insert->bind_param("iis", $user_id, $assistance_id, $today);

		if ($insert->execute()) {
			echo "success";
		} else {
			echo "error_saving";
		}
	}




}