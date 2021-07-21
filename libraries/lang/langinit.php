<?php
	$columnarr = array(
		"ten"=>'TEXT',
		"mota"=>'TEXT',
		"noidung"=>'TEXT'
	);

	$columnLang = array(
		"lang"=>"TEXT"
	);

	$columnSeo = array(
		"title"=>'TEXT',
		"keywords"=>'TEXT',
		"description"=>'TEXT'
	);

	$columnsetting = array(
		"ten"=>'TEXT'
	);
	
	$table_name=array('product_list','product_cat','product_item','product_sub','product_brand','product','news_list','news_cat','news_item','news_sub','news','photo','static');

	$table_seo=array('seopage','seo');

	$table_setting=array('setting','product_size','product_mau');

	function createLangInit()
	{
		global $config, $d, $columnarr, $columnLang,$columnSeo,$table_seo,$table_name,$columnsetting,$table_setting;

		foreach ($table_seo as $vat ) { 
			foreach($config['website']['lang'] as $klang => $vlang)
			{
				foreach($columnSeo as $kcol => $vcol)
				{
					$col = $kcol.$klang;
					$table='#_'.$vat;
					$rowcol = $d->rawQueryOne("show columns from $table like '$col'");

					if($rowcol==null) $d->rawQuery("alter table $table add $col $vcol character set utf8 collate utf8_unicode_ci ");
				}
			} 
		}

		foreach ($table_name as $vat ) { 
			foreach($config['website']['lang'] as $klang => $vlang)
			{
				foreach($columnarr as $kcol => $vcol)
				{
					$col = $kcol.$klang;
					$table='#_'.$vat;
					$rowcol = $d->rawQueryOne("show columns from $table like '$col'");

					if($rowcol==null) $d->rawQuery("alter table $table add $col $vcol character set utf8 collate utf8_unicode_ci ");
				}
			} 
		}

		foreach ($table_setting as $vat ) { 
			foreach($config['website']['lang'] as $klang => $vlang)
			{
				foreach($columnsetting as $kcol => $vcol)
				{
					$col = $kcol.$klang;
					$table='#_'.$vat;
					$rowcol = $d->rawQueryOne("show columns from $table like '$col'");

					if($rowcol==null) $d->rawQuery("alter table $table add $col $vcol character set utf8 collate utf8_unicode_ci ");
				}
			} 
		}

		foreach($config['website']['lang'] as $klang => $vlang)
		{
			foreach($columnLang as $kcol => $vcol)
			{
				$col = $kcol.$klang;
				$rowcol = $d->rawQueryOne("show columns from #_lang like '$col'");

				if($rowcol==null) $d->rawQuery("alter table #_lang add $col $vcol character set utf8 collate utf8_unicode_ci ");
			}
		}
		
		die("Thêm cột ngôn ngữ thành công.");
	}

	function deleteLangInit($lang)
	{
		if($lang!='')
		{
			global $config, $d, $columnarr, $columnSeo;

			foreach($config['website']['lang'] as $vlang)
			{
				foreach($columnSeo as $kcol => $vcol)
				{
					$col = $kcol.$lang;
					$row = $d->rawQueryOne("show columns from #_seo like '$col'");

					if($row!=null) $d->rawQuery("alter table #_seo drop $col");
				}
			}
			foreach($config['website']['lang'] as $vlang)
			{
				foreach($columnSeo as $kcol => $vcol)
				{
					$col = $kcol.$lang;
					$row = $d->rawQueryOne("show columns from #_seopage like '$col'");

					if($row!=null) $d->rawQuery("alter table #_seopage drop $col");
				}
			}
			
			die("Xóa cột ngôn ngữ thành công.");
		}
	}

	//createLangInit('ko');
	//deleteLangInit('ko');
?>