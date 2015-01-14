<?php
class modelFreelancers extends cmsModel {
	public function addCat($cats){		
		return $this->insert('freelancers_cats', $cats);
	}
	public function addUslug($cats){		
		return $this->insert('freelancers_uslugi', $cats);
	}
	public function getCat(){
		return $this->get('freelancers_cats');
	}
	public function getUslug($catid){
		  $this->filterEqual('cat_id', $catid);
		return $this->get('freelancers_uslugi');
	}
	public function deletUs($usid){	
		return $this->delete('freelancers_uslugi', $usid);
	}
	public function deletCat($catid){	
		foreach($this->getUslug($catid) as $us){
		    $this->deletUs($us['id']);
		}
		return $this->delete('freelancers_cats', $catid);
	}	
	public function addFreelancers($frel){		
		return $this->insert('freelancers', $frel);
	}
	public function addPortfolio($portf){		
		return $this->insert('freelancers_portfolio', $portf);
	}
	public function addUpPortfolio($portf){		
		return $this->insert('freelancers_portfoliofile', $portf);
	}
	public function getPortfolioPhoto($id){
		return $this->getItemById('freelancers_portfoliofile', $id);
	}
	public function deletePortfolioPhoto($id){
		$config = cmsConfig::getInstance();
		$portfolio = $this->getPortfolioPhoto($id);
		$images = self::yamlToArray($portfolio['fileimg']);
		if (is_array($images)){
			foreach($images as $path){
				@unlink( $config->upload_path . $path );
			}
		}
		$this->delete('freelancers_portfoliofile', $id);
	}
	public function getPortfolio($id){
		return $this->getItemById('freelancers_portfolio', $id);
	}
	public function deletePortfolio($id){
	        $this->filterEqual('portfolio_id', $id);
			$por=array();
		    $por= $this->get('freelancers_portfoliofile');
		    $this->resetFilters();
           		foreach ($por as $pr) {
                            $this->deletePortfolioPhoto($pr['id']);
	                }
			$this->delete('freelancers_portfolio', $id);
	}
	public function addotziv($dats){		
		return $this->insert('freelancers_otsiv', $dats);
	}	
	public function addUpOtvet($dats){		
		return $this->insert('freelancers_proektspez', $dats);
	}	
    public function getotziv($freelancid){ 
		$this->select("DATE_FORMAT( i.pubdate, '%d.%m.%Y' )", 'dates');				
        $this->select('u.avatar', 'user_avatar');
		$this->select('u.nickname', 'user_nickname');
	    $this->join('{users}', 'u', 'u.id = i.user_id');
	    $this->filterEqual('f_id', $freelancid);
	    $otsiv = $this->get('freelancers_otsiv');
		$this->resetFilters();
		return $otsiv;
	}
	public function getallotziv(){ 
		$this->select("DATE_FORMAT( i.pubdate, '%d.%m.%Y' )", 'dates');	
	    $this->join('freelancers', 'f', 'f.id = i.f_id');
		$this->select('uf.avatar', 'uf_avatar');
		$this->select('uf.nickname', 'uf_nickname');
	    $this->join('{users}', 'uf', 'uf.id = f.user_id');
	    
        $this->select('u.avatar', 'user_avatar');
		$this->select('u.nickname', 'user_nickname');
	    $this->join('{users}', 'u', 'u.id = i.user_id');
        $this->orderBy('i.pubdate', 'desc');		
	    $otsiv = $this->get('freelancers_otsiv');
		$this->resetFilters();
		$otsivs=array();
		 if($otsiv){
           foreach ($otsiv as $ot) {
		      $this->resetFilters();		   
		      $this->filterEqual('f_id', $ot['f_id']);
			  $this->filterEqual('tupe', 'o');		
		      $ot['ot'] = $this->getCount('freelancers_otsiv');		
		      $this->resetFilters();
              $this->filterEqual('f_id', $ot['f_id']);
		      $this->filterEqual('tupe', 'p');		
		      $ot['pr'] = $this->getCount('freelancers_otsiv');
		      $this->resetFilters();
			 $otsivs[]=$ot;
		   }
		 }
      
		return $otsivs;
	}
	public function getfrel($id){
		return $this->getItemById('freelancers', $id);
	}
	public function updatefrelans($id, $frelans){
		return $this->update('freelancers', $id, $frelans);
	}	
	public function editproekt($id, $proekt){
		return $this->update('freelancers_proekt', $id, $proekt);
	}		
    public function getuserfreelanc($userid){ 
		$this->resetFilters();
		$this->filterEqual('i.user_id', $userid);
		$frel = $this->getItem('freelancers');
		$this->resetFilters();
		return $frel;
	}
    public function getfreelancers($opt, $hom){ 
        $this->select('u.avatar', 'user_avatar');
		$this->select('u.nickname', 'user_nickname');
		$this->select('u.karma', 'user_karma');		
		$this->select('u.is_online', 'is_online');	
		$this->select('u.status_text', 'statu');			
		$this->select("DATE_FORMAT( u.date_log, '%d.%m.%Y' )", 'date_log');				
		$this->select("DATE_FORMAT( u.date_reg, '%d.%m.%Y' )", 'date_reg');				
	    $this->join('{users}', 'u', 'u.id = i.user_id');
		$this->select("IFNULL(c.name, '')", 'city_name');
        $this->select("IFNULL(c.id, 0)", 'city_id');
        $this->joinLeft('geo_cities', 'c', 'c.id = u.city');
        $this->select("COUNT(r.id)",  'portfolio');
        if($hom == 'f'){$this->joinLeft('freelancers_portfoliofile', 'r', 'i.id = r.user_id');}
        if($hom == 'z'){$this->joinLeft('freelancers_proekt', 'r', 'i.user_id = r.user_id');}
		$this->select("uc.name", 'cname');
        $this->joinLeft('freelancers_cats', 'uc', 'uc.id = i.cat_id');
        $this->select("uu.name", 'uname');
        $this->joinLeft('freelancers_uslugi', 'uu', 'uu.id = i.uslugi');
	 	$this->filterEqual('i.tupe', $hom);
	    $this->groupBy('i.id');   
        $this->orderBy('u.karma', 'desc');		
		
		$frels = $this->get('freelancers');
        $freelancer=array();
	    if($frels){
		  foreach ($frels as $frel) {
              $frel['hom'] = $freelancer['tupe'];
              if($hom == 'f'){				   
		          $this->filterEqual('user_id', $frel['id']);		
		          $frel['portfolio'] = $this->getCount('freelancers_portfoliofile');		
		          $this->resetFilters();
		       }
               if($hom == 'z'){				   
		          $this->filterEqual('user_id', $frel['user_id']);		
		          $frel['portfolio'] = $this->getCount('freelancers_proekt');
		          $this->resetFilters();
               }
		      $this->filterEqual('f_id', $frel['id']);
			  $this->filterEqual('tupe', 'o');		
		      $frel['ot'] = $this->getCount('freelancers_otsiv');		
		      $this->resetFilters();
              $this->filterEqual('f_id', $frel['id']);
		      $this->filterEqual('tupe', 'p');		
		      $frel['pr'] = $this->getCount('freelancers_otsiv');
		      $this->resetFilters();
              $frel['hom'] = $frel['tupe'];	  
              $frel['tupe'] = $this  -> tupefreelanc($frel['portfolio'], $hom, $opt);
              $freelancer[] = $frel;
		  }
		}
      return $freelancer;         
    }	
    public function getfreelanc($freelancid, $opt){ 
        $this->select('u.avatar', 'user_avatar');
		$this->select('u.nickname', 'user_nickname');
		$this->select('u.karma', 'user_karma');		
		$this->select('u.is_online', 'is_online');	
		$this->select('u.status_text', 'statu');					
		$this->select("DATE_FORMAT( u.date_log, '%d.%m.%Y' )", 'date_log');				
		$this->select("DATE_FORMAT( u.date_reg, '%d.%m.%Y' )", 'date_reg');				
	    $this->join('{users}', 'u', 'u.id = i.user_id');
		$this->select("IFNULL(c.name, '')", 'city_name');
        $this->select("IFNULL(c.id, 0)", 'city_id');
        $this->joinLeft('geo_cities', 'c', 'c.id = u.city');
        $this->select("uc.name", 'cname');
        $this->joinLeft('freelancers_cats', 'uc', 'uc.id = i.cat_id');
        $this->select("uu.name", 'uname');
        $this->joinLeft('freelancers_uslugi', 'uu', 'uu.id = i.uslugi');
		$freelancer = $this->getItemById('freelancers', $freelancid);
        $freelancer['hom'] = $freelancer['tupe'];
        if($freelancer['hom'] == 'f'){				   
		    $this->filterEqual('user_id', $freelancer['id']);		
		    $freelancer['portfolio'] = $this->getCount('freelancers_portfoliofile');		
		    $this->resetFilters();
		}
        if($freelancer['hom'] == 'z'){				   
		    $this->filterEqual('user_id', $freelancer['user_id']);		
		    $freelancer['portfolio'] = $this->getCount('freelancers_proekt');
		    $this->resetFilters();
        }
        $this->filterEqual('f_id', $freelancer['id']);
		$this->filterEqual('tupe', 'o');		
		$freelancer['ot'] = $this->getCount('freelancers_otsiv');		
	    $this->resetFilters();
        $this->filterEqual('f_id', $freelancer['id']);
		$this->filterEqual('tupe', 'p');		
	    $freelancer['pr'] = $this->getCount('freelancers_otsiv');
		$this->resetFilters();
        $freelancer['tupe'] = $this  ->   tupefreelanc($freelancer['portfolio'], $freelancer['hom'], $opt);
       return $freelancer;
	}
	 public function getAllPortfolios($count){ 
			$this->select("i.title", 'ftitle');
            $this->select("p.title", 'ptitle');
            $this->joinLeft('freelancers_portfolio', 'p', 'p.id = i.portfolio_id');
			$this->select("f.id", 'fid');
            $this->joinLeft('freelancers', 'f', 'f.id = p.spezid');
            $this->select('u.avatar', 'user_avatar');
		    $this->select('u.nickname', 'user_nickname');
	        $this->join('{users}', 'u', 'u.id = f.user_id');
		    $this->groupBy('i.id');   
            $this->limitPage(1,$count);		
		    $portfolios = $this->get('freelancers_portfoliofile');
		    $this->resetFilters();
       return $portfolios;
	 }
	 public function getportf($fid){ 
	             $port='';

	 		$this->filterEqual('spezid', $fid);
		    $port = $this->get('freelancers_portfolio');
		    $this->resetFilters();			
            $portfolios=array();
			if($port){
		      foreach ($port as $por) {
                  $this->filterEqual('portfolio_id', $por['id']);
		          $por['count'] = $this->getCount('freelancers_portfoliofile');
		          $this->resetFilters();
                  $this->filterEqual('portfolio_id', $por['id']);
			      $por['portf']=array();
		          $por['portf']= $this->get('freelancers_portfoliofile');
		          $this->resetFilters();
                  $ps[]=$por;
	          }
		   }
       return $ps;
    }
	public function tupefreelanc($portfolio, $hom, $opt){
       if($hom == 'f'){
           if( $portfolio < $opt['counttupe2']){ $tupf = $opt['tupe1'];}
           if( $portfolio >= $opt['counttupe2'] && $portfolio < $opt['counttupe3']){$tupf = $opt['tupe2'];}
           if( $portfolio >= $opt['counttupe3']){$tupf = $opt['tupe3'];}
       }
       if($hom == 'z'){
           if( $portfolio < $opt['zcounttupe2']){ $tupf = $opt['ztupe1'];}
           if( $portfolio >= $opt['zcounttupe2'] && $portfolio < $opt['zcounttupe3']){$tupf = $opt['ztupe2'];}
           if( $portfolio >= $opt['zcounttupe3']){$tupf = $opt['ztupe3'];}
       }
       return $tupf;
    }
	public function addproekts($proekts){		
		return $this->insert('freelancers_proekt', $proekts);
	}
	public function getproekts($uid = ''){ 
        $this->select('u.avatar', 'user_avatar');
		$this->select('u.nickname', 'user_nickname');
	    $this->join('{users}', 'u', 'u.id = i.user_id');
		$this->select("DATE_FORMAT( i.pubdate, '%d')", 'dya');				
		$this->select("DATE_FORMAT( i.pubdate, '%m.%y')", 'myar');	
		$this->select("uc.name", 'cname');
        $this->joinLeft('freelancers_cats', 'uc', 'uc.id = i.cat_id');
        $this->select("uu.name", 'uname');
        $this->joinLeft('freelancers_uslugi', 'uu', 'uu.id = i.uslugi');
        if($uid){$this->filterEqual('i.user_id', $uid);}
		$this->orderBy('i.pubdate', 'desc');		
		$pro = $this->get('freelancers_proekt');
        $this->resetFilters();
		if(!$pro){return;}
		foreach ($pro as $pr) {
		    $this->filterEqual('pro_id', $pr['id']);
		    $pr['coun'] = $this->getCount('freelancers_proektspez');
		    $this->resetFilters();
            $pr['chtml']  = strip_tags($pr['content']);
		  $proekts[] = $pr;
		}
	  return $proekts;
	}
	public function wereuser($userid){
		return $this->filterEqual('i.user_id', $userid);
	}
	public function getproekt($id){
		$this->select("DATE_FORMAT( i.pubdate, '%d.%m.%y')", 'pdate');		
        $this->select('COUNT(o.id)', 'coun');
	    $this->joinLeft('freelancers_proektspez', 'o', 'o.pro_id = i.id');
		$this->select("uc.name", 'cname');
        $this->joinLeft('freelancers_cats', 'uc', 'uc.id = i.cat_id');
        $this->select("uu.name", 'uname');
        $this->joinLeft('freelancers_uslugi', 'uu', 'uu.id = i.uslugi');	
	  return $this->getItemById('freelancers_proekt', $id);
	}
	public function getotvet($id, $opt){
		$this->resetFilters();
		$this->select('u.avatar', 'user_avatar');
		$this->select('u.nickname', 'user_nickname');
	    $this->join('{users}', 'u', 'u.id = i.user_id');
        $this->select('f.id', 'fid');
        $this->select('f.tupe', 'ftupe');
        $this->select('f.stat', 'fstat');
	    $this->joinLeft('freelancers', 'f', 'f.user_id = i.user_id');
		$this->select('COUNT(r.id)', 'portfolio');
	    $this->joinLeft('freelancers_portfoliofile', 'r', 'f.id = r.user_id');
		$this->select("DATE_FORMAT( i.pubdate, '%d.%m.%y')", 'pdate');		
		$this->select("DATE_FORMAT( i.pubdate, '%d')", 'dya');				
		$this->select("DATE_FORMAT( i.pubdate, '%m.%y')", 'myar');	
		$this->filterEqual('i.pro_id', $id);
		$this->orderBy('i.pubdate', 'desc');		
		$this->groupBy('i.id');   
		$pro = $this->get('freelancers_proektspez');
		$this->resetFilters();
		$pros = array();
        if(!$pro){return;}
		 foreach ($pro as $pr) {
		 if($pr['id']){
          $pr['ftupe'] = $this  ->   tupefreelanc($pr['portfolio'] , 'f', $opt);
		  $pros[] = $pr;
		  }
		}
		return $pros;
	}	
	public function getcountproekts(){
       return $this->getCount('freelancers_proekt');
    }
    public function getcountfreelancers($hom){
	   $this->filterEqual('i.tupe', $hom);
       return $this->getCount('freelancers');
    }	
	public function deleteProectOtvet($id){
		return $this->delete('freelancers_proektspez', $id);
    }	
	public function deleteProect($id){
		$this->resetFilters();	
		$this->filterEqual('i.pro_id', $id);		
		 foreach ($this->get('freelancers_proektspez') as $pr) {
		    $this->deleteProectOtvet($pr['id']);
		 }
		$this->resetFilters();
		return $this->delete('freelancers_proekt', $id);		 
    }	
	public function deleteFreelancer($id){
	    $frel = $this->getfrel($id);
		$this->resetFilters();		
		if($frel['tupe']=='f'){
		$this->filterEqual('i.spezid', $frel['id']);	
         if($this->get('freelancers_portfolio')){		
		 foreach ($this->get('freelancers_portfolio') as $pp) {
             $this->deletePortfolio($pp['id']);
         }	
		 }
		$this->resetFilters();		 
		}
		if($frel['tupe']=='z'){
		$this->filterEqual('i.user_id', $frel['user_id']);		
		 foreach ($this->get('freelancers_proekt') as $pp) {
             $this->deleteProect($pp['id']);
         }	
		$this->resetFilters();		 
		}
		if($this->getotziv($id)){
		 foreach ($this->getotziv($id) as $po) {
		    $this->delete('freelancers_otsiv', $po['id']);
		 }
		 }
		return $this->delete('freelancers', $id);		
	}
	
}