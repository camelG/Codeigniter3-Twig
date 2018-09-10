<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginationmaker {

    public function make($get = [], $cnt = 1, $page = 1, $limit = 20, $start = 0){
		
		if( empty($get['page']) || (int)$get['page'] < 1 ){
			$get['page'] = $page;
		}
		
		if( empty($get['limit']) || (int)$get['limit'] < 1 ){
			$get['limit'] = $limit;
		}
		$data = $get;

		if((int)$get['page'] > 1){
			$data['start'] = ( (int)$get['page'] * (int)$get['limit'] ) - (int)$get['limit'];
		}else{
			$data['start'] = 0;
		}

		$data['pager'] = ceil( $cnt/(int)$get['limit'] ) ?: 1;
		unset($get['page']);
		$data['search_url'] = http_build_query($get);
		
		return $data;
    }
    
}