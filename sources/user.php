<?php
if(!defined('SOURCES')) die("Error");
$action = htmlspecialchars($match['params']['action']);
switch($action)
{
	case 'dang-nhap':
	$title_crumb = dangnhap;
	checkIsLogin();
	login();
	break;
	case 'dang-ky':
	checkIsLogin();
	signup();	
	break;
	case 'delete-tin':
	checkIsLogin();
	DeleteTin();
	break;
	case 'delete-photo':
	checkIsLogin();
	DeletePhoto();
	break;
	case 'dang-tin':
	if(!isset($_SESSION[$login_member]['active']) && !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	$template = "account/dangtin";
	PostTin();
	break;
	case 'tin-dang':
	if(!isset($_SESSION[$login_member]['active']) && !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	$template = "account/tindang";
	GetListTin();
	break;
	case 'don-hang':
	if(!isset($_SESSION[$login_member]['active']) && !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	$template = "account/donhang";
	GetListOrder();
	break;
	case 'sua-tin':
	if(!isset($_SESSION[$login_member]['active']) && !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	$template = "account/suatin";
	EditTin();
	PostTin();
	break;
	case 'doi-mat-khau':
	if(!isset($_SESSION[$login_member]['active']) && !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	changePass_user();	
	break;
	case 'quen-mat-khau':
	if(!isset($_SESSION[$login_member]['active']) && !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	quenmatkhau_user();	
	break;
	case 'kich-hoat':
	$title_crumb = kichhoat;
	$template = "account/kichhoat";
	if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transfer("Trang không tồn tại",$config_base, false);
	if(isset($_POST['kichhoat'])) active_user();
	break;
	case 'tai-khoan':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);
	$template = "account/thongtin";
	$title_crumb = capnhatthongtin;
	info_user();
	break;
	case 'dang-xuat':	
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transfer("Trang không tồn tại",$config_base, false);	
	logout();
	break;
	case 'load-district':
	district();
	break;
	case 'load-ward':
	ward();
	break;
	case 'update-status-order':
	update_status_order();
	break;
	default:
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit();
}

/* SEO */
$seo->setSeo('title',$title_crumb);

/* breadCrumbs */
if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs('',$title_crumb);
$breadcrumbs = $breadcr->getBreadCrumbs();
function update_status_order(){
	global $d,$success,$func;
	if($func->isAjaxRequest()){
		$id_cancel=(int)$_POST['id'];
		$madonhang=(int)$_POST['madonhang'];

		$order=$d->rawQuery("select id from #_order where id='".$madonhang."'");
		$data=array();
		if(count($order)>0){

			$data['cancel_order']=$id_cancel;
			$data['ngayhuy']=time();
			$data['tinhtrang']=5;
			$d->where("id",$madonhang);
			$d->update('order',$data);
			$success=1;
		}else{
			$success=0;
		}
	}
	echo json_encode(array("success"=>$success));die;
}
function DeleteTin(){
	global $d, $func, $config_base, $login_member,$lang,$success;
	
	if($func->isAjaxRequest()){
		$id=(int)$_POST['id'];
		$row=$d->rawQueryOne("select id from #_product where type=? and id=?",array("san-pham",$id));

		if($row['id']){
			$d->rawQuery("delete from #_product where id = ?",array($id));
			/* Xóa gallery */
			$rowphoto = $d->rawQuery("select id, photo from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',"product"));

			if(count($rowphoto))
			{
				foreach($rowphoto as $v)
				{
					$func->delete_file(UPLOAD_PRODUCT_L.$v['photo']);
				}

				$d->rawQuery("delete from #_gallery where id_photo = ? and kind = ? and com = ?",array($id,'man',"product"));
			}
			$success=1;
		}else{
			$success=0;
		}
	}
	echo json_encode(array("id"=>$id,"success"=>$success));die;

}
function DeletePhoto(){
	global $d, $func, $config_base, $login_member,$lang,$success;
	
	if($func->isAjaxRequest()){
		$id=(int)$_POST['id'];
		/* Xóa gallery */
		$rowphoto = $d->rawQuery("select id, photo from #_gallery where id= ? and kind = ? and com = ?",array($id,'man',"product"));
		
		if(count($rowphoto))
		{
			$d->rawQuery("delete from #_gallery where id= ? and kind = ? and com = ?",array($id,'man',"product"));
			$func->delete_file(UPLOAD_PRODUCT_L.$rowphoto['photo']);
			$success=1;
		}else{
			$success=0;
		}

		
	}
	echo json_encode(array("id"=>$id,"success"=>$success));die;

}
function GetListTin(){
	global $d, $func, $config_base, $login_member,$lang,$product,$curPage,$paging,$get_page,$row_detail;

	$iduser = $_SESSION[$login_member]['id'];
	$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi, avatar, ngaytao from #_member where id = ? limit 0,1",array($iduser));

	//lấy danh sách bất động sản
	$where = "";
	$where = "id_member = ? and type = ? and hienthi > 0";
	$params = array($_SESSION[$login_member]['id'],'san-pham');
	$curPage=$get_page;
	$per_page = 10;
	$startpoint = (int)($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select photo, ten$lang, tenkhongdauvi, tenkhongdauen, giamoi, gia, giakm, id, duyettin, mota$lang, masp from #_product where $where order by stt,id desc $limit";
	
	$product = $d->rawQuery($sql,$params);
	
	$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum,$params);
	$total = $count['num'];
	$url = $func->getCurrentPageURL();
	$paging = $func->pagination($total,$per_page,$curPage,$url);
	

}
function GetListOrder(){

	global $d, $func, $config_base, $login_member,$lang,$order,$curPage,$paging,$get_page,$row_detail,$dem_order_new,$dem_order_xn,$dem_order_dg,$dem_order_ht,$dem_order_h,$tab,$match,$template,$info_dateil,$cart,$httt,$tinhtrang;
	
	$iduser = $_SESSION[$login_member]['id'];
	$tab = htmlspecialchars($match['params']['tab']);
	$madonhang = htmlspecialchars($match['params']['madonhang']);
	$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi, avatar, ngaytao from #_member where id = ? limit 0,1",array($iduser));
	if($madonhang==""){
		if($tab==""){
			

		//lấy danh sách bất động sản
			$where = "";
			$where = "id_user = ? ";
			$params = array($iduser);
			$curPage=$get_page;
			$per_page = 10;
			$startpoint = (int)($curPage * $per_page) - $per_page;
			$limit = " limit ".$startpoint.",".$per_page;
			$sql = "select * from #_order where $where order by stt,id desc $limit";

			$order = $d->rawQuery($sql,$params);

			$sqlNum = "select count(*) as 'num' from #_order where $where order by stt,id desc";
			$count = $d->rawQueryOne($sqlNum,$params);
			$total = $count['num'];
			$url = $func->getCurrentPageURL();
			$paging = $func->pagination($total,$per_page,$curPage,$url);


		// lấy thông tin trạng thái đơn hàng 
			$dem_order_new=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=1 and id_user=?  order by id desc",array($iduser));


			$dem_order_xn=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=2 and id_user=? order by id desc",array($iduser));

			$dem_order_dg=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=3 and id_user=? order by id desc",array($iduser));

			$dem_order_ht=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=4 and id_user=? order by id desc",array($iduser));

			$dem_order_h=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=5 and id_user=? order by id desc",array($iduser));	
		}else{

		//lấy danh sách bất động sản
			$where = "";
			$where = "id_user = ? ";
			if($tab=='wait_confirm'){
				$where .=' and tinhtrang=1';

			}elseif($tab=='confirmed'){

				$where .=' and tinhtrang=2';

			}elseif($tab=='shipping'){

				$where .=' and tinhtrang=3';

			}elseif($tab=='finish'){

				$where .=' and tinhtrang=4';

			}else{

				$where .=' and tinhtrang=5';
			}
			$params = array($iduser);
			$curPage=$get_page;
			$per_page = 10;
			$startpoint = (int)($curPage * $per_page) - $per_page;
			$limit = " limit ".$startpoint.",".$per_page;
			$sql = "select * from #_order where $where order by stt,id desc $limit";

			$order = $d->rawQuery($sql,$params);

			$sqlNum = "select count(*) as 'num' from #_order where $where order by stt,id desc";
			$count = $d->rawQueryOne($sqlNum,$params);
			$total = $count['num'];
			$url = $func->getCurrentPageURL();
			$paging = $func->pagination($total,$per_page,$curPage,$url);


		// lấy thông tin trạng thái đơn hàng 
			$dem_order_new=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=1 and id_user=?  order by id desc",array($iduser));


			$dem_order_xn=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=2 and id_user=? order by id desc",array($iduser));

			$dem_order_dg=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=3 and id_user=? order by id desc",array($iduser));


			$dem_order_ht=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=4 and id_user=? order by id desc",array($iduser));

			$dem_order_h=$d->rawQueryOne("select count(id) as num from #_order where tinhtrang=5 and id_user=? order by id desc",array($iduser));	

		}
	}else{
		$order=$d->rawQueryOne("select id,tonggia,phiship,madonhang,ngaytao,tinhtrang,httt,cancel_order,hoten,dienthoai,email,diachi,district,city,ngayhuy from #_order where madonhang= ? and id_user=? ",array($madonhang,$iduser));
		if($order['id']!="" && $_SESSION[$login_member]['id']!=""){
			$info_dateil=$d->rawQuery("select id_product,gia,id_order,gia,soluong,photo,ten from #_order_detail where id_order='".$order['id']."' order by id desc");
			
			$httt = $d->rawQueryOne("select ten$lang from #_news where type = ? and id=? order by stt,id desc",array('hinh-thuc-thanh-toan',$order['httt']));

			$tinhtrang = $d->rawQueryOne("select trangthai from #_status where id=? ",array($order['tinhtrang']));

			$func->get_places("city",$city);
			$func->get_places("wards",$wards);

			include TEMPLATE.$template= "account/donhang_simple";
		}else{
			$func->transfer("Trang không tồn tại",$config_base, false);
		}
		
	}


}
function EditTin(){
	global $d, $func,$config_base, $login_member,$lang,$match,$row,$row_detail,$hinhanhsp;
	$id = htmlspecialchars($match['params']['id']);

	$row = $d->rawQueryOne("select id,masp,ten$lang,photo,mota$lang,gia,id_list,id_cat from #_product where masp = ? and type=? ",array($id,'san-pham'));

	$row_detail=$d->rawQueryOne("select * from #_option_bds where id_product = ? and type=? ",array($row['id'],'san-pham'));

	/* Lấy hình ảnh con */
	$hinhanhsp = $d->rawQuery("select photo,id,stt from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 order by stt,id desc",array($row['id'],"san-pham","san-pham"));
	
	
}
function PostTin(){
	global $d, $func, $city,$district,$ward, $config_base, $login_member,$success,$lang,$listbds;
	$city=$d->rawQuery("select ten,id from #_city where hienthi=1 order by stt,id desc");
	$district=$d->rawQuery("select ten,id from #_district where hienthi=1 order by stt,id desc");
	$ward=$d->rawQuery("select ten,id from #_wards where hienthi=1 order by stt,id desc");
	
	if(!empty($_POST)){
		
		$uploader = new Uploader();
		$data_img = $uploader->upload($_FILES['image_file'], array(
	        'limit' => 10, //Maximum Limit of files. {null, Number}
	        'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
	        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
	        'required' => false, //Minimum one file is required for upload {Boolean}
	        'uploadDir' => UPLOAD_PRODUCT_L, //Upload directory {String}
	        'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
	        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
	        'replace' => false, //Replace the file if it already exists  {Boolean}
	        'perms' => null, //Uploaded file permisions {null, Number}
	        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
	        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
	        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
	        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
	        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
	        'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
	    ));
		

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
		$data=array();
		$data1=array();
		/*thông tin bds*/
		$data['id_list'] = (isset($_POST['listingType'])) ? htmlspecialchars($_POST['listingType']) : 0;
		$data['id_cat'] = (isset($_POST['propertyType'])) ? htmlspecialchars($_POST['propertyType']) : 0;
		$data['tenvi'] = (isset($_POST['ten_vi'])) ? htmlspecialchars($_POST['ten_vi']) : '';
		$data['gia'] = (isset($_POST['price'])) ? htmlspecialchars(str_replace(",","",$_POST['price'])) : 0;
		$data['motavi'] = (isset($_POST['description'])) ? htmlspecialchars($_POST['description']) : '';
		
		/*end*/

		/*option bds*/
		$data_op['name_agent'] = (isset($_POST['name_agent'])) ? htmlspecialchars($_POST['name_agent']) : '';
		$data_op['phone_agent'] = (isset($_POST['phone_agent'])) ? htmlspecialchars($_POST['phone_agent']) : '';
		$data_op['email_agent'] = (isset($_POST['email_agent'])) ? htmlspecialchars($_POST['email_agent']) : 0;
		$data_op['id_city'] = (isset($_POST['city'])) ? htmlspecialchars($_POST['city']) : 0;
		$data_op['id_district'] = (isset($_POST['district'])) ? htmlspecialchars($_POST['district']) : 0;
		$data_op['id_wards'] = (isset($_POST['ward'])) ? htmlspecialchars($_POST['ward']) : 0;
		$data_op['houseNumber'] = (isset($_POST['houseNumber'])) ? htmlspecialchars($_POST['houseNumber']) : '';
		$data_op['fullAddress'] = (isset($_POST['fullAddress'])) ? htmlspecialchars($_POST['fullAddress']) : '';
		$data_op['contact_name'] = (isset($_POST['name'])) ? htmlspecialchars($_POST['name']) : '';
		$data_op['contact_phone'] = (isset($_POST['phone'])) ? htmlspecialchars($_POST['phone']) : '';
		$data_op['contact_email'] = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
		$data_op['request-type'] = (isset($_POST['request-type'])) ? htmlspecialchars($_POST['request-type']) : '';
		/*end*/
		
		if($_POST['requirePost']){
			
			if(isset($_FILES)){

				if($_FILES['upload-file']['name']){
					$file_name = $func->uploadName($_FILES['upload-file']["name"]);
					$data['photo'] =$func->uploadImage("upload-file", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG',UPLOAD_PRODUCT_L,$file_name);
					
				}

			}
			$data['id_member'] = $_SESSION[$login_member]['id'];
			$data['hienthi'] =1;
			$data['duyettin'] = 0;
			$data['type'] = "san-pham";
			$data['masp'] =$func->digitalRandom(1,10,8);
			
			if(!$id){
				$row=$d->rawQueryOne("select count(id) as stt from #_product order by id desc");
				$data['stt'] = $row['stt']+1;

				if($d->insert('product',$data)){
					$success = 1;

					

					$fetch =$d->rawQueryOne("select id from #_product where id_member = ".$_SESSION[$login_member]['id']." order by id desc");
					$data['ngaytao'] = time();
					$id = $fetch['id'];


					$data_op['id_product']=$id;
					$data_op['ngaytao']=time();
					$data_op['type']="san-pham";
					$d->insert("option_bds",$data_op);

					if(isset($data_img['data']['files'])) {
						foreach($data_img['data']['files'] as $k=>$v){

							$data_photo['photo']   = end(explode("/",$v));
							$data_photo['type'] = "san-pham";	
							$data_photo['com'] = "product";	
							$data_photo['kind'] = "man";	
							$data_photo['val'] = "san-pham";	
							$data_photo['id_photo'] = $id;
							$data_photo['hienthi'] = 1;
							$d->insert("gallery",$data_photo);
						}


					}

				}
				$func->transfer("Đăng tin thành công",$config_base."account/tin-dang");
			}else{

				$data['ngaysua'] = time();
				$d->where("id",$id);
				if($d->update('product',$data)){
					$success = 1;

					$data_op['ngaysua']=time();
					$data_op['type']="san-pham";	
					$d->where("id",$id);
					$d->update("option_bds",$data_op);

					if(isset($data_img['data']['files'])) {

						foreach($data_img['data']['files'] as $k=>$v){

							$data_photo['photo']   = end(explode("/",$v));
							$data_photo['type'] = "san-pham";	
							$data_photo['com'] = "product";	
							$data_photo['kind'] = "man";	
							$data_photo['val'] = "san-pham";
							$data_photo['id_photo'] = $id;
							$data_photo['hienthi'] = 1;
							$d->insert("gallery",$data_photo);
						}




					}
				}
				$func->transfer("Sửa tin thành công",$config_base."account/tin-dang");

			}
		}

		
	}
}
function district(){
	global $d,$func;
	if($func->isAjaxRequest()){
		$id=(int)$_POST['id'];
		$district=$d->rawQuery("select ten,id from #_district where id_city=? and hienthi=1 order by stt,id desc",array($id));
		echo json_encode($district);die;
	}
}
function ward(){
	global $d,$func;
	if($func->isAjaxRequest()){
		$id=(int)$_POST['id'];
		$ward=$d->rawQuery("select ten,id from #_wards where id_district=? and hienthi=1 order by stt,id desc",array($id));
		echo json_encode($ward);die;
	}
}	
function info_user()
{
	global $d, $func, $row_detail, $config_base, $login_member;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{

		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, diachi, avatar, ngaytao from #_member where id = ? limit 0,1",array($iduser));

		if(!empty($_POST))
		{


			$data['ten'] = (isset($_POST['ten'])) ? htmlspecialchars($_POST['ten']) : '';
			$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
			$data['dienthoai'] = (isset($_POST['dienthoai'])) ? htmlspecialchars($_POST['dienthoai']) : 0;
			$data['email'] = (isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
			$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/","-",htmlspecialchars($_POST['ngaysinh']))) : 0;
			$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
			if(isset($_FILES['avatar'])){

				$file_name = $func->uploadName($_FILES['avatar']["name"]);
				if($photo = $func->uploadImage("avatar", 'jpg|png|gif|JPG|jpeg|JPEG|Jpg|PNG', UPLOAD_PHOTO_L,$file_name))
				{

					$row = $d->rawQueryOne("select id, avatar from #_member where id = ? limit 0,1",array($iduser));
					if($row['id']) $func->delete_file(UPLOAD_PHOTO_L.$row['avatar']);
					$data['avatar'] = $photo;

				}
			}


			$d->where('id', $iduser);
			if($d->update('member',$data))
			{
				if($password)
				{
					unset($_SESSION[$login_member]);
					setcookie('login_member_id',"",-1,'/');
					setcookie('login_member_session',"",-1,'/');
					$func->transfer("Cập nhật thông tin thành công",$config_base."account/dang-nhap");
				}
				$func->transfer("Cập nhật thông tin thành công",$config_base."account/tai-khoan");	            
			}
		}
	}
	else
	{
		$func->transfer("Trang không tồn tại",$config_base, false);
	}
}

function active_user()
{
	global $d, $func, $row_detail, $config_base;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
	$maxacnhan = (isset($_POST['maxacnhan'])) ? htmlspecialchars($_POST['maxacnhan']) : '';

	/* Kiểm tra thông tin */
	$row_detail = $d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1",array($id));

	if(!$row_detail['id']) $func->transfer("Tài khoản của bạn chưa được kích hoạt",$config_base, false);
	else if($row_detail['hienthi']) $func->transfer("Tài khoản của bạn đã được kích hoạt",$config_base);
	else
	{
		if($row_detail['maxacnhan'] == $maxacnhan)
		{
			$data['hienthi'] = 1;
			$data['maxacnhan'] = '';
			$d->where('id', $id);
			if($d->update('member',$data)) $func->transfer("Kích hoạt tài khoản thành công.",$config_base."");
		}
		else
		{
			$func->transfer("Mã xác nhận không đúng. Vui lòng nhập lại mã xác nhận.",$config_base."account/kich-hoat?id=".$id, false);
		}
	}
}

function login(){
	global $d,$stt,$msg,$success,$func,$error,$login_member;
	if($func->isAjaxRequest()){


		$error = array();
		$error['stt'] = false;
		$error['input'] = false;

		if(isset($_POST['remenber_pass'])){
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
			$row=$d->rawQueryOne("select id, password, username, dienthoai, diachi, email, ten,hienthi,type from #_member where email = ? ",array($email));
		}else{
			$row=$d->rawQueryOne("select id, password, username, dienthoai, diachi, email, ten,hienthi,type from #_member where username = ? ",array($email));
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
					$_SESSION[$login_member]['type'] = $row['type'];
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
		$type = htmlspecialchars($_POST['procedureTypeId']);

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
			$data['type'] = $type;
			$data['dienthoai'] = $phone;
			$data['maxacnhan'] = $maxacnhan;
			$data['hienthi'] = 0;
			$data['ngaytao'] = time();

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

	if(!$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transfer("Có lỗi xảy ra trong quá trình kích hoạt tài khoản. Vui lòng liên hệ với chúng tôi.",$config_base."lien-he", false);
}

function quenmatkhau_user()
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
function changePass_user()
{
	global $d, $setting, $emailer, $func, $login_member, $config_base, $lang,
	$error,$success;
	$iduser=$_SESSION[$login_member]['id'];


	$error = array();
	$error['stt'] = false;
	$error['input'] = false;
	if(!empty($_POST)){

		$pass_old = (isset($_POST['user_pass_old'])) ? htmlspecialchars($_POST['user_pass_old']) : '';
		$pass_news = (isset($_POST['user_pass'])) ? htmlspecialchars($_POST['user_pass']) : '';
		$re_pass_news = (isset($_POST['user_repass'])) ? htmlspecialchars($_POST['user_repass']) : '';


		$newpassMD5 = md5($pass_news);

		/* Kiểm tra tài khoản có tồn tại hay ko */
		$row = $d->rawQueryOne("select id,email,dienthoai from #_member where id=?  limit 0,1",array($iduser));
		if(!$row['id']){
			$error['msg'] = "Tài khoản không tồn tại";
			$error['stt']=1;

		}
		if(!$error['stt']){
			$passwordMD5 = md5($pass_old);
			$new_passwordMD5 = md5($pass_news);
			$row_ = $d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1",array($iduser,$passwordMD5));
			if(!$row_['id']){
				$error['data']['pass_old'] = "Mật khẩu cũ không chính xác ";
				$error['stt']=1;
				$error['input'] = true;
			}


		}
		if(!$error['stt']){

			if($pass_news != $re_pass_news){
				$error['data']['re_pass_new'] = "Nhập lại mật khẩu không chính xác";
				$error['stt']=1;
				$error['input'] = true;
			}
		}

		if(!$error['stt']){

			/* Cập nhật mật khẩu mới */
			$data['password'] = $newpassMD5;
			$d->where('email', $row['email']);
			$d->update('member',$data);

			/* Lấy thông tin người dùng */
			$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai, diachi from #_member where email = ? or dienthoai=? limit 0,1",array($row['email'],$row['dienthoai']));

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
			<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">Mật khẩu mới: '.$pass_news.'</p></div>
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
					"email" => $row['email']
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
		$error['data']['pass_old'] = "Vui lòng nhập mật khẩu cũ";
		$error['stt'] = 1;

	}
	echo json_encode(array("error"=>$error,"success"=>$success));
	die;

}
function logout()
{
	global $d, $func, $login_member, $config_base,$success;

	unset($_SESSION[$login_member]);
	setcookie('login_member_id',"",-1,'/');
	setcookie('login_member_session',"",-1,'/');
	$func->redirect($config_base);

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
	if($_SESSION[$login_member]['id']!=""){
		return true;
	}else{
		return false;
	}
}
?>