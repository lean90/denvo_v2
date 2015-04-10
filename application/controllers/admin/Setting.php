<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Setting extends MY_Controller {
	function __construct() {
		parent::__construct ();
	}
	function ShowPage() {
		$dataView = array ();
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'BANNER';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['banners'] = $results;
		
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'BANNER_MOBILE';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['mobile_banners'] = $results;
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'BANNER-URL';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['bannerUrls'] = $results;
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'HOME-VIDEO';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['homeVideo'] = $results [0];
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'KIEN-THUC-CHUNG';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['gk'] = $results;
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'SAN-PHAM';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['products'] = $results;
		
		$settingRepository = new SettingRepository ();
		$settingRepository->key = 'GAME';
		$results = $settingRepository->getMutilCondition ();
		$dataView ['games'] = $results;
		
		LayoutFactory::getLayout ( LayoutFactory::MAIN_ADMIN )->setData ( $dataView )->setTitles ( 'Cấu hình hệ thống' )->render ( 'admin/setting' );
	}
	function SaveGame() {
		$settingRepository = new SettingRepository ();
		$settingRepository->id = 7;
		$settingRepository->value = $this->input->post ( 'game-1' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 8;
		$settingRepository->value = $this->input->post ( 'game-2' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 9;
		$settingRepository->value = $this->input->post ( 'game-3' );
		$settingRepository->updateById ();
		
		redirect ( '/__admin/setting' );
	}
	function SaveProduct() {
		$settingRepository = new SettingRepository ();
		$settingRepository->id = 4;
		$settingRepository->value = $this->input->post ( 'product-1' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 5;
		$settingRepository->value = $this->input->post ( 'product-2' );
		$settingRepository->updateById ();
		
		redirect ( '/__admin/setting' );
	}
	function SaveGeneralKnowledge() {
		$settingRepository = new SettingRepository ();
		$settingRepository->id = 1;
		$settingRepository->value = $this->input->post ( 'gk-1' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 2;
		$settingRepository->value = $this->input->post ( 'gk-2' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 3;
		$settingRepository->value = $this->input->post ( 'gk-3' );
		$settingRepository->updateById ();
		redirect ( '/__admin/setting' );
	}
	function SaveHomeVideo() {
		$settingRepository = new SettingRepository ();
		$settingRepository->id = 16;
		$settingRepository->value = $this->input->post ( 'home-video' );
		$settingRepository->updateById ();
		redirect ( '/__admin/setting' );
	}
	function SaveBannerUrl() {
		$settingRepository = new SettingRepository ();
		$settingRepository->id = 13;
		$settingRepository->value = $this->input->post ( 'banner-1' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 14;
		$settingRepository->value = $this->input->post ( 'banner-2' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 15;
		$settingRepository->value = $this->input->post ( 'banner-3' );
		$settingRepository->updateById ();
		
		
		redirect ( '/__admin/setting' );
	}
	function SaveBanner() {
		$settingRepository = new SettingRepository ();
		
		$settingRepository->id = 10;
		$settingRepository->value = $this->SaveOneBanner ( 'banner-1' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 11;
		$settingRepository->value = $this->SaveOneBanner ( 'banner-2' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 12;
		$settingRepository->value = $this->SaveOneBanner ( 'banner-3' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 1001;
		$settingRepository->value = $this->SaveOneBanner( 'mobile-banner-1' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 1002;
		$settingRepository->value = $this->SaveOneBanner( 'mobile-banner-2' );
		$settingRepository->updateById ();
		
		$settingRepository->id = 1003;
		$settingRepository->value = $this->SaveOneBanner( 'mobile-banner-3' );
		
		$settingRepository->updateById ();
		
		redirect ( '/__admin/setting' );
	}
	
	private function SaveOneBanner($bannerName) {
		$fileAvatar = null;
		$files = isset ( $_FILES [$bannerName] ) && ! empty ( $_FILES [$bannerName] ) ? $_FILES [$bannerName] : $this->input->post ( $bannerName . '-hidden' );
		
		if (gettype ( $files ) == 'array' && $files ['size'] > 0) {
			$fileAvatar = $this->SaveBannerToImages ( $files );
		}
		return $fileAvatar;
	}
	
	private function SaveBannerToImages($files) {
		$fileRepository = new FileRepository ();
		$fileModel = new FileService ();
		$fileID = null;
		try {
			if (isset ( $files ['name'] )) {
				$fileInfo = $files;
				if (! $fileInfo ['name'] || ! is_uploaded_file ( $fileInfo ['tmp_name'] ) || ! file_exists ( $fileInfo ['tmp_name'] )) {
					return;
				}
				list ( $imgWidth, $imgHeight, $imgType, $imgAttr ) = getimagesize ( $fileInfo ['tmp_name'] );
				$fileID = $fileModel->handleImageUpload ( $fileInfo, $fileRepository );
			}
		} catch ( Exception $e ) {
			throw $e;
		}
		return $fileID;
	}
}