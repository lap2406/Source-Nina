<?php 
include "ajax_config.php";
switch($_POST['act'])
{
	case 'dang-nhap':
	checkIsLogin();
	login();
	break;
	case 'dang-ky':
	checkIsLogin();
	signup();	
	break;
	case 'quen-mat-khau':
	doimatkhau_user();	
	break;
	case 'dang-xuat':		
	logout();
	break;
	default:
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit();
}
function login(){
	global $d,$stt,$msg,$success,$func,$error,$login_member;
	if($func->isAjaxRequest()){


		$error = array();
		$error['stt'] = false;
		$error['input'] = false;

		if(isset($_POST['ghinho'])){
			setcookie("email_user",$_POST['email'],time() + 3600);
			setcookie("password_user",$_POST['password'],time() + 3600);
		}
		$email = (isset($_POST['acount'])) ? htmlspecialchars($_POST['acount']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$remember = (isset($_POST['remenber_pass'])) ? htmlspecialchars($_POST['remenber_pass']) : false;
		$passwordMD5 = md5($password);

		if($email==""){
			$error['data']['email'] = "Bạn chưa nhập email";
			$error['stt'] = 1;
			$error['input'] = true;

		}
		if($password==""){
			$error['data']['password'] = "Bạn chưa nhập mật khẩu";
			$error['stt'] = 1;
			$error['input'] = true;

		}
		if(isset($email)){
			$row=$d->rawQueryOne("select id, password, username, dienthoai, diachi, email, ten,hienthi from #_member where email = ? ",array($email));
		}else{
			$row=$d->rawQueryOne("select id, password, username, dienthoai, diachi, email, ten,hienthi from #_member where username = ? ",array($email));
		}

		
		if($row['id']==0){
			$error['stt'] = 1;
			$error['msg'] = "Tài khoản không tồn tại";
		}else{


			if($row['password'] == $passwordMD5){
				if(!$row['hienthi']){
					$error['stt'] = 1;
					$error['msg'] = "Tài khoản chưa được kích hoạt";				
				}else{

					$success = "Đăng nhập thành công";

					/* Tạo login session */
					$id_user = $row['id'];
					$lastlogin = time();
					$login_session = md5($row['password'].$lastlogin);
					$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));

					/* Lưu session login */
					$_SESSION[$login_member]['active'] = true;
					$_SESSION[$login_member]['id'] = $row['id'];
					$_SESSION[$login_member]['username'] = $row['username'];
					$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
					$_SESSION[$login_member]['diachi'] = $row['diachi'];
					$_SESSION[$login_member]['email'] = $row['email'];
					$_SESSION[$login_member]['ten'] = $row['ten'];
					$_SESSION[$login_member]['login_session'] = $login_session;

					/* Nhớ mật khẩu */
					setcookie('login_member_id',"",-1,'/');
					setcookie('login_member_session',"",-1,'/');
					if($remember)
					{
						$time_expiry = time()+3600*24;
						setcookie('login_member_id',$row['id'],$time_expiry,'/');
						setcookie('login_member_session',$login_session,$time_expiry,'/');
					}

				}
			}else{
				$error['stt'] = 1;
				$error['msg'] = "Tài khoản hoặc mật khẩu của bạn không chính xác";

			}

		}
		echo json_encode(array("error"=>$error,"success"=>$success));

		die();
	}

}
function signup(){
	global $d,$error,$success,$config_base,$func,$emailer;

	if($func->isAjaxRequest()){


		$error = array();
		$error['stt'] = false;
		$fullname = (isset($_POST['fullname'])) ? htmlspecialchars($_POST['fullname']) : '';
		$phone = (isset($_POST['phone'])) ? htmlspecialchars($_POST['phone']) : '';
		$email = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : '';
		$maxacnhan = $func->digitalRandom(0,3,6);

		if($fullname==""){
			$error['data']['fullname'] = "Bạn chưa nhập họ và tên";
			$error['stt'] = 1;
		}
		if(!$error['stt']){
			if(!Checknumber($phone)){
				$error['data']['phone'] = "Điện thoại phải là số";
				$error['stt'] = 1;
			}
		}
		if(!$error['stt']){
			$row =$d->rawQueryOne("select id from #_member where email ='".$email."'");
			if($row['id']){
				$error['data']['email'] = "Email đã tồn tại";
				$error['stt'] = 1;
			}

		}
		if(!$error['stt']){
			if(strlen($password) < 8){
				$error['data']['password'] = "Mật khẩu phải lớn hơn 8 ký tự";
				$error['stt'] = 1;
			}
		}


		if(!$error['stt']){
			$data['ten'] =$fullname;
			$data['password'] = md5($password);
			$data['email'] = $email;
			$data['dienthoai'] = (isset($_POST['phone'])) ? htmlspecialchars($_POST['phone']) : 0;
			$data['maxacnhan'] = $maxacnhan;
			$data['hienthi'] = 0;
			
			if($d->insert('member',$data))
			{
				$success = "Đăng ký tài khoản thành công với email: "." ".$email."";
				send_active_user($email);

			}


		}	
		echo json_encode(array("error"=>$error,"success"=>$success));
		die;
	}
}
function doimatkhau_user()
{
	global $d, $setting, $emailer, $func, $login_member, $config_base, $lang,
	$error,$success;


	$email = (isset($_POST['forgot_email'])) ? htmlspecialchars($_POST['forgot_email']) : '';
	$newpass = substr(md5(rand(0,999)*time()), 15, 6);
	$newpassMD5 = md5($newpass);

	$error = array();
	$error['stt'] = false;

	if($email!=""){
		/* Kiểm tra username và email */
		$row = $d->rawQueryOne("select id from #_member where email = ? or dienthoai= ?  limit 0,1",array($email,$email));
		if(!$row['id']){
			$error['data']['email']="Tài khoản không tồn tại";
			$error['stt']=1;
		}else{
			/* Cập nhật mật khẩu mới */
			$data['password'] = $newpassMD5;
			$d->where('username', $username);
			$d->where('email', $email);
			$d->update('member',$data);

			/* Lấy thông tin người dùng */
			$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where email = ? or dienthoai=? limit 0,1",array($email,$email));

			/* Gán giá trị gửi email */
			$iduser = $row['id'];
			$tendangnhap = $row['email'];
			$matkhau = $row['password'];
			$tennguoidung = $row['ten'];
			$emailnguoidung = $row['email'];
			$dienthoainguoidung = $row['dienthoai'];
			$diachinguoidung = $row['diachi'];

			/* Thông tin đăng ký */
			$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>Mật khẩu: *******'.substr($matkhau,-3).'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
			if($tennguoidung)
			{
				$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
			}

			if($emailnguoidung)
			{
				$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
			}

			if($diachinguoidung)
			{
				$thongtindangky.=$diachinguoidung.'<br>';
			}

			if($dienthoainguoidung)
			{
				$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
			}

			$contentMember = '
			<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
			<tbody>
			<tr>
			<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
			<tbody>
			<tr>
			<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
			<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
			<tbody>
			<tr>
			<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
			<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
			<table style="width:100%;">
			<tbody>
			<tr>
			<td>
			<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
			</td>
			<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			<tr style="background:#fff">
			<td align="left" height="auto" style="padding:15px" width="600">
			<table>
			<tbody>
			<tr>
			<td>
			<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào Quý khách</h1>
			<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Yêu cầu cung cấp lại mật khẩu của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Quý khách vui lòng xác nhận vào đường dẫn phía dưới để được cấp mấtu khẩu mới.</p>
			<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
			</td>
			</tr>
			<tr>
			<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<thead>
			<tr>
			<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
			<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
			</tr>
			</thead>
			<tbody>
			<tr>'.$thongtindangky.'</tr>
			</tbody>
			</table>
			</td>
			</tr>
			<tr>
			<td>
			<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng thay đổi mật khẩu ngay khi đăng nhập bằng mật khẩu mới bên dưới.</i>
			<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">Mật khẩu mới: '.$newpass.'</p></div>
			</p>
			</td>
			</tr>
			<tr>
			<td>&nbsp;
			<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, hoặc gọi về hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
			</td>
			</tr>
			<tr>
			<td>&nbsp;
			<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa '.$emailer->getEmail('company:website').' cảm ơn quý khách.</p>
			<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			<tr>
			<td align="center">
			<table width="600">
			<tbody>
			<tr>
			<td>
			<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã liên hệ tại '.$emailer->getEmail('company:website').'.<br>
			Để chắc chắn luôn nhận được email thông báo, phản hồi từ '.$emailer->getEmail('company:website').', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
			<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>';

			/* Send email admin */
			$arrayEmail = array(
				"dataEmail" => array(
				//"name" => $tennguoidung,
					"email" => $email
				)
			);
			$subject = "Thư cấp lại mật khẩu từ ".$setting['ten'.$lang];
			$message = $contentMember;
			$file = '';
			$success="Cấp lại mật khẩu thành công";
			if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file))
			{
				unset($_SESSION[$login_member]);
				setcookie('login_member_id',"",-1,'/');
				setcookie('login_member_session',"",-1,'/');

			}

		}

		
	}else{
		$error['data']['email'] = "Bạn chưa nhập email";
		$error['stt'] = 1;

	}
	echo json_encode(array("error"=>$error,"success"=>$success));
	die;

}
function send_active_user($email)
{

	global $d, $setting, $emailer, $func, $config_base, $lang;

	/* Lấy thông tin người dùng */
	$row = $d->rawQueryOne("select id, maxacnhan, username, password, ten, email, dienthoai, diachi from #_member where email = ? limit 0,1",array($email));
	/* Gán giá trị gửi email */
	$iduser = $row['id'];
	$maxacnhan = $row['maxacnhan'];
	$tendangnhap = $row['email'];
	$matkhau = $row['password'];
	$tennguoidung = $row['ten'];
	$emailnguoidung = $row['email'];
	$dienthoainguoidung = $row['dienthoai'];
	$diachinguoidung = $row['diachi'];
	$linkkichhoat = $config_base."account/kich-hoat?id=".$iduser;

	/* Thông tin đăng ký */
	$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:normal">Username: '.$tendangnhap.'</span><br>Mật khẩu: *******'.substr($matkhau,-3).'<br>Mã kích hoạt: '.$maxacnhan.'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	if($tennguoidung)
	{
		$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
	}
	if($emailnguoidung)
	{
		$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
	}
	if($diachinguoidung)
	{
		$thongtindangky.=$diachinguoidung.'<br>';
	}
	if($dienthoainguoidung)
	{
		$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
	}

	$contentMember = '
	<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
	<tr>
	<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
	<tbody>
	<tr>
	<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
	<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
	<tbody>
	<tr>
	<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
	<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
	<div style="display:flex;justify-content:space-between;align-items:center;">
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
	</td>
	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
	</tr>
	</tbody>
	</table>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr style="background:#fff">
	<td align="left" height="auto" style="padding:15px" width="600">
	<table>
	<tbody>
	<tr>
	<td>
	<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách đã đăng ký tại '.$emailer->getEmail('company:website').'</h1>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Thông tin tài khoản của quý khách đã được '.$emailer->getEmail('company:website').' cập nhật. Quý khách vui lòng kích hoạt tài khoản bằng cách truy cập vào đường link phía dưới.</p>
	<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">Thông tin tài khoản <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(Ngày '.date('d',$emailer->getEmail('datesend')).' tháng '.date('m',$emailer->getEmail('datesend')).' năm '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
	</td>
	</tr>
	<tr>
	<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin tài khoản</th>
	<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin người dùng</th>
	</tr>
	</thead>
	<tbody>
	<tr>'.$thongtindangky.'</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Quý khách vui lòng truy cập vào đường link phía dưới để hoàn tất quá trình đăng ký tài khoản.</i>
	<div style="margin:auto"><a href="'.$linkkichhoat.'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">Kích hoạt tài khoản</a></div>
	</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, hoặc gọi về hotline <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa '.$emailer->getEmail('company:website').' cảm ơn quý khách.</p>
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center">
	<table width="600">
	<tbody>
	<tr>
	<td>
	<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã đăng ký tại '.$emailer->getEmail('company:website').'.<br>
	Để chắc chắn luôn nhận được email thông báo, phản hồi từ '.$emailer->getEmail('company:website').', quý khách vui lòng thêm địa chỉ <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
	<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>';

	/* Send email admin */
	$arrayEmail = array(
		"dataEmail" => array(
				//"name" => $row['username'],
			"email" => $row['email']
		)
	);
	$subject = "Thư kích hoạt tài khoản thành viên từ ".$setting['ten'.$lang];
	$message = $contentMember;
	$file = '';

	$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file);

}
function logout()
{
	global $d, $func, $login_member, $config_base,$success;

	unset($_SESSION[$login_member]);
	setcookie('login_member_id',"",-1,'/');
	setcookie('login_member_session',"",-1,'/');
	$success=1;
	echo json_encode($success);die;
}
function Checknumber($phone){
	$flag=true;
	if(!preg_match("/^[\+0-9\-\(\)\s]*$/", $phone)){

		$flag=false;
	}
	return $flag;
}
function checkIsLogin(){
	global $login_member,$config_base,$func;

	if(count($_SESSION[$login_member]['id'])>0){
		$func->redirect($config_base);
	}
}
?>